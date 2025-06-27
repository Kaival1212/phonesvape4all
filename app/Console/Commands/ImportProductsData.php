<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\RepairService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportProductsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--file=products-backup.json} {--restore-images} {--clear-existing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products, categories, brands, variants, and repair services from a JSON backup file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->option('file');
        $restoreImages = $this->option('restore-images');
        $clearExisting = $this->option('clear-existing');

        $filePath = storage_path('app/backups/' . $filename);

        if (!File::exists($filePath)) {
            $this->error("❌ Backup file not found: {$filePath}");
            return Command::FAILURE;
        }

        $this->info("📂 Loading backup file: {$filename}");

        $jsonContent = File::get($filePath);
        $backupData = json_decode($jsonContent, true);

        if (!$backupData) {
            $this->error("❌ Invalid JSON format in backup file");
            return Command::FAILURE;
        }

        $this->info("✅ Backup file loaded successfully");
        $this->info("📅 Export date: {$backupData['export_date']}");
        $this->info("📊 Data summary:");
        $this->line("   - Categories: " . count($backupData['categories']));
        $this->line("   - Brands: " . count($backupData['brands']));
        $this->line("   - Products: " . count($backupData['products']));
        $this->line("   - Product Variants: " . count($backupData['product_variants']));
        $this->line("   - Repair Services: " . count($backupData['repair_services']));

        if ($clearExisting) {
            if ($this->confirm('⚠️  This will delete ALL existing product data. Are you sure?')) {
                $this->clearExistingData();
            } else {
                $this->info('Import cancelled.');
                return Command::SUCCESS;
            }
        }

        DB::beginTransaction();

        try {
            $this->importCategories($backupData['categories'], $restoreImages);
            $this->importBrands($backupData['brands'], $restoreImages);
            $this->importProducts($backupData['products'], $restoreImages);
            $this->importProductVariants($backupData['product_variants'], $restoreImages);
            $this->importRepairServices($backupData['repair_services'], $restoreImages);
            $this->importProductRepairServiceRelationships($backupData['product_repair_service_relationships']);

            DB::commit();

            $this->info("\n✅ Import completed successfully!");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ Import failed: " . $e->getMessage());
            $this->error("🔄 All changes have been rolled back.");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    private function clearExistingData()
    {
        $this->info('🗑️  Clearing existing data...');

        $driver = DB::getDriverName();

        // Handle different database drivers
        if ($driver === 'sqlite') {
            // For SQLite, use PRAGMA to disable foreign keys
            DB::statement('PRAGMA foreign_keys = OFF;');

            DB::table('product_repair_service')->delete();
            DB::table('repair_services')->delete();
            DB::table('product_variants')->delete();
            DB::table('products')->delete();
            DB::table('brands')->delete();
            DB::table('categories')->delete();

            DB::statement('PRAGMA foreign_keys = ON;');

        } else {
            // For MySQL and other databases
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            DB::table('product_repair_service')->truncate();
            RepairService::truncate();
            ProductVariant::truncate();
            Product::truncate();
            Brand::truncate();
            Category::truncate();

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $this->info('✅ Existing data cleared');
    }

    private function importCategories($categories, $restoreImages)
    {
        $this->info('📁 Importing categories...');

        foreach ($categories as $categoryData) {
            $imagePath = $categoryData['image'];

            if ($restoreImages && isset($categoryData['image_base64']) && $categoryData['image_base64']) {
                $imagePath = $this->restoreImage($categoryData['image_base64'], $categoryData['image']);
            }

            $category = Category::create([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
                'image' => $imagePath,
            ]);

            // Map old ID to new ID
            $this->idMappings['categories'][$categoryData['id']] = $category->id;
        }

        $this->line("   ✅ Imported " . count($categories) . " categories");
    }

    private function importBrands($brands, $restoreImages)
    {
        $this->info('🏷️  Importing brands...');

        foreach ($brands as $brandData) {
            $imagePath = $brandData['image'];

            if ($restoreImages && isset($brandData['image_base64']) && $brandData['image_base64']) {
                $imagePath = $this->restoreImage($brandData['image_base64'], $brandData['image']);
            }

            $brand = Brand::create([
                'category_id' => $this->idMappings['categories'][$brandData['category_id']],
                'name' => $brandData['name'],
                'slug' => $brandData['slug'],
                'image' => $imagePath,
            ]);

            // Map old ID to new ID
            $this->idMappings['brands'][$brandData['id']] = $brand->id;
        }

        $this->line("   ✅ Imported " . count($brands) . " brands");
    }

    private function importProducts($products, $restoreImages)
    {
        $this->info('📱 Importing products...');

        foreach ($products as $productData) {
            $imagePath = $productData['image'];

            if ($restoreImages && isset($productData['image_base64']) && $productData['image_base64']) {
                $imagePath = $this->restoreImage($productData['image_base64'], $productData['image']);
            }

            $product = Product::create([
                'category_id' => $this->idMappings['categories'][$productData['category_id']],
                'brand_id' => $this->idMappings['brands'][$productData['brand_id']],
                'name' => $productData['name'],
                'slug' => $productData['slug'],
                'image' => $imagePath,
                'description' => $productData['description'],
                'is_selling' => $productData['is_selling'],
                'is_repairable' => $productData['is_repairable'],
            ]);

            // Map old ID to new ID
            $this->idMappings['products'][$productData['id']] = $product->id;
        }

        $this->line("   ✅ Imported " . count($products) . " products");
    }

    private function importProductVariants($variants, $restoreImages)
    {
        $this->info('📦 Importing product variants...');

        foreach ($variants as $variantData) {
            $imagePath = $variantData['image'];

            if ($restoreImages && isset($variantData['image_base64']) && $variantData['image_base64']) {
                $imagePath = $this->restoreImage($variantData['image_base64'], $variantData['image']);
            }

            $variant = ProductVariant::create([
                'product_id' => $this->idMappings['products'][$variantData['product_id']],
                'variant_name' => $variantData['variant_name'],
                'price' => $variantData['price'],
                'sku' => $variantData['sku'],
                'image' => $imagePath,
            ]);

            // Map old ID to new ID
            $this->idMappings['product_variants'][$variantData['id']] = $variant->id;
        }

        $this->line("   ✅ Imported " . count($variants) . " product variants");
    }

    private function importRepairServices($services, $restoreImages)
    {
        $this->info('🔧 Importing repair services...');

        foreach ($services as $serviceData) {
            $imagePath = $serviceData['image'];

            if ($restoreImages && isset($serviceData['image_base64']) && $serviceData['image_base64']) {
                $imagePath = $this->restoreImage($serviceData['image_base64'], $serviceData['image']);
            }

            $service = RepairService::create([
                'product_id' => $this->idMappings['products'][$serviceData['product_id']],
                'name' => $serviceData['name'],
                'description' => $serviceData['description'],
                'image' => $imagePath,
                'price' => $serviceData['price'],
                'discount' => $serviceData['discount'],
                'total' => $serviceData['total'],
                'estimated_duration_minutes' => $serviceData['estimated_duration_minutes'],
            ]);

            // Map old ID to new ID
            $this->idMappings['repair_services'][$serviceData['id']] = $service->id;
        }

        $this->line("   ✅ Imported " . count($services) . " repair services");
    }

    private function importProductRepairServiceRelationships($relationships)
    {
        $this->info('🔗 Importing product-repair service relationships...');

        foreach ($relationships as $relationship) {
            DB::table('product_repair_service')->insert([
                'product_id' => $this->idMappings['products'][$relationship['product_id']],
                'repair_service_id' => $this->idMappings['repair_services'][$relationship['repair_service_id']],
                'created_at' => $relationship['created_at'],
                'updated_at' => $relationship['updated_at'],
            ]);
        }

        $this->line("   ✅ Imported " . count($relationships) . " relationships");
    }

    private function restoreImage($base64Data, $originalPath)
    {
        try {
            $imageData = base64_decode($base64Data);

            if ($imageData !== false) {
                Storage::disk('r2')->put($originalPath, $imageData);
                return $originalPath;
            }
        } catch (\Exception $e) {
            $this->warn("Could not restore image: {$originalPath} - {$e->getMessage()}");
        }

        return null;
    }
}

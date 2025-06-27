<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\RepairService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ExportProductsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:export {--file=products-backup.json} {--with-images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all products, categories, brands, variants, and repair services to a JSON file for backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting product data export...');

        $filename = $this->option('file');
        $withImages = $this->option('with-images');

        // Create backup directory if it doesn't exist
        $backupPath = storage_path('app/backups');
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        $exportData = [
            'export_date' => now()->toISOString(),
            'export_version' => '1.0',
            'categories' => $this->exportCategories($withImages),
            'brands' => $this->exportBrands($withImages),
            'products' => $this->exportProducts($withImages),
            'product_variants' => $this->exportProductVariants($withImages),
            'repair_services' => $this->exportRepairServices($withImages),
            'product_repair_service_relationships' => $this->exportProductRepairServiceRelationships(),
        ];

        // Save to file
        $filePath = $backupPath . '/' . $filename;
        File::put($filePath, json_encode($exportData, JSON_PRETTY_PRINT));

        $this->info("✅ Export completed successfully!");
        $this->info("📁 File saved to: {$filePath}");
        $this->info("📊 Export summary:");
        $this->line("   - Categories: " . count($exportData['categories']));
        $this->line("   - Brands: " . count($exportData['brands']));
        $this->line("   - Products: " . count($exportData['products']));
        $this->line("   - Product Variants: " . count($exportData['product_variants']));
        $this->line("   - Repair Services: " . count($exportData['repair_services']));
        $this->line("   - Product-Service Relations: " . count($exportData['product_repair_service_relationships']));

        // Create import command instructions
        $this->info("\n🔄 To import this data later, run:");
        $this->line("   php artisan products:import --file={$filename}");

        return Command::SUCCESS;
    }

    private function exportCategories($withImages = false)
    {
        $this->info('Exporting categories...');

        return Category::all()->map(function ($category) use ($withImages) {
            $data = [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'image' => $category->image,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ];

            if ($withImages && $category->image) {
                $data['image_base64'] = $this->getImageAsBase64($category->image);
            }

            return $data;
        })->toArray();
    }

    private function exportBrands($withImages = false)
    {
        $this->info('Exporting brands...');

        return Brand::all()->map(function ($brand) use ($withImages) {
            $data = [
                'id' => $brand->id,
                'category_id' => $brand->category_id,
                'name' => $brand->name,
                'slug' => $brand->slug,
                'image' => $brand->image,
                'created_at' => $brand->created_at,
                'updated_at' => $brand->updated_at,
            ];

            if ($withImages && $brand->image) {
                $data['image_base64'] = $this->getImageAsBase64($brand->image);
            }

            return $data;
        })->toArray();
    }

    private function exportProducts($withImages = false)
    {
        $this->info('Exporting products...');

        return Product::all()->map(function ($product) use ($withImages) {
            $data = [
                'id' => $product->id,
                'category_id' => $product->category_id,
                'brand_id' => $product->brand_id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->image,
                'description' => $product->description,
                'is_selling' => $product->is_selling,
                'is_repairable' => $product->is_repairable,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];

            if ($withImages && $product->image) {
                $data['image_base64'] = $this->getImageAsBase64($product->image);
            }

            return $data;
        })->toArray();
    }

    private function exportProductVariants($withImages = false)
    {
        $this->info('Exporting product variants...');

        return ProductVariant::all()->map(function ($variant) use ($withImages) {
            $data = [
                'id' => $variant->id,
                'product_id' => $variant->product_id,
                'variant_name' => $variant->variant_name,
                'price' => $variant->price,
                'sku' => $variant->sku,
                'image' => $variant->image,
                'created_at' => $variant->created_at,
                'updated_at' => $variant->updated_at,
            ];

            if ($withImages && $variant->image) {
                $data['image_base64'] = $this->getImageAsBase64($variant->image);
            }

            return $data;
        })->toArray();
    }

    private function exportRepairServices($withImages = false)
    {
        $this->info('Exporting repair services...');

        return RepairService::all()->map(function ($service) use ($withImages) {
            $data = [
                'id' => $service->id,
                'product_id' => $service->product_id,
                'name' => $service->name,
                'description' => $service->description,
                'image' => $service->image,
                'price' => $service->price,
                'discount' => $service->discount,
                'total' => $service->total,
                'estimated_duration_minutes' => $service->estimated_duration_minutes,
                'created_at' => $service->created_at,
                'updated_at' => $service->updated_at,
            ];

            if ($withImages && $service->image) {
                $data['image_base64'] = $this->getImageAsBase64($service->image);
            }

            return $data;
        })->toArray();
    }

    private function exportProductRepairServiceRelationships()
    {
        $this->info('Exporting product-repair service relationships...');

        $relationships = [];

        Product::with('repairServices')->get()->each(function ($product) use (&$relationships) {
            foreach ($product->repairServices as $service) {
                $relationships[] = [
                    'product_id' => $product->id,
                    'repair_service_id' => $service->id,
                    'created_at' => $service->pivot->created_at,
                    'updated_at' => $service->pivot->updated_at,
                ];
            }
        });

        return $relationships;
    }

    private function getImageAsBase64($imagePath)
    {
        try {
            if (Storage::disk('r2')->exists($imagePath)) {
                $imageContent = Storage::disk('r2')->get($imagePath);
                return base64_encode($imageContent);
            }
        } catch (\Exception $e) {
            $this->warn("Could not fetch image: {$imagePath} - {$e->getMessage()}");
        }

        return null;
    }
}

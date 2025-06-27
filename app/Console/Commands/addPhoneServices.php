<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use App\Models\RepairService;
use Illuminate\Console\Command;

class addPhoneServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-phone-services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add repair services to all products in the phones category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find the phones category
        $phonesCategory = Category::where('slug', 'phones')->first();

        if (!$phonesCategory) {
            $this->error('Phones category not found! Please make sure a category with slug "phones" exists.');
            return 1;
        }

        // Get all products in the phones category
        $phoneProducts = Product::where('category_id', $phonesCategory->id)->get();

        if ($phoneProducts->isEmpty()) {
            $this->warn('No products found in the phones category.');
            return 0;
        }

        // Define the repair services to add

//        01JYRXWJX2HXXKTHZX3CYVZ1SC.png
//01JYRXXCEKHZJ0X341TPSS3FVH.png
//01JYRXYJ7VVG6J0GBHRQB3CPA5.png
//01JYRXZ261KKMT7XV0GHV4SRWQ.png
//01JYRXZQCQXK4K4VJ0CABHVK69.png

        $repairServices = [
            [
                'name' => 'Screen Repair',
                'description' => '',
                'image' => '01JYRXWJX2HXXKTHZX3CYVZ1SC.png',
                'price' => 999,
                'discount' => null,
                'estimated_duration_minutes' => 60,
            ],
            [
                'name' => 'Back Repair',
                'description' => '',
                'image' => '01JYRXXCEKHZJ0X341TPSS3FVH.png',
                'price' => 999,
                'discount' => null,
                'estimated_duration_minutes' => null,
            ],
            [
                'name' => 'Charging Port Repair',
                'description' => '',
                'image' => '01JYRV3KNVQB2KQ52VBFZHDGVJ.png',
                'price' => 999,
                'discount' => null,
                'estimated_duration_minutes' => null,
            ],
            [
                'name' => 'Camera Lense(Per Lens)',
                'description' => '',
                'image' => '01JYRXYJ7VVG6J0GBHRQB3CPA5.png',
                'price' => 999,
                'discount' => null,
                'estimated_duration_minutes' => null,
            ],
            [
                'name' => 'Camera Lense',
                'description' => '',
                'image' => '01JYRXYJ7VVG6J0GBHRQB3CPA5.png',
                'price' => 999,
                'discount' => null,
                'estimated_duration_minutes' => null,
            ],
            [
                'name' => 'Water Damage',
                'description' => '',
                'image' => '01JYRXZQCQXK4K4VJ0CABHVK69.png',
                'price' => 999,
                'discount' => null,
                'estimated_duration_minutes' => null,
            ],
        ];

        $this->info("Found {$phoneProducts->count()} phone products.");
        $this->info("Adding " . count($repairServices) . " repair services to each product...");

        $progressBar = $this->output->createProgressBar($phoneProducts->count());
        $progressBar->start();

        $totalServicesCreated = 0;
        $skippedServices = 0;

        foreach ($phoneProducts as $product) {
            foreach ($repairServices as $serviceData) {
                // Check if this service already exists for this product
                $existingService = RepairService::where('product_id', $product->id)
                    ->where('name', $serviceData['name'])
                    ->first();

                if ($existingService) {
                    $skippedServices++;
                    continue;
                }

                // Create the repair service for this product
                RepairService::create([
                    'product_id' => $product->id,
                    'name' => $serviceData['name'],
                    'description' => $serviceData['description'],
                    'image' => $serviceData['image'],
                    'price' => $serviceData['price'],
                    'discount' => $serviceData['discount'],
                    'estimated_duration_minutes' => $serviceData['estimated_duration_minutes'],
                ]);

                $totalServicesCreated++;
            }
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        $this->info("✅ Successfully created {$totalServicesCreated} repair services!");

        if ($skippedServices > 0) {
            $this->warn("⚠️  Skipped {$skippedServices} services (already existed)");
        }

        $this->table(
            ['Product', 'Services Added'],
            $phoneProducts->map(function ($product) use ($repairServices, $skippedServices) {
                $servicesForThisProduct = count($repairServices);
                $existingForThisProduct = RepairService::where('product_id', $product->id)
                    ->whereIn('name', collect($repairServices)->pluck('name'))
                    ->count();

                return [
                    $product->name,
                    ($servicesForThisProduct - ($existingForThisProduct - (count($repairServices) - ($skippedServices / $phoneProducts->count()))))
                ];
            })->toArray()
        );

        return 0;
    }
}

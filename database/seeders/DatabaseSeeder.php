<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\RepairService;
use App\Models\ProductStoreInventory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
        ]);

        $stores = [
            [
                'name' => 'Phonesvapes 4all',
                'address' => '282 Upper Richmond Road',
                'city' => 'East Sheen',
                'postcode' => 'SW14 7JE',
                'phone' => '0208 123 4567',
                'email' => 'support@phonesvapes4all.co.uk',
                'slug' => 'phonesvapes-4all-east-sheen',
                'google_maps_link' => 'https://maps.google.com/?q=282+Upper+Richmond+Road,+SW14+7JE',
                'meta_title' => 'Phonesvapes 4all | East Sheen - Phones & Vapes 4 All',
                'meta_description' => 'Visit our East Sheen store for premium vapes, phones, and accessories. Located at 282 Upper Richmond Road.',
            ],
            [
                'name' => 'Phones4all',
                'address' => '14 King Street',
                'city' => 'Twickenham',
                'postcode' => 'TW1 3SN',
                'phone' => '0208 234 5678',
                'email' => 'twickenham@phones4all.co.uk',
                'slug' => 'phones4all-twickenham',
                'google_maps_link' => 'https://maps.google.com/?q=14+King+Street,+TW1+3SN',
                'meta_title' => 'Phones4all | Twickenham - Phones & Vapes 4 All',
                'meta_description' => 'Your local store for mobiles and vapes in Twickenham. Come to 14 King Street for deals and repairs.',
            ],
            [
                'name' => 'United Tech&Vape',
                'address' => 'Unit 18 Church Walk Shopping Centre',
                'city' => 'Caterham',
                'postcode' => 'CR3 6RT',
                'phone' => '01883 987 654',
                'email' => 'caterham@unitedtechvape.co.uk',
                'slug' => 'united-tech-vape-caterham',
                'google_maps_link' => 'https://maps.google.com/?q=Unit+18+Church+Walk,+CR3+6RT',
                'meta_title' => 'United Tech&Vape | Caterham - Phones & Vapes 4 All',
                'meta_description' => 'Shop phones, vapes, and tech accessories at United Tech&Vape in Caterham. Visit us at Church Walk Shopping Centre.',
            ]
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }

        $category = Category::create([
            'name' => 'Phones',
            'slug' => 'phones',
        ]);

        $brand = Brand::create([
            'name' => 'Apple',
            'slug' => 'apple',
            'category_id' => $category->id,
        ]);

        $product = Product::create([
            'name' => 'iPhone 12',
            'slug' => 'iphone-12',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'description' => 'Latest Apple smartphone with A14 Bionic chip.',
            'is_selling' => true,
            'is_repairable' => true,
        ]);

        $variants = [
            ['variant_name' => '64GB Black', 'price' => 699],
            ['variant_name' => '128GB White', 'price' => 749],
            ['variant_name' => '256GB Blue', 'price' => 799],
        ];

        foreach ($variants as $variant) {
            ProductVariant::create(array_merge($variant, ['product_id' => $product->id]));
        }

        $services = [
            ['name' => 'Screen Repair', 'price' => 350],
            ['name' => 'Water Damage Service', 'price' => 59],
            ['name' => 'Charging Port Repair', 'price' => 159],
            ['name' => 'Back Glass Repair', 'price' => 139],
            ['name' => 'Camera Repair', 'price' => 139],
            ['name' => 'Camera Lens Replacement', 'price' => 79],
        ];

        foreach ($services as $service) {
            RepairService::create(array_merge($service, ['product_id' => $product->id]));
        }

        foreach (Store::all() as $store) {
            ProductStoreInventory::create([
                'product_id' => $product->id,
                'store_id' => $store->id,
                'quantity' => rand(2, 10),
            ]);
        }
    }
}

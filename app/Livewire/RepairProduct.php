<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use App\Models\RepairService;
use App\Models\Store;
use Livewire\Component;

class RepairProduct extends Component
{
    public $search = '';
    public $brand;
    public $categoriesSlug;
    public $brandSlug;

    public function mount($brandSlug, $categoriesSlug)
    {
        $this->brand = Brand::where('slug', $brandSlug)->first();
        $this->categoriesSlug = $categoriesSlug;
        $this->brandSlug = $brandSlug;
    }

    public function render()
    {
        $products = Product::where('is_repairable', true)
            ->where('brand_id', $this->brand->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->get()
            ->sortBy('created_at');

        // Check if any product has repair services
        $hasRepairServices = false;
        foreach ($products as $product) {
            if ($product->repairServices()->exists()) {
                $hasRepairServices = true;
                break;
            }
        }

        return view('livewire.repair-products', [
            'products' => $products,
            'hasRepairServices' => $hasRepairServices
        ]);
    }
}

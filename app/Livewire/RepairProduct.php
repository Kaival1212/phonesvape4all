<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use App\Models\RepairService;
use App\Models\Store;
use Livewire\Component;

class RepairProduct extends Component
{
    // public $products;
    public $search = '';
    //public $repairService;
    public $brand;

    public function mount($brandSlug)
    {

        $this->brand = Brand::where('slug', $brandSlug)->first();

        // $this->products = Product::where('is_repairable', true)
        //     ->where('brand_id', $this->brand->id)
        //     ->get();

        //$this->repairService = RepairService::where('product_id')
    }

    public function render()
    {
        return view('livewire.repair-products' , [
            'products' =>  Product::where('is_repairable', true)
            ->where('brand_id', $this->brand->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->get()
        ]);
    }
}

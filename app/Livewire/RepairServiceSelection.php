<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class RepairServiceSelection extends Component
{
    public $services;
    public $product;

    public $categoriesSlug;
    public $brandSlug;
    public $productID;

    public function mount($categoriesSlug, $brandSlug, $productID)
    {
        $this->product = Product::where('id', $productID)->firstOrFail();
        $this->services = $this->product->repairServices()->get();

        $this->categoriesSlug = $categoriesSlug;
        $this->brandSlug = $brandSlug;
        $this->productID = $productID;
    }



    public function render()
    {
        return view('livewire.repair-service-selection');
    }
}

<?php

namespace App\Livewire\Buy;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Product;

class Phones extends Component
{
    public $search = '';
    //public $repairService;
    public $brand;
    public $categoriesSlug;
    public $brandSlug;

    public function mount($brandSlug , $categoriesSlug)
    {

        $this->brand = Brand::where('slug', $brandSlug)->first();
        $this->categoriesSlug = $categoriesSlug;
        $this->brandSlug = $brandSlug;


    }

    public function render()
    {
        return view('livewire.buy.phones' , [
            'products' =>  Product::where('is_selling', true)
            ->where('brand_id', $this->brand->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->get()
        ]);
    }
}

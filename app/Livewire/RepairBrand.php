<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Product;
use App\Models\Store;
use App\Models\Category;

class RepairBrand extends Component
{

    public $store;
    public $brands;
    public $category;


    public function mount($categoriesSlug)
    {
        $this->store = Store::where('slug', 'phonesvapes-4all-east-sheen')->firstOrFail();

        $this->category = Category::where('slug', $categoriesSlug)->firstOrFail();

        $this->brands = Brand::where('category_id', $this->category->id)->get();
    }


    public function render()
    {
        return view('livewire.repair-brand');
    }
}

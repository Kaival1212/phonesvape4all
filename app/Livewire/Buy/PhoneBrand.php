<?php

namespace App\Livewire\Buy;

use Livewire\Component;
use App\Models\Category;
use App\Models\Store;
use Livewire\Attributes\Layout;
use App\Models\Brand;

class PhoneBrand extends Component
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
        return view('livewire.buy.phone-brand');
    }
}

<?php

namespace App\Livewire\Buy;

use Livewire\Component;
use App\Models\Category;
use App\Models\Store;

class Buy extends Component
{
    public $store;
    public $categories;

    public function mount()
    {
        $this->store = Store::where('slug', 'phonesvapes-4all-east-sheen')->first();
        $this->categories = Category::all();

    }
    public function render()
    {
        return view('livewire.buy.buy');
    }
}

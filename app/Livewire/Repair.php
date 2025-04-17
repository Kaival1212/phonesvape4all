<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Store;
use Livewire\Attributes\Layout;

class Repair extends Component
{

    public $store;
    public $categories;

    public function mount()
    {
        $this->store = Store::where('slug', 'phonesvapes-4all-east-sheen')->first();
        $this->categories = Category::all();

    }

    // #[Layout('components.layouts.app', ['store' => $this->store])]
    public function render()
    {
        return view('livewire.repair');
    }
}

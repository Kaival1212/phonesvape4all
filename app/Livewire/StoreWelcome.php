<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Store;
use Livewire\Attributes\Layout;

class StoreWelcome extends Component
{
    public Store $store;

    public function mount(Store $store)
    {
        $this->store = $store;
    }

    public function mountWith(Store $store)
    {
        $this->mount($store);
        return $this->render();
    }

    #[Layout(name: 'components.layouts.app')]
    public function render()
    {
        return view(view: 'livewire.store-welcome')
            ->with(['store' => $this->store]);
    }
}

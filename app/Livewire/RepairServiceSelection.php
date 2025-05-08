<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\RepairService;
use Livewire\Component;

class RepairServiceSelection extends Component
{
    public $product;
    public $productID;
    public $categoriesSlug;
    public $brandSlug;
    public $modelNumber;
    public $isSubmitting = false;

    public function mount($categoriesSlug, $brandSlug, $productID)
    {
        $this->product = Product::findOrFail($productID);
        $this->productID = $productID;
        $this->categoriesSlug = $categoriesSlug;
        $this->brandSlug = $brandSlug;
    }

    public function submitModelNumber()
    {
        $this->isSubmitting = true;

        $this->validate([
            'modelNumber' => 'required|string|min:3'
        ]);

        $this->isSubmitting = false;

        return redirect()->route('repair.product.form.model', [
            'categoriesSlug' => $this->categoriesSlug,
            'brandSlug' => $this->brandSlug,
            'productID' => $this->productID,
            'model_number' => $this->modelNumber
        ]);
    }

    public function render()
    {
        $services = RepairService::where('product_id', $this->product->id)->get();

        return view('livewire.repair-service-selection', [
            'services' => $services
        ]);
    }
}

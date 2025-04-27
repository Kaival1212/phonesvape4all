<?php

namespace App\Livewire\Buy;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use App\Models\ProductStoreInventory;
use App\Models\SellBooking;

class PhoneVarients extends Component
{
    public $productID;
    public $product;
    public $productVarients;
    public $categoriesSlug;
    public $brandSlug;
    public $selectedVariant;

    public $customerName;
    public $customerPhone;
    public $customerEmail;

    public $storeId;


    public $availabeStores;

    public function mount($productID, $categoriesSlug, $brandSlug)
    {
        $this->productID = $productID;
        $this->categoriesSlug = $categoriesSlug;
        $this->brandSlug = $brandSlug;

        $this->product = Product::findOrFail($productID);
        $this->productVarients = $this->product->variants;

        if ($this->productVarients->count() > 0) {
            $this->selectedVariant = $this->productVarients->first()->id;
            $temp = $this->productVarients->firstWhere('id', $this->selectedVariant);
            $this->availabeStores = $temp->stock;

            //$this->availabeStores = $this->selectedVariant->stock;

        }
    }

    public function getSelectedVariantDetailsProperty()
    {

        $temp = $this->productVarients->firstWhere('id', $this->selectedVariant);
        $this->availabeStores = $temp->stock;

        return $temp;
    }

    protected function loadAvailableStores()
{
    $this->availabeStores = ProductStoreInventory::where('product_variant_id', $this->selectedVariant)
        ->get();
}

    public function updatedSelectedVariant()
    {
        $this->getSelectedVariantDetailsProperty();
    }



    public function buyNow()
    {
        Log($this->storeId);
        $variant = $this->getSelectedVariantDetailsProperty();

        $validated = $this->validate([
            'customerName' => 'required|string|max:255',
            'customerPhone' => 'required|string|max:15',
            'customerEmail' => 'required|email|max:255',
        ]);

        if ($variant) {
            SellBooking::create([
                'product_variant_id' => $variant->id,
                'store_id' => $this->storeId,
                'customer_name' => $this->customerName,
                'customer_phone' => $this->customerPhone,
                'customer_email' => $this->customerEmail,
                'status' => 'pending',
                "price" => $variant->price,
            ]);

            // flassh message
            session()->flash('success', 'Booking created successfully!');

        } else {
            Log::error('Variant not found for ID: ' . $this->selectedVariant);
        }
    }

    public function render()
    {
        return view('livewire.buy.phone-varients');
    }
}

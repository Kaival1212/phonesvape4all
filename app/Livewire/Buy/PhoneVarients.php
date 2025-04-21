<?php

namespace App\Livewire\Buy;

use Livewire\Component;
use App\Models\Product;

class PhoneVarients extends Component
{
    public $productID;
    public $product;
    public $productVarients;
    public $categoriesSlug;
    public $brandSlug;
    public $selectedVariant;
    public $quantity = 1;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($productID, $categoriesSlug, $brandSlug)
    {
        $this->productID = $productID;
        $this->categoriesSlug = $categoriesSlug;
        $this->brandSlug = $brandSlug;

        $this->product = Product::findOrFail($productID);
        $this->productVarients = $this->product->variants;

        if ($this->productVarients->count() > 0) {
            $this->selectedVariant = $this->productVarients->first()->id;
        }
    }

    public function getSelectedVariantDetailsProperty()
    {
        return $this->productVarients->firstWhere('id', $this->selectedVariant);
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $variant = $this->selectedVariantDetails;

        if (!$variant) {
            session()->flash('error', 'Variant not found.');
            return;
        }

        $cart = session()->get('cart', []);
        $key = 'variant_' . $variant->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $this->quantity;
        } else {
            $cart[$key] = [
                'product_id' => $this->product->id,
                'variant_id' => $variant->id,
                'variant_name' => $variant->variant_name,
                'price' => $variant->price,
                'quantity' => $this->quantity,
                'image' => $variant->image ?? $this->product->image,
            ];
        }

        session()->put('cart', $cart);
        session()->flash('success', 'Product added to cart!');
        $this->emit('refreshComponent');
    }

    public function buyNow()
    {
        $this->addToCart();
        return redirect()->route('cart.view');
    }

    public function render()
    {
        return view('livewire.buy.phone-varients');
    }
}

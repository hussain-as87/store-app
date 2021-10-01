<?php

namespace App\Http\Livewire;

use App\Models\Admin\Product;
use App\Models\favoriteProduct;
use Livewire\Component;

class FavoriteProductShow extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $favorite = favoriteProduct::where('product_id', $this->product->id)->where('user_id', auth()->id())->first();

        return view('livewire.favorite-product-show', compact('favorite'));
    }

    public function store()
    {
        $fav = favoriteProduct::where('product_id', $this->product->id)->where('user_id', auth()->id())->first();

        if ($fav === null) {
            favoriteProduct::create([
                'product_id' => $this->product->id,
                'user_id' => auth()->id()
            ]);
        } else {
            $fav->delete();
        }
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\favoriteProduct;
use Livewire\Component;

class FavoraiteProduct extends Component
{
    protected $product;
    
    public function render()
    {
        return view('livewire.favoraite-product');
    }
    public function store($id)
    {
        $fav = favoriteProduct::where('product_id', $id)->where('user_id', auth()->id())->first();

        if ($fav === null) {
            favoriteProduct::create([
                'product_id' => $id,
                'user_id' => auth()->id()
            ]);
        } else {
            $fav->delete();
        }
    }
}

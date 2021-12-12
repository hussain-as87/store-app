<?php

namespace App\Http\Livewire;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\favoriteProduct;
use App\Models\PriceDiscount;
use Livewire\Component;
use NumberFormatter;

class ProductsFilter extends Component
{
    public $search = '';
    public $color = '';
    public $price = '';
    public $tag = '';
    public $orderBy = 'id';


    public function render()
    {
        $products = Product::with('category.subcategories', 'product_images', 'user')->orderByDesc($this->orderBy)->search($this->search)
            ->orWhereNull('color',$this->color)->orWhere('price',$this->price)/*->orWhere('tag',$this->tag)*/
            ->paginate(10);
        $categories = Category::paginate(3);

        return view('livewire.products-filter', compact('products', 'categories'));
    }
}

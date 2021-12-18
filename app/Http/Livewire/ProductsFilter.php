<?php

namespace App\Http\Livewire;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Livewire\Component;

class ProductsFilter extends Component
{
    public $search = '';
    public $color_chose = '';
    public $price_range = [0, 1000000];
    /*     public $tag = '';
 */
    public $orderBy = 'id';


    public function render()
    {
        $products = Product::with('category.subcategories', 'product_images', 'user')->orderByDesc($this->orderBy)->search($this->search)
            /* ->Where('color', $this->color_chose ? $this->color_chose : null)->whereBetween('price', $this->price_range)
 */ ->paginate(10);
        $categories = Category::paginate(8);

        return view('livewire.products-filter', compact('products', 'categories'));
    }
}

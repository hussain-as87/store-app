<?php

namespace App\Http\Livewire;

use App\Models\Admin\Category;
use Livewire\Component;

class DataTablecategories extends Component
{
    public $perPage = 10;
    public $search = '';
    public $orderAsc = true;
    public $orderBy = 'id';
    public $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.data-tablecategories', [
            'categories' => Category::withCount('products', 'subcategories')
                ->search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}

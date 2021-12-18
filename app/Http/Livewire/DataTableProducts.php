<?php

namespace App\Http\Livewire;

use App\Models\Admin\Product;
use Livewire\Component;
use Livewire\WithPagination;

class DataTableProducts extends Component
{
    public $perPage = 10;
    public $search = '';
    public $orderAsc = true;
    public $orderBy = 'id';

    public function render()
    {
        return view('livewire.data-table-products',
            ['product' => Product::with('user.store', 'category')
                ->search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
            ]);
    }
}

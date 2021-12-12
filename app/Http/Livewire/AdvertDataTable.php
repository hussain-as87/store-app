<?php

namespace App\Http\Livewire;

use App\Models\Advert;
use Livewire\Component;

class AdvertDataTable extends Component
{
    public $advert;
    public $perPage = 10;
    public $search = '';
    public $orderAsc = true;
    public $orderBy = 'id';

    public function render()
    {
        $advertis = Advert::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.advert-data-table', compact('advertis'));
    }
}

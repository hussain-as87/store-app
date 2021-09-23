<?php

namespace App\Http\Livewire;

use App\Models\Rating;
use Livewire\Component;

class RatingProducts extends Component
{
    public $rating;
    public $currentId;
    public $product;
    public $hideForm;

    protected $rules = [
        'rating' => ['required', 'in:1,2,3,4,5']
    ];
    public function render()
    {
        $ra = Rating::where('product_id', $this->product->id)->where('user_id', auth()->id())->with('user')->first();
        return view('livewire.rating-products',compact('ra'));
    }
    public function mount()
    {
        if (auth()->user()) {
            $rating = Rating::where('user_id', auth()->id())->where('product_id', $this->product->id)->first();
            if (!empty($rating)) {
                $this->rating  = $rating->rating;
                $this->currentId = $rating->id;
            }
        }
        return view('livewire.rating-products');
    }

    public function delete($id)
    {
        $rating = Rating::where('id', $id)->first();
        if ($rating && ($rating->user_id == auth()->user()->id)) {
            $rating->delete();
        }
        if ($this->currentId) {
            $this->currentId = '';
            $this->rating  = '';
        }
        return redirect(request()->header('Referer'));
    }

    public function rate()
    {
        $rating = Rating::where('user_id', auth()->user()->id)->where('product_id', $this->product->id)->first();
        $this->validate();
        if (!empty($rating)) {
            $rating->user_id = auth()->user()->id;
            $rating->product_id = $this->product->id;
            $rating->rating = $this->rating;
            $rating->status = 1;
            try {
                $rating->update();
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            $rating = new Rating;
            $rating->user_id = auth()->user()->id;
            $rating->product_id = $this->product->id;
            $rating->rating = $this->rating;
            $rating->status = 1;
            try {
                $rating->save();
                return redirect(request()->header('Referer'));
            } catch (\Throwable $th) {
                throw $th;
            }
            $this->hideForm = true;
        }

    }
}

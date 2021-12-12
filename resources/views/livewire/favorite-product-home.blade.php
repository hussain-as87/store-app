<form action="" wire:submit.prevent="store({{$product->id}})">

    <div class="block2-txt-child2 flex-r p-t-3">
        <div href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2"></div>
        @if($favorite !== null)
            <button style="border: none; background: transparent;" type="submit"><img
                    class="icon-heart2 dis-block trans-04" src="{{asset('images/icons/icon-heart-02.png')}}" alt="ICON">
            </button>
        @else
            <button style="border: none; background: transparent;" type="submit"><img
                    class="icon-heart1 dis-block trans-04" src="{{asset('images/icons/icon-heart-01.png')}}" alt="ICON">
            </button>
        @endif
    </div>
</form>

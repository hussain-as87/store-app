<form action="" wire:submit.prevent="store({{$product->id}})">
    @csrf
    <button style="border: none; background: transparent;" type="submit">
        <a class="ps-shoe__favorite @if($favorite !== null)
            bg-danger
@endif"><i class="ps-icon-heart"></i></a></button>
</form>

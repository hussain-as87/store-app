<form action="" wire:submit.prevent="store({{$product->id}})">
    @csrf
    <button style="border: none; background: transparent;"><a class="mr-10 @if($favorite !== null)
            bg-danger
@endif"><i class="ps-icon-heart"></i></a></button>
</form>

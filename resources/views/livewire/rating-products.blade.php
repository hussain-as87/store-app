@if($hideForm != true)
    @if($ra != null)
        <div class="ps-product__rating">
            <form wire:click="rate()">
                <select class="ps-rating" name="rating" wire:model="rating" id="star">
                    <option value="1" {{ $ra->rating ? 'selected' : '' }}>1</option>
                    <option value="2" {{ $ra->rating ? 'selected' : '' }}>2</option>
                    <option value="3" {{ $ra->rating ? 'selected' : '' }}>3</option>
                    <option value="4" {{ $ra->rating ? 'selected' : '' }}>4</option>
                    <option value="5" {{ $ra->rating ? 'selected' : '' }}>5</option>
                </select>
            </form>
            @if(!empty($ra))
                <label for="star" href="">(Rate {{ $ra->rating }})</label>
            @endif
        </div>
    @else
        div class="ps-product__rating">
        <form wire:click="rate()">
            <select class="ps-rating" name="rating" wire:model="rating" id="star">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </form>
        </div>
    @endif

@endif


{{--
    @if($hideForm != true)

        <div class="ps-product__rating">
            <div class="block max-w-3xl px-1 py-2 mx-auto ps-rating">
                <form wire:click="rate()">
                    <div class="flex space-x-1 rating">
                        <label for="star1">
                            <input hidden wire:model="rating" type="radio" id="star1" name="rating" value="1" />
                            <svg class="bg-outline-warning cursor-pointer block w-8 h-8 @if($rating >= 1 ) text-warning @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" /></svg>
                        </label>
                        <label for="star2">
                            <input hidden wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                            <svg class="bg-outline-warning cursor-pointer block w-8 h-8 @if($rating >= 2 ) text-warning @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" /></svg>
                        </label>
                        <label for="star3">
                            <input hidden wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                            <svg class="bg-outline-warning cursor-pointer block w-8 h-8 @if($rating >= 3 ) text-warning @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" /></svg>
                        </label>
                        <label for="star4">
                            <input hidden wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                            <svg class="bg-outline-warning cursor-pointer block w-8 h-8 @if($rating >= 4 ) text-warning @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" /></svg>
                        </label>
                        <label for="star5">
                            <input hidden wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                            <svg class="bg-outline-warning cursor-pointer block w-8 h-8 @if($rating >= 5 ) text-warning @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" /></svg>
                        </label>
                    </div>
                </form>
            </div>

            @if(!empty($ra))
                <b class="p-2">( {{ $ra->rating }} <svg class="bg-outline-warning cursor-pointer block w-8 h-8 text-warning" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="15" height="15">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" /></svg> )</b>
            @endif
        </div>

    @endif

--}}

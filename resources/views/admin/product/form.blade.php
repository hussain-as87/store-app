@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf
<ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach (config('locales.languages') as $key => $val)
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#home{{ $key }}">{{ __($val['name']) }}</a>
        </li>
    @endforeach
</ul>


<div class="tab-content" id="myTabContent">
    @if ($product->image)
        <div class="center">
            <img src="{{ asset('storage/products/' . $product->image) }}"
                 style="width: 200px;border-radius: 100px;height: 200px">
        </div>
    @endif

    {{-- tab start --}}
    @foreach (config('locales.languages') as $key => $val)
        <div id="home{{ $key }}" class="container tab-pane {{ $loop->index == 0 ? 'show active' : '' }}"
             aria-labelledby="{{ $key }}-tab"><br>

            <div class="form-group">
                <label for="name">{{ __('name') }}({{ __($val['name']) }})</label>
                <input type="text" name="name[{{ $key }}]"
                       class="form-control @error('name.' . $key) is-invalid alert-danger @enderror" id="name"
                       value="{!! old('name.' . $key, $product->getTranslation('name', $key)) ?? $product->name !!}"
                       aria-describedby="emailHelp"
                       placeholder="@error('name.' . $key){{ $message }} @enderror">
            </div>

            <div class="form-group">
                <label
                    for="description[{{ $key }}]">{{ __('description') }}({{ __($val['name']) }})</label>
                <textarea placeholder="@error('description.' . $key){{ $message }} @enderror"
                          name="description[{{ $key }}]" class="form-control" id="description[{{ $key }}]"
                          rows="5">
                {!! old('description.' . $key, $product->getTranslation('description', $key)) ?? $product->description !!}</textarea>
            </div>

        </div>
    @endforeach
    {{-- tab end --}}

    <div class="form-group">
        <label for="image">{{ __('image') }}</label>
        <input type="file" name="image" class="form-control" id="image"
               value="{{ old('image') ?? $product->image }}">
        @error('image')
        <small class="alert-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="price">{{ __('price') }}</label>
        <input type="number" name="price" class="form-control @error('price') is-invalid alert-danger @enderror"
               id="price" value="{{ old('price') ?? $product->price }}"
               placeholder="@error('price'){{ $message }} @enderror">

    </div>
    <div class="form-group">
        <label for="category">{{ __('category') }}</label>
        <select name="category_id" id="category" class="form-control">
            @foreach ($category as $cat)
                <option value="{{ $cat->id }}" {{ $product->category_id === $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

        <div class="form-group">
        <label for="size">{{ __('size') }}</label>
        <select name="size" id="size" class="form-control">
            <option>{{__('Choose an option')}}</option>
            <option value="S" {{ $product->size === 'S' ? 'selected' : '' }}>{{ __('size') }} S</option>
            <option value="M" {{ $product->size === 'M' ? 'selected' : '' }}>{{ __('size') }} M</option>
            <option value="L" {{ $product->size === 'L' ? 'selected' : '' }}>{{ __('size') }} L</option>
            <option value="XL" {{ $product->size === 'XL' ? 'selected' : '' }}>{{ __('size') }} XL</option>
            <option value="XXL" {{ $product->size === 'XXL' ? 'selected' : '' }}>{{ __('size') }} XXL</option>
            <option value="XXXL" {{ $product->size === 'XXXL' ? 'selected' : '' }}>{{ __('size') }} XXXL</option>
        </select>
    </div>

        <div class="form-group">
        <label for="color">{{ __('color') }}    <button class="btn" style="background-color: {{$product->color?$product->color:''}}">{{$product->color}}</button></label>
        <select name="color" id="color" class="form-control">
            <option>{{__('Choose an option')}}</option>
            <option value="red" {{ $product->color === 'red' ? 'selected' : '' }}>{{__('red')}}</option>
            <option value="yellow" {{ $product->color === 'yellow' ? 'selected' : '' }}>{{__('yellow')}}</option>
            <option value="blue" {{ $product->color === 'blue' ? 'selected' : '' }}>{{__('blue')}}</option>
            <option value="white" {{ $product->color === 'white' ? 'selected' : '' }}>{{__('white')}}</option>
            <option value="grey" {{ $product->color === 'grey' ? 'selected' : '' }}>{{__('grey')}}</option>
        </select>
    </div>



    <div class="form-group">
        <label for="gallery">{{ __('gallery') }}</label>
        <input type="file" name="gallery[]" class="form-control" id="gallery"
               value="{{ old('gallery') ?? $product->image }}" multiple>
        @error('gallery')
        <small class="alert-danger">{{ $message }}</small>
        @enderror
        <div class="col-12" style="display: inline-flex;">
            @foreach ($product->product_images as $img)
                <div class="col-3">
                    <img src="{{ asset('storage/' . $img->path) }}"
                         style="width: 100px;border-radius: 50px;height: 100px;" alt="{{ $img->id }}">
                    <a class="btn btn-danger" href="{{ route('gallery.destroy', $img->id) }}"
                       onclick="confirm('are you sure ?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-trash2" viewBox="0 0 16 16">
                            <path
                                d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z"/>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>


    </div>

    <div class="form-group">
        <label for="tags">{{ __('tags') }}</label>
        <input type="text" name="tags" class="form-control @error('tags') is-invalid alert-danger @enderror" id="tags"
               value="{{ old('tags') ?? implode(', ', $product->tags->pluck('name')->toArray()) }}"
               placeholder="@error('tags'){{ $message }} @enderror">
    </div>


 {{--   <div class="form-group">
        <label for="color">{{ __('color') }}</label>
        <select name="color" id="color" class="form-control">
            <option value="red" class="btn-danger">{{__('red')}}</option>
            <option value="yellow" class="btn-warning">{{__('yellow')}}</option>
            <option value="blue" class="btn-primary">{{__('blue')}}</option>
            <option value="green" class="btn-success">{{__('green')}}</option>
        </select>
    </div>--}}


    <div class="form-group">
        <label class="sr-only" for="discount_value">{{ __('discount value') }}</label>
        <div class="input-group mb-4">
            <div class="input-group-prepend">
                @php
                    $d = App\Models\PriceDiscount::where('product_id',$product->id)->first();
                    $formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);
                @endphp
                @if($d)
                    <div class="input-group-text">{{ $formatter->format($d->percentage) }}</div>
                @endif
            </div>
            <input type="number" name="percentage"
                   class="form-control @error('percentage') is-invalid alert-danger @enderror" id="percentage"
                   value="{{ old('percentage') }}" placeholder="{{ __('enter discount value') }}">
        </div>
    </div>



</div>

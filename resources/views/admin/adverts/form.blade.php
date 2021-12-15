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
    @if ($advert->image)
    <div class="center">
        <img src="{{ asset('storage/advertis/' . $advert->image) }}" style="width: 200px;border-radius: 100px;height: 200px">
    </div>
    @endif

    {{-- tab start --}}
    @foreach (config('locales.languages') as $key => $val)
    <div id="home{{ $key }}" class="container tab-pane {{ $loop->index == 0 ? 'show active' : '' }}" aria-labelledby="{{ $key }}-tab"><br>

        <div class="form-group">
            <label for="name">{{ __('title') }}({{ __($val['name']) }})</label>
            <input type="text" name="title[{{ $key }}]" class="form-control @error('title.' . $key) is-invalid alert-danger @enderror" id="title" value="{!! old('title.' . $key, $advert->getTranslation('title', $key)) ?? $advert->title !!}" aria-describedby="emailHelp" placeholder="@error('title.' . $key){{ $message }} @enderror">
        </div>

        <div class="form-group">
            <label >{{ __('content') }}({{ __($val['name']) }})</label>
            <textarea placeholder="@error('content.' . $key){{ $message }} @enderror" name="content[{{ $key }}]" class="form-control"  rows="5">
                 {!! old('content.' . $key, $advert->getTranslation('content', $key)) ?? $advert->content !!}</textarea>
        </div>

    </div>
    @endforeach
    {{-- tab end --}}

    <div class="form-group">
        <label for="photo">{{ __('image') }}</label>
        <input type="file" name="photo" class="form-control" id="image" value="{{ old('photo') ?? $advert->photo }}">
        @error('photo')
        <small class="alert-danger">{{ $message }}</small>
        @enderror
    </div>

</div>

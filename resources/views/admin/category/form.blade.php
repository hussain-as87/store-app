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
    @foreach(config('locales.languages') as $key => $val)
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#home{{$key}}">{{__($val['name'])}}</a>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="myTabContent">

    {{--tab start--}}
    @foreach(config('locales.languages') as $key => $val)
        <div id="home{{$key}}" class="container tab-pane {{ $loop->index == 0 ? 'show active' : '' }}"
             aria-labelledby="{{ $key }}-tab"><br>

            <div class="form-group">
                <label for="name">{{__('name')}}({{ __($val['name']) }})</label>
                <input type="text" name="name[{{$key}}]"
                       class="form-control @error('name.'.$key) is-invalid alert-danger @enderror" id="name"
                       value="{!! old('name.'.$key,$category->getTranslation('name',$key)) ?? $category->name !!}"
                       aria-describedby="emailHelp" placeholder="@error('name.'.$key){{$message}} @enderror">
            </div>

            <div class="form-group">
                <label>{{ __('content') }}({{ __($val['name']) }})</label>
                <textarea placeholder="@error('content.' . $key){{ $message }} @enderror" name="content[{{ $key }}]"
                          class="form-control" rows="5">
                 {!! old('content.' . $key, $category->getTranslation('content', $key)) ?? $category->content !!}</textarea>
            </div>
        </div>
    @endforeach
    {{--tab end--}}

    <div class="form-group">
        <label for="photo">{{ __('image') }}</label>
        <input type="file" name="photo" class="form-control" id="image" value="{{ old('photo') ?? $category->photo }}">
        @error('photo')
        <small class="alert-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="show" id="exampleRadios1"
               value="1" {{ $category->show == 1 ? 'checked' : '' }}>
        <label class="form-check-label" for="exampleRadios1">
            {{__('show')}}
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="show" id="exampleRadios2"
               value="0" {{ $category->show == 0 ? 'checked' : '' }}>
        <label class="form-check-label" for="exampleRadios2">
            {{__('dont show')}}
        </label>
    </div>
</div>

@extends('layouts.admin_layout')
@section('header_page')
    {{ __('edit profile') }}
@endsection
@section('title')
    {{ __('edit profile') }}
@endsection
@section('name'){{ __('profile') }}@endsection
@section('href'){{ route('profile-user.show', auth()->id()) }}@endsection
@section('name2'){{ __('change password') }}@endsection
@section('href2'){{ route('change.password', auth()->id()) }}@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <form enctype="multipart/form-data" method="post"
                      action="{{ route('profile-user.update', auth()->id()) }}">
                    @method('PUT')
                    @csrf
                    @if ($profile->avatar)
                        <div class="center">
                            <img src="{{ asset('storage/' . $profile->avatar) }}"
                                 style="width: 200px;border-radius: 100px;height: 200px">
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="avatar_profile">{{ __('avatar') }}</label>
                        <input type="file" name="avatar_profile" class="form-control" id="avatar"
                               value="{{ old('avatar_profile') ?? $profile->avatar }}">
                        @error('avatar_profile')
                        <small class="alert-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="first_name">{{ __('first name') }}</label>
                        <input type="text" name="first_name"
                               class="form-control @error('first_name') is-invalid alert-danger @enderror"
                               id="first_name" value="{{ old('first_name') ?? $profile->first_name }}"
                               aria-describedby="emailHelp" placeholder="@error('first_name'){{ $message }} @enderror">
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="last_name">{{ __('last name') }}</label>
                        <input type="text" name="last_name"
                               class="form-control @error('last_name') is-invalid alert-danger @enderror" id="last_name"
                               value="{{ old('last_name') ?? $profile->last_name }}" aria-describedby="emailHelp"
                               placeholder="@error('last_name'){{ $message }} @enderror">
                    </div>

                    <div class="form-group">
                        <label for="phone">{{ __('phone') }}</label>
                        <input type="tel" name="phone"
                               class="form-control @error('phone') is-invalid alert-danger @enderror" id="last_name"
                               value="{{ old('phone') ?? $profile->phone }}" aria-describedby="emailHelp"
                               placeholder="@error('phone'){{ $message }} @enderror">
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('address') }}</label>
                        <input type="text" name="address"
                               class="form-control @error('address') is-invalid alert-danger @enderror" id="last_name"
                               value="{{ old('address') ?? $profile->address }}" aria-describedby="emailHelp"
                               placeholder="@error('address'){{ $message }} @enderror">
                    </div>
                    <div class="form-group">
                        <label for="country">{{ __('country') }}</label>
                        <input type="text" name="country"
                               class="form-control @error('country') is-invalid alert-danger @enderror" id="last_name"
                               value="{{ old('country') ?? $profile->country }}" aria-describedby="emailHelp"
                               placeholder="@error('country'){{ $message }} @enderror">
                    </div>
                    <div class="row">
                        <div class="col-4 form-group">
                            <label for="facebbok">{{ __('facebook') }}</label>
                            <input type="url" name="facebook"
                                   class="form-control @error('facebook') is-invalid alert-danger @enderror"
                                   id="facebbok" value="{{ old('facebook') ?? $social->facebook }}"
                                   aria-describedby="emailHelp"
                                   placeholder="@error('facebook'){{ $message }} @enderror">
                        </div>
                        <div class="col-4 form-group">
                            <label for="instagram">{{ __('instagram') }}</label>
                            <input type="url" name="facebook"
                                   class="form-control @error('instagram') is-invalid alert-danger @enderror"
                                   id="instagram" value="{{ old('instagram') ?? $social->instagram }}"
                                   aria-describedby="emailHelp"
                                   placeholder="@error('instagram'){{ $message }} @enderror">
                        </div>
                        <div class="col-4 form-group">
                            <label for="twitter">{{ __('twitter') }}</label>
                            <input type="url" name="twitter"
                                   class="form-control @error('twitter') is-invalid alert-danger @enderror" id="twitter"
                                   value="{{ old('twitter') ?? $social->twitter }}" aria-describedby="emailHelp"
                                   placeholder="@error('twitter'){{ $message }} @enderror">
                        </div>
                        <div class="col-4 form-group">
                            <label for="google">{{ __('google') }}</label>
                            <input type="url" name="google"
                                   class="form-control @error('google') is-invalid alert-danger @enderror" id="google"
                                   value="{{ old('google') ?? $social->google }}" aria-describedby="emailHelp"
                                   placeholder="@error('google'){{ $message }} @enderror">
                        </div>
                        <div class="col-4 form-group">
                            <label for="pinterest">{{ __('pinterest') }}</label>
                            <input type="url" name="pinterest"
                                   class="form-control @error('pinterest') is-invalid alert-danger @enderror"
                                   id="pinterest" value="{{ old('pinterest') ?? $social->pinterest }}"
                                   aria-describedby="emailHelp"
                                   placeholder="@error('pinterest'){{ $message }} @enderror">
                        </div>
                    </div>
                    <a class="btn badge-warning" href="{{route('profile-user.show', auth()->id()) }}">{{__('Go Back')}}
                        <i class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

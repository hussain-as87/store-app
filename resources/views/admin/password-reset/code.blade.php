@extends('layouts.store_layout')
@section('content')
    <main class="login-form">
        <div class="cotainer py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('verified') }}</div>
                        <div class="card-body">

                            <div class="contianer py-4 col-md-8">
                                <form action="{{ route('reset.password.get') }}" method="get">
                                    @csrf
                                    <label for="pass">{{__('received code')}}</label>
                                    <input type="text" class="form-control" id="pass" name="token">
                                    <br>
                                    @error('token')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <br>
                                    <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i
                                            class="fas fa-check"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

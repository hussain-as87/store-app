@extends('layouts.admin_layout')
@section('header_page')
{{__('create product')}}
@endsection
@section('title')
{{__('create product')}}
@endsection
@section('name'){{ __('create') }}@endsection
@section('href'){{ route('coupons.create') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">{{ __('code') }}</th>
            <th scope="col">{{ __('discount value') }}</th>
            <th scope="col">{{ __('is active') }}</th>
            <th scope="col">{{ __('created at') }}</th>
            <th scope="col">{{ __('updated at') }}</th>
            @can('coupon-edit')
            <th scope="col">{{ __('edit') }}</th>
            @endcan
            @can('coupon-delete')
            <th scope="col">{{ __('delete') }}</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @foreach ($coupon as $key => $c)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ $c->code }}</td>
            <td>{{ $c->discount_value }}</td>
            <td class="@if($c->is_active == 1) text-success  @else  text-danger @endif">{{ $c->is_active ? __('active') :  __('inactive')}}</td>
            <td>{{ $c->created_at->diffForHumans() }}</td>
            <td>{{ $c->updated_at->diffForHumans() }}</td>
            @can('coupon-edit')
            <td>
                <button type="button" class="btn btn-info btn-circle" data-toggle="modal" data-target="#edit-coupon">
                    <i class="fas fa-edit" data-tooltip="{{ __('edit') }}"></i>
                </button></td>
            @endcan

            @can('coupon-delete')
            <td><a class="btn btn-danger btn-circle" href="{{ route('coupons.destroy', $c->id) }}" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash" data-tooltip="{{ __('delete') }}"></i>
                </a>
            </td>
            @endcan
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="edit-coupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ ('edit') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('coupons.update',$c->id) }}">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <select name="is_active" id="is_active" class="form-control mb-4 @error('discount_value')  alert-danger @enderror">
                                <option value="1" {{ $c->is_active == 1 ? 'selected' : '' }}>{{ __('active') }}</option>
                                <option value="0" {{ $c->is_active == 0 ? 'selected' : '' }}>{{ __('inactive') }}</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn badge-warning" data-dismiss="modal">{{__('Go Back')}} <i class="fas fa-arrow-left"></i></button>
                            <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
{!! $coupon->links() !!}
@endsection

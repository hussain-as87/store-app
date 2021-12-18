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
                <td>{{ $c->is_active ? __('inactive') : __('active') }}</td>
                <td>{{ $c->created_at->diffForHumans() }}</td>
                <td>{{ $c->updated_at->diffForHumans() }}</td>
                @can('coupon-delete')
                    <td><a class="btn btn-danger btn-circle" href="{{ route('coupons.destroy', $c->id) }}"
                           onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"
                                                                         data-tooltip="{{ __('delete') }}"></i>
                        </a>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $coupon->links() !!}
@endsection

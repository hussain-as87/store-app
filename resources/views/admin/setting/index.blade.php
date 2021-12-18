@extends('layouts.admin_layout')
@section('header_page')
{{ __('settings') }}@endsection
@section('title')
{{ __('settings') }}@endsection
@section('name'){{ __('categories') }}@endsection
@section('href'){{ route('categories.index') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> {{__('settings')}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <table class="table">
                        <thead>
                           <tr>
                                <th>{{ __('name') }}</th>
                                <th>{{ __('value') }}</th>
                                <th width="280px">{{ __('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($settings as $key => $setting)
                            <tr class="">
                                <td>{{ $setting->name }}</td>
                                <td class="text-primary">{{ $setting->value }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('settings.edit',$setting->id) }}">{{ __('edit') }}  <i class="fas fa-fw fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@extends('layouts.admin_layout')
@section('header_page')
{{__('contact')}}
@endsection
@section('title')
{{__('contact')}}
@endsection
@section('name'){{ __('categories') }}@endsection
@section('href'){{ route('categories.index') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> {{__('contacts')}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('email') }}</th>
                                <th width="280px">{{ __('Message') }}</th>
                                <th>{{ __('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $key => $con)
                            <tr>
                                <td>{{ $key}}</td>
                                <td>{{ $con->email }}</td>
                                <td>{{\Illuminate\Support\Str::limit($con->message,10) }}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.contact.destroy', $con->id], 'style' => 'display:inline']) !!}
                                    {!! Form::submit(__('delete'), ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $contacts->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

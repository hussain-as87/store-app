@extends('layouts.admin_layout')

@section('header_page')
    {{ __('roles') }}
@endsection
@section('title')
    {{ __('roles') }}
@endsection
@can('user-per')
@section('name'){{ __('users') }}@endsection
@section('href'){{ route('users.index') }}@endsection
@endcan
@can('role-create')
@section('name2'){{ __('create') }}@endsection
@section('href2'){{ route('roles.create') }}@endsection
@endcan

@section('content')


    <table class="table table-bordered">
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('name') }}</th>
            <th width="280px">{{ __('actions') }}</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info btn-circle" href="{{ route('roles.show', $role->id) }}"><i class="fa fa-book"
                                                                                                      data-tooltip="{{ __('show') }}"></i></a>
                    @can('role-edit')
                        <a class="btn btn-primary btn-circle" href="{{ route('roles.edit', $role->id) }}"><i
                                class="fa fa-edit" data-tooltip="{{ __('edit') }}"></i></a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                        <button type="submit" class="btn btn-danger btn-circle"><i class="fas fa-trash"
                                                                                   data-tooltip="{{ __('delete') }}"></i>
                        </button>
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $roles->render() !!}
@endsection

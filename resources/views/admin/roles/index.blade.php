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
                            <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">{{ __('show') }}</a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">{{ __('edit') }}</a>
                            @endcan
                            @can('role-delete')
                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                {!! Form::submit(__('delete'), ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $roles->render() !!}
        @endsection

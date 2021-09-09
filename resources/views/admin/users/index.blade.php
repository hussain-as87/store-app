@extends('layouts.admin_layout')

@section('header_page')
    {{ __('users') }}
@endsection
@section('title')
    {{ __('users') }}
@endsection
@can('user-per')
    @section('name'){{ __('create') }}@endsection
    @section('href'){{ route('users.create') }}@endsection
    @endcan
    @can('role-list')
        @section('name2'){{ __('roles') }}@endsection
        @section('href2'){{ route('roles.index') }}@endsection
        @endcan
        @section('content')
            <table class="table table-bordered">
                <tr>
                    <th>{{ __('#') }}</th>
                    <th>{{ __('name') }}</th>
                    <th>{{ __('email') }}</th>
                    <th>{{ __('status') }}</th>
                    <th>{{ __('roles') }}</th>
                    <th width="280px">{{ __('actions') }}</th>
                </tr>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="@if ($user->status === '0') text-success
                        @else
                            text-danger @endif">{{ $user->status ? __('inactive') : __('active') }} </td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">{{ __('show') }}</a>
                            @can('user-per')
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">{{ __('edit') }}</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                {!! Form::submit(__('delete'), ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}

                            @endcan

                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $data->render() !!}
        @endsection

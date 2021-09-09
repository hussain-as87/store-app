@extends('layouts.admin_layout')
@section('header_page')
    {{ __('trash') }}
@endsection
@section('title')
    {{ __('trash') }}
@endsection
@section('name'){{ __('create') }}@endsection
@section('href'){{ route('subcategories.create') }}@endsection
@section('name2'){{ __('categories') }}@endsection
@section('href2'){{ route('categories.index') }}@endsection
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('name') }}</th>
                <th scope="col">{{ __('deleted at') }}</th>
                <th scope="col">{{ __('restore') }}</th>
                <th scope="col">{{ __('force delete') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subcategories as $key => $cat)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $cat->name }}</a></td>
                    <td>{{ $cat->deleted_at->diffForHumans() }}</td>
                    <td><a class="btn btn-warning btn-circle" href="{{ route('subcategories.restore', $cat->id) }}">
                            <i class="fa fa-recycle"></i>
                        </a>
                    </td>

                    <td>
                        <a class="btn btn-danger btn-circle" href="{{ route('subcategories.forceDelete', $cat->id) }}"
                           onclick="return confirm('Are you sure?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash2" viewBox="0 0 16 16">
                                <path
                                    d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $subcategories->links() !!}
    </div>
@endsection

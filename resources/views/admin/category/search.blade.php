@extends('layouts.admin_layout')
@section('header_page')
    {{ __('categories') }}
@endsection
@section('title')
    {{ __('categories') }}
@endsection
@section('name'){{ __('create') }}@endsection
@section('href'){{ route('categories.create') }}@endsection
@section('name2'){{ __('categories') }}@endsection
@section('href2'){{ route('categories.index') }}@endsection
@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('name') }}</th>
                    <th scope="col">{{ __('created at') }}</th>
                    <th scope="col">{{ __('updated at') }}</th>
                    <th scope="col">{{ __('products') }}</th>
                    <th scope="col">{{ __('subcategories') }}</th>
                    @can('update', $category)
                        <th scope="col">{{ __('edit') }}</th>
                    @endcan
                    @can('delete', $category)
                        <th scope="col">{{ __('delete') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>

                @if ($categories->count() > 0)
                    {{-- <p> The Search results for your query <b> {{ $query }} </b> are :</p> --}}
                    @foreach ($categories as $key => $cat)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td><a href="{{ route('category.show', $cat->id) }}">{{ $cat->name }}</a></td>
                            <td>{{ $cat->created_at->diffForHumans() }}</td>
                            <td>{{ $cat->updated_at->diffForHumans() }}</td>
                            <td>{{ $cat->products->count() }}</td>
                            <td>{{ $cat->subcategories->count() }}</td>
                            @can('update', $category)
                                <td><a class="btn btn-dark btn-circle" href="{{ route('categories.edit', $cat->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                </a></td>@endcan
                            @can('delete', $category)
                                <td>
                                    <a class="btn btn-danger btn-circle" href="{{ route('categories.destroy', $cat->id) }}"
                                        onclick="return confirm('Are you sure?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path
                                                d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                        </svg>
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                @else
                    {{ __('not found') }}
                @endif
            </tbody>
        </table>
        {!! $categories->links() !!}
    </div>
@endsection

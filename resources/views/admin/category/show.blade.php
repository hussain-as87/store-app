@extends('layouts.admin_layout')
@section('header_page')
    {{ $category->name }}
@endsection
@section('title')
    {{ $category->name }}
@endsection
@section('name'){{ __('create') }}@endsection
@section('href'){{ route('categories.create') }}@endsection
@section('name2'){{ __('categories') }}@endsection
@section('href2'){{ route('categories.index') }}@endsection
@section('content')
    <h3>{{ __('subcategories') }}</h3>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('name') }}</th>
                <th scope="col">{{ __('created at') }}</th>
                <th scope="col">{{ __('updated at') }}</th>
                <th scope="col">{{ __('products') }}</th>
                <th scope="col">{{ __('edit') }}</th>
                <th scope="col">{{ __('delete') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subcategories as $key => $cat)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->created_at->diffForHumans() }}</td>
                    <td>{{ $cat->updated_at->diffForHumans() }}</td>
                    <td>{{ $cat->products_count }}</td>
                    <td><a class="btn btn-dark btn-circle" href="{{ route('subcategories.edit', $cat->id) }}">
                            <i class="fa fa-edit" data-tooltip="{{ __('edit') }}"></i>

                        </a></td>
                    <td>
                        <form method="post" action="{{ route('subcategories.destroy', $cat->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"
                                    type="submit">
                                {{__('delete') }} <i class="fas fa-trash" data-tooltip="{{ __('delete') }}"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $subcategories->links() !!}
    </div>
    <h3>{{ __('products') }}</h3>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ __('image') }}</th>
                <th scope="col">#</th>
                <th scope="col">{{ __('name') }}</th>
                <th scope="col">{{ __('category') }}</th>
                <th scope="col">{{ __('description') }}</th>
                <th scope="col">{{ __('price') }}</th>
                <th scope="col">{{ __('user') }}</th>
                <th scope="col">{{ __('created at') }}</th>
                <th scope="col">{{ __('updated at') }}</th>
                <th scope="col">{{ __('edit') }}</th>
                <th scope="col">{{ __('delete') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $key => $prod)
                <tr>

                    <td><img src="{{ asset('storage/products/' . $prod->image) }}" alt="{{ $prod->name }}"
                             style="width: 60px"/></td>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $prod->name }}</td>
                    <td>{{ $prod->category->name }}</td>
                    <td>
                        @if ($prod->description != null)
                            {!! \Illuminate\Support\Str::limit($prod->description, '15') !!}
                        @else
                            no description
                        @endif
                    </td>
                    <td>{{ $prod->price }} $</td>
                    <td>{{ $prod->user->name }}</td>
                    <td>{{ $prod->created_at->diffForHumans() }}</td>
                    <td>{{ $prod->updated_at->diffForHumans() }}</td>
                    <td><a class="btn btn-dark btn-circle" href="{{ route('products.edit', $prod->id) }}">
                            <i class="fa fa-edit" data-tooltip="{{ __('edit') }}"></i>

                        </a></td>
                    <td><a class="btn btn-danger btn-circle" href="{{ route('products.destroy', $prod->id) }}"
                           onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash" data-tooltip="{{ __('delete') }}"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $products->links() !!}
    </div>

@endsection

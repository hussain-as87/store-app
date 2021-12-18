<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> {{__('products')}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <div class="dataTables_length" id="dataTable_length"><label>{{__('show')}} <select
                                        wire:model="perPage"
                                        name="perPage"
                                        class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> </label></div>
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <div class="dataTables_length" id="sort_by">
                                <p>{{__('order by')}}
                                    <select
                                        wire:model="orderBy"
                                        id="sort_by"
                                        class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="id">{{__('id')}}</option>
                                        <option value="name">{{__('name')}}</option>
                                        <option value="created_at">{{__('created at')}}</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="dataTables_filter" id="sort">
                                <p>{{__('sort type')}}
                                    <select
                                        id="sort"
                                        wire:model="orderAsc"
                                        name="perPage"
                                        class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="1">{{__('Ascending')}}</option>
                                        <option value="0">{{__('Descending')}}</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div id="dataTable_filter" class="dataTables_filter"><label>{{__('search')}}:<input
                                        type="search"
                                        wire:model.debounce.300ms="search"
                                        class="form-control form-control-sm" style="width:739px"
                                        placeholder="{{__('Search Here')}}"
                                        aria-controls="dataTable"></label>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('image') }}</th>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('name') }}</th>
                            <th scope="col">{{ __('category') }}</th>
                            <th scope="col">{{ __('price') }}</th>
                            <th scope="col">{{ __('user') }}</th>
                            <th scope="col">{{ __('store') }}</th>
                            <th scope="col">{{ __('created at') }}</th>
                            <th scope="col">{{ __('updated at') }}</th>
                            @can('product-edit')
                                <th scope="col">{{ __('edit') }}</th>
                            @endcan
                            @can('product-delete')
                                <th scope="col">{{ __('delete') }}</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($product as $key => $prod)
                            <tr>

                                <td><img src="{{ asset('storage/products/' . $prod->image) }}"
                                         alt="{{ $prod->name }}"
                                         style="width: 50px;"/></td>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $prod->name }}</td>
                                <td>{{ $prod->category->name }}</td>
                                <td>{{ $prod->price }} $</td>
                                <td>{{ $prod->user->name }}</td>
                                <td>{{ $prod->user->store->name }}</td>
                                <td>{{ $prod->created_at->diffForHumans() }}</td>
                                <td>{{ $prod->updated_at->diffForHumans() }}</td>
                                @can('product-edit')

                                    <td><a class="btn btn-dark btn-circle"
                                           href="{{ route('products.edit', $prod->id) }}">
                                            <i class="fa fa-edit" data-tooltip="{{ __('edit') }}"></i>

                                        </a></td> @endcan

                                @can('product-delete')
                                    <td><a class="btn btn-danger btn-circle"
                                           href="{{ route('products.destroy', $prod->id) }}"
                                           onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash" data-tooltip="{{ __('delete') }}"></i>
                                        </a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $product->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

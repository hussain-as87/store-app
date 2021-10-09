<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> {{__('categories')}}</h6>
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
                                        name="perPage"
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
                            <div id="dataTable_filter" class="dataTables_filter"><label>{{__('search')}}:<input type="search"
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
                        @foreach ($categories as $key => $cat)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td><a href="{{ route('categories.show', $cat->id) }}">{{ $cat->name }}</a></td>
                                <td>{{ $cat->created_at->diffForHumans() }}</td>
                                <td>{{ $cat->updated_at->diffForHumans() }}</td>
                                <td>{{ $cat->products_count }}</td>
                                <td>{{ $cat->subcategories_count }}</td>
                                @can('category-edit')
                                    <td><a class="btn btn-dark btn-circle" href="{{ route('categories.edit', $cat->id) }}">
                                            <i class="fa fa-edit"></i>

                                        </a></td>@endcan
                                @can('category-delete')
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
                        </tbody>
                    </table>
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

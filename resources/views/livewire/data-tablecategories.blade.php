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
                                        wire:model="perPage" name="perPage"
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
                                    <select wire:model="orderBy" name="perPage" id="sort_by"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="id">{{__('id')}}</option>
                                        <option value="name">{{__('name')}}</option>
                                        <option value="name">{{__('content')}}</option>
                                        <option value="created_at">{{__('created at')}}</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="dataTables_filter" id="sort">
                                <p>{{__('sort type')}}
                                    <select id="sort" wire:model="orderAsc" name="perPage"
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
                                        type="search" wire:model.debounce.300ms="search"
                                        class="form-control form-control-sm" style="width:739px"
                                        placeholder="{{__('Search Here')}}" aria-controls="dataTable"></label>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('image') }}</th>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('name') }}</th>
                            <th scope="col">{{ __('content') }}</th>
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
                                <td><img src="{{ asset('storage/category/' . $cat->photo) }}" alt="{{ $cat->name }}"
                                         style="width: 50px"/></td>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td><a href="{{ route('categories.show', $cat->id) }}">{{ $cat->name }}</a></td>
                                <td>{{ $cat->content }}</td>
                                <td>{{ $cat->created_at->diffForHumans() }}</td>
                                <td>{{ $cat->updated_at->diffForHumans() }}</td>
                                <td>{{ $cat->products_count }}</td>
                                <td>{{ $cat->subcategories_count }}</td>
                                @can('category-edit')
                                    <td><a class="btn btn-dark btn-circle"
                                           href="{{ route('categories.edit', $cat->id) }}">
                                            <i class="fa fa-edit" data-tooltip="{{ __('edit') }}"></i>

                                        </a></td>@endcan
                                @can('category-delete')
                                    <td>
                                        <a class="btn btn-danger btn-circle"
                                           href="{{ route('categories.destroy', $cat->id) }}"
                                           onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash" data-tooltip="{{ __('delete') }}"></i>
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

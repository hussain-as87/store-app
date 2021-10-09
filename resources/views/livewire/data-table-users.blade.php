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
                            <th>{{ __('#') }}</th>
                            <th>{{ __('name') }}</th>
                            <th>{{ __('email') }}</th>
                            <th>{{ __('status') }}</th>
                            <th>{{ __('roles') }}</th>
                            <th width="280px">{{ __('actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
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
                                    <a class="btn btn-info"
                                       href="{{ route('users.show', $user->id) }}">{{ __('show') }}</a>
                                    @can('user-per')
                                        <a class="btn btn-primary"
                                           href="{{ route('users.edit', $user->id) }}">{{ __('edit') }}</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                        {!! Form::submit(__('delete'), ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}

                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $data->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

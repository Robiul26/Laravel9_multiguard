@section('title', 'Role List')
<x-app-layout>
    <!-- Page Content -->
    <main>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Role</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a
                                        href="{{ Auth::guard('admin')->user() ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>

                                </li>
                                <li class="breadcrumb-item active">Role</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            {{-- Message --}}
                            @include('layouts.partials.message')

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Role List</h3>
                                    {{-- @if (Auth::guard('admin')->user()->can('role.create')) --}}
                                    <button type="button" class="btn btn-primary add_customer" data-toggle="modal"
                                        data-target=".bs-example-modal-add_data" style="float: right;"><i
                                            class="fa fa-plus"></i> NEW
                                        Role</button>
                                    {{-- @endif --}}
                                </div>

                                <div class="card-body">
                                    <table id="example" class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">SN</th>
                                                <th>ID</th>
                                                <th>Role NAME</th>
                                                <th>Permissions</th>
                                                <th style="width: 10%;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sl = 0 @endphp
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{ ++$sl }}</td>
                                                    <td>{{ $role->id }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        @foreach ($role->permissions as $permis)
                                                            <span class="badge badge-success">{{ $permis->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td class="d-flex">
                                                        @if (Auth::guard('admin')->user()->can('role.edit'))
                                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                                class="btn btn-primary btn-xs mr-2"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::guard('admin')->user()->can('role.delete'))
                                                            <form action="{{ route('roles.destroy', $role->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs"
                                                                    onclick="return confirm('Are you sure you want to delete this Role ?');">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                {{-- Edit modal --}}
                                                <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Role </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <form action="{{ route('roles.update', $role->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="col-md-12 col-sm-12 col-12 mt-3">
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <label for="">Role Name</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" placeholder="Role Name *"
                                                                            value="{{ $role->name }}"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'Role Name *'" />
                                                                        @error('name')
                                                                            <div class="alert text-danger">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <p>Permission</p>
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">

                                                                        {{-- <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="checkAllEdit">
                                                                            <label class="custom-control-label"
                                                                                for="checkAllEdit">All</label>
                                                                        </div> --}}
                                                                        @foreach ($permissions as $permission)
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    name="permissions[]"
                                                                                    value="{{ $permission->name }}"
                                                                                    class="custom-control-input"
                                                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                                                    id="checkEdit{{ $permission->id }}">
                                                                                <label class="custom-control-label"
                                                                                    for="checkEdit{{ $permission->id }}">{{ $permission->name }}</label>
                                                                            </div>
                                                                        @endforeach

                                                                        @error('permissions')
                                                                            <div class="alert text-danger">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="far fa-save"></i>&nbsp;&nbsp;Save
                                                                        Changes</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal"><i
                                                                            class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="modal fade bs-example-modal-add_data" data-backdrop="static" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Role</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="col-md-12 col-sm-12 col-12 mt-3">

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="">Role Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Role Name *"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Role Name *'" />
                                @error('name')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-12 mt-3">

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="">Permission</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                    <label class="custom-control-label" for="checkAll">All</label>
                                </div>
                                <hr>
                                @foreach ($permissions as $permission)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="custom-control-input" id="check{{ $permission->id }}">
                                        <label class="custom-control-label"
                                            for="check{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach

                                @error('permissions')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-save"></i>&nbsp;&nbsp;Save Role</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


    @section('scripts')
        {{-- for Add new --}}
        <script>
            $('#checkAll').click(function() {
                if ($(this).is(':checked')) {
                    let allChecked = $('input[type=checkbox]').prop('checked', true);
                } else {
                    $('input[type=checkbox]').prop('checked', false);
                }
            });
        </script>

        {{-- for Edit --}}
        <script>
            $('#checkAllEdit').click(function() {
                if ($(this).is(':checked')) {
                    let allCheckedEdit = $('input[type=checkbox]').prop('checked', true);
                } else {
                    $('input[type=checkbox]').prop('checked', false);
                }
            });
        </script>
    @endsection

</x-app-layout>

@section('title', 'permission List')
<x-app-layout>
    <!-- Page Content -->
    <main>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>permission</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a
                                        href="{{ Auth::guard('admin')->user() ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>

                                </li>
                                <li class="breadcrumb-item active">permission</li>
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
                                    <h3 class="card-title">permission List</h3>
                                    {{-- @if (Auth::guard('admin')->user()->can('permission.create')) --}}
                                    <button type="button" class="btn btn-primary add_customer" data-toggle="modal"
                                        data-target=".bs-example-modal-add_data" style="float: right;"><i
                                            class="fa fa-plus"></i> NEW
                                        permission</button>
                                    {{-- @endif --}}
                                </div>

                                <div class="card-body">
                                    <table id="example" class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">SN</th>
                                                <th>Permission Name</th>
                                                <th style="width: 10%;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sl = 0 @endphp
                                            @foreach ($permissions as $permission)
                                                <tr>
                                                    <td>{{ ++$sl }}</td>
                                                    <td>{{ $permission->name }}</td>
                                                    <td class="d-flex">
                                                        {{-- @if (Auth::guard('admin')->user()->can('permission.edit')) --}}
                                                        {{-- <a href="{{ route('permissions.edit', $permission->id) }}"
                                                            class="btn btn-primary btn-xs mr-2"><i
                                                                class="fa fa-edit"></i></a> --}}
                                                        {{-- @endif --}}
                                                        <button type="button" class="btn btn-primary btn-xs mr-2"
                                                            data-toggle="modal" data-target="#editModal{{ $permission->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        {{-- @if (Auth::guard('admin')->user()->can('permission.delete')) --}}
                                                        <form
                                                            action="{{ route('permissions.destroy', $permission->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs"
                                                                onclick="return confirm('Are you sure you want to delete this permission ?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        {{-- @endif --}}
                                                    </td>
                                                </tr>
                                                {{-- Edit modal --}}
                                                <div class="modal fade" id="editModal{{ $permission->id }}"
                                                    tabindex="-1" permission="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit permission </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('permissions.update', $permission->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="col-md-12 col-sm-12 col-12 mt-3">
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <label for="">Permission Name</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name"
                                                                            placeholder="permission Name *"
                                                                            value="{{ $permission->name }}"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'permission Name *'" />
                                                                        @error('name')
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
        <div class="modal fade bs-example-modal-add_data" data-backdrop="static" tabindex="-1" permission="dialog"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New permission</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <form action="{{ route('permissions.store') }}" method="post">
                        @csrf
                        <div class="col-md-12 col-sm-12 col-12 mt-3">

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="">permission Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="permission Name *" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'permission Name *'" />
                                @error('name')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-save"></i>&nbsp;&nbsp;Save permission</button>
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

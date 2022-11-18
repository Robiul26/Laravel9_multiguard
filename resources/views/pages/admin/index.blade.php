@section('title', 'Admin List')
<x-app-layout>
    <!-- Page Content -->
    <main>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Admin</li>
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
                                    <h3 class="card-title">Admin List</h3>

                                    <button type="button" class="btn btn-primary add_customer" data-toggle="modal"
                                        data-target=".bs-example-modal-add_data" style="float: right;"><i
                                            class="fa fa-plus"></i> NEW
                                        Admin</button>
                                </div>

                                <div class="card-body">
                                    <table id="example" class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">SN</th>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>Email</th>
                                                <th>Roles</th>
                                                <th style="width: 10%;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sl = 0 @endphp
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td>{{ ++$sl }}</td>
                                                    <td>{{ $admin->id }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>
                                                        @foreach ($admin->roles as $role)
                                                            <span class="badge badge-info">{{ $role->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td class="d-flex">
                                                        <button type="button" class="btn btn-primary btn-xs mr-2"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $admin->id }}"><i
                                                                class="fa fa-edit"></i></button>
                                                        <form action="{{ route('admins.destroy', $admin->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs"
                                                                onclick="return confirm('Are you sure you want to delete this User ?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                {{-- Edit modal --}}
                                                <div class="modal fade" id="editModal{{ $admin->id }}" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Admin Information </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <form action="{{ route('admins.update', $admin->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="col-md-12 col-sm-12 col-12 mt-3">

                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <label for="name">User Name <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" id="name"
                                                                            value="{{ $admin->name }}"
                                                                            placeholder="User Name *"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'User Name *'"
                                                                            required autofocus />
                                                                        @error('name')
                                                                            <div class="alert text-danger">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <label for="email">User Email <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="email" class="form-control"
                                                                            name="email" id="email"
                                                                            value="{{ $admin->email }}"
                                                                            placeholder="User Email *"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'User Email *'"
                                                                            required autofocus />
                                                                        @error('email')
                                                                            <div class="alert text-danger">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <label for="password">Password <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="password" class="form-control"
                                                                            name="password" id="password"
                                                                            value="{{ old('password') }}"
                                                                            autocomplete="new-password" />
                                                                        @error('password')
                                                                            <div class="alert text-danger">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <label for="password_confirmation">Confirm
                                                                            Password <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="password" class="form-control"
                                                                            name="password_confirmation"
                                                                            id="password_confirmation" />
                                                                        @error('password_confirmation')
                                                                            <div class="alert text-danger">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <label for="roles{{$admin->id}}">Assign Roles <span
                                                                                class="text-danger">*</span></label>
                                                                        <select class="form-control select2"
                                                                            name="roles[]" id="roles{{$admin->id}}"
                                                                            style="width:100%;" required multiple>
                                                                            @foreach ($roles as $role)
                                                                                <option value="{{ $role->name }}"
                                                                                    {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                                                                                    {{ $role->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('roles')
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
                        <h4 class="modal-title">Users Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <form method="POST" action="{{ route('admins.store') }}">
                        @csrf
                        <div class="col-md-12 col-sm-12 col-12 mt-3">

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="name">User Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}" placeholder="User Name *"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'User Name *'" required
                                    autofocus />
                                @error('name')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="email">User Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ old('email') }}" placeholder="User Email *"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'User Email *'"
                                    required autofocus />
                                @error('email')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password"
                                    value="{{ old('password') }}" required autocomplete="new-password" />
                                @error('password')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="password_confirmation">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" required />
                                @error('password_confirmation')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="roles">Assign Roles <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="roles[]" id="roles"
                                    style="width:100%;" required multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


    @section('scripts')

    @endsection

</x-app-layout>

@section('title', 'Role List')
<x-app-layout>
    <!-- Page Content -->
    <main>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Role</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Role</li>
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
                                    <h3 class="card-title">Edit Role</h3>
                                       <a href="{{ route('roles.index') }}" class="btn btn-primary add_customer" style="float: right;"><i
                                            class="fa fa-list"></i>
                                        Role List</a>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('roles.update', $role->id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-md-12 col-sm-12 col-12 mt-3">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label for="">Role Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Role Name *" value="{{ $role->name }}"
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
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">

                                                {{-- <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="checkAllEdit">
                                                                            <label class="custom-control-label"
                                                                                for="checkAllEdit">All</label>
                                                                        </div> --}}
                                                @foreach ($permissions as $permission)
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission->name }}" class="custom-control-input"
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>


    @section('scripts')

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

@section('title', 'Category List')
<x-app-layout>
    <!-- Page Content -->
    <main>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Category</li>
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
                                    <h3 class="card-title">Category List</h3>

                                    <button type="button" class="btn btn-primary add_customer" data-toggle="modal"
                                        data-target=".bs-example-modal-add_data" style="float: right;"><i
                                            class="fa fa-plus"></i> NEW
                                        Category</button>
                                </div>

                                <div class="card-body">
                                    <table id="example" class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">SN</th>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th style="width: 10%;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sl = 0 @endphp
                                            @foreach ($categories as $item)
                                                <tr>
                                                    <td>{{ ++$sl }}</td>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="d-flex">
                                                        <button type="button"
                                                            class="btn btn-primary btn-xs mr-2"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $item->id }}"><i
                                                                class="fa fa-edit"></i></button>
                                                        <form action="{{ route('categories.destroy', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs"
                                                                onclick="return confirm('Are you sure you want to delete this Unit ?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                {{-- Edit modal --}}
                                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Unit Information </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <form action="{{ route('categories.update', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="col-md-12 col-sm-12 col-12 mt-3">

                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <input type="text" class="form-control"
                                                                            name="name" placeholder="Category Name *"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'Category Name *'"
                                                                            value="{{ $item->name }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
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
                        <h4 class="modal-title">Warehouse Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="col-md-12 col-sm-12 col-12 mt-3">

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <input type="text" class="form-control" name="name"
                                    placeholder="Customer Name *" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Customer Name *'" />
                                @error('name')
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

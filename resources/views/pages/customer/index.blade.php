@section('title', 'Customer List')
<x-app-layout>
    <!-- Page Content -->
    <main>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Customer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer</li>
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
                                    <h3 class="card-title">Customer List</h3>

                                    <button type="button" class="btn btn-primary add_customer" data-toggle="modal"
                                        data-target=".bs-example-modal-add_customer" style="float: right;"><i
                                            class="fa fa-plus"></i> NEW
                                        CUSTOMER</button>
                                </div>

                                <div class="card-body">
                                    <table id="example" class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">SN</th>
                                                <th>Photo</th>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>MOBILE</th>
                                                <th>NID</th>
                                                <th>ADDRESS</th>
                                                <th>EMAIL</th>
                                                <th>NOMINEE NAME</th>
                                                <th>NOMINEE MOBILE</th>
                                                <th style="width: 10%;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sl = 0 @endphp
                                            @foreach ($customers as $item)
                                                <tr>
                                                    <td>{{ ++$sl }}</td>
                                                    <td>
                                                        <img class="w-100"
                                                            src="{{ asset('uploads/images/customer/' . $item->photo) }}"
                                                            alt="">
                                                    </td>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->mobile }}</td>
                                                    <td>{{ $item->nid }}</td>
                                                    <td>{{ $item->address }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->nominee_name }}</td>
                                                    <td>{{ $item->nominee_mobile }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $item->id }}"><i
                                                                class="fa fa-edit"></i></button>
                                                        <form action="{{ route('customers.destroy', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs"
                                                                onclick="return confirm('Are you sure you want to delete this Customer ?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                {{-- Edit modal --}}
                                                <div class="modal fade" id="editModal{{ $item->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Customer Information </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <form action="{{ route('customers.update', $item->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="col-md-12 col-sm-12 col-12 mt-3">

                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <input type="text" class="form-control"
                                                                            name="name" placeholder="Customer Name *"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'Customer Name *'"
                                                                            value="{{ $item->name }}" />
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-12">
                                                                        <input type="text" class="form-control"
                                                                            name="mobile" placeholder="Mobile Number *"
                                                                            onkeypress="return isNumberKey(event)"
                                                                            maxlength="11" minlength="11"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'Mobile Number *'"
                                                                            value="{{ $item->mobile }}" />
                                                                    </div>
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <input type="text" class="form-control"
                                                                            name="nid" placeholder="NID (Optional)"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'NID (Optional)'"
                                                                            value="{{ $item->nid }}" />
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-12">
                                                                        <input type="text" class="form-control"
                                                                            name="address" placeholder="Address *"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'Address *'"
                                                                            value="{{ $item->address }}" />
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-12">
                                                                        <input type="file"
                                                                            class="form-control d-none" name="photo"
                                                                            id="photo{{ $item->id }}"
                                                                            onchange="document.getElementById('output{{ $item->id }}').src = window.URL.createObjectURL(this.files[0])">


                                                                        <div class="align-items-center row">
                                                                            <div class="col-md-6">
                                                                                <label for="photo{{ $item->id }}"
                                                                                    class="form-control font-weight-normal">Photo
                                                                                    (Optional)
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="photo{{ $item->id }}">
                                                                                    <img id="output{{ $item->id }}"
                                                                                        class="w-50"
                                                                                        src="{{ asset('uploads/images/customer/' . $item->photo) }}"
                                                                                        alt="{{ $item->photo }}">
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-12">
                                                                        <input type="email" class="form-control"
                                                                            name="email"
                                                                            placeholder="example@sunshine.com (Optional)"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'example@sunshine.com (Optional)'"
                                                                            value="{{ $item->email }}" />
                                                                    </div>
                                                                    <div
                                                                        class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <input type="text" class="form-control"
                                                                            name="nominee_name"
                                                                            placeholder="Nominee Name (Optional)"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'Nominee Name (Optional)'"
                                                                            value="{{ $item->nominee_name }}" />
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-12">
                                                                        <input type="text" class="form-control"
                                                                            name="nominee_mobile"
                                                                            placeholder="Nominee Mobile Number (Optional)"
                                                                            onkeypress="return isNumberKey(event)"
                                                                            maxlength="11" minlength="11"
                                                                            onfocus="this.placeholder = ''"
                                                                            onblur="this.placeholder = 'Nominee Mobile Number (Optional)'"
                                                                            value="{{ $item->nominee_mobile }}" />
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
        <div class="modal fade bs-example-modal-add_customer" data-backdrop="static" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Customer Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 mt-3">
                            <input type="text" class="form-control" name="name" placeholder="Customer Name *"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Customer Name *'" />
                            @error('name')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-12">
                            <input type="text" class="form-control" name="mobile" placeholder="Mobile Number *"
                                onkeypress="return isNumberKey(event)" maxlength="11" minlength="11"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile Number *'" />
                            @error('mobile')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" name="nid" placeholder="NID (Optional)"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'NID (Optional)'" />
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-12">
                            <input type="text" class="form-control" name="address" placeholder="Address *"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address *'" />
                            @error('address')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-12">
                            <input type="file" class="form-control d-none" name="photo" id="photo"
                                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">


                            <div class="align-items-center row">
                                <div class="col-md-12" id="photoLabel">
                                    <label for="photo" class="form-control font-weight-normal">Photo
                                        (Optional)
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label for="photo">
                                        <img id="output" class="w-50" src="#" alt="">
                                    </label>
                                </div>
                            </div>
                        </div>




                        <div class="form-group col-md-12 col-sm-12 col-12">
                            <input type="email" class="form-control" name="email"
                                placeholder="example@sunshine.com (Optional)" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'example@sunshine.com (Optional)'" />
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" name="nominee_name"
                                placeholder="Nominee Name (Optional)" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Nominee Name (Optional)'" />
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-12">
                            <input type="text" class="form-control" name="nominee_mobile"
                                placeholder="Nominee Mobile Number (Optional)" onkeypress="return isNumberKey(event)"
                                maxlength="11" minlength="11" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Nominee Mobile Number (Optional)'" />
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
        <script type="text/javascript">
            $(function() {
                $('#photo').on('change', function() {
                    $('#photoLabel').addClass('col-md-6');
                    $('#photoLabel').removeClass('col-md-12');
                });
            });
        </script>
    @endsection

</x-app-layout>

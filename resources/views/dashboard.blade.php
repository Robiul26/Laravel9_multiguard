<x-app-layout>
    <!-- Page Content -->
    <main>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                   <a
                                        href="{{ Auth::guard('admin')->user() ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>

                               
                                </li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            @php
                $totalCustomer = App\Models\Customer::where('status', 1)->count();
                $totalWarhouse = App\Models\Warhouse::count();
                $totalUser = App\Models\User::count();
            @endphp


            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Dashboard</h3>
                                </div>

                                <div class="card-body">
                                    <section class="content">
                                        <div class="container-fluid">
                                            <div class="box-header with-border">
                                                <h2><b>WELCOME TO "Cold Storage Management System"</b></h2>
                                            </div>
                                            <div class="row">

                                                <div class="col-lg-3 col-6">
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3>{{ $totalCustomer < 9 ? '0' . $totalCustomer : $totalCustomer }}
                                                            </h3>
                                                            <p>Total Customer</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-stats-bars"></i>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-3 col-6">
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3>{{ $totalWarhouse < 9 ? '0' . $totalWarhouse : $totalWarhouse }}
                                                            </h3>
                                                            <p>Total Warhouse</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-bag"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3>50</h3>
                                                            <p>Today Expense</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-pie-graph"></i>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-3 col-6">
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3>100</h3>
                                                            <p>Today Profit</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-stats-bars"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3>{{ $totalUser < 9 ? '0' . $totalUser : $totalUser }}
                                                            </h3>
                                                            <p>Total User</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-person-add"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <a href="#">
                                                        <div class="small-box bg-success">
                                                            <div class="inner">
                                                                <h3>100</h3>
                                                                <p>Total Invoice</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="far fa-money-bill-alt"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <a href="#">
                                                        <div class="small-box bg-primary">
                                                            <div class="inner">
                                                                <h3>gg</h3>
                                                                <p>Total Customer</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fas fa-users"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <a href="#">
                                                        <div class="small-box bg-info">
                                                            <div class="inner">
                                                                <h3>gg</h3>
                                                                <p>Total Supplier</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <a href="#">
                                                        <div class="small-box bg-secondary">
                                                            <div class="inner">
                                                                <h3>gg</h3>
                                                                <p>Total Product</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="ion ion-bag"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-app-layout>

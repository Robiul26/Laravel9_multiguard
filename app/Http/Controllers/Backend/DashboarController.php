<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;
use App\Models\Warhouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboarController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        // if (is_null($this->user) || !$this->user->can('dashboard.view')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view dashboard !!');
        // }

        $data['totalCustomer'] = Customer::where('status', 1)->count();
        $data['totalWarhouse'] = Warhouse::count();
        $data['totalAdmin'] = Admin::count();
        $data['totalUser'] = User::count();
        $data['totalRole'] = Role::count();
        $data['totalPermission'] = Permission::count();
        return view('backend.dashboard', $data);
    }
}

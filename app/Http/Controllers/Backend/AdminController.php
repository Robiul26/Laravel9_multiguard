<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
  public $user;

  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      $this->user = Auth::guard('admin')->user();
      return $next($request);
    });
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (is_null($this->user) || !$this->user->can('Admin View')) {
      abort(403, 'Sorry !! You are Unauthorized to view any admin !!');
    }

    $data['admins'] = Admin::all();
    $data['roles'] = Role::all();
    return view('pages.admin.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    if (is_null($this->user) || !$this->user->can('Admin Create')) {
      abort(403, 'Sorry !! You are Unauthorized to create admin !!');
    }
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if (is_null($this->user) || !$this->user->can('Admin Create')) {
      abort(403, 'Sorry !! You are Unauthorized to create admin !!');
    }

    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:100|unique:admins',
      'password' => 'required|min:8|confirmed',
    ]);

    $user = new Admin();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    if ($request->roles) {
      $user->assignRole($request->roles);
    }
    return redirect()->back()->with('success', 'User has been created !!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {

    if (is_null($this->user) || !$this->user->can('Admin View')) {
      abort(403, 'Sorry !! You are Unauthorized to view any admin !!');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    if (is_null($this->user) || !$this->user->can('Admin Edit')) {
      abort(403, 'Sorry !! You are Unauthorized to edit admin !!');
    }

    $data['user'] = Admin::findOrFail($id);
    $data['roles'] = Role::all();
    return view('pages.admin.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function update(Request $request, $id)
  {
    if (is_null($this->user) || !$this->user->can('Admin Edit')) {
      abort(403, 'Sorry !! You are Unauthorized to edit admin !!');
    }

    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:100|unique:admins,email,' . $id,
      'password' => 'nullable|min:8|confirmed',
    ]);

    $user =  Admin::find($id);
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->password) {
      $user->password = Hash::make($request->password);
    }

    $user->update();

    $user->roles()->detach();
    if ($request->roles) {
      $user->assignRole($request->roles);
    }
    return redirect()->back()->with('success', 'User has been updated !!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (is_null($this->user) || !$this->user->can('Admin Delete')) {
      abort(403, 'Sorry !! You are Unauthorized to delete any admin !!');
    }

    $user = Admin::findOrFail($id);
    $user->delete();
    return redirect()->back()->with('success', 'User has been deleted !!');
  }
}

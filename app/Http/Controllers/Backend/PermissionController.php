<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // public $user;

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         $this->user = Auth::guard('admin')->user();
    //         return $next($request);
    //     });
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // if (is_null($this->user) || !$this->user->can('permission.view')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any permission !!');
        // }
        $data['permissions'] = Permission::all();
        return view('pages.permission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (is_null($this->user) || !$this->user->can('permission.create')) {
        //     abort(403, 'Sorry !! You are Unauthorized to create any permission !!');
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (is_null($this->user) || !$this->user->can('permission.create')) {
        //     abort(403, 'Sorry !! You are Unauthorized to create any permission !!');
        // }
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        // $data = new permission();
        // $data->name = $request->name;
        // $data->save();
        permission::create(['name' => $request->name, 'guard_name' => 'admin']);



        return redirect()->back()->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (is_null($this->user) || !$this->user->can('permission.view')) {
        //     abort(403, 'Sorry !! You are Unauthorized to create any permission !!');
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (is_null($this->user) || !$this->user->can('permission.edit')) {
        //     abort(403, 'Sorry !! You are Unauthorized to edit any permission !!');
        // }
        $data['permission'] = permission::findOrFail($id);
        return view('pages.permission.edit', $data);
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
        // if (is_null($this->user) || !$this->user->can('permission.edit')) {
        //     abort(403, 'Sorry !! You are Unauthorized to update any permission !!');
        // }
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $permission = permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->update();

        return redirect()->back()->with('success', 'Data Saved Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        // if (is_null($this->user) || !$this->user->can('permission.delete')) {
        //     abort(403, 'Sorry !! You are Unauthorized to delete any permission !!');
        // }
        $permission = permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['customers'] = Customer::get();
        return view('pages.customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Customer Create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        $data = new Customer();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->nid = $request->nid;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->nominee_name = $request->nominee_name;
        $data->nominee_mobile = $request->nominee_mobile;
        // For Photo Request
        if ($request->has('photo')) {
            $fileName = $request->mobile . '-customer-' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/customer'), $fileName);
            $data->photo = $fileName;
        }
        $data->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = Customer::findOrFail($id);
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->nid = $request->nid;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->nominee_name = $request->nominee_name;
        $data->nominee_mobile = $request->nominee_mobile;
        // For Photo Request
        if ($request->has('photo')) {
            $fileName = $request->mobile . '-customer-' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/customer'), $fileName);

            if ($data->photo) {
                $file_path = public_path() . "/uploads/images/customer/" . $data->photo;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $data->photo = $fileName;
            }
        }
        $data->update();
        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        //check file
        if ($customer->photo) {
            //file path
            $file_path = public_path() . "/uploads/images/customer/" . $customer->photo;
            //check file path
            if (file_exists($file_path)) {
                //file delete
                unlink($file_path);
            }
        }
        $customer->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }





}

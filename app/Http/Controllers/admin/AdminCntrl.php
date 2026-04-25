<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
// use Auth;
use App\Models\User;

class AdminCntrl extends Controller
{
    public function adminUser_dashboard()
    {
        $browserhead['getrecord'] = User::getAdmin();
        $browserhead['header_title'] = 'AdminUser-dashboard';
        return view('admin.admin.list' ,$browserhead);
    }
    public function adminUser_dashboard_add()
    {
        $browserhead['header_title'] = 'AdminUser-Add New';
        return view('admin.admin.admin-create' ,$browserhead);
    }
    // create function for admin account
    public function adminUser_dashboard_create(Request $request)
    {
        // dd($request->all());
        request()->validate(['email'=> 'required|email|unique:users']);

        $user = new User;
        $user->name = $request->name;
        // $user->storename = $request->storename;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admin-adminv2/list')->with('success', "Admin successfully created a new user admin");
    }
    // done admin function import to database structure
    // edit function for admin account
    public function adminUser_dashboard_getedit($id)
    {
        $browserhead['getRecord'] = User::getSingle($id);
        $browserhead['header_title'] = 'AdminUser-edit';
        return view('admin.admin.admin-edit' ,$browserhead);
    }
    public function adminUser_dashboard_update($id, Request $request)
    {
        request()->validate(['email'=> 'required|email|unique:users,email,'.$id]);

        $user = User::getSingle($id);
        $user->name = $request->name;
        // $user->storename = $request->storename;
        $user->email = $request->email;
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admin-adminv2/list')->with('success', "Admin successfully updated");
    }
    public function adminUser_dashboard_delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('success', "Admin successfully deleted");
    }
}

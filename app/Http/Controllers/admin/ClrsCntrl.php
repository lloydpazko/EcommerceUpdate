<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\colorModel;
use Auth;
use Illuminate\Http\Request;

class ClrsCntrl extends Controller
{
    public function colors_list()
    {
        $browserhead['getrecord'] = colorModel::getRecord();
        $browserhead['header_title'] = 'AdminUser-colors-details-list';
        return view('admin.colors.colorslist' ,$browserhead);
    }
    public function colors_create()
    {
        $browserhead['getrecord'] = colorModel::getRecord();
        $browserhead['header_title'] = 'AdminUser-colors-create';
        return view('admin.colors.colors-create' ,$browserhead);
    }
    public function colors_post(Request $request)
    {
        // dd($request->all());
        // request()->validate(['slug'=> 'required|unique:brand']);
        // remove the verification

        $color = new colorModel;
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id;
        $color->save();

        return redirect('admin-adminv2/colors/colorlist')->with('success', "color has been created successfully you may now check your data tables list");
    }
    public function colors_edit($id)
    {
        $browserhead['getRecord'] = colorModel::getSingle($id);
        $browserhead['header_title'] = 'AdminUser-Edit-color';
        return view('admin.colors.colors-edit' ,$browserhead);
    }
    public function colors_update(Request $request , $id)
    {
        // request()->validate(['slug'=> 'required|unique:brand,slug,'. $id]);
        // remove verification for color code

        $color = colorModel::getSingle($id);
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->save();

        return redirect('admin-adminv2/colors/colorlist')->with('success', "color has been Updated successfully you may now check your data tables list");
    }
    public function delete_colors($id)
    {
        $color = colorModel::getSingle($id);
        $color-> is_delete = 1;
        $color->save();

        return redirect()->back()->with('success', "color has been Deleted successfully you may now check again your data tables list");
    }
}

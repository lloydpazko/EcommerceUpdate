<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brandModel;
use Auth;

class BrndCntrl extends Controller
{
    public function brand_list()
    {
        $browserhead['getrecord'] = BrandModel::getRecord();
        $browserhead['header_title'] = 'AdminUser-brand-list';
        return view('admin.brand.brandlist' ,$browserhead);
    }
    public function brand_create()
    {
        $browserhead['header_title'] = 'AdminUser-Create-Brand';
        return view('admin.brand.create-brand' ,$browserhead);
    }
    public function brand_post(Request $request)
    {
        // dd($request->all());
        request()->validate(['slug'=> 'required|unique:brand']);

        $brand = new brandModel;
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->created_by = Auth::user()->id;
        $brand->save();

        return redirect('admin-adminv2/brand/brandlist')->with('success', "brand has been created successfully you may now check your data tables list");
    }
    public function brand_edit($id)
    {
        $browserhead['getRecord'] = brandModel::getSingle($id);
        $browserhead['header_title'] = 'AdminUser-Edit-brand';
        return view('admin.brand.edit-brand' ,$browserhead);
    }
    public function brand_update(Request $request , $id)
    {
        request()->validate(['slug'=> 'required|unique:brand,slug,'. $id]);

        $brand = brandModel::getSingle($id);
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->save();

        return redirect('admin-adminv2/brand/brandlist')->with('success', "brand has been Updated successfully you may now check your data tables list");
    }
    public function delete_brand($id)
    {
        $brand = brandModel::getSingle($id);
        $brand-> is_delete = 1;
        $brand->save();

        return redirect()->back()->with('success', "Brand has been Deleted successfully you may now check again your data tables list");
    }
}

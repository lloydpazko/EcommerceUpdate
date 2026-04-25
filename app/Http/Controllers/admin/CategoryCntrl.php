<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categoryModel;
use Auth;

class CategoryCntrl extends Controller
{
    public function adminUser_category_list()
    {
        $browserhead['getrecord'] = categoryModel::getRecord();
        $browserhead['header_title'] = 'AdminUser-category-list';
        return view('admin.category.categorylist' ,$browserhead);
    }
    public function adminUser_category_add()
    {
        $browserhead['header_title'] = 'AdminUser-Create-Category';
        return view('admin.category.create-category' ,$browserhead);
    }
    public function adminUser_category_create(Request $request)
    {
        // dd($request->all());
        request()->validate(['slug'=> 'required|unique:category']);

        $category = new CategoryModel;
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('admin-adminv2/category/list')->with('success', "Category has been created successfully you may now check your data tables list");
    }
    public function adminUser_category_getedit($id)
    {
        $browserhead['getRecord'] = CategoryModel::getSingle($id);
        $browserhead['header_title'] = 'AdminUser-Edit-Category';
        return view('admin.category.edit-category' ,$browserhead);
    }
    public function adminUser_category_update(Request $request , $id)
    {
        request()->validate(['slug'=> 'required|unique:category,slug,'. $id]);

        $category = CategoryModel::getSingle($id);
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->save();

        return redirect('admin-adminv2/category/list')->with('success', "Category has been Updated successfully you may now check your data tables list");
    }
    public function adminUser_category_delete($id)
    {
        $category = CategoryModel::getSingle($id);
        $category-> is_delete = 1;
        $category->save();

        return redirect()->back()->with('success', "Category has been Deleted successfully you may now check again your data tables list");
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categoryModel;
use App\Models\subcat;
use Auth;

class subcategoryCntrl extends Controller
{
    public function adminUser_subcat_list()
    {
        $browserhead['getRecord'] = subcat::getRecord();
        $browserhead['header_title'] = 'Admin-subcategory';
        return view('admin.subcategory.sub-catlist' ,$browserhead);
    }
    public function adminUser_subcat_add()
    {
        $browserhead['getcategory'] = categoryModel::getRecord();
        $browserhead['header_title'] = 'Admin-subcategory-create';
        return view('admin.subcategory.create-subc' ,$browserhead);
    }
    public function adminUser_subcat_create(Request $request)
    {
        // dd($request->all());
        request()->validate(['slug'=> 'required|unique:subcategory']);

        $subcategory = new subcat;
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        return redirect('admin-adminv2/sub-category/list')->with('success', "Sub-Category That You Added has been created successfully you may now check your data tables list");
    }
    public function adminUser_subcat_getedit($id)
    {
        $browserhead['getcategory'] = categoryModel::getRecord();
        $browserhead['getRecord'] = subcat::getSingle($id);
        $browserhead['header_title'] = 'AdminUser-Edit-SubCategory';
        return view('admin.subcategory.edit-subc' ,$browserhead);
    }
    public function adminUser_subcat_update(Request $request , $id)
    {
         // dd($request->all());
         request()->validate(['slug'=> 'required|unique:subcategory']);

         $subcategory = subcat::getSingle($id);
         $subcategory->category_id = trim($request->category_id);
         $subcategory->name = trim($request->name);
         $subcategory->slug = trim($request->slug);
         $subcategory->status = trim($request->status);
         $subcategory->meta_title = trim($request->meta_title);
         $subcategory->meta_description = trim($request->meta_description);
         $subcategory->meta_keywords = trim($request->meta_keywords);
         $subcategory->meta_keywords = trim($request->meta_keywords);
         $subcategory->save();

         return redirect('admin-adminv2/sub-category/list')->with('success', "Sub-Category That You Added has been created successfully you may now check your data tables list");
    }
    public function adminUser_subcat_delete($id)
    {
        $subcategory = subcat::getSingle($id);
        $subcategory-> is_delete = 1;
        $subcategory->save();

        return redirect()->back()->with('success', "Sub-Category has been Deleted successfully you may now check again your data tables list");
    }
    public function get_sub_category(Request $request)
    {
        // dd($request->all());
        $category_id = $request->id;
        $get_sub_category = subcat::getRecordSubCategory($category_id);
        $html = '';
        $html .= '<option value="">Select Type of Sub Category</option>';
        foreach ($get_sub_category as $value)
        {
            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}

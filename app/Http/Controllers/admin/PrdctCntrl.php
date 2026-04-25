<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\productsizeModel;
use Illuminate\Http\Request;
use Str;
use App\Models\categoryModel;
use App\Models\subcat;
use App\Models\brandModel;
use App\Models\colorModel;
use App\Models\ProductModel;
use App\Models\ProductColorModel;
use App\Models\ProductImageModel;
use Auth;

class PrdctCntrl extends Controller
{
    public function product_list()
    {
        $browserhead['getRecord'] = ProductModel::getRecord();
        $browserhead['header_title'] = 'AdminUser-Product-list';
        return view('admin.product.product-list', $browserhead);
    }
    public function product_create()
    {
        $browserhead['header_title'] = 'AdminUser-Create-Product';
        return view('admin.product.create-product', $browserhead);
    }
    public function product_post(Request $request)
    {
        $title = trim($request->title);
        $product = new ProductModel;
        $product->title = $title;
        $product->created_by = Auth::user()->id;
        $product->save();
        $slug = Str::slug($title, "-");
        ProductModel::checkSlug($slug);

        $checkSlug = ProductModel::checkSlug($slug);
        if(empty($checkSlug))
        {
            $product->slug = $slug;
            $product->save();
        }
        else
        {
            $new_slug = $slug.'-'.$product->id;
            $product->slug = $new_slug;
            $product->save();
        }
        return redirect('admin-adminv2/product/product-edit/'. $product->id);
        // dd($slug);
    }
    public function product_edit($product_id)
    {
        $product = ProductModel::getSingle($product_id);
        if(!empty($product))
        {
            $browserhead['getCategory'] = categoryModel::getRecordActive();
            // $browserhead['getSubcategory'] = subcat::getRecord();
            $browserhead['brand'] = brandModel::getRecordActive();
            $browserhead['getColor'] = colorModel::getRecordActive();
            $browserhead['product'] = $product;
            $browserhead['GetSubCategory'] = subcat::getRecordSubCategory($product->category_id);
            $browserhead['header_title'] = 'AdminUser-Edit-Product';
            return view('admin.product.edit-product', $browserhead);
        }
    }
    public function product_update(Request $request , $product_id)
    {
        // dd($request->all());
        $product = ProductModel::getSingle($product_id);
        if(!empty($product))
        {

            $product->title = trim($request->title);
            $product->sku = trim($request->sku);
            $product->slug = trim($request->slug);
            $product->category_id = trim($request->category_id);
            $product->sub_category_id = trim($request->sub_category_id);
            $product->brand_id = trim($request->brand_id);
            $product->price = trim($request->price);
            $product->old_price = trim($request->old_price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->additional_information = trim($request->additional_information);
            $product->shipping_returns = trim($request->shipping_returns);
            $product->status = trim($request->status);
            $product->save();

            ProductColorModel::DeleteRecord($product->id);

            if(!empty($request->color_id))
            {
                foreach($request->color_id as $color_id)
                {
                    $color = new ProductColorModel;
                    $color->color_id = $color_id;
                    $color->product_id = $product->id;
                    $color->save();
                }
            }

            productsizeModel::DeleteRecord($product->id);

            if(!empty($request->size))
            {
                foreach($request->size as $size)
                {
                    if (!empty($size['name']))
                    {
                        $sizeSave = New productsizeModel;
                        $sizeSave->name = $size['name'];
                        $sizeSave->price = !empty($size['price']) ? $size['price'] : 0;
                        $sizeSave->product_id = $product_id;
                        $sizeSave->save();
                    }
                }
            }

            if(!empty($request->file('image')))
            {
                foreach($request->file('image') as $value)
                {
                    // print_r($value);
                    // echo "************"; check if the image is not empty

                    if ($value->isValid())
                    {
                        // echo "test";
                        // die; check if the value is valid to upload using conditions here

                        $ext = $value->getClientOriginalExtension();

                        $randomStr = $product->id.Str::random(20);
                        $filename = Strtolower($randomStr).'.'.$ext;
                        $value->move('upload/product/', $filename);

                        $imageupload = new ProductImageModel;
                        $imageupload->image_name = $filename;
                        $imageupload->image_extension = $ext;
                        $imageupload->product_id = $product->id;
                        $imageupload->save();

                        // echo $filename = Strtolower($randomStr).'.'.$ext;
                        // echo "<br>"; checking if the file is make it random and has unique name
                    }

                }
            }

            return redirect()->back()->with('success','Product has been successfully updated with all added new details.');
        }
        else
        {
            abort(404);
        }
    }
    public function images_delete($id)
    {
        $image = ProductImageModel::getSingle($id);
        if(!empty($image->getLogo()))
        {
            unlink('upload/product/'. $image->image_name);
        }
        $image->delete();

        return redirect()->back()->with('success', "Image has been deleted successfully");

        // $image = ProductImageModel::getSingle($id);
        // if(!empty($image))
        // {
        //     $image->delete();
        //     return redirect()->back()->with('success', "Image has been deleted successfully");
        // }
    }
    public function images_sortable(Request $request)
    {
        // dd($request->all());
        if(!empty($request->photo_id))
        {
            $i = 1;
            foreach($request->photo_id as $photo_id)
            {
                $image = ProductImageModel::getSingle( $photo_id );
                $image->order_by = $i;
                $image->save();

                $i++;
            }
        }
        $json['success'] = true;
        echo json_encode($json);
    }
}

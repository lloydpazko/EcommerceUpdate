<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categoryModel;
use App\Models\subcat;
use App\Models\ProductModel;
use App\Models\colorModel;
use App\Models\brandModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getCategories($slug, $subSlug = '')
    {
        $getCategory = categoryModel::getSingleSlug($slug);
        $getSubCategory = subcat::getSingleSlug($subSlug);
        $data['getColor'] = colorModel::getRecordActive();
        $data['getBrand'] = brandModel::getRecordActive();

        if(!empty($getCategory) && !empty($getSubCategory))
        {
            $data['getSubCategoryfilter'] = subcat::getRecordSubCategory($getCategory->id);

            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;

            $data['getSubCategory'] = $getSubCategory;
            $data['getCategory'] = $getCategory;

            $getProduct = ProductModel::getProduct($getCategory->id, $getSubCategory->id);

            $data['getProduct'] = $getProduct;
            return view('product.list' ,$data);
        }
        else if(!empty($getCategory))
        {
            $data['getSubCategoryfilter'] = subcat::getRecordSubCategory($getCategory->id);
            // dd($data['getSubCategoryfilter']);

            $data['getCategory'] = $getCategory;

            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;

            $getProduct = ProductModel::getProduct($getCategory->id);
            // dd($getProduct->nextPageUrl());
            $page = 0;
            if(!empty($getProduct->nextPageUrl()))
            {
                $parse_url = parse_url($getProduct->nextPageUrl());
                if(!empty($parse_url['query']))
                {
                    parse_str($parse_url['query'],$get_array);
                    $page = !empty($get_array['page'])? $get_array['page'] : 0;
                }
            }
            $data['getProduct'] = $getProduct;

            return view('product.list' ,$data);
        }
        else
        {
            abort(404);
        }
    }
    public function GetFilterProductAjax( Request $request)
    {
        $getProduct = ProductModel::getProduct();
        // dd($getProduct);
        // dd($request->all());
        return response()->json([
            "status" => true,
            "success" => view("product._list",
            ["getProduct" => $getProduct,
            ])->render(),],
            200);
    }
}

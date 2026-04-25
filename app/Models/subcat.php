<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcat extends Model
{
    use HasFactory;
    protected $table = 'subcategory';

    static public function getRecord()
    {
        return self::select('subcategory.*','users.name as created_by_name', 'category.name as category_name')
        ->join('category', 'category.id', '=', 'subcategory.category_id')
        ->join('users', 'users.id', '=', 'subcategory.created_by')
        ->where('subcategory.is_delete', '=' , 0)
        ->orderBy('subcategory.id', 'desc')
        ->paginate(8);
    }
    static public function getRecordSubCategory($category_id)
    {
        return self::select('subcategory.*')
        ->join('users', 'users.id', '=', 'subcategory.created_by')
        ->where('subcategory.is_delete', '=' , 0)
        ->where('subcategory.status', '=' , 0)
        ->where('subcategory.category_id', '=' , $category_id)
        ->orderBy('subcategory.name', 'asc')
        ->get();
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    // added function for catergory import sub category list items
    static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
        ->where('subcategory.is_delete', '=' , 0)
        ->where('subcategory.status', '=' , 0)
        ->first();
    }
    // done added function for total number of subcategory items
    public function TotalProducts()
    {
        return $this->hasMany(ProductModel::class, "sub_category_id")
        ->where('product.is_delete', '=', 0)
        ->where('product.status', '=', 0)
        ->count();
    }
    // done added few codes
}

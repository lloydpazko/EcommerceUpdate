<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryModel extends Model
{
    use HasFactory;
    protected $table = 'category';
    static public function getRecord()
    {
        return self::select('category.*','users.name as created_by_name')
        ->join('users', 'users.id', '=', 'category.created_by')
        ->where('category.is_delete', '=' , 0)
        ->orderBy('category.id', 'desc')
        ->Paginate(8);
    }

    static public function getRecordActive()
    {
        return self::select('category.*')
        ->join('users', 'users.id', '=', 'category.created_by')
        ->where('category.is_delete', '=' , 0)
        ->where('category.status', '=' , 0)
        ->orderBy('category.name', 'asc')
        ->get();
    }
    // added new function for front pages

    static public function getRecordMenu()
    {
        return self::select('category.*')
        ->join('users', 'users.id', '=', 'category.created_by')
        ->where('category.is_delete', '=' , 0)
        ->where('category.status', '=' , 0)
        ->get();
    }
    // done added codes

    // added another function to create sub catergories to display front page

    public function getSubCategory()
    {
        return $this->hasMany(subcat::class, "category_id")->where('subcategory.status', '=', 0)
        ->where('subcategory.is_delete', '=',0);
    }

    // done added and modified

    static public function getSingle($id)
    {
        return self::find($id);
    }
    // added function for catergory list items
    static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
        ->where('category.is_delete', '=' , 0)
        ->where('category.status', '=' , 0)
        ->first();
    }
    // done added function for catergory list items
}

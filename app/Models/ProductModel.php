<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    static function getSingle($id)
    {
        return self::find($id);
    }
    static function getRecord()
    {
        return self::select('product.*', 'users.name as created_by_name')
        ->join('users', 'users.id', '=', 'product.created_by')
        ->where('product.is_delete', '=', 0)
        ->orderBy('product.id', 'desc')
        ->paginate(10);
    }

    static public function getProduct($category_id = '', $subcategory_id = '')
    {
        $return = ProductModel::select('product.*', 'users.name as created_by_name',
                                                'category.name as category_name' , 'category.slug as category_slug',
                                                'subcategory.name as sub_category_name' , 'subcategory.slug as sub_category_slug')
                    ->join('users', 'users.id', '=', 'product.created_by')
                    ->join('category', 'category.id', '=', 'product.category_id')
                    ->join('subcategory', 'subcategory.id', '=', 'product.sub_category_id');
                    if (!empty($category_id))
                    {
                        $return = $return->where('product.category_id', '=', $category_id);
                    }
                    if (!empty($subcategory_id))
                    {
                        $return = $return->where('product.sub_category_id', '=', $subcategory_id);
                    }
                    // filter subcategories
                    if(!empty(Request::get('Sub_Category_id')))
                    {
                        $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
                        // dd($sub_category_id);
                        $sub_category_id_array = explode(",", $sub_category_id);
                        $return = $return->whereIn('product.sub_category_id',  $sub_category_id_array);

                    }
                    else
                    {
                        if(!empty(Request::get('old_category_id')))
                        {
                            $return = $return->where('product.category_id', '=', Request::get('old_category_id'));
                        }
                        if(!empty(Request::get('old_sub_Category_id')))
                        {
                            $return = $return->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
                        }
                    }
                    // joining sub category with colors
                    if(!empty(Request::get('color_id')))
                    {
                        $color_id = rtrim(Request::get('color_id'), ',');
                        // dd($sub_category_id);
                        $color_id_array = explode(",", $color_id);
                        $return = $return->join('product_color', 'product_color.product_id', '=',
                        'product.id');
                        $return = $return->whereIn('product_color.color_id',  $color_id_array);
                    }
                    // brand
                    if(!empty(Request::get('brand_id')))
                    {
                        $brand_id = rtrim(Request::get('brand_id'), ',');
                        // dd($sub_category_id);
                        $brand_id_array = explode(",", $brand_id);
                        $return = $return->whereIn('product.brand_id',  $brand_id_array);
                    }

                    if(!empty(Request::get('start_price')) && !empty(Request::get('end_price')))
                    {
                        $start_price = str_replace('$', '', Request::get('start_price'));
                        $end_price = str_replace('$', '', Request::get('end_price'));
                        $return = $return->where('product.price', '>=', $start_price);
                        $return = $return->where('product.price', '<=', $end_price);
                    }
                    // to use group by you need to location app/config/database.php then find mysql select 'strict' => true, rename it to 'strict' => false,
                    $return = $return->where('product.is_delete', '=', 0)
                    ->where('product.status', '=', 0)
                    // ->groupBy('product.id')
                    ->orderBy('product.id', 'desc')
                    ->paginate(10);
        return $return;
    }

    static function getImageSingle($product_id)
    {
        return ProductImageModel::where('product_id', '=', $product_id)->orderby('order_by', 'asc')->first();
    }

    static public function checkSlug($slug)
    {
        return self::where('slug', '=', $slug)->count();
    }
    public function getColor()
    {
        return $this->hasMany(ProductColorModel::class, "product_id");
    }
    public function getSize()
    {
        return $this->hasMany(productsizeModel::class, "product_id");
    }
    public function getImage()
    {
        return $this->hasMany(ProductImageModel::class, "product_id")->orderby('order_by', 'asc');
        // return $this->hasMany(ProductImageModel::class, "product_id")->orderby('order_by', 'asc');
    }
}

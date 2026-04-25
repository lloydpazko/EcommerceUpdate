<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthCntrl;
use App\Http\Controllers\Admin\DashboardCntrl;
use App\Http\Controllers\Admin\AdminCntrl;
use App\Http\Controllers\Admin\CategoryCntrl;
use App\Http\Controllers\Admin\subcategoryCntrl;
use App\Http\Controllers\Admin\PrdctCntrl;
use App\Http\Controllers\Admin\brndCntrl;
use App\Http\Controllers\Admin\ClrsCntrl;
use App\Http\Controllers\HomeCntrl;
use App\Http\Controllers\ProductController as ProductFront;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// end front pages

// login session
Route::get('admin-login', [AuthCntrl::class, 'admin_UserLogin']);
Route::post('admin-login', [AuthCntrl::class, 'admin_UserLogin_authenticated']);
Route::get('admin-logout', [AuthCntrl::class, 'admin_logout']);
// end login session

// dashboard middleware group to secure our admin dashboardpanel for admin
Route::group(['middleware' => 'AdminUserSecure'], function ()
{
    // default routes
    // Route::get('admin-dashboard', function () {
    //     return view('admin.admin-dashboard');
    // });

    // Route::get('admin/adminv2/list', function () {
    //     $browserhead['header_title'] = 'AdminUser-dashboard';
    //     return view('admin.admin.list', $browserhead);
    // });

    // end default routes

    // navigation for admin panel routes

    Route::get('admin-dashboard', [DashboardCntrl::class, 'admin_dashboard']);

    // add , edit and delete function for admin routes
    Route::get('admin-adminv2/list', [AdminCntrl::class, 'adminUser_dashboard']);
    Route::get('admin-adminv2/create-admin', [AdminCntrl::class, 'adminUser_dashboard_add']);
    Route::post('admin-adminv2/get-admin-info', [AdminCntrl::class, 'adminUser_dashboard_create']);
    Route::get('admin-adminv2/edit-admin/{id}', [AdminCntrl::class, 'adminUser_dashboard_getedit']);
    Route::post('admin-adminv2/edit-admin/{id}', [AdminCntrl::class, 'adminUser_dashboard_update']);
    Route::get('admin-adminv2/delete-admin/{id}', [AdminCntrl::class, 'adminUser_dashboard_delete']);
    // end delete and function routes

    // category routes
    Route::get('admin-adminv2/category/list', [CategoryCntrl::class, 'adminUser_category_list']);
    Route::get('admin-adminv2/category-create', [CategoryCntrl::class, 'adminUser_category_add']);
    Route::post('admin-adminv2/category-get-info', [CategoryCntrl::class, 'adminUser_category_create']);
    Route::get('admin-adminv2/category-edit/{id}', [CategoryCntrl::class, 'adminUser_category_getedit']);
    Route::post('admin-adminv2/category-edit/{id}', [CategoryCntrl::class, 'adminUser_category_update']);
    Route::get('admin-adminv2/delete-category/{id}', [CategoryCntrl::class, 'adminUser_category_delete']);

    // end category

    // subcategory routes
    Route::get('admin-adminv2/sub-category/list', [subcategoryCntrl::class, 'adminUser_subcat_list']);
    Route::get('admin-adminv2/sub-category/create', [subcategoryCntrl::class, 'adminUser_subcat_add']);
    Route::post('admin-adminv2/sub-category-get-info', [subcategoryCntrl::class, 'adminUser_subcat_create']);
    Route::get('admin-adminv2/subcat-edit/{id}', [subcategoryCntrl::class, 'adminUser_subcat_getedit']);
    Route::post('admin-adminv2/subcat-edit/{id}', [subcategoryCntrl::class, 'adminUser_subcat_update']);
    Route::get('admin-adminv2/delete-subcategory/{id}', [subcategoryCntrl::class, 'adminUser_subcat_delete']);

    // route on ajax script
    Route::post('admin-adminv2/sub_category', [subcategoryCntrl::class, 'get_sub_category']);
    // end route on ajax script

    // end category

    // routes for product routes
    Route::get('admin-adminv2/product/list', [PrdctCntrl::class, 'product_list']);
    Route::get('admin-adminv2/product/create', [PrdctCntrl::class, 'product_create']);
    Route::post('admin-adminv2/product/post_product', [PrdctCntrl::class, 'product_post']);
    Route::get('admin-adminv2/product/product-edit/{id}', [PrdctCntrl::class, 'product_edit']);
    Route::post('admin-adminv2/product/product-edit/{id}', [PrdctCntrl::class, 'product_update']);
    Route::get('admin-adminv2/product/product-del/{id}', [PrdctCntrl::class, 'product_delete']);

    Route::get('admin-adminv2/product/images-delete/{id}', [PrdctCntrl::class, 'images_delete']);
    // sortable for product images
    Route::post('admin-adminv2/product_image_sortable', [PrdctCntrl::class, 'images_sortable']);

    // end for product routes

    // routes for brand routes
    Route::get('admin-adminv2/brand/brandlist', [brndCntrl::class, 'brand_list']);
    Route::get('admin-adminv2/brand/create-brand', [brndCntrl::class, 'brand_create']);
    Route::post('admin-adminv2/brand/post_brand', [brndCntrl::class, 'brand_post']);
    Route::get('admin-adminv2/brand/brand-edit/{id}', [brndCntrl::class, 'brand_edit']);
    Route::post('admin-adminv2/brand/brand-edit/{id}', [brndCntrl::class, 'brand_update']);
    Route::get('admin-adminv2/delete-brand/{id}', [brndCntrl::class, 'delete_brand']);
    // end for brand routes

    // color routes
    Route::get('admin-adminv2/colors/colorlist', [ClrsCntrl::class, 'colors_list']);
    Route::get('admin-adminv2/colors/create', [ClrsCntrl::class, 'colors_create']);
    Route::post('admin-adminv2/colors/post_color', [ClrsCntrl::class, 'colors_post']);
    Route::get('admin-adminv2/colors/colors-edit/{id}', [ClrsCntrl::class, 'colors_edit']);
    Route::post('admin-adminv2/colors/colors-edit/{id}', [ClrsCntrl::class, 'colors_update']);
    Route::get('admin-adminv2/colors/delete-brand/{id}', [ClrsCntrl::class, 'delete_colors']);

    // end color

    // end navigation for admin panel routes
});
// end admin middleware group to secure
Route::get('/', [HomeCntrl::class, 'Frontpages']);
// Route::get('/', [HomeCntrl::class, 'home']);
Route::get('{category?}/{subcategory?}', [ProductFront::class, 'GetCategories']);
// end route
// filter products routes
Route::post('get_filter_product_ajax', [ProductFront::class, 'GetFilterProductAjax']);

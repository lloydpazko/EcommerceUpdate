<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brandModel extends Model
{
    use HasFactory;
    protected $table = 'brand';

    static public function getRecord()
    {
        return self::select('brand.*','users.name as created_by_name')
        ->join('users', 'users.id', '=', 'brand.created_by')
        ->where('brand.is_delete', '=' , 0)
        ->orderBy('brand.id', 'desc')
        ->Paginate(10);
    }
    static public function getRecordActive()
    {
        return self::select('brand.*')
        ->join('users', 'users.id', '=', 'brand.created_by')
        ->where('brand.is_delete', '=' , 0)
        ->where('brand.status', '=' , 0)
        ->orderBy('brand.name', 'asc')
        ->Paginate(10);
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
}

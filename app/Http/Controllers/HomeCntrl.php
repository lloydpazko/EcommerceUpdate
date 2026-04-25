<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeCntrl extends Controller
{
    public function Frontpages()
    {
        $data['meta_title'] = 'E-commerce';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        return view('welcome', $data);
    }
}

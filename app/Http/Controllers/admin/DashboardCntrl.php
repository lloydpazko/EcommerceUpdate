<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardCntrl extends Controller
{
    public function admin_dashboard()
    {
        $browserhead['header_title'] = 'Admin-dashboard';
        return view('admin.admin-dashboard' ,$browserhead);
    }
}

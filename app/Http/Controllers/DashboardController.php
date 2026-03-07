<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function template()
    {
        return view('pages.dashboard.template');
    }
}

<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    function dashboard() {
        return view('components.dashboard', get_defined_vars());
    }
}

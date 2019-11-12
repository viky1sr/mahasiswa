<?php

namespace App\Http\Controllers;

use App\Sisswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboards.index');
    }
}

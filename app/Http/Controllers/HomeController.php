<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\YearClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }
}

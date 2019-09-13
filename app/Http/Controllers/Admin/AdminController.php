<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.index');
    }

    public function projectUploadFile(Request $request)
    {
        dd($request->allFiles());
    }
}

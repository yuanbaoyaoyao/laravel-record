<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('user_info.index',[
            'info' => $request->user()->info,
        ]);
    }
}

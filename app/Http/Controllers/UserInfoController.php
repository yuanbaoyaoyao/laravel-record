<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoRequest;
use App\Models\UserInfo;
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

    public function create()
    {
        return view('user_info.create_and_edit',['i'=>new UserInfo()]);
    }

    public function store(UserInfoRequest $request)
    {
        $request->user()->info()->create($request->only([
            'department',
            'user',
            'contact_phone'
        ]));

        return redirect()->route('user_info.index');
    }

    public function edit(UserInfo $user_info)
    {
        return view('user_info.create_and_edit',['i'=>$user_info]);
    }

    public function update(UserInfo $user_info,UserInfoRequest $request)
    {
        $user_info->update($request->only([
            'department',
            'user',
            'contact_phone'
        ]));
        return redirect()->route('user_info.index');
    }
}

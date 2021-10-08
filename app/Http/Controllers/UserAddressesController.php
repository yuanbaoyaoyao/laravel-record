<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('user_addresses.index',[
            'addresses' => $request->user()->addresses,
        ]);
    }

    public function create()
    {
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }

    public function store(UserAddressRequest $request)
    {
        $request->user()->addresses()->create($request->only([
            'department',
            'user',
            'contact_phone'
        ]));

        return redirect()->route('user_addresses.index');
    }

    public function edit(UserAddress $user_addresses)
    {
        $this->authorize('own',$user_addresses);
        return view('user_addresses.create_and_edit',['address'=>$user_addresses]);
    }

    public function update(UserAddress $user_addresses,UserAddressRequest $request)
    {
        $this->authorize('own',$user_addresses);
        $user_addresses->update($request->only([
            'department',
            'user',
            'contact_phone'
        ]));
        return redirect()->route('user_addresses.index');
    }

    public function destroy(UserAddress $user_addresses)
    {
        $this->authorize('own',$user_addresses);
        $user_addresses->delete();

        return [];
    }
}

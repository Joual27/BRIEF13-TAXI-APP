<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PassengerController extends Controller
{
    public function index(){
        return view('passenger.home');
    }

    public function edit(){
        $user = Auth::user();
        return view('passenger.edit',['user' => $user]);
    }


    public function update(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();

        if($image = $request->file('image')){
            $destinationFolder = 'images/';
            $img = date('YmdHis'). "." . $image->getClientOriginalExtension();
            $image->move($destinationFolder,$img);
            $data['image'] = $img ;
        }

        $user = Auth::user();

        $user->update($data);

        return redirect()->route('editPassenger')->with('success', 'Passenger Updated Successfully !');
    }

    public function logout()
    {
        Session::forget('user_id');
        Session::forget('name');
        Session::forget('image');
        Session::forget('role');
        Auth::logout();
        return redirect()->route('login');
    }
}

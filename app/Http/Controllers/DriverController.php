<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DriverController extends Controller
{
    //

    public function index(){
        return view('driver.home');
    }


    public function edit(){
        $user = Auth::user()->load('driver');
        return view('driver.edit',['user' => $user]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'mimes:jpeg,jpg,png|max:2048',
            'car' => 'required',
            'payment' => 'required'
        ]);

        $user = Auth::user();

        if($image = $request->file('image')){
            $destinationFolder = 'images/';
            $img = date('YmdHis'). "." . $image->getClientOriginalExtension();
            $image->move($destinationFolder,$img);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $img
            ]);

            $user->driver->update([
               'car' => $request->car,
               'payment_type' => $request->payment
            ]);

            Session::put('image',$img);
        }

        else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $user->driver->update([
                'car' => $request->car,
                'payment_type' => $request->payment
            ]);
        }

        return redirect()->route('editDriver')->with('success' , 'Driver Infos Updated Successfully !');

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

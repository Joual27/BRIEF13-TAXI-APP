<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    //

    public function Register(Request $req)
    {

        $req->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8'

        ]);


        if ($req['password'] !== $req['password_confirmation']) {
            return redirect()->route('register')->withErrors('Passwords dont match , Try again !');
        } else {
            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
            ]);

            Passenger::create([
                'user_id' => $user->id
            ]);


            return redirect()->route('login')->with('success', 'Registration made successfully ! please Sign In !');
        }


    }

    public function driverRegistration(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
            'car' => 'required',
            'payment' => 'required'
        ]);


        if ($req['password'] !== $req['password_confirmation']) {
            return redirect()->route('driverRegister')->withErrors('Passwords dont match , Try again !');
        } else {
            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
            ]);

            Driver::create([
                'user_id' => $user->id,
                'car' => $req->car,
                'payment_type' => $req->payment
            ]);

            return redirect()->route('login')->with('success', 'Registration made successfully ! please Sign In !');
        }

    }


    public function login(Request $request)
    {
       $request->validate([
           'email' => 'required|email',
           'password' => 'required'
       ]);

       if(Auth::attempt([
           'email' => $request->email,
           'password' => $request->password
       ])){

           $user = Auth::user();
           Session::put('user_id',$user->id);
           Session::put('name',$user->name);
           Session::put('image',$user->image);

           if($user->is_passenger()){
               Session::put('role','passenger');
               return redirect()->route('passengerDashboard');
           }
           elseif ($user->is_driver()){
               Session::put('role','driver');
               return redirect()->route('driverDashboard');
           }
           elseif ($user->is_admin()){
               Session::put('role','admin');
           }

       }


    }
}

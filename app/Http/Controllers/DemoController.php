<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoController extends Controller
{
    public function logindemo(Request $request)
    {
        if($request->user === 'demouser'){

            $user = User::find(1);
            Auth::login($user);

            return redirect()->route('home');

            // return view('logindemo', [
            //     'email'=>'user@user.com',
            //     'password'=>'user'
            // ]);

        }else{
            return redirect()->route('login');
        }
    }
}

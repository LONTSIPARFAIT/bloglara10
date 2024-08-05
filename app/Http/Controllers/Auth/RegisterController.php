<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    public function showRegistrationForm():View{
        return view('auth.register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required','string','between:5,100',
            'email' => 'required','email','unique:users',
            'password' => 'required','min:4','confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']) ;

        // $user = User::create([
        //     'name' => $validated['name'],
        //     'email' => $validated['email'],
        //     'password' => bcrypt($validated['password']),
        // ]);

        $user = User::create($validated);

        Auth::login($user);


        return redirect()->route('home')->withStatus('You have successfully registered!');

    }
}

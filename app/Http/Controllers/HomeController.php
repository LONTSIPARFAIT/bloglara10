<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home.index');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validate([
            'current_password' => ['required', 'string', function (string $attribute, mixed $value, Closure $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail("Le :attribute est erronné.");
                }
            }],
            "password" => ["required", "string", "min:4", "confirmed"],
        ]);
        $user->update([
            "password" => Hash::make($validated['password']),
        ]);
        return redirect()->route('home')->withStatus("Mot de passe modifié");
    }

    // public function store(Request $request)
    // {
    //     // Logique pour gérer la requête POST
    // }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;


class LoginController extends Controller
{
    public function index(): View
    {
        return view ('login');
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            if(auth()->user()->isExpired()){

                Auth::logout();

                return back()->withErrors([
                    'msg' => 'Acesso expirado'
                ]);

            }
            
            $user = Auth()->user();
            if($user->isAdmin()){
                return redirect()->route('users.index');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas'
        ]);

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');

    }

    

}

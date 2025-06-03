<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registerStore(Request $request)
    {
        $request->validate([
            'cnpj' => 'required|string|max:18|unique:empresas',
            'razaoSocial' => 'required|string|max:255',
            'email' => 'required|email|unique:empresas',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $empresa = Empresa::create([
            'cnpj' => $request->cnpj,
            'razaoSocial' => $request->razaoSocial,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($empresa, true); // Segundo parâmetro true para "remember me"
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function loginAcount(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $remember = $request->filled('remember');

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }

            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}

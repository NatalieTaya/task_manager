<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request -> only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/tasks');
        }
        return back()->withErrors(['username' => 'Неверные данные']);
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Завершение сессии пользователя
        $request->session()->invalidate(); // Очистка сессии
        $request->session()->regenerateToken(); // Генерация нового CSRF-токена
        return redirect('/');    
    }
    
}

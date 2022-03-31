<?php
 
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

use Auth;
use Exception;

class AuthController extends Controller
{
    public function index()
    {
        try
        {
            return view('front.auth.login');    
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }

    public function login(Request $request)
    {
        try
        {
            $data = [
                'username' => $request->username,
                'password' => $request->password
            ];

            Auth::attempt($data);
            if (Auth::check())
            {
                return redirect('/')->with('success', 'Login success');;
            }
            else
            {
                return back()->with('error', 'Email atau password salah');
            }
        }
        catch (Exception $e)
        {
            return back()->with('error', 'Opps, terjadi kesalahan saat login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
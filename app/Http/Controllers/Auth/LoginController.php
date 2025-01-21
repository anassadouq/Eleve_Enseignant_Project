<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users based on their role after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            return route('student.index'); // Route for student dashboard
        } elseif ($user->role === 'professeur') {
            return route('professeur.index'); // Route for professor dashboard
        }
        elseif ($user->role === 'admin') {
            return route('admin.index'); // Route for professor dashboard
        }

        // Default fallback
        return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

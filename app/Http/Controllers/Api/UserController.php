<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Web Request
    public function profile()
    {
        $user = auth()->guard('web')->user();
        // Access user information like $user->name, $user->email, etc.
        
        return Auth::user();
    }

    public function getUser(Request $request)
    {
        $user = auth('web')->user(); // Assuming token-based auth for API
        // Access user information like $user->name, $user->email, etc.
        print_r($user); exit;
        return $user; // Or return relevant user data
    }
}
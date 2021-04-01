<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|string|min:5|max:25|confirmed',
        ]);
        $studentRole = Role::where('name','student')->first();
        $user= User::create([
            'role_id' => $studentRole->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token= $user->createToken('auth_token');
        return ['token' => $token->plainTextToken];
    }
}

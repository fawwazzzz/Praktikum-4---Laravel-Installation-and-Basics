<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    # membuat fitur Register
    public function register(Request $request) 
    {
        # Menangkap inputan
        $input = [
            'nama' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        # Menginsert data ke table user
        $user = User::create($input);

        $data = [
            'messege' => 'User is create succesfully',
            'data' => $user
        ];

        # Mengirim response JSON
        return response()->json($data, 200);
    }

    # Membuat fitur login
    public function login(Request $request)
    {
        # Mengambil inputan user (email & password)
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        # Mengambil data user berdasarkan email
        $user =  User::where('email', $input['email'])->firts();

        # Membandingkan apakah data berdasarkan email sama dengan data dari databse
        $isLoginSuccesfully = ($input['email'] == $user->email && Hash::check($input['password'], $user->password));

        if ($isLoginSuccesfully) {
            # Membuat token menggunakan method createToken
            $token = $user->createToken('auth_token');

            $data = [
                'messege' => 'Login succesfully',
                'token' => $token->plainTextToken
            ];

            # Mengembalikan response JSON
            return response()->jso($data, 200);
        }
        else {
            $data = [
                'messege' => 'Username or password is invalid'
            ];

            return response()->json($data, 401);
        }
    }
}

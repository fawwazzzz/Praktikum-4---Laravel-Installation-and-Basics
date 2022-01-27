<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        # Mengambil inputan (nama,email,password) sekalian enkripsi password
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        # Menangkap inputan
        $user = User::create($input);

        $data = [
            'message' => 'Register is succesfully'
        ];
        return response()->json($data, 200);
    }

    public function login(Request $request) {
        # Mengambil inputan/data
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];
        # Validasi data
        $user = User::where('email', $input['email'])->first();
        $isLoginValid = $input['email'] == $user->email && Hash::check($input['password'], $user->password);
        # Kondisi
        if ($isLoginValid) {
            $token = $user->createToken('auth_token');

            $data = [
                'message' => 'Login i succesfully',
                'token' => $token->plainTextToken
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Invalid Login'
            ];
            return response()->json($data,401);
        }
    }
}

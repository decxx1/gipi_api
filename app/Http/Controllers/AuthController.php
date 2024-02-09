<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function registerUser (RegisterUserRequest $request):JsonResponse
    {
        try {
            $company = Company::create();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_id' => $company->id
            ]);

            return response()->json([
                'status' => true,
                'message' => "El usuario fue creado!",
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error al registrar usuario',
            'error' => $e->getMessage(),], 500);
        }

    }

    public function loginUser (LoginUserRequest $request):JsonResponse
    {

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status' => false,
                'message' => "Email y password no coinciden"
            ], 401);
        }

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'status' => true,
            'message' => "El usuario fue logeado",
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);

    }

}

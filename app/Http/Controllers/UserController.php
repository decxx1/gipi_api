<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;



class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        if ($users){
            return response()->json([
                'users' => $users
            ], 200);
        }

        return response()->json([
            'mensaje' => "Error al mostrar usuarios"
        ], 500);
    }

    // public function createUser(CreateUserRequest $request)
    // {
    //     $users = User::all();
    //     if ($users){
    //         return response()->json([
    //             'users' => $users
    //         ], 200);
    //     }

    //     return response()->json([
    //         'mensaje' => "Error al crear usuario"
    //     ], 500);
    // }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        if ($clients){
            return response()->json([
                'clients' => $clients
            ], 200);
        }

        return response()->json([
            'mensaje' => "Error al mostrar clientes"
        ], 500);
    }

    public function create( CreateClientRequest $request)
    {
        try{
            $client = Client::create($request->validated());
            return response()->json([
                'message' => 'Cliente creado correctamente',
                'client' => $client,
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Error al crear cliente',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}

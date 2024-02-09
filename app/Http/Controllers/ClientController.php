<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function index():JsonResponse
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

    public function store( CreateUpdateClientRequest $request):JsonResponse
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
    public function update( CreateUpdateClientRequest $request, int $id):JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró el cliente'
            ], 500);
        }

        try{
            $client = Client::findOrFail($id);
            //$this->authorize('update', $client);
            $client->update($request->validated());
            return response()->json([
                'message' => 'Cliente actualizado correctamente',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al actualizar cliente',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function destroy(int $id):JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró el cliente'
            ], 500);
        }
        try{
            $client = Client::findOrFail($id);
            //$this->authorize('delete', $client);
            $client->delete();
            return response()->json([
                'message' => 'Cliente eliminado correctamente',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al eliminar cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CrudProviderRequest;

class ProviderController extends Controller
{
    public function index():JsonResponse
    {
        $providers = Provider::all();
        if ($providers){
            return response()->json([
                'providers' => $providers
            ], 200);
        }

        return response()->json([
            'mensaje' => "Error al mostrar proveedores"
        ], 500);
    }

    public function store( CrudProviderRequest $request):JsonResponse
    {
        try{
            $provider = Provider::create($request->validated());
            return response()->json([
                'message' => 'Proveedor creado correctamente',
                'provider' => $provider,
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Error al crear proveedor',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function update( CrudProviderRequest $request, int $id):JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró el proveedor'
            ], 500);
        }

        try{
            $provider = Provider::findOrFail($id);
            //$this->authorize('update', $provider);
            $provider->update($request->validated());
            return response()->json([
                'message' => 'Proveedor actualizado correctamente',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al actualizar proveedor',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function destroy(int $id):JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró el proveedor'
            ], 500);
        }
        try{
            $provider = Provider::findOrFail($id);
            //$this->authorize('delete', $provider);
            $provider->delete();
            return response()->json([
                'message' => 'Proveedor eliminado correctamente',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al eliminar proveedor',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

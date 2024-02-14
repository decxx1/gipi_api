<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CrudProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index():JsonResponse
    {
        $products = Product::all();
        if ($products){
            return response()->json([
                'productos' => $products
            ], 200);
        }

        return response()->json([
            'mensaje' => "Error al mostrar productos"
        ], 500);
    }

    public function store( CrudProductRequest $request):JsonResponse
    {
        try{
            //tomar datos que pasaron la validación
            $productData = $request->validated();
            //except('image')
            if(isset($request->validated()['image'])){
                unset($productData['image']);
            }
            $product = Product::create($productData);
            if(isset($request->validated()['image'])){
                $imageController = new ImageController();
                $image = $imageController->upload($request, $product->id);
            }
            return response()->json([
                'message' => 'Producto creado correctamente',
                'product' => $product,
                'image' => $image
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Error al crear producto',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function update( CrudProductRequest $request, int $id):JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró el producto'
            ], 500);
        }

        try{
            $product = Product::findOrFail($id);
            //$this->authorize('update', $product);
            $product->update($request->validated());
            return response()->json([
                'message' => 'Producto actualizado correctamente',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al actualizar producto',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function destroy(int $id):JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró el producto'
            ], 500);
        }
        try{
            $product = Product::findOrFail($id);
            //$this->authorize('delete', $product);
            $product->delete();
            return response()->json([
                'message' => 'Producto eliminado correctamente',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al eliminar producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CrudCategoryRequest;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index():JsonResponse
    {
        $categories = Category::all();
        if ($categories){
            return response()->json([
                'categories' => $categories
            ], 200);
        }

        return response()->json([
            'mensaje' => "Error al mostrar categorias"
        ], 500);
    }

    public function store( CrudCategoryRequest $request):JsonResponse
    {
        try{
            $category = Category::create($request->validated());
            return response()->json([
                'message' => 'Categoría creada correctamente',
                'category' => $category,
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Error al crear categoría',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function update( CrudCategoryRequest $request, int $id):JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró la categoría'
            ], 500);
        }

        try{
            $category = Category::findOrFail($id);
            //$this->authorize('update', $category);
            $category->update($request->validated());
            return response()->json([
                'message' => 'Categoría actualizado correctamente',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al actualizar categoría',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function destroy(int $id):JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró la categoría'
            ], 500);
        }
        try{
            $category = Category::findOrFail($id);
            //$this->authorize('delete', $category);
            $category->delete();
            return response()->json([
                'message' => 'Categoría eliminada correctamente',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al eliminar categoría',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

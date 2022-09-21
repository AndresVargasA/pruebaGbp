<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = Product::all();
            return response()->json([
                'products' => $products
            ]);
        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                // 'status' => $e->statusCode()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);

            $product = Product::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'estado' => 1
            ]);

            return response()->json([
                'msg' => 'Producto creado',
                'product' => $product
            ]);

        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                // 'status' => $e->statusCode()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $product = Product::find($id);
            return response()->json([
                'product' => $product
            ]);
        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                // 'status' => $e->statusCode()
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $product = Product::find($id);
            if($request->nombre){
                $product->nombre = $request->nombre;
                $product->save();
            }

            if($request->descripcion){
                $product->descripcion = $request->descripcion;
                $product->save();
            }

            return response()->json([
                'msg' => 'Producto actualizado',
                'product' => $product
            ]);
        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $product = Product::find($id);
            $product->estado = 0;
            $product->save();
            return response()->json([
                'msg' => "producto eliminado"
            ]);
        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                // 'status' => $e->statusCode()
            ]);
        }
    }
}

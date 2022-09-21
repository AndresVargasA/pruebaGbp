<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Exception;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $inventories = Inventory::with('products')->get();
            return response()->json([
                'inventories' => $inventories
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
                'id_bodega' => 'required',
                'id_producto' => 'required',
                'cantidad' => 'required',
            ]);

            $inventory = Inventory::create([
                'id_bodega' => $request->id_bodega,
                'id_producto' => $request->id_producto,
                'cantidad' => $request->cantidad
            ]);

            return response()->json([
                'msg' => 'inventario creado',
                'inventory' => $inventory
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $inventory = Inventory::find($id);
            return response()->json([
                'inventory' => $inventory
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $inventory = Inventory::find($id);
            $inventory->estado = 0;
            $inventory->save();
            return response()->json([
                'msg' => "inventario eliminado"
            ]);
        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                // 'status' => $e->statusCode()
            ]);
        }
    }
}

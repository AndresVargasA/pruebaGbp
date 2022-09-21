<?php

namespace App\Http\Controllers;

use App\Models\History;
use Exception;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $history = History::with('winteryOrigen','winteryDestino', 'inventory')->get();
            return response()->json([
                'historial' => $history
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
                'cantidad' => 'required',
                'id_bodega_origen' => 'required',
                'id_bodega_destino' => 'required',
                'id_inventario' => 'required',
            ]);

            $history = History::create([
                'cantidad' => $request->cantidad,
                'id_bodega_origen' => $request->id_bodega_origen,
                'id_bodega_destino' => $request->id_bodega_destino,
                'id_inventario' => $request->id_inventario,
            ]);

            return response()->json([
                'msg' => 'historial creado',
                'history' => $history
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
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $history = History::find($id);
            return response()->json([
                'history' => $history
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
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $history = History::find($id);
            $history->estado = 0;
            $history->save();
            return response()->json([
                'msg' => "historial eliminado"
            ]);
        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                // 'status' => $e->statusCode()
            ]);
        }
    }
}

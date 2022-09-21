<?php

namespace App\Http\Controllers;

use App\Models\Winery;
use Exception;
use Illuminate\Http\Request;

class WineryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $wineries = Winery::with('inventories')->get();
            return response()->json([
                'wineries' => $wineries
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
                'id_responsable' => 'required',
            ]);

            $product = Winery::create([
                'nombre' => $request->nombre,
                'id_responsable' => $request->id_responsable,
                'estado' => 1
            ]);

            return response()->json([
                'msg' => 'Bodega creado',
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
     * @param  \App\Models\Winery  $winery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $winery = Winery::with('inventories')->where('id', $id)->get();
            return response()->json([
                'winery' => $winery
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
     * @param  \App\Models\Winery  $winery
     * @return \Illuminate\Http\Response
     */
    public function edit(Winery $winery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Winery  $winery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Winery $winery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Winery  $winery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            // $winery = Winery::with('inventories')->where('id', $id)->get();
            $winery = Winery::find($id);
            $winery->estado = 0;
            $winery->save();
            return response()->json([
                'msg' => "Bodega eliminada",
                // 'prueba' => $winery
            ]);
        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                // 'status' => $e->statusCode()
            ]);
        }
    }
}

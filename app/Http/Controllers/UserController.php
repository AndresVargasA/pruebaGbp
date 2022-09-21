<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $users = User::all();
            return response()->json([
                'users' => $users
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
                'foto' => 'required',
            ]);

            $user = User::create([
                'nombre' => $request->nombre,
                'foto' => $request->foto,
                'estado' => 1
            ]);

            return response()->json([
                'msg' => 'Usuario creado',
                'user' => $user
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = User::find($id);
            return response()->json([
                'user' => $user
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $user = User::find($id);
            if($request->nombre){
                $user->nombre = $request->nombre;
                $user->save();
            }

            if($request->foto){
                $user->foto = $request->foto;
                $user->save();
            }

            return response()->json([
                'msg' => 'Usuario actualizado',
                'user' => $user
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id);
            $user->estado = 0;
            $user->save();
            return response()->json([
                'msg' => "usuario eliminado"
            ]);
        }catch (Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                // 'status' => $e->statusCode()
            ]);
        }
    }
}

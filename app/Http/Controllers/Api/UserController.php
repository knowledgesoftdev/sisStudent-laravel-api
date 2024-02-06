<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $inputs = $request->input();
        $inputs['password'] = Hash::make(trim($request->password));
        $res = User::create($inputs);

        return response()->json([
            'data' => $res,
            'message' => "Usuario creado con exito."

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exist = User::find($id);
        if (isset($exist)) {
            return response()->json([
                'data' => $exist,
                'message' => "Usuario encontrado."
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => "Usuario no encontrado."
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exist=User::find($id);
        if(isset($exist)){
            $exist->first_name=$request->first_name;
            $exist->last_name=$request->last_name;
            $exist->email=$request->email;
            $exist->password=Hash::make(trim($request->password));

            if($exist->save()){
                return response()->json([
                    "data" => $exist,
                    "message" => "Usuario actualizado."
                ]);
            }else{
                return response()->json([
                    "error" => true,
                    "message" => "No se pudo actualizar el usuario."
                ]);
            }
            
        }else{
            return response()->json([
                "error" => true,
                "message" => "No existe el usuario."
            ]);
        }
        return $exist;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exist = User::find($id);
        if (isset($exist)) {
            $res = User::destroy($id);
            if ($res) {
                return response()->json([
                    "user" => $exist,
                    "message" => "Se ha eliminado el usuario correctamente."
                ]);
            } else {
                return response()->json([
                    "error" => true,
                    "message" => "No se logro eliminar al usuario."
                ]);
            }
        } else {
            return response()->json([
                "error" => true,
                "message" => "No existe el usuario."
            ]);
        }
    }
}

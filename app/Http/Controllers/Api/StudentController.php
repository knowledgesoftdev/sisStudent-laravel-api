<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::orderby("id","desc")->get();
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
        $response = Student::create($inputs);
        return response()->json([
            'data' => $response,
            'message' => "Estudiando ingresado con exito.",
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
        $exist = Student::find($id);
        if (isset($exist)) {
            return response()->json([
                'data' => $exist,
                'message' => "Estudiando encontrado con exito.",
            ]); {
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => "No se encontro al estudiante.",
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
        $exist = Student::find($id);
        if (isset($exist)) {
            $exist->first_name = $request->first_name;
            $exist->last_name = $request->last_name;
            $exist->image = $request->image;
            if ($exist->save()) {
                return response()->json([
                    'data' => $exist,
                    'message' => "Estudiando actualizado con exito.",
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => "No se actualizo el estudiante.",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => "No existe el estudiante.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exist = Student::find($id);
        if (isset($exist)) {
            $res = Student::destroy($id);
            if ($res) {
                return response()->json([
                    'error' => false,
                    'message' => "Estudiando eliminado."
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => "No se pudo eliminar al estudiante."
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => "No existe el estudiante.",
            ]);
        }
    }
}

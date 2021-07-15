<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = DB::select("SELECT e.*, a.nombre AS area FROM empleados e, areas a WHERE e.area_id = a.id ");
        return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = DB::select("SELECT * FROM areas ");
        $roles = DB::select("SELECT * FROM roles ");
        return view('empleado.create', compact('areas', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = new Empleado;
        $empleado->nombre       = $request->input('nombre');
        $empleado->email        = $request->input('email');
        $empleado->sexo         = $request->input('sexo');
        $empleado->area_id      = $request->input('area_id');
        $empleado->descripcion  = $request->input('descripcion');
        $empleado->boletin      = $request->has('boletin')? $request->input('boletin') : 0 ;
        if ($empleado->save()) {
            $empleado_id = $empleado->id;
            $roles = $request->input('rol_id');
            DB::select("DELETE FROM empleado_rol WHERE empleado_id = '$empleado_id' ");
            foreach ($roles as $rol_id) { 
                //$insert = DB::select("INSERT INTO empleado_rol (rol_id, empleado_id) VALUES ('$rol_id', 'empleado_id')");
                DB::table('empleado_rol')->insert(['rol_id' => $rol_id, 'empleado_id' => $empleado_id]);
            }
            //dd($request);
            return response()->json(['accion' => 1, 'message' => 'Datos guardados correctamente!', 'data' => $empleado]);
        }
        return response()->json(['accion' => 0, 'message' => 'Error to delete '], 500);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $areas = DB::select("SELECT * FROM areas ");
        $empleado_rol = DB::select("SELECT * FROM empleado_rol WHERE empleado_id = '$id' ");
        $roles = DB::select("SELECT * FROM roles ");
        return view('empleado.edit', compact('areas', 'roles', 'empleado', 'empleado_rol', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        $empleado->nombre       = $request->input('nombre');
        $empleado->email        = $request->input('email');
        $empleado->sexo         = $request->input('sexo');
        $empleado->area_id      = $request->input('area_id');
        $empleado->descripcion  = $request->input('descripcion');
        $empleado->boletin      = $request->has('boletin')? $request->input('boletin') : 0 ;
        if ($empleado->save()) {
            $empleado_id = $empleado->id;
            $roles = $request->input('rol_id');
            DB::select("DELETE FROM empleado_rol WHERE empleado_id = '$empleado_id' ");
            foreach ($roles as $rol_id) { 
                //$insert = DB::select("INSERT INTO empleado_rol (rol_id, empleado_id) VALUES ('$rol_id', 'empleado_id')");
                DB::table('empleado_rol')->insert(['rol_id' => $rol_id, 'empleado_id' => $empleado_id]);
            }
            //dd($request);
            return response()->json(['accion' => 1, 'message' => 'Datos actualizados correctamente!', 'data' => $empleado]);
        }
        return response()->json(['accion' => 0, 'message' => 'Error to delete '], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        //
    }
}

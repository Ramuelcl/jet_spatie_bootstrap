<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pag=6)
    {
        $datos['empleados']=Empleado::paginate($pag);
        return view('empleado.index')->
        with('datos', $datos);
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',            'ApellidoPaterno'=>'required|string|max:100',            'ApellidoMaterno'=>'max:100',
            'Correo'=>'required|email',
            'Foto'=>'max:10000|mimes:jpeg,png,jp',
        ];
        $mensaje=[
            'Nombre.required'=>'El nombre es requerido',
            'ApellidoPaterno.required'=>'El apellido es requerido',
            'Correo.required'=>'El email es requerido',
            'Correo.email'=>'El email debe ser válido',
         ];

        $this->validate($request, $campos, $mensaje);

        $datos=\request()->except('_token');
        if ($request->hasFile('Foto')) {
            $datos['Foto']=$request->file('Foto')->store('images', 'public');
        }
        // dd($datos);
        Empleado::insert($datos);
        return \redirect('empleado')->with('mensaje', 'registro agregado')
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id=0)
    {
        $empleado=Empleado::findOrFail($id);
        // return \view('empleado.edit', \compact('empleado'));
        return \view('empleado.edit')->
        with('empleado', $empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',            'ApellidoPaterno'=>'required|string|max:100',            'ApellidoMaterno'=>'string|max:100',            'Correo'=>'required|email',

        ];
        $mensaje=[
            'Nombre.required'=>'El nombre es requerido',
            'ApellidoPaterno.required'=>'El apellido es requerido',
            'Correo.required'=>'El email es requerido',
            'Correo.email'=>'El email debe ser ',

        ];
        if ($request->hasFile('Foto')) {
            $campos['Foto']='max:10000|mimes:jpeg,png,jp';
            $mensaje['Foto.required']='La foto es requerida';
        }
        $this->validate($request, $campos, $mensaje);

        $datos=\request()->except(['_token', '_method']);

        if ($request->hasFile('Foto')) {
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datos['Foto']=$request->file('Foto')->store('images', 'public');
        }

        Empleado::where('id', '=', $id)->update($datos);

        return \redirect('empleado')->with('mensaje', 'registro actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id=0)
    {
        if ($id>0) {
            // borrar archivo foto
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);

            Empleado::destroy($id);
        }
        return \redirect('empleado')->with('mensaje', 'registro borrado');
    }
}

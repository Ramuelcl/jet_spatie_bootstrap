<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//
use App\Models\User;
use Spatie\Permission\Models\Role;
//
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paginate = 5)
    {
        $datos['user'] = User::paginate($paginate);
        return view('admin.usuarios.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $datos['usuario'] =null;
        $datos['roles'] = Role::pluck('id', 'name')->sort()->all();
        $datos['permisos'] = Permission::pluck('id', 'name', )->sort()->all();
        return \view('admin.usuarios.crear', compact('datos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user=User::create($input);
        $user->assignRole($request->input('roles'));
        return \redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        // \dd($user);
        $datos['user']=$user;
        $datos['roles'] = Role::pluck('id', 'name')->sort()->all();
        $datos['permisos'] = Permission::pluck('id', 'name', )->sort()->all();
        $datos['userRole'] = $user->roles->pluck('name', 'name');
        $datos['userPerm'] = $user->permissions->pluck('name', 'name')
        ->all();
        return \view('admin.usuarios.editar ', \compact('datos'));
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
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users,email' .$id,
            // si el usuario administrador edita el usuario
            // el campo password NO es requerido
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user=User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return \redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id>1) {
            User::find($id)->delete();
        }
        return \redirect()->route('usuarios.index');
    }
}

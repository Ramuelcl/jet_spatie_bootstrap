<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// ... Spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// manejo de datos
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super-admin|admin');
        // ... otras opciones por roles
        // $this->middleware('role:super-admin|admin', ['only'=>['index']]);
        // ... otras opciones por permisos
        // $this->middleware('permission:new|edit|delete|publish|unpublish', ['only'=>['index']]);
        // $this->middleware('role:super-admin|admin', ['only'=>['index']]);
        // $this->middleware('permission:new', ['only'=>['create', 'store']]);
        // $this->middleware('permission:edit', ['only'=>['edit', 'update']]);
        // $this->middleware('permission:delete', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paginate = 5)
    {
        $datos['role'] = Role::paginate($paginate);
        return view('admin.roles.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $datos['role'] = Role::get();
        $datos['permission'] = Permission::get();
        return \view('admin.roles.crear', compact('datos'));
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
            'permission'=>'required'
        ]);
        $role=Role::create(['name'=>$request->input('name')]);
        return \redirect()->route('admin.roles.index');
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
        $datos['role'] = Role::find($id);
        $datos['permission'] = Permission::get();
        $datos['rolePermissions'] = DB::table('role_has_permissions')->where('role_has_permissions.role_id', '=', $id)
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();
        return \view('admin.roles.editar', \compact('datos'));
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
        $this->validate($request, ['name'=>'required','permission'=>'required']);
        $role=Role::find($id);
        $role->name=$request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return \redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('roles')->where('id', $id)->delete();
        return \redirect()->route('admin.roles.index');
    }
}

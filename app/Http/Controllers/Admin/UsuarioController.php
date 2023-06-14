<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class UsuarioController extends Controller
{
    public function index()
    {
        $datas = User::orderBy('id')->get();
        return view('admin.users.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.users.crear');
    }

    public function store(Request $request)
    {
        if (!($request->activo)) {
            $request->merge(['activo' => '0']);
        }
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        $usuario = User::create($data);
        $usuario->centroVotaciones()->sync($request->input('centro_id'));
        return redirect('administrador/usuario')->with('mensaje', 'Usuario creado exitosamente.');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.users.editar', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (!($request->activo)) {
            $request->merge(['activo' => '0']);
        }
        $user = User::findOrFail($id);
        if ($request->input('password') != "********") {
            $user->password = bcrypt($request->input('password'));
        }
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->tipo = $request->input('tipo');
        $user->mesa = $request->input('mesa');
        $user->activo = $request->input('activo');
        $centros = $request->input('centro_id');
        foreach ($centros as $key => $centroId) {
            if ($centroId == 0) {
                unset($centros[$key]);
            }
        }
        $user->centroVotaciones()->sync($centros);
        $user->save();
        return redirect('administrador/usuario')->with('mensaje', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            User::destroy($id);
        } catch (Exception $e) {
            return redirect('administrador/usuario')->withErrors(['catch', $e->getMessage()]);
        }
        return redirect('administrador/usuario')->with('mensaje', 'Usuario eliminado con éxito.');
    }
}

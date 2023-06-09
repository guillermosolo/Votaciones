<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partido;
use Exception;

class PartidoController extends Controller
{
    public function index()
    {
        $datas = Partido::orderBy('id')->get();
        return view('admin.partidos.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.partidos.crear');
    }

    public function store(Request $request)
    {
        Partido::create($request->all());
        return redirect('administrador/partido')->with('mensaje', 'Partido creado exitosamente.');
    }

    public function edit($id)
    {
        $data = Partido::findOrFail($id);
        return view('admin.partidos.editar',compact('data'));
    }

    public function update(Request $request, $id)
    {
        Partido::findOrFail($id)->update($request->all());
        return redirect('administrador/partido')->with('mensaje', 'Partido actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            Partido::destroy($id);
        } catch (Exception $e) {
            return redirect('administrador/partido')->withErrors(['catch', $e->getMessage()]);
        }
        return redirect('administrador/partido')->with('mensaje', 'Partido eliminado con éxito.');
    }
}

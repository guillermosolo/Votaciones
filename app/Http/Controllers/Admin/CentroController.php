<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CentroVotacion;
use Exception;

class CentroController extends Controller
{
    public function index()
    {
        $datas = CentroVotacion::orderBy('id')->get();
        return view('admin.centros.index', compact('datas'));
    }

    public function create()
    {
        $ultimoID = CentroVotacion::latest('id')->value('id');
        $ultimoID++;
        return view('admin.centros.crear',compact('ultimoID'));
    }

    public function store(Request $request)
    {
        CentroVotacion::create($request->all());
        return redirect('administrador/centro')->with('mensaje', 'Centro de votación creado exitosamente.');
    }

    public function edit($id)
    {
        $data = CentroVotacion::findOrFail($id);
        return view('admin.centros.editar',compact('data'));
    }

    public function update(Request $request, $id)
    {
        CentroVotacion::findOrFail($id)->update($request->all());
        return redirect('administrador/centro')->with('mensaje', 'Centro de votación actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            CentroVotacion::destroy($id);
        } catch (Exception $e) {
            return redirect('administrador/centro')->withErrors(['catch', $e->getMessage()]);
        }
        return redirect('administrador/centro')->with('mensaje', 'Centro de votación eliminado con éxito.');
    }
}

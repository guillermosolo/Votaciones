<?php

namespace App\Http\Controllers\Fiscal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CentroVotacion;
use App\Models\Partido;
use App\Models\Resultado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FiscalController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $usuario->todosDatos = Auth::user()->todosDatos();
        //dd($usuario);
        return view('fiscal.index', compact('usuario'));
    }

    public function presidente()
    {
        $datas = Partido::where('presidente', '>', 0)->orderBy('presidente')->get();
        return view('fiscal.presidente.index', compact('datas'));
    }

    public function alcalde()
    {
        $datas = Partido::where('alcalde', '>', 0)->orderBy('alcalde')->get();
        return view('fiscal.alcalde.index', compact('datas'));
    }

    public function diputado()
    {
        $datas = Partido::where('diputado', '>', 0)->orderBy('diputado')->get();
        return view('fiscal.diputado.index', compact('datas'));
    }

    public function mesa()
    {
        return view('fiscal.mesa.index');
    }

    public function fotos()
    {
        return view('fiscal.mesa.cerrar');
    }

    public function impugnar()
    {
        return view('fiscal.mesa.impugnar');
    }

    public function storeImpugnar(Request $request)
    {
        $centroId = $request->input('centro');
        $mesa = $request->input('mesa');
        DB::beginTransaction();
        try {
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                $this->subirFotos($files, 'I', $centroId, $mesa);
                Resultado::where('centro_id', $centroId)->where('mesa', $mesa)->delete();
                $user = Auth::user();
                $user->mesaImpugnada = true;
                $user->save();
                DB::commit();
            } else {
                return redirect('fiscal/impugnar')->withErrors('Debe de seleccionar como mínimo un archivo.');
            }
            return redirect('fiscal/fiscal')->with('mensaje', 'Impugnación guardada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->borrarArchivos($centroId, $mesa);
            return redirect('fiscal/impugnar')->withErrors("Error al guardar impugnación, <strong> Intente de nuevo</strong>.");
        }
    }

    public function subirFotos(array $files, string $boleta, string $centroId, string $mesa)
    {
        $correlativo = 0;

        foreach ($files as $file) {
            $correlativo++;
            $extension = $file->getClientOriginalExtension();
            $fileName = $boleta . '_' . $centroId . '_' . $mesa . '_' . $correlativo . '.' . $extension;
            while (Storage::disk('public')->exists("$fileName")) {
                $correlativo++;
                $fileName = $centroId . '_' . $mesa . '_' . $correlativo . '.' . $extension;
            }

            $file->storeAs('', $fileName, 'public');
        }
    }

    public function borrarArchivos($centroId, $mesa)
    {
        $archivos = Storage::disk('public')->allFiles('/');
        $patron = "/^.*" . $centroId . "_" . $mesa . "_.*\..+$/";

        foreach ($archivos as $archivo) {
            if (preg_match($patron, $archivo)) {
                Storage::disk('public')->delete($archivo);
            }
        }
    }

    public function cerrar(Request $request)
    {
        $centroId = $request->input('centro');
        $mesa = $request->input('mesa');
        DB::beginTransaction();
        try {
            if ($request->hasFile('imagesPres') && $request->hasFile('imagesDip') && $request->hasFile('imagesAl')) {
                $files = $request->file('imagesPres');
                $this->subirFotos($files, 'P', $centroId, $mesa);
                $files = $request->file('imagesDip');
                $this->subirFotos($files, 'D', $centroId, $mesa);
                $files = $request->file('imagesAl');
                $this->subirFotos($files, 'A', $centroId, $mesa);
                Resultado::where('centro_id', $centroId)->where('mesa', $mesa)->update(['cerrado' => true]);
                $user = Auth::user();
                $user->mesaCerrada = true;
                $user->save();
                DB::commit();
            } else {
                return redirect('fiscal/cerrar')->withErrors('Debe de seleccionar como mínimo un archivo.');
            }
            return redirect('fiscal/fiscal')->with('mensaje', 'Mesa cerrada Exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->borrarArchivos($centroId, $mesa);
            return redirect('fiscal/cerrar')->withErrors("Error al cerrar la mesa, <strong> Intente de nuevo</strong>.");
        }
    }

    public function aperturar(Request $request)
    {
        $user = Auth::user();
        $papeletas = $request->papeletas;
        $user->papeletas = $papeletas;
        $user->save();
        return redirect('fiscal/fiscal')->with('mensaje', "Mesa aperturada con $papeletas papeletas.");
    }

    public function store(Request $request)
    {
        $mesa = $request->input('mesa');
        $boleta = $request->input('boleta');
        $centroid = $request->input('centro');
        $partidos = $request->input('partido');
        $votos = $request->input('votos');
        $user = Auth::user();
        $ruta = "";
        switch ($boleta) {
            case 'A':
                $ruta = 'alcalde';
                break;
            case 'D':
                $ruta = 'diputado';
                break;
            case 'P':
                $ruta = 'presidente';
                break;
        }
        $cantidadVotos = array_sum($votos);
       /* if ($cantidadVotos != $user->papeletas) {
            return redirect()->route($ruta)->withErrors("La cantidad de papeletas reportadas <strong>($cantidadVotos)</strong> no coincide con la cantidad de papeletas de apertura <strong>($user->papeletas)</strong>.")->withInput();
        }*/
        DB::beginTransaction();
        try {
            Resultado::where('centro_id', $centroid)->where('mesa', $mesa)->where('boleta', $boleta)->delete();
            foreach ($partidos as $key => $partido) {
                $resultado = new Resultado();
                $resultado->centro_id = $centroid;
                $resultado->mesa = $mesa;
                $resultado->boleta = $boleta;
                $resultado->partido_id = $partido;
                $resultado->cantidad = $votos[$key];
                $resultado->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($ruta)->withErrors(['catch', 'No se pudo guardar debido a un error en el sistema', $e->getMessage()]);
        }
        $centroNombre = CentroVotacion::where('id', $centroid)->value('nombre');
        return redirect('fiscal/fiscal')->with('mensaje', "Se guardaron correctamente $cantidadVotos votos del Centro de Votacion $centroNombre Mesa No. $mesa");
    }
}

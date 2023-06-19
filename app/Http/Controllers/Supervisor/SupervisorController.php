<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Resultado;
use App\Models\User;
use App\Models\CentroVotacion;
use Illuminate\Support\Facades\Storage;

class SupervisorController extends Controller
{
    public function index($centroVotacion)
    {
        $centroVotacionIds = explode(',', $centroVotacion);
        $datas = User::where(function ($query) {
            $query->where('mesaCerrada', true)
                ->where(function ($subquery) {
                    $subquery->where('mesaValidadaPres', false)
                        ->orWhere('mesaValidadaAl', false)
                        ->orWhere('mesaValidadaDip', false);
                });
        })
            ->orWhere(function ($query) {
                $query->where('mesaImpugnada', true)
                    ->where('mesaValidadaImp', false);
            })
            ->where('tipo', 2)
            ->whereHas('centroVotaciones', function ($query) use ($centroVotacionIds) {
                $query->whereIn('centro_votacion_id', $centroVotacionIds);
            })
            ->get();
        return view('supervisor.index', compact('datas'));
    }

    public function listarArchivos($centroId, $mesa, $boleta)
    {
        $archivos = Storage::disk('public')->allFiles('/');
        $patron = "/^" . $boleta . "_" . $centroId . "_" . $mesa . "_.*\..+$/";
        $archivosFiltrados = preg_grep($patron, $archivos);
        $listaArchivos = [];

        foreach ($archivosFiltrados as $archivo) {
            $nombreArchivo = pathinfo($archivo, PATHINFO_FILENAME);
            $extensionArchivo = pathinfo($archivo, PATHINFO_EXTENSION);
            $nombreCompleto = $nombreArchivo . '.' . $extensionArchivo;
            $listaArchivos[] = $nombreCompleto;
        }
        return $listaArchivos;
    }

    public function validarPres($centroVotacion, $mesa, $fiscal)
    {
        $datas = Resultado::where('centro_id', $centroVotacion)
            ->where('mesa', $mesa)
            ->where('boleta', 'P')
            ->where('cerrado', true)
            ->where('validado', false)
            ->join('partidos', 'resultados.partido_id', '=', 'partidos.id')
            ->orderBy('partidos.presidente', 'asc')->get();
        $imagenes = $this->listarArchivos($centroVotacion, $mesa, 'P');
        return view('supervisor.presidente.index', compact('datas', 'centroVotacion', 'mesa', 'fiscal', 'imagenes'));
    }

    public function validarImp($centroVotacion, $mesa, $fiscal)
    {
        $imagenes = $this->listarArchivos($centroVotacion, $mesa, 'I');
        return view('supervisor.impugnada.index', compact('centroVotacion', 'mesa', 'fiscal', 'imagenes'));
    }

    public function updateImp(Request $request)
    {
        $fiscal = $request->input('fiscal');
        $centro = $request->input('centro');
        $mesa = $request->input('mesa');
        User::where('id', $fiscal)->update(['mesaValidadaImp' => 1]);
        $centroNombre = CentroVotacion::where('id', $centro)->value('nombre');
        return redirect()->route('menuSuper', ['centroVotacion' => $centro])->with('mensaje', "Se validaron correctamente la impugnación de la Mesa No. $mesa del Centro de Votacion $centroNombre.");
    }

    public function validarDip($centroVotacion, $mesa, $fiscal)
    {
        $datas = Resultado::where('centro_id', $centroVotacion)
            ->where('mesa', $mesa)
            ->where('boleta', 'D')
            ->where('cerrado', true)
            ->where('validado', false)
            ->join('partidos', 'resultados.partido_id', '=', 'partidos.id')
            ->orderBy('partidos.diputado', 'asc')->get();
        $imagenes = $this->listarArchivos($centroVotacion, $mesa, 'D');
        return view('supervisor.diputado.index', compact('datas', 'centroVotacion', 'mesa', 'fiscal', 'imagenes'));
    }

    public function validarAl($centroVotacion, $mesa, $fiscal)
    {
        $datas = Resultado::where('centro_id', $centroVotacion)
            ->where('mesa', $mesa)
            ->where('boleta', 'A')
            ->where('cerrado', true)
            ->where('validado', false)
            ->join('partidos', 'resultados.partido_id', '=', 'partidos.id')
            ->orderBy('partidos.alcalde', 'asc')->get();
        $imagenes = $this->listarArchivos($centroVotacion, $mesa, 'A');
        return view('supervisor.alcalde.index', compact('datas', 'centroVotacion', 'mesa', 'fiscal', 'imagenes'));
    }

    public function update(Request $request)
    {
        try {
            $mesa = $request->input('mesa');
            $centro = $request->input('centro');
            $boleta = $request->input('boleta');
            $votos = $request->input('votos');
            $partidos = $request->input('partido');
            $fiscal = $request->input('fiscal');
            switch ($boleta) {
                case 'A':
                    $ruta = 'validarAl';
                    $campo = 'mesaValidadaAl';
                    break;
                case 'D':
                    $ruta = 'validarDip';
                    $campo = 'mesaValidadaDip';
                    break;
                case 'P':
                    $ruta = 'validarPresi';
                    $campo = 'mesaValidadaPres';
                    break;
            }

            // Iniciar la transacción
            DB::beginTransaction();

            // Iterar sobre los arreglos de votos y partidos
            foreach ($votos as $index => $voto) {
                $partido = $partidos[$index];

                // Obtener el resultado existente para el partido en la misma mesa, centro y boleta
                $resultado = Resultado::where('mesa', $mesa)
                    ->where('centro_id', $centro)
                    ->where('boleta', $boleta)
                    ->where('partido_id', $partido)
                    ->lockForUpdate() // Opcional: bloquear las filas para evitar conflictos de concurrencia
                    ->firstOrFail();
                // Actualizar el campo cantidad con el valor del voto correspondiente
                $resultado->cantidad = $voto;
                $resultado->validado = true;
                $resultado->save();
                User::where('id', $fiscal)->update([$campo => 1]);
            }

            // Realizar cualquier otra acción necesaria
            // ...

            // Confirmar la transacción si todo es correcto
            DB::commit();
        } catch (\Exception $e) {
            // Deshacer la transacción en caso de error
            DB::rollBack();
            return redirect()->route($ruta, ['centroVotacion' => $centro, 'mesa' => $mesa, 'fiscal' => $fiscal])->withErrors(['catch', 'No se pudo validar debido a un error en el sistema', $e->getMessage()]);
        }
        $cantidadVotos = array_sum($votos);
        $centroNombre = CentroVotacion::where('id', $centro)->value('nombre');
        return redirect()->route('menuSuper', ['centroVotacion' => $centro])->with('mensaje', "Se validaron correctamente $cantidadVotos votos del Centro de Votacion $centroNombre Mesa No. $mesa");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resultado;
use App\Models\Partido;
use Illuminate\Support\Facades\DB;
use App\Dhondt;
use App\Models\CentroVotacion;
use App\Models\User;

class AdminController extends Controller
{
    private $colores;

    public function __construct()
    {
        $this->colores = [
            'rgba(255, 0, 0, 0.4)',    // 1: Rojo
            'rgba(0, 255, 0, 0.4)',    // 2: Verde
            'rgba(0, 0, 255, 0.4)',    // 3: Azul
            'rgba(255, 255, 0, 0.4)',  // 4: Amarillo
            'rgba(255, 0, 255, 0.4)',  // 5: Magenta
            'rgba(0, 255, 255, 0.4)',  // 6: Cian
            'rgba(128, 0, 0, 0.4)',    // 7: Marrón oscuro
            'rgba(0, 128, 0, 0.4)',    // 8: Verde oscuro
            'rgba(0, 0, 128, 0.4)',    // 9: Azul oscuro
            'rgba(128, 128, 0, 0.4)',  // 10: Oliva
            'rgba(128, 0, 128, 0.4)',  // 11: Púrpura
            'rgba(0, 128, 128, 0.4)',  // 12: Verde azulado
            'rgba(128, 128, 128, 0.4)', // 13: Gris
            'rgba(255, 102, 102, 0.4)', // 14: Rojo claro
            'rgba(102, 255, 102, 0.4)', // 15: Verde claro
            'rgba(102, 102, 255, 0.4)', // 16: Azul claro
            'rgba(255, 255, 102, 0.4)', // 17: Amarillo claro
            'rgba(255, 102, 255, 0.4)', // 18: Magenta claro
            'rgba(102, 255, 255, 0.4)', // 19: Cian claro
            'rgba(153, 51, 0, 0.4)',   // 20: Marrón
            'rgba(0, 153, 51, 0.4)',   // 21: Verde oliva
            'rgba(51, 0, 153, 0.4)',   // 22: Púrpura oscuro
            'rgba(153, 153, 0, 0.4)',  // 23: Verde oliva claro
            'rgba(153, 0, 153, 0.4)',  // 24: Púrpura claro
            'rgba(0, 153, 153, 0.4)',  // 25: Cian oscuro
            'rgba(153, 153, 153, 0.4)', // 26: Gris claro
            'rgba(255, 153, 102, 0.4)', // 27: Naranja claro
            'rgba(102, 255, 153, 0.4)', // 28: Verde claro
            'rgba(153, 102, 255, 0.4)', // 29: Lila claro
            'rgba(255, 255, 153, 0.4)', // 30: Amarillo claro
            'rgba(255, 153, 255, 0.4)', // 31: Rosa claro
            'rgba(0, 0, 0, 0.4)',      // 32: Negro
            'rgba(255, 255, 255, 0.4)', // 33: Blanco
            'rgba(85, 85, 85, 0.4)',   // 34: Gris oscuro
            'rgba(255, 255, 255, 0.4)', // 36: Gris claro
            'rgba(170, 170, 170, 0.4)' // 35: Gris medio
        ];
    }
    public function index()
    {
        //dd($this->datosNoGraficados());
        // Recuperar todos los partidos
        $partidos = Partido::where('presidente', '>', 0)->get();

        // Organizar los datos en un formato adecuado para el gráfico
        $partidosPres = [];
        $partidosDip = [];
        $partidosAl = [];
        $partidosT = [];

        $i = 0;
        foreach ($partidos as $partido) {

            $datosPartido = [
                'nombre' => $partido->siglas,
                'color' => $this->colores[$partido->id - 1],
                'id' => $partido->id,
            ];
            $partidosPres[] = $datosPartido;
            $i++;
        }

        $partidos = Partido::where('diputado', '>', 0)->get();

        $i = 0;
        foreach ($partidos as $partido) {

            $datosPartido = [
                'nombre' => $partido->siglas,
                'color' => $this->colores[$partido->id - 1],
                'id' => $partido->id,
            ];
            $partidosDip[] = $datosPartido;
            $i++;
        }

        $partidos = Partido::where('alcalde', '>', 0)->get();

        $i = 0;
        foreach ($partidos as $partido) {

            $datosPartido = [
                'nombre' => $partido->siglas,
                'color' => $this->colores[$partido->id - 1],
                'id' => $partido->id,
            ];
            $partidosAl[] = $datosPartido;
            $i++;
        }

        $partidos = Partido::all();
        $i = 0;
        foreach ($partidos as $partido) {

            $datosPartido = [
                'nombre' => $partido->siglas,
                'color' => $this->colores[$partido->id - 1],
                'id' => $partido->id,
            ];
            $partidosT[] = $datosPartido;
            $i++;
        }

        return view('admin.index', compact('partidosPres', 'partidosAl', 'partidosDip', 'partidosT'));
    }

    public function datosNoGraficados()
    {
        $totalAlcalde = Resultado::where('validado', true)
            ->where('boleta', 'A')
            ->where('partido_id', '<=', 31)
            ->select(DB::raw('SUM(resultados.cantidad) as votes'))
            ->pluck('votes')->first();
        $totalPresidente = Resultado::where('validado', true)
            ->where('boleta', 'P')
            ->where('partido_id', '<=', 31)
            ->select(DB::raw('SUM(resultados.cantidad) as votes'))
            ->pluck('votes')->first();
        $totalDiputado = Resultado::where('validado', true)
            ->where('boleta', 'D')
            ->where('partido_id', '<=', 31)
            ->select(DB::raw('SUM(resultados.cantidad) as votes'))
            ->pluck('votes')->first();
        $mesasComputadas = User::where(function ($query) {
            $query->where('mesaValidadaPres', true)
                ->where('mesaValidadaAl', true)
                ->where('mesaValidadaDip', true);
        })
            ->orWhere('mesaImpugnada', true)
            ->select(DB::raw('COUNT(mesa) as mesas'))
            ->pluck('mesas')->first();
        $mesasTotal = CentroVotacion::select(DB::raw('SUM(JRV) as mesas'))->pluck('mesas')->first();
        $mesasPorcentaje = number_format(($mesasComputadas * 100) / $mesasTotal, 2) . '%';
        $mesasImpugnadas = User::where('mesaImpugnada', true)
            ->select(DB::raw('COUNT(mesa) as mesas'))
            ->pluck('mesas')->first();
        $votosOtros = Resultado::where('validado', true)
            ->where('partido_id', '>=', 32)
            ->where('partido_id', '<=', 35)
            ->join('partidos', 'resultados.partido_id', '=', 'partidos.id')
            ->groupBy('partidos.id', 'boleta')
            ->select('partidos.siglas as Tipo', 'boleta', DB::raw('SUM(cantidad) as votes'))
            ->get()->toArray();
        $votosEmitidosPorcentaje = Resultado::where('validado', true)
            ->where('partido_id', '<', 36)
            ->groupBy('boleta')
            ->select('boleta', DB::raw('SUM(cantidad) as votos'))
            ->get()->toArray();
        $empadronados = CentroVotacion::select(DB::raw('SUM(empadronados) as empadronados'))->pluck('empadronados')->first();
        foreach ($votosEmitidosPorcentaje as &$resultado) {
            $resultado['porcentaje'] = number_format($resultado['votos'] * 100 / $empadronados, 2) . '%';
        }
        $jsonData = ['totalAlcalde' => $totalAlcalde];
        $jsonData += ['totalPresidente' => $totalPresidente];
        $jsonData += ['totalDiputado' => $totalDiputado];
        $jsonData += ['mesasComputadasNumero' => $mesasComputadas];
        $jsonData += ['mesasComputadasPorcentaje' => $mesasPorcentaje];
        $jsonData += ['mesasImpugnadas' => $mesasImpugnadas];
        $jsonData += ['votosOtros' => $votosOtros];
        $jsonData += ['porcentajeVotantes' => $votosEmitidosPorcentaje];
        $d = new Dhondt;
        $d->seats = 14;
        $d->min = 0;
        $resultados = Resultado::where('validado', true)
            ->where('boleta', 'A')
            ->where('partido_id', '<=', 31)
            ->join('partidos', 'resultados.partido_id', '=', 'partidos.id')
            ->groupBy('partidos.id')
            ->select('partidos.siglas as ent', DB::raw('SUM(resultados.cantidad) as votes'), DB::raw('0 as seats'), DB::raw('true as ok'))
            ->get()->toArray();
        $d->addParties($resultados);
        $d->process();
        $data = $d->getPartiesOK();
        $jsonData += ['concejales' => $data];
        return $jsonData;
    }

    public function obtenerDatosGrafico()
    {
        $datosExtra = $this->datosNoGraficados();
        $partidos = Partido::where('presidente', '>', 0)->get();

        $resultados = Resultado::select('partido_id', DB::raw('SUM(cantidad) as total_cantidad'))
            ->where('boleta', 'P')
            ->where('cerrado', true)
            ->where('validado', true)
            ->groupBy('partido_id')
            ->get();

        $partidosPres = [];

        $i = 0;

        foreach ($partidos as $partido) {
            $datosPartido = [
                'nombre' => $partido->siglas,
                'color' => $this->colores[$partido->id - 1],
                'id' => $partido->id,
                'total' => 0,
            ];

            $i++;

            foreach ($resultados as $resultado) {
                if ($resultado->partido_id == $partido->id) {
                    $datosPartido['total'] = $resultado->total_cantidad;
                }
            }

            $partidosPres[] = $datosPartido;
        }

        $partidos = Partido::where('alcalde', '>', 0)->get();

        $resultados = Resultado::select('partido_id', DB::raw('SUM(cantidad) as total_cantidad'))
            ->where('boleta', 'A')
            ->where('cerrado', true)
            ->where('validado', true)
            ->groupBy('partido_id')
            ->get();

        $partidosAl = [];

        $i = 0;

        foreach ($partidos as $partido) {
            $datosPartido = [
                'nombre' => $partido->siglas,
                'color' => $this->colores[$partido->id - 1],
                'id' => $partido->id,
                'total' => 0,
            ];

            $i++;

            foreach ($resultados as $resultado) {
                if ($resultado->partido_id == $partido->id) {
                    $datosPartido['total'] = $resultado->total_cantidad;
                }
            }

            $partidosAl[] = $datosPartido;
        }

        $partidos = Partido::where('diputado', '>', 0)->get();

        $resultados = Resultado::select('partido_id', DB::raw('SUM(cantidad) as total_cantidad'))
            ->where('boleta', 'D')
            ->where('cerrado', true)
            ->where('validado', true)
            ->groupBy('partido_id')
            ->get();

        $partidosDip = [];

        $i = 0;

        foreach ($partidos as $partido) {
            $datosPartido = [
                'nombre' => $partido->siglas,
                'color' => $this->colores[$partido->id - 1],
                'id' => $partido->id,
                'total' => 0,
            ];

            $i++;

            foreach ($resultados as $resultado) {
                if ($resultado->partido_id == $partido->id) {
                    $datosPartido['total'] = $resultado->total_cantidad;
                }
            }

            $partidosDip[] = $datosPartido;
        }

        return response()->json([
            'partidosPres' => $partidosPres,
            'partidosAl' => $partidosAl,
            'partidosDip' => $partidosDip,
            'noGraficables' => $datosExtra
        ]);
    }
}

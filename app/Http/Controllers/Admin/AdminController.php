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

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    private $colores, $coloresB;

    public function __construct()
    {
        $this->colores = [
            'rgba(25, 28, 175, 0.2)',         //azul
            'rgba(255, 183, 0, 0.2)',         //bien
            'rgba(60, 92, 169, 0.2)',         //cabal
            'rgba(33, 51, 104, 0.2)',         //cambio
            'rgba(241, 202, 49, 0.2)',    //creo
            'rgba(255, 238, 0, 0.2)',         //elefante
            'rgba(155, 50, 28, 0.2)',        //fcn
            'rgba(157, 252, 60, 0.2)',    //familia
            'rgba(37, 65, 164, 0.2)',        //prosperidad
            'rgba(33, 41, 90, 0.2)',        //humanista
            'rgba(0, 0, 0, 0.2)',        //pin
            'rgba(9, 37, 88, 0.2)',           //nosotros
            'rgba(48, 60, 98, 0.2)',        //republicano
            'rgba(215, 223, 40, 0.2)',        //semilla
            'rgba(102, 45, 145, 0.2)',        //todos
            'rgba(80, 167, 0, 0.2)',          //une
            'rgba(49, 49, 144, 0.2)',         //republicana
            'rgba(235, 210, 156, 0.2)',    //urng - winaq
            'rgba(0, 155, 160, 0.2)',        //valor - unionista
            'rgba(0, 155, 160, 0.2)',         //valor
            'rgba(0, 104, 172, 0.2)',         //vamos
            'rgba(237, 28, 36, 0.2)',         //victoria
            'rgba(0, 163, 230, 0.2)',         //viva
            'rgba(227, 0, 130, 0.2)',         //vos
            'rgba(213, 52, 58, 0.2)',         //podemos
            'rgba(255, 195, 0, 0.2)',         //mlp
            'rgba(192, 134, 112, 0.2)',    //cherifon
            'rgba(118, 210, 37, 0.2)',    //justicia
            'rgba(243, 225, 153, 0.2)',    //pan
            'rgba(235, 210, 156, 0.2)',    //winaq
            'rgba(202, 184, 10, 0.2)',    //urng
            'rgba(0, 0, 0, 0.2)',      // nulos
            'rgba(255, 255, 255, 0.2)', // Blanco
            'rgba(85, 85, 85, 0.2)',   // invalidos
            'rgba(255, 255, 255, 0.2)', // impugnados
            'rgba(170, 170, 170, 0.2)' // no usados
        ];

        $this->coloresB = [
            'rgba(25, 28, 175, 1)',         //azul
            'rgba(255, 183, 0, 1)',         //bien
            'rgba(60, 92, 169, 1)',         //cabal
            'rgba(33, 51, 104, 1)',         //cambio
            'rgba(241, 202, 49, 1)',    //creo
            'rgba(255, 238, 0, 1)',         //elefante
            'rgba(155, 50, 28, 1)',        //fcn
            'rgba(157, 252, 60, 1)',    //familia
            'rgba(37, 65, 164, 1)',        //prosperidad
            'rgba(33, 41, 90, 1)',        //humanista
            'rgba(0, 0, 0, 1)',        //pin
            'rgba(9, 37, 88, 1)',           //nosotros
            'rgba(48, 60, 98, 1)',        //republicano
            'rgba(215, 223, 40, 1)',        //semilla
            'rgba(102, 45, 145, 1)',        //todos
            'rgba(80, 167, 0, 1)',          //une
            'rgba(49, 49, 144, 1)',         //republicana
            'rgba(235, 210, 156, 1)',    //urng - winaq
            'rgba(0, 155, 160, 1)',        //valor - unionista
            'rgba(0, 155, 160, 1)',         //valor
            'rgba(0, 104, 172, 1)',         //vamos
            'rgba(237, 28, 36, 1)',         //victoria
            'rgba(0, 163, 230, 1)',         //viva
            'rgba(227, 0, 130, 1)',         //vos
            'rgba(213, 52, 58, 1)',         //podemos
            'rgba(255, 195, 0, 1)',         //mlp
            'rgba(192, 134, 112, 1)',    //cherifon
            'rgba(118, 210, 37, 1)',    //justicia
            'rgba(243, 225, 153, 1)',    //pan
            'rgba(235, 210, 156, 1)',    //winaq
            'rgba(202, 184, 10, 1)',    //urng
            'rgba(0, 0, 0, 1)',      // nulos
            'rgba(0, 0, 0, 1)', //blanco
            'rgba(85, 85, 85, 1)',   //invalidos
            'rgba(0, 0, 0, 1)', // impugnados
            'rgba(170, 170, 170, 1)' // no usados
        ];
    }
    public function index()
    {
        //dd($this->datosNoGraficados(['U','R']));
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
                'color' => $this->colores[($partido->id) - 1],
                'colorB' => $this->coloresB[($partido->id) - 1],
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
                'color' => $this->colores[($partido->id) - 1],
                'colorB' => $this->coloresB[($partido->id) - 1],
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
                'color' => $this->colores[($partido->id) - 1],
                'colorB' => $this->coloresB[($partido->id) - 1],
                'id' => $partido->id,
            ];
            $partidosAl[] = $datosPartido;
            $i++;
        }
        //dd($partidosPres,$partidosAl,$partidosDip);
        return view('admin.index', compact('partidosPres', 'partidosAl', 'partidosDip'));
    }

    public function datosNoGraficados($arregloOpciones)
    {
        $totalAlcalde = Resultado::where('validado', true)
            ->join('centro_votacion', 'resultados.centro_id', '=', 'centro_votacion.id')
            ->where('boleta', 'A')
            ->where('partido_id', '<=', 31)
            ->whereIn('centro_votacion.sector', $arregloOpciones)
            ->select(DB::raw('SUM(resultados.cantidad) as votes'))
            ->pluck('votes')->first() ?? 0;
        $totalPresidente = Resultado::where('validado', true)
            ->join('centro_votacion', 'resultados.centro_id', '=', 'centro_votacion.id')
            ->where('boleta', 'P')
            ->where('partido_id', '<=', 31)
            ->whereIn('centro_votacion.sector', $arregloOpciones)
            ->select(DB::raw('SUM(resultados.cantidad) as votes'))
            ->pluck('votes')->first() ?? 0;
        $totalDiputado = Resultado::where('validado', true)
            ->join('centro_votacion', 'resultados.centro_id', '=', 'centro_votacion.id')
            ->where('boleta', 'D')
            ->where('partido_id', '<=', 31)
            ->whereIn('centro_votacion.sector', $arregloOpciones)
            ->select(DB::raw('SUM(resultados.cantidad) as votes'))
            ->pluck('votes')->first() ?? 0;
        $mesasComputadas = User::where('tipo', 2)
            ->whereHas('centroVotaciones', function ($query) use ($arregloOpciones) {
                $query->whereIn('sector', $arregloOpciones);
            })
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('mesaValidadaPres', true)
                        ->where('mesaValidadaAl', true)
                        ->where('mesaValidadaDip', true);
                })
                    ->orWhere(function ($query) {
                        $query->where('mesaImpugnada', true)
                            ->where('mesavalidadaImp', true);
                    });
            })
            ->select(DB::raw('COUNT(mesa) as mesas'))
            ->pluck('mesas')
            ->first();
        $centrosVotacion = CentroVotacion::whereHas('users', function ($query) {
            $query->where('tipo', 2) // Filtrar por tipo de usuario igual a 2
                ->where(function ($subQuery) {
                    $subQuery->where('mesaValidadaImp', true)
                        ->orWhere(function ($nestedSubQuery) {
                            $nestedSubQuery->where('mesaValidadaPres', 1)
                                ->where('mesaValidadaAl', 1)
                                ->where('mesaValidadaDip', 1);
                        });
                });
        })
        ->withCount(['users AS user_count' => function ($query) {
            $query->where('tipo', 2);
        }]) // Contar usuarios relacionados con tipoUsuario igual a 2
        ->havingRaw('jrv = user_count') // Comparar campo JRV con el conteo
        ->get();
        $centroVotacionCompleto = $centrosVotacion->count();
        $mesasTotal = CentroVotacion::whereIn('sector', $arregloOpciones)
            ->select(DB::raw('SUM(JRV) as mesas'))->pluck('mesas')->first();
        $mesasPorcentaje = ($mesasTotal != 0) ? (number_format(($mesasComputadas * 100) / $mesasTotal, 2) . '%') : 0;
        $mesasImpugnadas = User::where('tipo', 2)
            ->where('mesaImpugnada', true)
            ->where('mesaValidadaImp', true)
            ->whereHas('centroVotaciones', function ($query) use ($arregloOpciones) {
                $query->whereIn('sector', $arregloOpciones);
            })
            ->select(DB::raw('COUNT(mesa) as mesas'))
            ->pluck('mesas')->first();
        $votosOtros = Resultado::where('validado', true)
            ->where('partido_id', '>=', 32)
            ->where('partido_id', '<=', 35)
            ->join('partidos', 'resultados.partido_id', '=', 'partidos.id')
            ->join('centro_votacion', 'resultados.centro_id', '=', 'centro_votacion.id')
            ->whereIn('centro_votacion.sector', $arregloOpciones)
            ->groupBy('partidos.id', 'boleta')
            ->select('partidos.siglas as Tipo', 'boleta', DB::raw('SUM(cantidad) as votes'))
            ->get()->toArray();
        $votosEmitidosPorcentaje = Resultado::where('validado', true)
            ->whereNotIn('partido_id', [34, 36])
            ->join('centro_votacion', 'resultados.centro_id', '=', 'centro_votacion.id')
            ->whereIn('centro_votacion.sector', $arregloOpciones)
            ->groupBy('boleta')
            ->select('boleta', DB::raw('SUM(cantidad) as votos'))
            ->get()->toArray();
        $empadronados = CentroVotacion::whereIn('sector', $arregloOpciones)
            ->select(DB::raw('SUM(empadronados) as empadronados'))->pluck('empadronados')->first() ?? 0;
        foreach ($votosEmitidosPorcentaje as &$resultado) {
            $resultado['porcentaje'] = number_format($resultado['votos'] * 100 / $empadronados, 2) . '%';
        }
        $jsonData = ['totalAlcalde' => $totalAlcalde];
        $jsonData += ['totalPresidente' => $totalPresidente];
        $jsonData += ['totalDiputado' => $totalDiputado];
        $jsonData += ['centroVotacionCompletado' => $centroVotacionCompleto];
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
            ->get();
        if ($resultados->isEmpty()) {
            $jsonData += ['concejales' => []];
        } else {
            $d->addParties($resultados->toArray());
            $d->process();
            $data = $d->getPartiesOK();
            $jsonData += ['concejales' => $data];
        }
        return $jsonData;
    }

    public function obtenerDatosGrafico($request)
    {
        $arregloOpciones = explode(",", $request);

        $datosExtra = $this->datosNoGraficados($arregloOpciones);
        $partidos = Partido::where('presidente', '>', 0)->get();

        $resultados = Resultado::select('partido_id', DB::raw('SUM(cantidad) as total_cantidad'))
            ->join('centro_votacion', 'resultados.centro_id', '=', 'centro_votacion.id')
            ->where('boleta', 'P')
            ->where('cerrado', true)
            ->where('validado', true)
            ->whereIn('centro_votacion.sector', $arregloOpciones)
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
            ->join('centro_votacion', 'resultados.centro_id', '=', 'centro_votacion.id')
            ->where('boleta', 'A')
            ->where('cerrado', true)
            ->where('validado', true)
            ->whereIn('centro_votacion.sector', $arregloOpciones)
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
            ->join('centro_votacion', 'resultados.centro_id', '=', 'centro_votacion.id')
            ->where('boleta', 'D')
            ->where('cerrado', true)
            ->where('validado', true)
            ->whereIn('centro_votacion.sector', $arregloOpciones)
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

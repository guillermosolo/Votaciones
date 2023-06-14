<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resultado;
use App\Models\Partido;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private $colores;

    public function __construct()
    {
        $this->colores = [
            'rgba(255, 0, 0, 0.8)',    // 1: Rojo
            'rgba(0, 255, 0, 0.8)',    // 2: Verde
            'rgba(0, 0, 255, 0.8)',    // 3: Azul
            'rgba(255, 255, 0, 0.8)',  // 4: Amarillo
            'rgba(255, 0, 255, 0.8)',  // 5: Magenta
            'rgba(0, 255, 255, 0.8)',  // 6: Cian
            'rgba(128, 0, 0, 0.8)',    // 7: Marrón oscuro
            'rgba(0, 128, 0, 0.8)',    // 8: Verde oscuro
            'rgba(0, 0, 128, 0.8)',    // 9: Azul oscuro
            'rgba(128, 128, 0, 0.8)',  // 10: Oliva
            'rgba(128, 0, 128, 0.8)',  // 11: Púrpura
            'rgba(0, 128, 128, 0.8)',  // 12: Verde azulado
            'rgba(128, 128, 128, 0.8)', // 13: Gris
            'rgba(255, 102, 102, 0.8)', // 14: Rojo claro
            'rgba(102, 255, 102, 0.8)', // 15: Verde claro
            'rgba(102, 102, 255, 0.8)', // 16: Azul claro
            'rgba(255, 255, 102, 0.8)', // 17: Amarillo claro
            'rgba(255, 102, 255, 0.8)', // 18: Magenta claro
            'rgba(102, 255, 255, 0.8)', // 19: Cian claro
            'rgba(153, 51, 0, 0.8)',   // 20: Marrón
            'rgba(0, 153, 51, 0.8)',   // 21: Verde oliva
            'rgba(51, 0, 153, 0.8)',   // 22: Púrpura oscuro
            'rgba(153, 153, 0, 0.8)',  // 23: Verde oliva claro
            'rgba(153, 0, 153, 0.8)',  // 24: Púrpura claro
            'rgba(0, 153, 153, 0.8)',  // 25: Cian oscuro
            'rgba(153, 153, 153, 0.8)', // 26: Gris claro
            'rgba(255, 153, 102, 0.8)', // 27: Naranja claro
            'rgba(102, 255, 153, 0.8)', // 28: Verde claro
            'rgba(153, 102, 255, 0.8)', // 29: Lila claro
            'rgba(255, 255, 153, 0.8)', // 30: Amarillo claro
            'rgba(255, 153, 255, 0.8)', // 31: Rosa claro
            'rgba(0, 0, 0, 0.8)',      // 32: Negro
            'rgba(255, 255, 255, 0.8)', // 33: Blanco
            'rgba(85, 85, 85, 0.8)',   // 34: Gris oscuro
            'rgba(255, 255, 255, 0.8)', // 36: Gris claro
            'rgba(170, 170, 170, 0.8)' // 35: Gris medio
        ];
    }
    public function index()
    {
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

        return view('admin.index', compact('partidosPres','partidosAl','partidosDip','partidosT'));
    }

    public function obtenerDatosGrafico()
    {
        $partidos = Partido::where('presidente', '>', 0)->get();

        $resultados = Resultado::select('partido_id', DB::raw('SUM(cantidad) as total_cantidad'))
            ->where('boleta', 'P')
            ->where('cerrado',true)
            ->where('validado',true)
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
            ->where('cerrado',true)
            ->where('validado',true)
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
            ->where('cerrado',true)
            ->where('validado',true)
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
            'partidosPres'=>$partidosPres,
            'partidosAl'=>$partidosAl,
            'partidosDip'=>$partidosDip
        ]);
    }
}

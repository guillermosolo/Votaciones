<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $tipo = $user->tipo;

            switch ($tipo) {
                case 1:
                    return redirect()->route('menuAdmin');
                    break;
                case 2:
                    return redirect()->route('menuFiscal');
                    break;
                case 3:
                    return redirect()->route('menuSuper');
                    break;
                default:
                    abort(403);
                    break;
            }
        }
    }
}

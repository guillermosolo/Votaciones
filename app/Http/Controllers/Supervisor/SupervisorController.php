<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupervisorController extends Controller
{
    public function index()
    {
        return view('supervisor.index');
    }
}

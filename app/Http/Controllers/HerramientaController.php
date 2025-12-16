<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class HerramientaController extends Controller
{

    public function index()
{
    return view('herramientas.index');
}

    //  Historial de errores del sistema
    public function logs()
    {
        $path = storage_path('logs/laravel.log');
        $logs = File::exists($path) ? File::get($path) : 'No hay registros de errores.';
        return view('herramientas.logs', compact('logs'));
    }

    //  Panel de tareas internas
    public function tareas()
 {
    $productosSinProveedor = DB::table('productos')->whereNull('id_proveedor')->get();
    $pedidosSinCliente = DB::table('pedido')->whereNull('id_cliente')->get();

    return view('herramientas.tareas', compact('productosSinProveedor', 'pedidosSinCliente'));
 }


    //  Control de acceso
    
 public function accesos()
 {
    $sessions = DB::table('sessions')->get()->map(function ($session) {
        $session->last_activity = Carbon::createFromTimestamp($session->last_activity)->toDateTimeString();
        return $session;
    });

    return view('herramientas.accesos', compact('sessions'));
 }
}

@extends('layouts.app')

@section('title', 'Panel de Herramientas')

@section('content')
<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
    }
    h1 {
        color: #C70202;
        text-align: center;
        margin-bottom: 30px;
    }
    .card {
        background-color: #2a2a2a;
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.5);
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-title {
        color: #C70202;
        font-weight: bold;
    }
    .card-text {
        color: #ddd;
    }
    .btn-danger {
        background-color: #C70202;
        border: none;
    }
    .btn-danger:hover {
        background-color: #a00101;
    }
    .btn-warning {
        background-color: #ff9900;
        border: none;
        color: #fff;
    }
    .btn-warning:hover {
        background-color: #cc7a00;
    }
    .btn-success {
        background-color: #008000;
        border: none;
    }
    .btn-success:hover {
        background-color: #006600;
    }
</style>

<div class="container">
    <h1>Panel de Herramientas de Soporte</h1>

    <div class="row">
        <!-- Historial de errores -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Historial de Errores</h5>
                    <p class="card-text">Consulta los errores registrados en el sistema Laravel.</p>
                    <a href="{{ route('herramienta.logs') }}" class="btn btn-danger">Ver Logs</a>
                </div>
            </div>
        </div>

        <!-- Panel de tareas internas -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Tareas Internas</h5>
                    <p class="card-text">Revisa qué falta por registrar y pedidos incompletos.</p>
                    <a href="{{ route('herramienta.tareas') }}" class="btn btn-warning">Ver Tareas</a>
                </div>
            </div>
        </div>

        <!-- Control de acceso -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Control de Acceso</h5>
                    <p class="card-text">Consulta quién entró al sistema y cuándo.</p>
                    <a href="{{ route('herramienta.accesos') }}" class="btn btn-success">Ver Accesos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

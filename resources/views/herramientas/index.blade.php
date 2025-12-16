@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Panel de Herramientas de Soporte</h1>

    <div class="row">
        <!-- Historial de errores -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Historial de Errores</h5>
                    <p class="card-text">Consulta los errores registrados en el sistema Laravel.</p>
                    <a href="{{ route('herramienta.logs') }}" class="btn btn-danger">Ver Logs</a>
                </div>
            </div>
        </div>

        <!-- Panel de tareas internas -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tareas Internas</h5>
                    <p class="card-text">Revisa qué falta por registrar y pedidos incompletos.</p>
                    <a href="{{ route('herramienta.tareas') }}" class="btn btn-warning">Ver Tareas</a>
                </div>
            </div>
        </div>

        <!-- Control de acceso -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Control de Acceso</h5>
                    <p class="card-text">Consulta quién entró al sistema y cuándo.</p>
                    <a href="{{ route('herramienta.accesos') }}" class="btn btn-success">Ver Accesos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Control de Acceso</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Sesión</th>
                <th>ID Usuario</th>
                <th>IP</th>
                <th>Navegador</th>
                <th>Última Actividad</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sessions as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->user_id }}</td>
                <td>{{ $s->ip_address }}</td>
                <td>{{ $s->user_agent }}</td>
                <td>{{ $s->last_activity }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No hay registros de acceso.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

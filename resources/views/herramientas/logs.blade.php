@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Historial de Errores del Sistema</h2>

    <div class="card">
        <div class="card-body">
            <pre style="white-space: pre-wrap; word-wrap: break-word; background-color: #f8f9fa; padding: 1rem;">
{{ $logs }}
            </pre>
        </div>
    </div>
</div>
@endsection

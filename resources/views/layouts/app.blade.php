<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'SIPA | Panel de Control')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap desde CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- Estilos personalizados -->
  @stack('styles')

  <style>
      body { min-height: 100vh; }
      .sidebar { width: 240px; }
      .app { display: flex; }
      .content { flex: 1; }
      .nav-link.active { font-weight: 600; }
  </style>
</head>
<body>
<div class="app">
  <aside class="sidebar bg-light border-end">
    <div class="p-3">
      <h5 class="mb-3">SIPA</h5>
      <nav class="nav flex-column">
        <a class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">Clientes</a>
        <a class="nav-link {{ request()->is('ventas*') ? 'active' : '' }}" href="{{ route('ventas.index') }}">Ventas</a>
        <a class="nav-link {{ request()->is('compras*') ? 'active' : '' }}" href="{{ route('compras.index') }}">Compras</a>
        <a class="nav-link {{ request()->is('productos*') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a>
        <a class="nav-link {{ request()->is('proveedores*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">Proveedores</a>
        <a class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}" href="{{ route('reportes.index') }}">Reportes</a>
        <a class="nav-link {{ request()->is('herramientas*') ? 'active' : '' }}" href="{{ route('herramientas.index') }}">Herramientas</a>
      </nav>
    </div>
  </aside>

  <main class="content">
    <header class="border-bottom bg-white">
      <div class="container-fluid py-3 d-flex justify-content-between align-items-center">
        <h1 class="h5 m-0">@yield('title', 'Panel')</h1>
        <div>
          <span class="text-muted">Usuario</span>
          <a href="#" class="btn btn-sm btn-outline-secondary ms-2">Cerrar sesión</a>
        </div>
      </div>
    </header>

    <div class="container-fluid py-4">
      @yield('content')
    </div>
  </main>
</div>

<!-- Scripts personalizados -->
@stack('scripts')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

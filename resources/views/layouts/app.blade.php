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
      body {
        min-height: 100vh;
        background-color: #1a1a1a;
        color: #fff;
      }
      .app { display: flex; }

      /* Sidebar */
      .sidebar {
        width: 240px;
        background-color: #2a2a2a !important;
        color: #fff;
      }
      .sidebar h5 {
        color: #C70202;
      }
      .nav-link {
        color: #ddd;
      }
      .nav-link.active, .nav-link:hover {
        color: #fff;
        background-color: #C70202;
      }

      /* Header/Navbar */
      header {
        background-color: #2a2a2a !important;
        color: #fff;
        border-bottom: 2px solid #C70202;
      }
      header h1 {
        color: #C70202;
      }
      .btn-outline-secondary {
        border-color: #C70202;
        color: #C70202;
      }
      .btn-outline-secondary:hover {
        background-color: #C70202;
        color: #fff;
      }

      /* Footer */
      footer {
        background-color: #2a2a2a;
        color: #aaa;
        border-top: 2px solid #C70202;
        text-align: center;
        padding: 10px;
        font-size: 0.9rem;
      }
  </style>
</head>
<body>
<div class="app">
  <aside class="sidebar border-end">
    <div class="p-3">
      <h5 class="mb-3">SIPA</h5>
      <nav class="nav flex-column">
        <a class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">Clientes</a>
        <a class="nav-link {{ request()->is('ventas*') ? 'active' : '' }}" href="{{ route('ventas.index') }}">Ventas</a>
        <a class="nav-link {{ request()->is('compras*') ? 'active' : '' }}" href="{{ route('compras.index') }}">Compras</a>
        <a class="nav-link {{ request()->is('productos*') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a>
        <a class="nav-link {{ request()->is('proveedores*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">Proveedores</a>
        <a class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}" href="{{ route('reportes.index') }}">Reportes</a>
        <a class="nav-link {{ request()->is('herramientas*') ? 'active' : '' }}" href="{{ route('herramienta.index') }}">Herramientas</a>
      </nav>
    </div>
  </aside>

  <main class="content d-flex flex-column flex-grow-1">
    <header class="border-bottom">
      <div class="container-fluid py-3 d-flex justify-content-between align-items-center">
        <h1 class="h5 m-0">@yield('title', 'Panel')</h1>
        <div>
          <span class="text-muted">Usuario</span>
          <!-- Botón de cerrar sesión -->
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-secondary ms-2">
                  Cerrar sesión
              </button>
          </form>
        </div>
      </div>
    </header>

    <div class="container-fluid py-4 bg-dark text-white flex-grow-1">
      @yield('content')
    </div>

    <footer class="bg-dark text-white border-top border-danger text-center py-2">
      <small>&copy; {{ date('Y') }} SIPA - Panel de Control</small>
    </footer>
  </main>
</div>

<!-- Scripts personalizados -->
@stack('scripts')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

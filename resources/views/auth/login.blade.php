<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión | SIPA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }
        .card-header {
            background-color: #C70202;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }
        .form-label {
            color: #ddd;
        }
        .form-control {
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #444;
        }
        .form-control:focus {
            border-color: #C70202;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #C70202;
            border: none;
        }
        .btn-primary:hover {
            background-color: #a00101;
        }
    </style>
</head>
<body>
    <div class="card shadow">
        <div class="card-header">
            <h4>Iniciar sesión</h4>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Usuario / Email</label>
                    <input type="text" name="email" id="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>

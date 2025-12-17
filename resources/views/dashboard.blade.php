<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-box {
            background-color: #2a2a2a;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }
        h1 {
            color: #C70202;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 30px;
        }
        a.button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #C70202;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        a.button:hover {
            background-color: #a00101;
        }
    </style>
</head>
<body>
    <div class="dashboard-box">
        <h1>Bienvenido administrador/ra</h1>
        <p>Has iniciado sesión correctamente.</p>
        <a href="{{ route('clientes.index') }}" class="button">Continuar</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor de Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(120deg, #0f2027, #203a43, #2c5364);
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            color: #fff;
        }

        .sidebar {
            width: 35%;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            padding: 4rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: inset -1px 0 1px rgba(255, 255, 255, 0.05);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar i {
            font-size: 4rem;
            color: #00f7ff;
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .sidebar h1 {
            font-size: 2rem;
            text-align: center;
            color: #f1faee;
        }

        .main-content {
            flex-grow: 1;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 3rem;
            animation: fadeIn 1.2s ease-out;
        }

        .main-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .main-content p {
            font-size: 1.2rem;
            max-width: 500px;
            color: #cce8f4;
            margin-bottom: 2rem;
        }

        .btn-access {
            padding: 0.9rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f2027;
            background: linear-gradient(to right, #00f7ff, #00c3ff);
            border: none;
            border-radius: 50px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            transition: all 0.3s ease-in-out;
            display: inline-flex;
            align-items: center;
        }

        .btn-access i {
            margin-right: 0.6rem;
        }

        .btn-access:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.6);
        }

        .floating-blob {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #00f7ff33 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
            animation: pulseBlob 6s infinite;
        }

        @keyframes pulseBlob {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 2rem;
                flex-direction: row;
                justify-content: space-between;
            }

            .sidebar h1 {
                font-size: 1.5rem;
            }

            .main-content {
                padding: 2rem;
                align-items: center;
                text-align: center;
            }

            .floating-blob {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <i class="fa-solid fa-cubes-stacked"></i>
        <h1>Gestor de Productos</h1>
    </div>

    <div class="main-content">
        <h2>Control total, diseño impecable</h2>
        <p>Consulta y administra tus productos de manera eficaz y Rapida.</p>
        <p> Actualmente nos encontramos en fase de prueba y esperamos proximas actualizaciones.</p>
        <a href="#" class="btn-access" data-bs-toggle="modal" data-bs-target="#adminModal">
            <i class="fa-solid fa-arrow-right-to-bracket"></i> Administrativo
        </a>
        <p> </p>
        <a href="" class="btn-access">
            <i class="fa-solid fa-user"></i> Clientes
        </a>

        <div class="floating-blob"></div>
    </div>

    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"
                style="background: #203a43; color: #cce8f4; border: 1px solid #00c3ff; border-radius: 10px;">
                <div class="modal-header" style="border-bottom: 1px solid #00c3ff;">
                    <h5 class="modal-title" id="adminModalLabel" style="color: #00f7ff;">Acceso Administrativo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: invert(1);"></button>
                </div>
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if (session('error'))
                            <div class="alert alert-danger mt-2"
                                style="background: #ff4d4d; color: #fff; border: none;">
                                {{ session('error') }}
                            </div>
                        @endif
                        <p style="color: #cce8f4;">Por favor, ingresa tus credenciales para acceder a la sección
                            administrativa.</p>
                        <div class="mb-3">
                            <label for="username" class="form-label" style="color: #cce8f4;">Usuario</label>
                            <input type="text" name="username" id="username" class="form-control"
                                style="background: #2c5364; color: #cce8f4; border: 1px solid #00c3ff;" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label" style="color: #cce8f4;">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control"
                                style="background: #2c5364; color: #cce8f4; border: 1px solid #00c3ff;" required>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #00c3ff;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="background: #2c5364; color: #cce8f4; border: 1px solid #00c3ff;">Cancelar</button>
                        <button type="submit" class="btn btn-primary"
                            style="background: linear-gradient(to right, #00f7ff, #00c3ff); border: none; color: #0f2027;">Acceder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

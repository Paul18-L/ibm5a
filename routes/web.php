<?php
session_start();

// Incluir los controladores necesarios
require_once '../app/controllers/PersonaController.php';
require_once '../app/controllers/SexoController.php';
require_once '../app/controllers/DireccionController.php';
require_once '../app/controllers/TelefonoController.php';
require_once '../app/controllers/EstadocivilController.php';

$requestUri = $_SERVER["REQUEST_URI"];
$basePath = '/ibm5a/public/';
$route = str_replace($basePath, '', $requestUri);
$route = strtok($route, '?');

// Mostrar menú de navegación moderno
if (empty($route) || $route === '/') {
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Menú Principal</title>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css' rel='stylesheet'>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #1e3c72, #2a5298);
                color: white;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            header {
                background-color: rgba(0, 0, 0, 0.3);
                padding: 20px;
                text-align: center;
                box-shadow: 0 2px 5px rgba(0,0,0,0.4);
            }

            header h1 {
                font-size: 2.5em;
                color: #fff;
                text-shadow: 1px 1px 5px #000;
            }

            .menu-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 40px;
                flex-grow: 1;
            }

            .menu {
                width: 90%;
                max-width: 500px;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .menu a {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 15px 20px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                font-size: 1.3em;
                border-radius: 12px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                transition: background 0.3s ease, transform 0.2s ease;
            }

            .menu a i {
                margin-right: 10px;
            }

            .menu a:hover {
                background-color: #45a049;
                transform: scale(1.05);
            }

            footer {
                background-color: rgba(0, 0, 0, 0.2);
                text-align: center;
                padding: 15px;
                font-size: 0.9em;
                color: #ddd;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Panel de Gestión - Sistema IBM5A</h1>
        </header>

        <div class='menu-container'>
            <div class='menu'>
                <a href='{$basePath}persona/index'><i class='fas fa-user'></i>Personas</a>
                <a href='{$basePath}sexo/index'><i class='fas fa-venus-mars'></i>Sexos</a>
                <a href='{$basePath}direccion/index'><i class='fas fa-map-marker-alt'></i>Direcciones</a>
                <a href='{$basePath}telefono/index'><i class='fas fa-phone'></i>Teléfonos</a>
                <a href='{$basePath}estadocivil/index'><i class='fas fa-heart'></i>Estados Civiles</a>
            </div>
        </div>

        <footer>
            &copy; " . date('Y') . " Sistema IBM5A | Desarrollado por Carlos Andrés Martínez
        </footer>
    </body>
    </html>
    ";
} else {
    // Enrutamiento MVC
    switch ($route) {
        // Persona
        case 'persona':
        case 'persona/index':
            (new PersonaController())->index();
            break;
        case 'persona/create':
            (new PersonaController())->createForm();
            break;
        case 'persona/edit':
            isset($_GET['idpersona']) ? (new PersonaController())->edit($_GET['idpersona']) : print("Error: Falta el ID para editar.");
            break;
        case 'persona/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new PersonaController())->update();
            break;
        case 'persona/view':
            isset($_GET['idpersona']) ? (new PersonaController())->registro($_GET['idpersona']) : print("Error: Falta el ID.");
            break;

        // Sexo
        case 'sexo':
        case 'sexo/index':
            (new SexoController())->index();
            break;
        case 'sexo/edit':
            isset($_GET['idsexo']) ? (new SexoController())->edit($_GET['idsexo']) : print("Error: Falta el ID.");
            break;
        case 'sexo/eliminar':
            isset($_GET['idsexo']) ? (new SexoController())->eliminar($_GET['idsexo']) : print("Error: Falta el ID.");
            break;
        case 'sexo/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new SexoController())->delete();
            break;
        case 'sexo/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new SexoController())->update();
            break;

        // Dirección
        case 'direccion':
        case 'direccion/index':
            (new DireccionController())->index();
            break;
        case 'direccion/create':
            (new DireccionController())->createForm();
            break;
        case 'direccion/edit':
            isset($_GET['iddireccion']) ? (new DireccionController())->edit($_GET['iddireccion']) : print("Error: Falta el ID.");
            break;
        case 'direccion/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new DireccionController())->update();
            break;

        // Teléfono
        case 'telefono':
        case 'telefono/index':
            (new TelefonoController())->index();
            break;
        case 'telefono/create':
            (new TelefonoController())->createForm();
            break;
        case 'telefono/edit':
            isset($_GET['idtelefono']) ? (new TelefonoController())->edit($_GET['idtelefono']) : print("Error: Falta el ID.");
            break;
        case 'telefono/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new TelefonoController())->update();
            break;

        // Estado Civil
        case 'estadocivil':
        case 'estadocivil/index':
            (new EstadoCivilController())->index();
            break;
        case 'estadocivil/edit':
            isset($_GET['idestadocivil']) ? (new EstadocivilController())->edit($_GET['idestadocivil']) : print("Error: Falta el ID.");
            break;
        case 'estadocivil/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new EstadocivilController())->update();
            break;
        case 'estadocivil/eliminar':
            isset($_GET['idestadocivil']) ? (new EstadocivilController())->eliminar($_GET['idestadocivil']) : print("Error: Falta el ID.");
            break;
        case 'estadocivil/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new EstadocivilController())->delete();
            break;

        default:
            echo "<h2 style='color:white; text-align:center; margin-top:50px;'>Error 404: Página no encontrada.</h2>";
            break;
    }
}
?>

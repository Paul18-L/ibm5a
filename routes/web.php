<?php
session_start();

require_once '../app/controllers/PersonaController.php';
require_once '../app/controllers/SexoController.php';
require_once '../app/controllers/DireccionController.php';
require_once '../app/controllers/TelefonoController.php';
require_once '../app/controllers/EstadocivilController.php';

$requestUri = $_SERVER["REQUEST_URI"];
$basePath = '/ibm5a/public/';
$route = str_replace($basePath, '', $requestUri);
$route = strtok($route, '?');

// Menú principal simple
if (empty($route) || $route === '/') {
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Menú Principal</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                text-align: center;
                padding: 20px;
            }
            h1 {
                margin-bottom: 30px;
            }
            .menu a {
                display: block;
                margin: 10px auto;
                padding: 10px;
                width: 200px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
            .menu a:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <h1>Menú del Sistema</h1>
        <div class='menu'>
            <a href='{$basePath}persona/index'>Personas</a>
            <a href='{$basePath}sexo/index'>Sexos</a>
            <a href='{$basePath}direccion/index'>Direcciones</a>
            <a href='{$basePath}telefono/index'>Teléfonos</a>
            <a href='{$basePath}estadocivil/index'>Estados Civiles</a>
        </div>
    </body>
    </html>
    ";
} else {
    // Rutas básicas
    switch ($route) {
        case 'persona':
        case 'persona/index':
            (new PersonaController())->index();
            break;
        case 'persona/create':
            (new PersonaController())->createForm();
            break;
        case 'persona/edit':
            if (isset($_GET['idpersona'])) (new PersonaController())->edit($_GET['idpersona']);
            break;
        case 'persona/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new PersonaController())->update();
            break;
        case 'persona/view':
            if (isset($_GET['idpersona'])) (new PersonaController())->registro($_GET['idpersona']);
            break;

        case 'sexo':
        case 'sexo/index':
            (new SexoController())->index();
            break;
        case 'sexo/edit':
            if (isset($_GET['idsexo'])) (new SexoController())->edit($_GET['idsexo']);
            break;
        case 'sexo/eliminar':
            if (isset($_GET['idsexo'])) (new SexoController())->eliminar($_GET['idsexo']);
            break;
        case 'sexo/delete':
        case 'sexo/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new SexoController();
                if ($route === 'sexo/delete') $controller->delete();
                else $controller->update();
            }
            break;

        case 'direccion':
        case 'direccion/index':
            (new DireccionController())->index();
            break;
        case 'direccion/create':
            (new DireccionController())->createForm();
            break;
        case 'direccion/edit':
            if (isset($_GET['iddireccion'])) (new DireccionController())->edit($_GET['iddireccion']);
            break;
        case 'direccion/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new DireccionController())->update();
            break;

        case 'telefono':
        case 'telefono/index':
            (new TelefonoController())->index();
            break;
        case 'telefono/create':
            (new TelefonoController())->createForm();
            break;
        case 'telefono/edit':
            if (isset($_GET['idtelefono'])) (new TelefonoController())->edit($_GET['idtelefono']);
            break;
        case 'telefono/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new TelefonoController())->update();
            break;

        case 'estadocivil':
        case 'estadocivil/index':
            (new EstadoCivilController())->index();
            break;
        case 'estadocivil/edit':
            if (isset($_GET['idestadocivil'])) (new EstadocivilController())->edit($_GET['idestadocivil']);
            break;
        case 'estadocivil/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new EstadocivilController())->update();
            break;
        case 'estadocivil/eliminar':
            if (isset($_GET['idestadocivil'])) (new EstadocivilController())->eliminar($_GET['idestadocivil']);
            break;
        case 'estadocivil/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') (new EstadocivilController())->delete();
            break;

        default:
            echo "<h2 style='color:red; text-align:center;'>Error 404: Página no encontrada.</h2>";
            break;
    }
}
?>

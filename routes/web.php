<?php
session_start();

// Incluir los controladores necesarios
require_once '../app/controllers/PersonaController.php';
require_once '../app/controllers/SexoController.php';
require_once '../app/controllers/DireccionController.php';
require_once '../app/controllers/TelefonoController.php';
require_once '../app/controllers/EstadocivilController.php';

$requestUri = $_SERVER["REQUEST_URI"];
$basePath = '/ibm5a/';  // Cambiado a ibm5a
// Remover el prefijo basePath
$route = str_replace($basePath, '', $requestUri);
$route = strtok($route, '?'); // Quitar parámetros GET

// Mostrar el menú si no se ha solicitado ninguna acción específica
if (empty($route) || $route === '/') {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Menú de Tablas</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 30px;
                background-color: #f9f9f9;
            }
            h1 {
                color: #333;
            }
            ul.menu {
                list-style: none;
                padding: 0;
                max-width: 300px;
            }
            ul.menu li {
                background-color: #4CAF50;
                margin: 8px 0;
                padding: 12px;
                border-radius: 5px;
                text-align: center;
            }
            ul.menu li a {
                color: white;
                text-decoration: none;
                font-weight: bold;
                display: block;
            }
            ul.menu li a:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <h1>Menú de Tablas</h1>
        <ul class="menu">
            <li><a href="<?php echo $basePath; ?>persona/index">Personas</a></li>
            <li><a href="<?php echo $basePath; ?>sexo/index">Sexos</a></li>
            <li><a href="<?php echo $basePath; ?>direccion/index">Direcciones</a></li>
            <li><a href="<?php echo $basePath; ?>telefono/index">Teléfonos</a></li>
            <li><a href="<?php echo $basePath; ?>estadocivil/index">Estados Civiles</a></li>
        </ul>
    </body>
    </html>
    <?php
} else {
    // Enrutar a los controladores según la ruta
    switch ($route) {
        case 'persona':
        case 'persona/index':
            $controller = new PersonaController();
            $controller->index();
            break;
        case 'persona/create':
            $controller = new PersonaController();
            $controller->createForm();
            break;
        case 'persona/edit':
            if (isset($_GET['idpersona'])) {
                $controller = new PersonaController();
                $controller->edit($_GET['idpersona']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'persona/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new PersonaController();
                $controller->update();
            }
            break;
        case 'persona/view':
            if (isset($_GET['idpersona'])) {
                $controller = new PersonaController();
                $controller->registro($_GET['idpersona']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;

        case 'sexo':
        case 'sexo/index':
            $controller = new SexoController();
            $controller->index();
            break;
        case 'sexo/edit':
            if (isset($_GET['idsexo'])) {
                $controller = new SexoController();
                $controller->edit($_GET['idsexo']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'sexo/eliminar':
            if (isset($_GET['idsexo'])) {
                $controller = new SexoController();
                $controller->eliminar($_GET['idsexo']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'sexo/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new SexoController();
                $controller->delete();
            }
            break;
        case 'sexo/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new SexoController();
                $controller->update();
            }
            break;

        case 'direccion':
        case 'direccion/index':
            $controller = new DireccionController();
            $controller->index();
            break;
        case 'direccion/create':
            $controller = new DireccionController();
            $controller->createForm();
            break;
        case 'direccion/edit':
            if (isset($_GET['iddireccion'])) {
                $controller = new DireccionController();
                $controller->edit($_GET['iddireccion']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'direccion/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new DireccionController();
                $controller->update();
            }
            break;

        case 'telefono':
        case 'telefono/index':
            $controller = new TelefonoController();
            $controller->index();
            break;
        case 'telefono/create':
            $controller = new TelefonoController();
            $controller->createForm();
            break;
        case 'telefono/edit':
            if (isset($_GET['idtelefono'])) {
                $controller = new TelefonoController();
                $controller->edit($_GET['idtelefono']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'telefono/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new TelefonoController();
                $controller->update();
            }
            break;

        case 'estadocivil':
        case 'estadocivil/index':
            $controller = new EstadocivilController();
            $controller->index();
            break;
        case 'estadocivil/edit':
            if (isset($_GET['idestadocivil'])) {
                $controller = new EstadocivilController();
                $controller->edit($_GET['idestadocivil']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'estadocivil/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new EstadocivilController();
                $controller->update();
            }
            break;
        case 'estadocivil/eliminar':
            if (isset($_GET['idestadocivil'])) {
                $controller = new EstadocivilController();
                $controller->eliminar($_GET['idestadocivil']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'estadocivil/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new EstadocivilController();
                $controller->delete();
            }
            break;

        default:
            echo "Error 404: Página no encontrada.";
            break;
    }
}
?>

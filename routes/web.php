<?php
session_start();

// Cargar controladores
require_once '../app/controllers/PersonaController.php';
require_once '../app/controllers/SexoController.php';
require_once '../app/controllers/DireccionController.php';
require_once '../app/controllers/TelefonoController.php';
require_once '../app/controllers/EstadocivilController.php';

$requestUri = $_SERVER["REQUEST_URI"];
$basePath = '/ibm5a/public/';

// Quitar el prefijo basePath y los parámetros GET
$route = str_replace($basePath, '', $requestUri);
$route = strtok($route, '?');

// Agregar hoja de estilos
echo '<link rel="stylesheet" type="text/css" href="/ibm5a/public/css/stylesMenu.css">';

// Mostrar menú si no hay ruta específica
if (empty($route) || $route === '/') {
    echo "<div class='menu-container'>";
    echo "<h1>Menú de Tablas</h1>";
    echo "<ul class='menu-list'>";
    echo "<li><a href='{$basePath}persona/index'>Personas</a></li>";
    echo "<li><a href='{$basePath}sexo/index'>Sexos</a></li>";
    echo "<li><a href='{$basePath}direccion/index'>Direcciones</a></li>";
    echo "<li><a href='{$basePath}telefono/index'>Teléfonos</a></li>";
    echo "<li><a href='{$basePath}estadocivil/index'>Estados Civiles</a></li>";
    echo "</ul>";
    echo "</div>";
} else {
    switch ($route) {

        // RUTAS PARA PERSONA
        case 'persona':
        case 'persona/index':
            (new PersonaController())->index();
            break;

        case 'persona/create':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new PersonaController())->create();
            }
            break;

        case 'persona/editForm':
            if (isset

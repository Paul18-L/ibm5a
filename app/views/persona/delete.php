<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Persona</title>
</head>
<body>

<h1>Eliminar Persona</h1>

<p>¿Estás seguro de que deseas eliminar la siguiente persona?</p>

<form action="/apple5a/public/persona/delete" method="POST">
    <input type="hidden" name="idpersona" value="<?= htmlspecialchars($persona['idpersona']) ?>">

    <label for="nombres">Nombres:</label>
    <input type="text" id="nombres" value="<?= htmlspecialchars($persona['nombres']) ?>" disabled><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" value="<?= htmlspecialchars($persona['apellidos']) ?>" disabled><br><br>

    <label for="fechanacimiento">Fecha de Nacimiento:</label>
    <input type="date" id="fechanacimiento" value="<?= htmlspecialchars($persona['fechanacimiento']) ?>" disabled><br><br>

    <label for="sexo">Sexo:</label>
    <input type="text" id="sexo" value="<?= htmlspecialchars($persona['sexo']) ?>" disabled><br><br>

    <label for="estadocivil">Estado Civil:</label>
    <input type="text" id="estadocivil" value="<?= htmlspecialchars($persona['estadocivil']) ?>" disabled><br><br>

    <input type="submit" value="Confirmar Eliminación">
</form>

<br>
<a href="index">Volver al listado</a>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar estado civil</title>
</head>
<body>

<h1>Editar estado civil</h1>

<form action="/ibm5a/public/estadocivil/update" method="POST">
    <input type="hidden" name="idestadocivil" value="<?php echo htmlspecialchars($estadocivil['idestadocivil']); ?>">

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($estadocivil['nombre']); ?>" required>

    <input type="submit" value="Actualizar">
</form>

<a href="/apple5a/public/estadocivil/index">Volver al listado</a>

</body>
</html>

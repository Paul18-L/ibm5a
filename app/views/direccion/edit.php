<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar dirección</title>
</head>
<body>

<h1>Editar Dirección</h1>

<form action="/ibm5a/public/direccion/update" method="POST">
    <input type="hidden" name="iddireccion" value="<?php echo htmlspecialchars($direccion['iddireccion']); ?>">

    <label for="nombre">Dirección:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($direccion['nombre']); ?>" required>

    <input type="submit" value="Actualizar">
</form>

<a href="/ibm5a/public/direccion/index">Volver al listado</a>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Teléfono</title>
</head>
<body>
// Editar Teléfono 
<h1>Editar Teléfono</h1>

<form action="/ibm5a/public/telefono/update" method="POST">
    <input type="hidden" name="idtelefono" value="<?php echo htmlspecialchars($telefono['idtelefono']); ?>">

    <label for="idpersona">ID de Persona:</label>
    <input type="number" name="idpersona" id="idpersona" value="<?php echo htmlspecialchars($telefono['idpersona']); ?>" required>

    <label for="numero">Número:</label>
    <input type="text" name="numero" id="numero" value="<?php echo htmlspecialchars($telefono['numero']); ?>" required>

    <input type="submit" value="Actualizar">
</form>

<a href="/ibm5a/public/telefono/index">Volver al listado</a>

</body>
</html>

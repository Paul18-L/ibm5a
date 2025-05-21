<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Teléfono</title>
</head>
<body>

<h1>¿Estás seguro de que deseas eliminar este teléfono?</h1>

<form action="/ibm5a/public/telefono/delete" method="POST">
    <input type="hidden" name="idtelefono" value="<?php echo htmlspecialchars($telefono['idtelefono']); ?>">

    <p><strong>Número:</strong> <?php echo htmlspecialchars($telefono['numero']); ?></p>
    <p><strong>ID Persona:</strong> <?php echo htmlspecialchars($telefono['idpersona']); ?></p>

    <input type="submit" value="Eliminar">
    <a href="/ibm5a/public/telefono/index">Cancelar</a>
</form>

</body>
</html>

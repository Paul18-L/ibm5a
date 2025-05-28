<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar dirección</title>
</head>
<body>

<h1>Editar dirección</h1>
<form action="/ibm5a/public/dirección/delete" method="POST">
    <input type="hidden" name="iddireccion" value="<?php echo htmlspecialchars($direccion['iddireccion']); ?>">
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($direccion['nombre']); ?>" required>
    
    <input type="submit" value="Eliminar">
</form>

<a href="index">Volver al listado</a>

</body>
</html>

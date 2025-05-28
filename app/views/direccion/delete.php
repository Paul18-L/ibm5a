<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar dirrecion</title>
</head>
<body>

<h1>Editar dirrecion</h1>
<form action="/ibm5a/public/dirreción/delete" method="POST">
    <input type="hidden" name="iddirrecion" value="<?php echo htmlspecialchars($sexo['iddirrecion']); ?>">
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($sexo['nombre']); ?>" required>
    
    <input type="submit" value="Eliminar">
</form>

<a href="index">Volver al listado</a>

</body>
</html>

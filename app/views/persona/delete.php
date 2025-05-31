<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Persona</title>
</head>
<body>

<h1>Eliminar la Persona</h1>
<form action="/ibm5a/public/persona/delete" method="POST">
    <input type="hidden" name="idpersona" value="<?php echo htmlspecialchars($persona['idpersona']); ?>">
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($persona['nombre']); ?>" required readonly>
    
    <input type="submit" value="Eliminar">
</form>

<a href="index">Volver al listado</a>

</body>
</html>

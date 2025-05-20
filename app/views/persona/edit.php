<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
</head>
<body>

    <h1>Editar Persona</h1>

    <form action="/apple5a/public/persona/update" method="POST">
        <input type="hidden" name="idpersona" value="<?= htmlspecialchars($persona['idpersona']) ?>">

        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" id="nombres" value="<?= htmlspecialchars($persona['nombres']) ?>" required><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($persona['apellidos']) ?>" required><br><br>

        <label for="fechanacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fechanacimiento" id="fechanacimiento" value="<?= htmlspecialchars($persona['fechanacimiento']) ?>" required><br><br>

        <label for="idsexo">Sexo:</label>
        <select name="idsexo" id="idsexo" required>
            <?php if (!empty($sexos)): ?>
                <?php foreach ($sexos as $sexoOption): ?>
                    <option value="<?= $sexoOption['idsexo'] ?>" <?= $sexoOption['idsexo'] == $persona['idsexo'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($sexoOption['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No hay sexos disponibles</option>
            <?php endif; ?>
        </select><br><br>

        <label for="idestadocivil">Estado Civil:</label>
        <select name="idestadocivil" id="idestadocivil" required>
            <?php if (!empty($estadosCiviles)): ?>
                <?php foreach ($estadosCiviles as $estadoCivilOption): ?>
                    <option value="<?= $estadoCivilOption['idestadocivil'] ?>" <?= $estadoCivilOption['idestadocivil'] == $persona['idestadocivil'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($estadoCivilOption['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No hay estados civiles disponibles</option>
            <?php endif; ?>
        </select><br><br>

        <input type="submit" value="Actualizar Persona">
    </form>

    <a href="index">Volver al listado</a>

</body>
</html>

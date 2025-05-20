<form action="../../controllers/PersonaController.php?action=create" method="POST">
    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres" id="nombres" required><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" required><br><br>

    <label for="fechanacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="fechanacimiento" id="fechanacimiento" required><br><br>

    <label for="idsexo">Sexo:</label>
    <select name="idsexo" id="idsexo" required>
        <option value="">-- Seleccione --</option>
        <?php if (!empty($sexos)): ?>
            <?php foreach ($sexos as $sexo): ?>
                <option value="<?= htmlspecialchars($sexo['idsexo']) ?>">
                    <?= htmlspecialchars($sexo['nombre']) ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">No hay sexos disponibles</option>
        <?php endif; ?>
    </select><br><br>

    <label for="idestadocivil">Estado Civil:</label>
    <select name="idestadocivil" id="idestadocivil" required>
        <option value="">-- Seleccione --</option>
        <?php if (!empty($estadosCiviles)): ?>
            <?php foreach ($estadosCiviles as $estado): ?>
                <option value="<?= htmlspecialchars($estado['idestadocivil']) ?>">
                    <?= htmlspecialchars($estado['nombre']) ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">No hay estados civiles disponibles</option>
        <?php endif; ?>
    </select><br><br>

    <input type="submit" value="Crear Persona">
</form>

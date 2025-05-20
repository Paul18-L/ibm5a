 <form action="../../controllers/DireccionController.php?action=create" method="POST">
    <label for="idpersona">Persona:</label>
    <select name="idpersona" id="idpersona" required>
        <option value="">Seleccione una persona</option>
        <?php foreach ($personas as $persona): ?>
            <option value="<?= htmlspecialchars($persona['idpersona']) ?>">
                <?= htmlspecialchars($persona['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="nombre">Dirección:</label>
    <input type="text" name="nombre" id="nombre" required placeholder="Ej. Av. Central 123">

    <input type="submit" value="Crear">
 </form>

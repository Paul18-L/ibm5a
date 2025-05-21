<h1>Agregar Teléfono</h1>

<form action="/ibm5a/public/telefono/store" method="POST">
    <label for="idpersona">ID de Persona:</label>
    <input type="number" name="idpersona" id="idpersona" required>

    <label for="numero">Número de Teléfono:</label>
    <input type="text" name="numero" id="numero" required>

    <input type="submit" value="Guardar">
</form>

<a href="/ibm5a/public/telefono/index">Volver al listado</a>

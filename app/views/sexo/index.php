<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Sexos</title>
    <link rel="stylesheet" href="/ibm5a/public/css/style.css">
</head>
<body>

<div class="container">
    <h1>Listar Sexos</h1>
    
    <a href="/ibm5a/app/views/sexo/create.php">
        <button>Agregar</button>
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sexos) && is_array($sexos)): ?>
                <?php foreach ($sexos as $sexo): ?>
                    <tr>
                        <td><?= htmlspecialchars($sexo['idsexo']) ?></td>
                        <td><?= htmlspecialchars($sexo['nombre']) ?></td>
                        <td>
                            <a href="/ibm5a/public/sexo/edit?idsexo=<?= htmlspecialchars($sexo['idsexo']) ?>">
                                <button>Editar</button>
                            </a>
                            <a href="/ibm5a/public/sexo/eliminar?idsexo=<?= htmlspecialchars($sexo['idsexo']) ?>" 
                               onclick="return confirm('¿Estás seguro de eliminar este registro?');">
                                <button>Eliminar</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay registros disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="/ibm5a/public/js/script.js"></script>
</body>
</html>

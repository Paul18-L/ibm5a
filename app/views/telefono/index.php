<!DOCTYPE html>
<html lang="es">
<head>
// lista Teléfono 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Teléfonos</title>
    <link rel="stylesheet" href="/ibm5a/public/css/style.css">
</head>
<body>

<div class="container">
    <h1>Listar Teléfonos</h1>
    <a href="/ibm5a/app/views/telefono/create.php"><button>Agregar</button></a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($telefonos) && is_array($telefonos)): ?>
                <?php foreach ($telefonos as $telefono): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($telefono['idtelefono']); ?></td>
                        <td><?php echo htmlspecialchars($telefono['numero']); ?></td>
                        <td>
                            <a href="/ibm5a/public/telefono/edit?idtelefono=<?php echo htmlspecialchars($telefono['idtelefono']); ?>">
                                <button>Editar</button>
                            </a>
                            <a href="/ibm5a/public/telefono/eliminar?idtelefono=<?php echo htmlspecialchars($telefono['idtelefono']); ?>" 
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

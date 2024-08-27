<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link rel="stylesheet" href="http://localhost/biblioteca/public/css/styles.css">
</head>
<body>
    <h1>Lista de Libros</h1>

    <!-- Formulario para añadir un nuevo libro -->
    <form id="formularioLibro">
        <div>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        <div>
            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" required>
        </div>
        <div>
            <label for="ano_publicacion">Año de Publicación</label>
            <input type="number" id="ano_publicacion" name="ano_publicacion" required>
        </div>
        <div>
            <label for="genero">Género</label>
            <input type="text" id="genero" name="genero" required>
        </div>
        <button type="submit">Añadir Libro</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Año de Publicación</th>
                <th>Género</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
            <tr>
                <td><?= $libro->id ?></td>
                <td><?= $libro->titulo ?></td>
                <td><?= $libro->autor ?></td>
                <td><?= $libro->ano_publicacion ?></td>
                <td><?= $libro->genero ?></td>
                <td>
                    <!-- Botón para editar el libro -->
                    <a href="http://localhost/biblioteca/libro/edit/<?= $libro->id ?>">Editar</a>
                    <!-- Botón para eliminar el libro -->
                    <a href="http://localhost/biblioteca/libro/delete/<?= $libro->id ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="http://localhost/biblioteca/public/js/app.js"></script>
</body>
</html>

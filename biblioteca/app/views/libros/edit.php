<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="http://localhost/biblioteca/public/css/styles.css">
</head>
<body>
    <h1>Editar Libro</h1>

    <!-- Formulario para editar un libro existente -->
    <form id="formularioLibro">
        <input type="hidden" id="libro_id" name="libro_id" value="<?= $libro->id ?>">
        <div>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?= $libro->titulo ?>" required>
        </div>
        <div>
            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" value="<?= $libro->autor ?>" required>
        </div>
        <div>
            <label for="ano_publicacion">Año de Publicación</label>
            <input type="number" id="ano_publicacion" name="ano_publicacion" value="<?= $libro->ano_publicacion ?>" required>
        </div>
        <div>
            <label for="genero">Género</label>
            <input type="text" id="genero" name="genero" value="<?= $libro->genero ?>" required>
        </div>
        <button type="submit">Guardar Cambios</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('formularioLibro').addEventListener('submit', function(event) {
            event.preventDefault();

            const libroId = document.getElementById('libro_id').value;
            const data = {
                titulo: document.getElementById('titulo').value,
                autor: document.getElementById('autor').value,
                ano_publicacion: document.getElementById('ano_publicacion').value,
                genero: document.getElementById('genero').value,
            };

            axios.put(`http://localhost/biblioteca/libro/update/${libroId}`, data)
                .then(response => {
                    alert(response.data.message);
                    window.location.href = 'http://localhost/biblioteca/libro';
                })
                .catch(error => {
                    console.error('Error al actualizar el libro:', error);
                });
        });
    </script>
</body>
</html>

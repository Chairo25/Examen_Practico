document.addEventListener("DOMContentLoaded", function() {
    const formulario = document.getElementById("formularioLibro");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();

        const metodo = formulario.getAttribute("data-method") || "post";
        const url = formulario.getAttribute("action") || "/biblioteca/libro/create";
        const formData = {
            titulo: document.getElementById("titulo").value,
            autor: document.getElementById("autor").value,
            ano_publicacion: document.getElementById("ano_publicacion").value,
            genero: document.getElementById("genero").value
        };

        axios({
            method: metodo,
            url: url,
            data: formData
        })
        .then(function(response) {
            alert(response.data.message);
            window.location.reload(); // Recargar la página para actualizar la lista de libros
        })
        .catch(function(error) {
            console.error("Hubo un error al procesar el formulario:", error);
        });
    });

    // Manejar la edición de un libro
    const botonesEditar = document.querySelectorAll(".btn-edit");
    botonesEditar.forEach(function(boton) {
        boton.addEventListener("click", function(event) {
            event.preventDefault();
            const id = this.getAttribute("href").split("/").pop();

            axios.get(`/biblioteca/libro/${id}`)
            .then(function(response) {
                const libro = response.data;

                // Rellenar el formulario con los datos del libro para editar
                document.getElementById("titulo").value = libro.titulo;
                document.getElementById("autor").value = libro.autor;
                document.getElementById("ano_publicacion").value = libro.ano_publicacion;
                document.getElementById("genero").value = libro.genero;

                // Cambiar el formulario para manejar la actualización en lugar de la creación
                formulario.setAttribute("action", `/biblioteca/libro/update/${id}`);
                formulario.setAttribute("data-method", "put");
            })
            .catch(function(error) {
                console.error("Hubo un error al obtener los datos del libro:", error);
            });
        });
    });

    // Manejar la eliminación de un libro
    const botonesEliminar = document.querySelectorAll(".btn-delete");
    botonesEliminar.forEach(function(boton) {
        boton.addEventListener("click", function(event) {
            event.preventDefault();
            const id = this.getAttribute("href").split("/").pop();

            if (confirm("¿Estás seguro de que deseas eliminar este libro?")) {
                axios.post(`/biblioteca/libro/delete/${id}`)
                .then(function(response) {
                    alert(response.data.message);
                    window.location.reload(); // Recargar la página para actualizar la lista de libros
                })
                .catch(function(error) {
                    console.error("Hubo un error al eliminar el libro:", error);
                });
            }
        });
    });
});

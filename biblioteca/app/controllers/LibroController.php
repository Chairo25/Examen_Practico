<?php

class LibroController extends Controller {
    private $libroModel;

    public function __construct() {
        $this->libroModel = $this->model('Libro');
    }

    public function index() {
        $libros = $this->libroModel->getAll();
        $this->view('libros/index', ['libros' => $libros]);
    }

    public function show($id) {
        if (is_numeric($id)) {
            $libro = $this->libroModel->getById($id);

            if ($libro) {
                $this->view('libros/show', ['libro' => $libro]);
            } else {
                $this->view('errors/not_found', ['message' => 'Libro no encontrado']);
            }
        } else {
            $this->view('errors/invalid_request', ['message' => 'ID inválido']);
        }
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data) {
            if ($this->libroModel->add($data)) {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Libro añadido correctamente']);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(['message' => 'Error al añadir el libro']);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['message' => 'Datos inválidos']);
        }
    }

    public function edit($id) {
        if (is_numeric($id)) {
            $libro = $this->libroModel->getById($id);
            if (!$libro) {
                $this->view('errors/not_found', ['message' => 'Libro no encontrado']);
            } else {
                $this->view('libros/edit', ['libro' => $libro]);
            }
        } else {
            $this->view('errors/invalid_request', ['message' => 'ID inválido']);
        }
    }

    public function update($id) {
        if (is_numeric($id)) {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data) {
                if ($this->libroModel->update($id, $data)) {
                    header('Content-Type: application/json');
                    echo json_encode(['message' => 'Libro actualizado correctamente']);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(['message' => 'Error al actualizar el libro']);
                }
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(['message' => 'Datos inválidos']);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['message' => 'ID inválido']);
        }
    }

    public function delete($id) {
        if (is_numeric($id)) {
            if ($this->libroModel->delete($id)) {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Libro eliminado correctamente']);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(['message' => 'Error al eliminar el libro']);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['message' => 'ID inválido']);
        }
    }
}

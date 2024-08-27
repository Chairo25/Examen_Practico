<?php

class Libro {
    private $db;

    public function __construct() {
        // Obtener la instancia de la base de datos a través del método getInstance()
        $this->db = Database::getInstance();
    }    

    public function getAll() {
        $query = $this->db->query("SELECT * FROM libros");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }       

    public function getById($id) {
        $query = $this->db->prepare("SELECT * FROM libros WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }    

    public function add($data) {
        $sql = "INSERT INTO libros (titulo, autor, ano_publicacion, genero) VALUES (:titulo, :autor, :ano_publicacion, :genero)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':autor', $data['autor']);
        $stmt->bindParam(':ano_publicacion', $data['ano_publicacion']);
        $stmt->bindParam(':genero', $data['genero']);
        return $stmt->execute();
    }    

    public function update($id, $data) {
        $query = $this->db->prepare("UPDATE libros SET titulo = :titulo, autor = :autor, ano_publicacion = :ano_publicacion, genero = :genero WHERE id = :id");
        $query->bindParam(':titulo', $data['titulo']);
        $query->bindParam(':autor', $data['autor']);
        $query->bindParam(':ano_publicacion', $data['ano_publicacion'], PDO::PARAM_INT);
        $query->bindParam(':genero', $data['genero']);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }      

    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM libros WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
    
}

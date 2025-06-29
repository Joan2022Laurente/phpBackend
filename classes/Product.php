<?php
class Product {
    private $conn;
    private $table_name = "productos";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $precio_anterior;
    public $imagen;
    public $categoria;
    public $stock;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all products
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get products by category
    public function getByCategory($categoria) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE categoria = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $categoria);
        $stmt->execute();
        return $stmt;
    }

    // Get single product
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->precio = $row['precio'];
            $this->precio_anterior = $row['precio_anterior'];
            $this->imagen = $row['imagen'];
            $this->categoria = $row['categoria'];
            $this->stock = $row['stock'];
            return true;
        }
        return false;
    }

    // Search products
    public function search($keywords) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nombre LIKE ? OR descripcion LIKE ? ORDER BY id DESC";
        $keywords = "%{$keywords}%";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->execute();
        return $stmt;
    }
}
?>

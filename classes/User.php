<?php
class User {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password_hash;
    public $fecha_nacimiento;
    public $tipo_documento;
    public $numero_documento;
    public $celular;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create user
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nombre=:nombre, apellido=:apellido, email=:email, password_hash=:password_hash,
                      fecha_nacimiento=:fecha_nacimiento, tipo_documento=:tipo_documento,
                      numero_documento=:numero_documento, celular=:celular";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password_hash = password_hash($this->password_hash, PASSWORD_DEFAULT);

        // Bind values
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password_hash", $this->password_hash);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":tipo_documento", $this->tipo_documento);
        $stmt->bindParam(":numero_documento", $this->numero_documento);
        $stmt->bindParam(":celular", $this->celular);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Login user
    public function login($email, $password) {
        $query = "SELECT id, nombre, apellido, email, password_hash FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($password, $row['password_hash'])) {
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->apellido = $row['apellido'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }

    // Check if email exists
    public function emailExists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
}
?>

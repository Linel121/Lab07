<?php
class Database{
    private $hostname='localhost';
    private $database='lab07';
    private $username='root';
    private $password='';
    private $pdo; 

    function conectar(): PDO {
        try {
            $conexion = "mysql:host=".$this->hostname.";dbname=".$this->database;
            $option = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->pdo = new PDO($conexion, $this->username, $this->password, $option); 
            return $this->pdo;
        } catch(PDOException $e) {
            echo 'Error de conexion :'.$e->getMessage();
            exit;
        }
    }
    function obtenerUsuarios($pdo) {
        $stmt = $pdo->query("SELECT * FROM usuario");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function eliminarUsuario($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM usuario WHERE id = ?");
        $stmt->execute([$id]);
    }
}


?>

<?php
class Database{
    private $hostname='localhost';
    private $database='llab07';
    private $username='root';
    private $password='';
    private $pdo; // Propiedad para almacenar la instancia de PDO
    
    function conectar(){
        try{
            $conexion="mysql:host=".$this->hostname.";dbname=".$this->database;
            $option=[
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES=>false,
            ];
            $this->pdo = new PDO($conexion, $this->username, $this->password, $option); // Almacena la instancia de PDO en la propiedad
            return $this->pdo;
        } 
        catch(PDOException $e) {
            echo 'Error de conexion :'.$e->getMessage();
            exit;
        }
    }   
}


?>

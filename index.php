<?php
session_start();
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
if(isset($_POST['Enviar'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $hashed_password = hash('sha256', $contraseña);
    $sql = $con->prepare("SELECT * FROM usuario WHERE nombre_usuario = :usuario AND pass = :pass;");
    $sql->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $sql->bindParam(':pass', $hashed_password, PDO::PARAM_STR);
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    if($resultado) {   
        $correcto = true;
    }else {
        $correcto = false;
    }
    if($correcto) {
        $_SESSION['id'] = $resultado['id'];
        $_SESSION['usuario'] = $usuario;
        $_SESSION['contraseña'] = $hashed_password;
        $_SESSION['nombre'] = $resultado['nombre'];
        $_SESSION['apellido'] = $resultado['apellido'];
        $_SESSION['edad'] = $resultado['edad'];
        $_SESSION['DNI'] = $resultado['DNI'];
        $_SESSION['numero'] = $resultado['numero'];
        $_SESSION['correo'] = $resultado['correo'];
        $_SESSION['administrador'] = $resultado['administrador'];
        header("Location: validar.php");
    }else
        echo '<script>alert("Contraseña incorrecta. Por favor, inténtalo de nuevo.");</script>';
        echo '<script>window.location.href = "index.html";</script>';    
    }
?>
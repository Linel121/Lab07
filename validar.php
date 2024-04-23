<?php 
session_start();
if(empty($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}

if(isset($_POST['salir'])){
    session_destroy();
    header("Location: index.html");
    exit;
}
if ($_SESSION['administrador'] == 0){
    header("Location: coca.php");
}else{
    header("Location: crud.php");
}

?>

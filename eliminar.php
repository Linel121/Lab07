<?php
session_start();

require_once 'config/database.php'; 

$db = new Database(); 
$pdo = $db->conectar();

if(empty($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}
elseif(isset($_POST['salir'])){
    session_destroy();
    header("Location: index.html");
    exit;
}


if(isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
   
    if(isset($_POST['usuario_a_eliminar'])) {
  
        $id_usuario_a_eliminar = $_POST['usuario_a_eliminar'];
    
        $db->eliminarUsuario($pdo, $id_usuario_a_eliminar);
       
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Acciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Menú de Acciones</h1>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <form action="" method="post" class="mr-3">
                <div class="form-group">
                    <label for="accion">Selecciona una acción:</label>
                    <select class="form-control" id="accion" name="accion">
                        <option value="crear">Crear</option>
                        <option value="editar">Editar</option>
                        <option value="eliminar">Eliminar</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            <form method="post">
                <button type="submit" class="btn btn-danger" name="salir">Salir</button>
            </form>
        </div>
        
        <?php if(isset($_POST['accion']) && $_POST['accion'] === 'eliminar'): ?>
            <h2 class="mt-5">Eliminar Usuario</h2>
            <ul class="list-group mt-3">
                <?php 
                // Obtener usuarios de la base de datos
                $usuarios = $db->obtenerUsuarios($pdo);
                foreach($usuarios as $usuario): 
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $usuario['nombre']; ?>
                    <form method="post">
                        <input type="hidden" name="usuario_a_eliminar" value="<?php echo $usuario['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>

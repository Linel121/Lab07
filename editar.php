<?php
session_start();
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
if (empty($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}
$registro = [];
if (isset($_POST['editar_id'])) {
    $id = $_POST['editar_id'];
    $query = $con->prepare("SELECT * FROM usuario WHERE id = ?");
    $query->execute([$id]);
    $registro = $query->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['editar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $numero = $_POST['numero'];
    $correo = $_POST['correo'];
    $administrador = $_POST['administrador'];
    $nombre_usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $pass_hash = hash('sha256', $pass);
   
    $query = $con->prepare("UPDATE usuario SET nombre = ?, apellido = ?, edad = ?, DNI = ?, numero = ?, correo = ?, administrador = ?, nombre_usuario = ?, pass = ? WHERE id = ?");
    $query->execute([$nombre, $apellido, $edad, $dni, $numero, $correo, $administrador, $nombre_usuario, $pass_hash, $id]);

    header("Location: crud.php");
    exit;
}
?>
<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Registro</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                .mensaje {
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Editar registro</h2>
                <form action="" method="post">
                        <input type="hidden" name="editar_id" value="<?php echo isset($registro['id']) ? $registro['id'] : ''; ?>">
                        <div class="form-group">
                            <label for="nombre_u">Nombre de usuario:</label>
                            <input type="text" class="form-control" id="nombre_u" name="usuario" value="<?php echo $registro['nombre_usuario']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $registro['nombre']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $registro['apellido']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="numero">Número:</label>
                            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $registro['numero']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad:</label>
                            <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $registro['edad']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="dni">DNI:</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $registro['DNI']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $registro['correo']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="pass"  required>
                        </div>
                        <div class="form-group">
                            <label for="administrador">Rol:</label>
                            <select class="form-control" id="administrador" name="administrador">
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                </div>
                <button type="submit" class="btn btn-sm btn-danger" name="editar" onclick="return confirm('¿Estás seguro de que deseas editar este registro?')">Editar</button>
                </form>
            </div>
        </body>
</html>
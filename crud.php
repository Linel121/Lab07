<?php 
session_start();
// Verificar si el usuario está logueado
if (empty($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}

// Acción de cerrar sesión
if (isset($_POST['salir'])) {
    session_destroy();
    header("Location: index.html");
    exit;
}
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
$sql = $con->query("SELECT * FROM usuario");
$registros = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Acciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .mensaje {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Menú de Acciones</h1>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <!-- Formulario para seleccionar acción -->
            <form action="" method="post" class="mr-3">
                <div class="form-group">
                    <label for="accion">Selecciona una acción:</label>
                    <select class="form-control" id="accion" name="accion">
                        <option value="mostrar">Mostrar</option>
                        <option value="crear">Crear</option>
                        <option value="editar">Editar</option>
                        <option value="eliminar">Eliminar</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
            </form>
            <!-- Formulario para cerrar sesión -->
            <form method="post">
                <button type="submit" class="btn btn-danger" name="salir">Salir</button>
            </form>
        </div>
        <br>
        <br>
        <?php
        if (isset($_POST['enviar'])){
            $accion = $_POST['accion'];
            if ($accion == 'mostrar'){
        ?>
                <h2>Registros Existentes</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Número</th>
                            <th>Edad</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $registro) : ?>
                        <tr>
                            <td><?php echo $registro['id']; ?></td>
                            <td><?php echo $registro['nombre_usuario']; ?></td>
                            <td><?php echo $registro['nombre']; ?></td>
                            <td><?php echo $registro['apellido']; ?></td>
                            <td><?php echo $registro['numero']; ?></td>
                            <td><?php echo $registro['edad']; ?></td>
                            <td><?php echo $registro['DNI']; ?></td>
                            <td><?php echo $registro['correo']; ?></td>
                            <td><?php echo $registro['administrador'] == 1 ? 'Admin' : 'User'; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
        <?php
            if ($accion == 'eliminar'){
            ?>
                <h2>Registros Existentes</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Número</th>
                            <th>Edad</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $registro) : ?>
                        <tr>
                            <td><?php echo $registro['id']; ?></td>
                            <td><?php echo $registro['nombre_usuario']; ?></td>
                            <td><?php echo $registro['nombre']; ?></td>
                            <td><?php echo $registro['apellido']; ?></td>
                            <td><?php echo $registro['numero']; ?></td>
                            <td><?php echo $registro['edad']; ?></td>
                            <td><?php echo $registro['DNI']; ?></td>
                            <td><?php echo $registro['correo']; ?></td>
                            <td><?php echo $registro['administrador'] == 1 ? 'Admin' : 'User'; ?></td>
                            <td>
                                <a href="<?php echo $registro['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
        <?php
            if ($accion == 'editar'){
            ?>
                <h2>Registros Existentes</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Número</th>
                            <th>Edad</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $registro) : ?>
                        <tr>
                            <td><?php echo $registro['id']; ?></td>
                            <td><?php echo $registro['nombre_usuario']; ?></td>
                            <td><?php echo $registro['nombre']; ?></td>
                            <td><?php echo $registro['apellido']; ?></td>
                            <td><?php echo $registro['numero']; ?></td>
                            <td><?php echo $registro['edad']; ?></td>
                            <td><?php echo $registro['DNI']; ?></td>
                            <td><?php echo $registro['correo']; ?></td>
                            <td><?php echo $registro['administrador'] == 1 ? 'Admin' : 'User'; ?></td>
                            <td>
                                <a href="<?php echo $registro['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
        <?php
            if ($accion == 'crear'){
            ?>
                <div class="container">
                    <h2>Crear Nuevo Registro</h2>
                    <form action="?accion=crear" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="numero">Número:</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad:</label>
                            <input type="number" class="form-control" id="edad" name="edad" required>
                        </div>
                        <div class="form-group">
                            <label for="dni">DNI:</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="administrador">Rol:</label>
                            <select class="form-control" id="administrador" name="administrador">
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        <?php
        }
        ?>
        <?php
        }
        ?>
    </div>
</body>
</html>

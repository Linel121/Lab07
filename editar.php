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
</head>
<body>
    <div class="container">
        <h2>Editar registro</h2>
        <form action="" method="post">
            <!-- Otros campos del formulario -->
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
                <small class="text-danger" id="edadError"></small>
            </div>
            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $registro['DNI']; ?>" required>
                <small class="text-danger" id="dniError"></small>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $registro['correo']; ?>" required>
                <small class="text-danger" id="correoError"></small>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="pass" required>
                <small class="text-danger" id="passError"></small>
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
    <script>
        document.getElementById('nombre_u').addEventListener('input', function() {
            var username = this.value.trim();
            var regex = /^[a-zA-Z0-9_-]+$/;
            var isValid = regex.test(username);
            var feedback = document.getElementById('usernameHelpBlock');
            var inputField = this;
            
            if (isValid) {
                inputField.classList.remove('is-invalid');
                feedback.innerText = 'Se permiten letras, números, _ y -';
            } else {
                inputField.classList.add('is-invalid');
                feedback.innerText = 'Por favor, ingrese un nombre de usuario válido.';
            }
        });
        document.getElementById('nombre').addEventListener('input', function() {
            var name = this.value.trim();
            var regex = /^[a-zA-Z\s]*$/;
            var isValid = regex.test(name);
            var inputField = this;
            
            if (isValid) {
                inputField.classList.remove('is-invalid');
            } else {
                inputField.classList.add('is-invalid');
            }
        });
        document.getElementById('apellido').addEventListener('input', function() {
            var apellido = this.value.trim();
            var regex = /^[a-zA-Z\s]*$/;
            var isValid = regex.test(apellido);
            var inputField = this;
            
            if (isValid) {
                inputField.classList.remove('is-invalid');
            } else {
                inputField.classList.add('is-invalid');
            }
        });
        document.getElementById('numero').addEventListener('input', function() {
            var numero = this.value.trim();
            var regex = /^\d{9}$/;
            var isValid = regex.test(numero);
            var inputField = this;
            
            if (isValid) {
                inputField.classList.remove('is-invalid');
            } else {
                inputField.classList.add('is-invalid');
            }
        });
        document.getElementById('edad').addEventListener('input', function() {
            var edad = parseInt(this.value.trim());
            var edadError = document.getElementById('edadError');
            
            if (isNaN(edad) || edad < 0 || edad > 999) {
                edadError.textContent = 'La edad debe ser un número positivo de hasta 3 dígitos.';
                this.classList.add('is-invalid');
            } else {
                edadError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });
        document.getElementById('dni').addEventListener('input', function() {
            var dni = this.value.trim();
            var dniError = document.getElementById('dniError');
            

            if (!(/^\d+$/.test(dni)) || parseInt(dni) < 0) {
                dniError.textContent = 'El DNI debe contener solo números y no puede ser negativo.';
                this.classList.add('is-invalid');
            } else {
                dniError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });
        document.getElementById('correo').addEventListener('input', function() {
            var correo = this.value.trim();
            var correoError = document.getElementById('correoError');
            
            if (correo.length > 8) {
                correoError.textContent = 'El correo no puede tener más de 8 caracteres.';
                this.classList.add('is-invalid');
            } else {
                correoError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });
        document.getElementById('password').addEventListener('input', function() {
            var password = this.value.trim();
            var passError = document.getElementById('passError');
            
            if (password.length > 8) {
                passError.textContent = 'La contraseña no puede tener más de 8 caracteres.';
                this.classList.add('is-invalid');
            } else {
                passError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });
    </script>
</body>
</html>

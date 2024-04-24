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
    </div>
</body>
</html>

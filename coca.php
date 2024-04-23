<?php 
session_start();
if(empty($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}

if(isset($_POST['Salir'])){
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
    <title>Blog de Coca-Cola</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        section.blog-posts {
            padding: 20px;
        }

        article {
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
        }

        article h2 {
            color: #dc143c;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo-container text-center mt-3">
                <img src="img/fcc.png" alt="Logo de Coca-Cola" class="img-fluid" style="max-width: 150px;">
            </div>
            <h1 class="text-center mt-4">Blog de Coca-Cola</h1>
            <div class="container-usuario text-right mt-3">
                <h3>Cuenta de <?php echo $_SESSION['usuario']; ?></h3>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-danger mt-3">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.coca-colacompany.com/about-us">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.coca-cola.com/pe/es/brands/coca-cola">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.entuhogar.coca-cola.com.co/productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.coca-colacompany.com/about-us/contact-us">Contacto</a>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="blog-posts mt-4">
            <article class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Nuevo lanzamiento: Coca-Cola Zero Sugar</h2>
                    <p class="card-text">Descubre nuestro último producto: Coca-Cola Zero Sugar, la misma refrescante Coca-Cola, sin azúcar.</p>
                </div>
            </article>
            <article class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Historia de Coca-Cola</h2>
                    <p class="card-text">Conoce la fascinante historia detrás de la marca Coca-Cola, desde sus humildes comienzos hasta convertirse en una de las marcas más reconocidas a nivel mundial.</p>
                </div>
            </article>
            <article class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Receta de cóctel: Coca-Cola con limón</h2>
                    <p class="card-text">¡Aprende a preparar un delicioso cóctel con Coca-Cola y limón para sorprender a tus amigos en tu próxima reunión!</p>
                </div>
            </article>
            <article class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Beneficios de Coca-Cola Light</h2>
                    <p class="card-text">Descubre los beneficios de Coca-Cola Light y por qué es la elección perfecta para aquellos que buscan una opción baja en calorías.</p>
                </div>
            </article>
            <article class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Impacto ambiental de Coca-Cola</h2>
                    <p class="card-text">Conoce las iniciativas de sostenibilidad de Coca-Cola y nuestro compromiso con el medio ambiente.</p>
                </div>
            </article>
            <article class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Top 10 anuncios memorables de Coca-Cola</h2>
                    <p class="card-text">Revive los anuncios más icónicos de Coca-Cola que han dejado una huella en la cultura popular.</p>
                </div>
            </article>
        </section>

        <footer class="bg-dark text-white text-center py-3 mt-5">
            <p>&copy; 2024 Blog de Coca-Cola</p>
            <form method="post">
                <button type="submit" class="btn btn-danger" name="Salir">Salir</button>
            </form>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

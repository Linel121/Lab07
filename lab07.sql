

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `edad` int(3) DEFAULT NULL,
  `DNI` int(10) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `administrador` int(1) DEFAULT NULL,
  `nombre_usuario` varchar(30) DEFAULT NULL,
  `contraseña` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `edad`, `DNI`, `numero`, `correo`, `administrador`, `nombre_usuario`, `contraseña`) VALUES
(1, 'Paulo', 'Garcia', 18, 72428560, 906740999, 'Paulo.garfar@gmail.com', 1, 'paulozzq', '123'),
(2, 'Ana', 'López', 25, 1234567891, 123456789, 'ana@example.com', 0, 'analopez', 'contraseña1'),
(3, 'Pedro', 'Martínez', 30, 2147483647, 987654321, 'pedro@example.com', 0, 'pedromartinez', 'contraseña2'),
(4, 'María', 'Gómez', 22, 2147483647, 246813579, 'maria@example.com', 0, 'mariagomez', 'contraseña3'),
(5, 'Carlos', 'Rodríguez', 28, 1357924680, 135792468, 'carlos@example.com', 0, 'carlosrodriguez', 'contraseña4'),
(6, 'Laura', 'Hernández', 35, 2147483647, 369258147, 'laura@example.com', 0, 'laurahernandez', 'contraseña5'),
(7, 'David', 'Sánchez', 40, 1593572460, 159357246, 'david@example.com', 0, 'davidsanchez', 'contraseña6');


ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;


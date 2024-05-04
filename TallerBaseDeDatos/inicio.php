<?php
session_start();

// 
if (!isset($_SESSION['user_rol_id'])) {
    header("Location: index.php");
    exit();
}

// las funciones del usuario desde la sesión
$funciones = $_SESSION['funciones'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página de Inicio</title>
</head>
<body>
    <h2>Bienvenido</h2>
    <h3>Funciones Disponibles:</h3>
    <ul>
        <?php foreach ($funciones as $funcion) : ?>
            <li><a href="<?php echo $funcion['url']; ?>"><?php echo $funcion['nombre']; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="logout.php">Cerrar Sesión</a></p>
</body>
</html>

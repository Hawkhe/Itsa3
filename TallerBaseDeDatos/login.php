 <?php
session_start();

// Datos de conexión a la base de datos
$host = 'localhost';
$dbname = 'tareaLogin';
$username = 'tallerDiego';
$password = '65701710';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    try {
        // Conexión a la base de datos
        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Llamada al procedimiento iniciar_sesion
        $stmt = $conn->prepare("CALL iniciar_sesion(:p_usuario, :p_contrasenia, :p_user_rol_id)");
        $stmt->bindParam(':p_usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':p_contrasenia', $contrasenia, PDO::PARAM_STR);
        $stmt->bindParam(':p_user_rol_id', $user_rol_id, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();

        // Obtener el resultado del procedimiento almacenado
        $user_rol_id = $stmt->fetch(PDO::FETCH_ASSOC)['p_user_rol_id'];

        // Llamada al procedimiento obtener_funciones_por_rol
        $stmt = $conn->prepare("CALL obtener_funciones_por_rol(:p_user_rol_id)");
        $stmt->bindParam(':p_user_rol_id', $user_rol_id, PDO::PARAM_INT);
        $stmt->execute();
        $funciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar las funciones obtenidas
        echo "<h2>Funciones del Usuario:</h2>";
        echo "<ul>";
        foreach ($funciones as $funcion) {
            echo "<li>{$funcion['nombre']}</li>";
        }
        echo "</ul>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Autenticación de Usuario</title>
</head>
<body>
    <h1>Autenticación de Usuario</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="contrasenia">Contraseña:</label><br>
        <input type="password" id="contrasenia" name="contrasenia" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>

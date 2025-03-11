<?php
// Comprobamos si se han enviado los datos del formulario
if (isset($_POST['usr']) && isset($_POST['psw'])) {

    // Sanitizamos la entrada para evitar inyecciones de código malicioso
    // Aunque usaremos prepared statements, es buena práctica hacerlo
    $usr = htmlspecialchars($_POST['usr']);
    $psw = htmlspecialchars($_POST['psw']);

    // Datos de conexión a la base de datos
    $server = 'localhost';
    $user = 'root'; // No usar 'root', crear un usuario con permisos limitados
    $password = '';
    $bd = 'notes';

    // Conectamos a la base de datos utilizando mysqli
    $db = new mysqli($server, $user, $password, $bd);

    // Comprobamos la conexión
    if ($db->connect_error) {
        die('Error de conexión: ' . $db->connect_error);
    }

    // Utilizamos prepared statements para prevenir SQL Injection
    $query = $db->prepare("SELECT * FROM login WHERE usr = ? AND psw = ?");
    // 'ss' indica que estamos pasando dos parámetros de tipo string
    $query->bind_param('ss', $usr, $psw);
    $query->execute();

    // Obtenemos el resultado de la consulta
    $resultado = $query->get_result();

    // Verificamos si hay alguna fila que coincida
    if ($resultado->num_rows > 0) {
        // Si el usuario existe, iniciamos la sesión
        session_start();
        $_SESSION["usr"] = $usr;
        
        // Cerramos la consulta y la conexión
        $query->close();
        $db->close();

        // Redirigimos al usuario a la página principal
        header("Location: home.php");
        exit();
    } else {
        // Si no hay coincidencias, redirigimos al usuario a la página de inicio de sesión
        $query->close();
        $db->close();
        header("Location: index.html");
        exit();
    }
}
?>

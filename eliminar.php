<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['eliminar'])) {
    $server = 'localhost';
    $user  = 'root';
    $password = '';
    $bd = 'notes';
    $db = mysqli_connect($server, $user, $password, $bd) or die('Error al conectar con la base de datos');

    $idsAEliminar = implode(",", array_map('intval', $_POST['eliminar']));
    $queryBorrar = "DELETE FROM notas WHERE id IN ($idsAEliminar)";
    mysqli_query($db, $queryBorrar) or die('Error al eliminar los registros');

    mysqli_close($db);

    // Redirige de vuelta a la página principal
    header("Location: home.php");
    exit();
} else {
    // Si se accede directamente o sin datos, redirige de vuelta
    header("Location: home.php");
    exit();
}
?>

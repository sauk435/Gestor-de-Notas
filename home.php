
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>
<header>
  <?php
  session_start();
  if(empty($_SESSION["usr"])){
    header( "Location: index.html");
  }
  else{
    $usuario=$_SESSION["usr"];
    echo('<h1 id="tituloN" >Gestor de Notas</h1>');
    echo('<div id="usuario">');
    echo("Usuario: " . ucfirst($usuario) );
    echo('<br><a href="logout.php">Cerrar sesión</a>');}
    echo('</div>');
  ?>
</header>
<body>
    <form id="form2" action="nuevanota.php" method="post">
        <h2>Añadir Nota</h2>
        <label for="titulo">Titulo de la Nota:</label>
        <input class="intp" type="text" name="titulo" id="titulo">
        <label for="nota">Nota:</label>
        <textarea class="intp" name="nota" id="nota" cols="30" rows="10"></textarea>
        <input id="sumitN" type="submit" value="Añadir Nota">
        <input type="text" name="autor" value="<?php echo $usuario; ?>" style="display:none;">
    </form>
    <?php
      $server = 'localhost';
      $user  = 'root';
      $password = '';
      $bd = 'notes';
      $db = mysqli_connect($server, $user, $password, $bd) or die('Error al conectar con la base de datos');
      $query = "SELECT id, autor, titulo, nota FROM notas"; // Selecciona el id pero no lo mostramos
      $resultado = mysqli_query($db, $query) or die('Error al realizar la consulta');
      echo("<form method='post' action='eliminar.php'>");
      echo("<table id='tablaN'>");
      echo("<tr id='notas'>");
      echo("<th>Seleccionar</th>"); // Columna para los checkboxes
      echo("<th>Autor</th><th>Título</th><th>Nota</th>"); // Encabezados visibles
      echo("</tr>");
      while ($fila = $resultado->fetch_assoc()) {
          echo("<tr>");
          // Checkbox con valor del id, pero no se muestra el id
          echo("<td><input type='checkbox' name='eliminar[]' value='" . $fila['id'] . "'></td>");
          // Mostramos solo autor, título y nota
          echo("<td class='filas'>" . ucfirst($fila['autor']) . "</td>");
          echo("<td class='filas'>" . ucfirst($fila['titulo']) . "</td>");
          echo("<td class='filas'>" . ucfirst($fila['nota']) . "</td>");
          echo("</tr>");
      }
      echo("</table>");
      echo("<button type='submit' name='borrar' class='boton-borrar'>Borrar seleccionados</button>");
      echo("</form>");
      mysqli_close($db);
    ?>

    
</body>
</html>

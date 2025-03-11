<?php
  //si el campo del nombre tiene contenido es por que han enviado el formulario
  if(isset($_POST['titulo'])){ 
      //conectamos con la base de datos
      $server = 'localhost';
      $user  =   'root';
      $password = '' ;
      $bd ='notes';
      $db = mysqli_connect($server,$user,$password, $bd) or die('Error al conectar con la base de datos');
      //guardamos en variables los datos enviados
      $titulo = $_POST['titulo'];
      $nota = $_POST['nota'];
      $usuario = $_POST['autor'];	
      //insertamos los datos en la base de datos
      $query ="INSERT INTO notas (autor,titulo,nota) VALUES ('$usuario','$titulo','$nota')";
      //ejecutamos la consulta
      mysqli_query($db,$query) or die('Error al insertar los datos');
      //cerramos la conexión
      mysqli_close($db);
      header("Location: home.php");
  }
?>
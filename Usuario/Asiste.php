<?php  include("../cargarIdioma.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <?php
   //cargamos valores necesarios 
   $Nombre=$_GET["Nombre"];
   $Horario=$_GET["Horario"];
   $Profesor=$_GET["Profesor"];
   //cargamos id de usuario
   $Id_Usuario=$_SESSION['Id_Usuario'];
   $conexion=mysqli_connect('localHost','root','');
   echo mysqli_error($conexion);
   mysqli_select_db($conexion, 'gimvm');
   echo mysqli_error($conexion);
   //actualizamos el numero de plazas disponibles en la tabla actividades
   $consulta="UPDATE reservas SET Asiste=1 WHERE Nombre='$Nombre' AND Horario='$Horario' AND Profesor='$Profesor' AND Id_Usuario='$Id_Usuario'";
   mysqli_query($conexion,$consulta);
   echo mysqli_error($conexion);
   echo "Cambios realizados";
   mysqli_close($conexion);
   header("Location: ./verReservas.php");
   ?> 
</body>
</html>
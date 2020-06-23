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
   $Plazas=$_GET["Plazas"];
   $Plazas_Disponibles=$_GET["Plazas_Disponibles"];
   //cargamos id de usuario
   $Id_Usuario=$_SESSION['Id_Usuario'];
   //descontamos uno a las plazas disponibles
   $Plazas_Disponibles=$Plazas_Disponibles-1;
   $conexion=mysqli_connect('localHost','root','');
   echo mysqli_error($conexion);
   mysqli_select_db($conexion, 'gimvm');
   echo mysqli_error($conexion);
   //actualizamos el numero de plazas disponibles en la tabla actividades
   $consulta="UPDATE clases SET Plazas_Disponibles='$Plazas_Disponibles' WHERE Nombre='$Nombre' AND Horario='$Horario' AND Profesor='$Profesor' ";
   mysqli_query($conexion,$consulta);
   echo mysqli_error($conexion);
   //Realizamos insercion en la tabla reservas
   $insercion="INSERT INTO reservas (Nombre,Horario,Profesor,Id_Usuario,Asiste) VALUES ('$Nombre','$Horario','$Profesor','$Id_Usuario',0)";
   mysqli_query($conexion,$insercion);
   echo mysqli_error($conexion);
   echo "Cambios realizados";
   mysqli_close($conexion);
   header("Location: ./Actividades.php");
   ?> 
</body>
</html>
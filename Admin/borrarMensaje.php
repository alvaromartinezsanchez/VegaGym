<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1, shrinkto-fit=no">
    <meta name="keywords" content="Gimnasio Murcia, Fitnes, Ejercicio">
	<meta name="description" content="Gimnasio Murcia, Fitnes, Ejercicio">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php
        include("./HeaderAdmin.php");
    ?>
    <?php
    $Emisor=$_GET['Emisor'];
    $Receptor=$_GET['Receptor'];
    $Fecha=$_GET['Fecha'];
    $Mensaje=$_GET['Mensaje'];
    $conexion=mysqli_connect('localHost','root','');
    echo mysqli_error($conexion);
    mysqli_select_db($conexion, 'gimvm');
    echo mysqli_error($conexion);
    $consulta="DELETE FROM mensajes WHERE Id_Emisor='$Emisor' AND Id_Receptor='$Receptor' AND Fecha='$Fecha' ";
    mysqli_query($conexion,$consulta);
    echo mysqli_error($conexion);
    mysqli_close($conexion);
    header("Location: ./EnviarMensaje.php")
    ?>
    
    
</body>
</html>
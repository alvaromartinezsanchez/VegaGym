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
    $Id_U=$_GET["Id"];
    $conexion=mysqli_connect('localHost','root','');
    echo mysqli_error($conexion);

    mysqli_select_db($conexion, 'gimvm');
    echo mysqli_error($conexion);
    $consulta="UPDATE usuarios SET Activo=0 WHERE Id_Usuario='$Id_U' ";
    mysqli_query($conexion,$consulta);
    echo mysqli_error($conexion);
    echo "Cambios realizados";
    mysqli_close($conexion);
    header("Location: ./ActivarUsuario.php");
    ?>
</body>
</html>
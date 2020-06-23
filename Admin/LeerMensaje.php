<?php
/*Cargamos el idioma y el resto de variables de sesion*/
include("../cargarIdioma.php");
if(isset($_SESSION['Id_Usuario'])){

?>
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
    //Cambiamos el valor de leido
    $consulta="UPDATE mensajes SET Leido=1 WHERE Id_Emisor='$Emisor' AND Id_Receptor='$Receptor' AND Fecha='$Fecha' ";
    mysqli_query($conexion,$consulta);
    echo mysqli_error($conexion);
    //Obtenemos nombre de emisor y receptor conociendo su id
    $ConsultaEmisor="SELECT Nombre FROM usuarios WHERE Id_Usuario='$Emisor'";
    $ConsultaReceptor="SELECT Nombre FROM usuarios WHERE Id_Usuario='$Receptor'";
    $NombreEmi=mysqli_query($conexion, $ConsultaEmisor);
    $NombreRe=mysqli_query($conexion, $ConsultaReceptor);
    $rowEmi=mysqli_fetch_assoc($NombreEmi);
    $rowRe=mysqli_fetch_assoc($NombreRe);
    $Emisor=$rowEmi['Nombre'];
    $Receptor=$rowRe['Nombre'];
    mysqli_close($conexion);

    ?>
    <section class="row justify-content-center">
    	<article class="col-10 mensaje">
            <h3>Emisor: <?php echo $Emisor ?></h3>
            <hr>
            <h3>Destinatario: <?php echo $Receptor ?> </h3>
            <hr>
            <h3>Fecha: <?php echo $Fecha ?></h3>
            <hr>
            <h3>Mensaje: </h3>
            <hr>
            <p class="h5"><?php echo $Mensaje ?></p>
            <br>
            <div class="row justify-content-end">
                <a href="EnviarMensaje.php" class="btn btn-dark text-right mr-5">Volver</a>
            </div>
            
        </article>
        
    </section>
    
</body>
</html>
<?php
}else{
    header("Location: ../Inicio/index.php");
}
?>
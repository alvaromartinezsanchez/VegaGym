<?php
/*Cargamos el idioma y el resto de variables de sesion*/
include("../cargarIdioma.php");
if(isset($_SESSION['Id_Usuario'])){
 $Id=$_SESSION['Id_Usuario'];
 $Nombre=$_SESSION['Nombre'];
 $Apellido=$_SESSION['Apellido'];
 $Clave=$_SESSION['Clave'];
 $Rol=$_SESSION['Rol'];
 $Activo=$_SESSION['Activo'];
 $Sexo=$_SESSION['Sexo'];
 $Edad=$_SESSION['Edad'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=devide-width, initial-scale=1, shrinkto-fit=no">
    <meta name="keywords" content="Gimnasio Murcia, Fitnes, Ejercicio">
	<meta name="description" content="Gimnasio Murcia, Fitnes, Ejercicio">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php
    //CARGA EL ESTILO , LA APERTURA DEL BODY Y EL HEADER
    include("./HeaderAdmin.php");
    ?>
		
    <section class="row justify-content-center">
    <header class="row justify-content-center">
            <h3><?php echo $textos['Bienvenido'];?><?php echo "  $Nombre   $Apellido "; ?></h3>    
        </header>
	</section>
		
	<aside class="row justify-content-around">
        <div class="col-3">
            <img src="../images/Bienvenida.jpg" alt="Bienvenida">
        
        </div>
        <div class="col-5">
            <div class="row mensaje">
                <div class="col-12">
                    <h1><?php echo $textos['UltimaNoticia'];?></h1>
                    <?php
                    $conexion=mysqli_connect('localHost','root','');
                    echo mysqli_error($conexion);

                    mysqli_select_db($conexion, 'gimvm');
                    echo mysqli_error($conexion);
                    $consulta="SELECT * FROM noticias ORDER BY Id_Noticia DESC LIMIT 1";
                    $resultado=mysqli_query($conexion,$consulta);
                    echo mysqli_error($conexion);
                    $row=mysqli_fetch_assoc($resultado);
                    ?>
                    <p><?php echo $row['Noticia']?></p>
                    <p><?php echo $row['Fecha']?></p>
                    <?php


                    mysqli_close($conexion);
                    ?>
                </div>
            </div>
            
        </div>
        
	</aside>
		
    <?php
        include("../Inicio/FooterInicio.php");
    ?>
</body>
</html>
<?php
}else{
    header("Location: ../Inicio/index.php");
}
?>
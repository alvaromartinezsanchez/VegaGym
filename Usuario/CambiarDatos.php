<?php
/*Cargamos el idioma y el resto de variables de sesion*/
include("../cargarIdioma.php");
if(isset($_SESSION['Id_Usuario'])){
$Id=$_SESSION['Id_Usuario'];

?>
 <?php
                if(isset($_POST['Nombre'])&&isset($_POST['Apellido'])&&isset($_POST['Clave'])&&isset($_POST['Rol'])&&isset($_POST['Sexo'])&&isset($_POST['Edad'])){
                    //Obtenemos nuevos valores y los almacenamos
                    $NuevoNombre=$_POST['Nombre'];
                    $NuevoApellido=$_POST['Apellido'];
                    $NuevoClave=$_POST['Clave'];
                    $NuevoEdad=$_POST['Edad'];
                    $NuevoSexo=$_POST['Sexo'];
                    $NuevoRol=$_POST['Rol'];

                    $conexion=mysqli_connect('localHost','root','');
                    echo mysqli_error($conexion);

                    mysqli_select_db($conexion, 'gimvm');
                    echo mysqli_error($conexion);
                    $consulta="UPDATE usuarios SET Nombre='$NuevoNombre', Apellido='$NuevoApellido', Clave='$NuevoClave', Edad='$NuevoEdad', Sexo='$NuevoSexo', Rol='$NuevoRol' WHERE Id_Usuario='$Id' ";
                    mysqli_query($conexion,$consulta);
                    echo mysqli_error($conexion);
                    echo "Cambios realizados";
                    mysqli_close($conexion);
                    //Actualizamos los datos de sesion
                    $_SESSION['Nombre']=$NuevoNombre;
                    $_SESSION['Apellido']=$NuevoApellido;
                    $_SESSION['Clave']=$NuevoClave;
                    $_SESSION['Edad']=$NuevoEdad;
                    $_SESSION['Sexo']=$NuevoSexo;
                    $_SESSION['Rol']=$NuevoRol;
                    
                    }
                    $Nombre=$_SESSION['Nombre'];
                    $Apellido=$_SESSION['Apellido'];
                    $Clave=$_SESSION['Clave'];
                    $Rol=$_SESSION['Rol'];
                    $Sexo=$_SESSION['Sexo'];
                    $Edad=$_SESSION['Edad'];
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
    <title><?php echo $textos['DatosUsuario'];?></title>
</head>
<?php
        include("./HeaderUsuario.php");
    ?>
		
    <section class="row justify-content-center">
    	<article class="col-8">
            
            <form action="CambiarDatos.php" method="post" enctype="multipart/form-data">
            <table width="400">
                <tr>
                    <td colspan="4"><h4><strong><?php echo $textos['DatosUsuario'];?></strong></h4></td>
                </tr>
                
                <tr>
                    <td><?php echo $textos['Nombre'];?></td> <td><input type="text" name="Nombre" value=<?php echo $Nombre; ?> required></td>
                    <td><?php echo $textos['Apellido'];?></td> <td><input type="text" name="Apellido" value=<?php echo $Apellido; ?> required></td>
                </tr>

                <tr>
                    <td><?php echo $textos['Clave'];?></td> <td><input type="text" name="Clave" value=<?php echo $Clave; ?> required></td>
                    <td><?php echo $textos['Rol'];?></td> <td><input type="text" name="Rol" value=<?php echo $Rol; ?> required readonly></td>
                </tr>
                <tr>
                    <td><?php echo $textos['Sexo'];?></td> <td><input type="text" name="Sexo" value=<?php echo $Sexo; ?> required></td>
                    <td><?php echo $textos['Edad'];?></td> <td><input type="text" name="Edad" value=<?php echo $Edad; ?> required></td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="button" value="<?php echo $textos['Enviar'];?>" ></td>
                </tr>
            </table>
            </form>
           
        </article>
	</section>
		
	<aside>
		
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
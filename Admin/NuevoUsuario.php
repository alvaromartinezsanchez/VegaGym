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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1, shrinkto-fit=no">
    <meta name="keywords" content="Gimnasio Murcia, Fitnes, Ejercicio">
	<meta name="description" content="Gimnasio Murcia, Fitnes, Ejercicio">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo Usuario</title>
</head>
<?php
        include("./HeaderAdmin.php");
    ?>
		
    <section class="row justify-content-center">
    	<article class="col-8">
            
            <form action="" method="post" enctype="multipart/form-data" class="row justify-content-center" style="border: 1px solid white; margin: 15px;">
            <h3 class="col-12"><?php echo $textos['NuevoUsuario'];?></h3>
            <table class="col-8 table-striped">
                <tr>
                    <td colspan="4">Rol=1 (Admin) Rol=0 (Usuario)</td>
                </tr>
                <tr>
                    <td><?php echo $textos['Activo'];?></td> <td><input type="text" name="Activo" ></td>
                    <td colspan="2">0=Activo  1=No Activo</td>
                </tr>
                <tr>
                    <td><?php echo $textos['Nombre'];?></td> <td><input type="text" name="Nombre"  required></td>
                    <td><?php echo $textos['Apellido'];?></td> <td><input type="text" name="Apellido"  required></td>
                </tr>

                <tr>
                    <td><?php echo $textos['Clave'];?></td> <td><input type="text" name="Clave" required></td>
                    <td><?php echo $textos['Rol'];?></td> <td><input type="text" name="Rol"  required ></td>
                </tr>
                <tr>
                    <td><?php echo $textos['Sexo'];?></td> <td><input type="text" name="Sexo"  required></td>
                    <td><?php echo $textos['Edad'];?></td> <td><input type="text" name="Edad"  required></td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="button" value="<?php echo $textos['Enviar'];?>" ></td>
                </tr>
            </table>
            </form>
            <?php
                if(!empty($_POST['Nombre'])&&isset($_POST['Nombre'])&&isset($_POST['Apellido'])&&isset($_POST['Clave'])&&isset($_POST['Rol'])&&isset($_POST['Sexo'])&&isset($_POST['Edad'])){
                    //Obtenemos nuevos valores y los almacenamos
                    $NuevoNombre=$_POST['Nombre'];
                    $NuevoApellido=$_POST['Apellido'];
                    $NuevoClave=$_POST['Clave'];
                    $NuevoEdad=$_POST['Edad'];
                    $NuevoSexo=$_POST['Sexo'];
                    $NuevoRol=$_POST['Rol'];
                    $NuevoActivo=$_POST['Activo'];

                    $conexion=mysqli_connect('localHost','root','');
                    echo mysqli_error($conexion);

                    mysqli_select_db($conexion, 'gimvm');
                    echo mysqli_error($conexion);
                    //Realizamos la insercion
                    $consulta="INSERT INTO usuarios (Id_Usuario,Nombre,Apellido,Clave,Rol,Activo,Sexo,Edad) VALUES (null,'$NuevoNombre','$NuevoApellido','$NuevoClave','$NuevoRol','$NuevoActivo','$NuevoSexo','$NuevoEdad')";
                    mysqli_query($conexion,$consulta);
                    echo mysqli_error($conexion);
                    ?>
                    <p class="mensaje"><?php echo "Usuario Insertado";?></p><?php
                    mysqli_close($conexion);
                    
                    }
            ?>
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
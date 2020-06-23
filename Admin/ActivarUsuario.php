<?php
/*Cargamos el idioma y el resto de variables de sesion*/
include("../cargarIdioma.php");
if(isset($_SESSION['Id_Usuario'])){
//Cargamos datos de sesion
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
<html lang="es">
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1, shrinkto-fit=no">
    <meta name="keywords" content="Gimnasio Murcia, Fitnes, Ejercicio">
	<meta name="description" content="Gimnasio Murcia, Fitnes, Ejercicio">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ActivarUsuario</title>
        
    </head>
    <script>
            //Activar Usuario
            function activar(Id_U){
                window.location="http://localhost/VegaGym/Admin/Activar.php?Id="+Id_U;
            }
            //Desactivar usuario
            function desactivar(Id_U){
                window.location="http://localhost/VegaGym/Admin/Desactivar.php?Id="+Id_U;
            }
            //VEr ficha
            function verFicha(Id_U){
                window.location="http://localhost/VegaGym/app/reportes/ficha.php?Id="+Id_U;
            }
            

        </script>
	<?php
        include("./HeaderAdmin.php");
    ?>
		
	<section class="row justify-content-center">
    	<article class="col-10">
            <form action="" method="POST" class="row justify-content-center">
            <table border="1px" class="table table-striped col-12 ">
                <thead>
                <tr>
                    <th><?php echo $textos['Id'];?></th>
                    <th><?php echo $textos['Nombre'];?></th>
                    <th><?php echo $textos['Apellido'];?></th>
                    <th><?php echo $textos['Clave'];?></th>
                    <th><?php echo $textos['Rol'];?></th>
                    <th><?php echo $textos['Sexo'];?></th>
                    <th><?php echo $textos['Edad'];?></th>
                    <th><?php echo $textos['Activo'];?></th>
                    <th><?php echo $textos['Ficha'];?></th>
                </tr>   
                </thead>
            
        
        <?php
            $conn=mysqli_connect('localHost','root','');
            echo mysqli_error($conn);
            
            mysqli_select_db($conn,'gimvm');
            echo mysqli_error($conn);

            $consulta= "SELECT * FROM usuarios" ;
            
            $resultado=mysqli_query($conn, $consulta);
            echo mysqli_error($conn);
            $cont=0;
            while ($mostrar = mysqli_fetch_array($resultado)) {
                $cont++;
             ?>
             
             <tr>
                <td><input name="Id_U<?php echo $cont;?>" type="text" value="<?php echo $mostrar['Id_Usuario']?>" readonly></td>
                <td><strong><?php echo $mostrar['Nombre']?></strong></td>
                <td><?php echo $mostrar['Apellido']?></td>
                <td><?php echo $mostrar['Clave']?></td>
                <td><?php echo $mostrar['Rol']?></td>
                <td><?php echo $mostrar['Sexo']?></td>
                <td><?php echo $mostrar['Edad']?></td>
                <td><?php
                    if($mostrar['Activo']==1){
                    ?>
                    <input type="button" onclick="activar('<?php echo $mostrar['Id_Usuario']?>')" value="<?php echo $textos['Activar'];?>">
                    <?php
                    }else{
                    ?>
                    <input type="button" onclick="desactivar('<?php echo $mostrar['Id_Usuario']?>')" value="<?php echo $textos['Desactivar'];?>">
                    <?php
                    }
                    ?>
                </td>
                <td><input type="button" onclick="verFicha('<?php echo $mostrar['Id_Usuario']?>')" value="Ficha"></td>
            </tr>
        <?php
        }

        ?>
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
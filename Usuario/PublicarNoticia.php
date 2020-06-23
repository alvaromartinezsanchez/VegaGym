
<?php
include("../cargarIdioma.php");
if(isset($_SESSION['Id_Usuario'])){
/*Cargamos variables de sesion*/

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
    <title><?php echo $textos['PublicarNoticia'];?></title>
    <script>
        function leer(autor,fecha,noticia,nomAutor){
            window.location="http://localhost/VegaGym/Usuario/VerNoticia.php?Autor="+autor+"&Fecha="+fecha+"&Noticia="+noticia+"&nomAutor="+nomAutor;
        }
    </script>
</head>
<?php
        include("./HeaderUsuario.php");
    ?>
		
    <section class="row justify-content-center">
    	<article class="col-8">
            
            <form action="" method="POST" class="row">
            
            <table border="1px" class="table table-striped">
            
            <tr>
                <th><?php echo $textos['Autor'];?></th>
                <th><?php echo $textos['Fecha'];?></th>
                <th><?php echo $textos['Noticia'];?></th>
            </tr>
        
            <?php
            //Realizamos consulta para mostrar todo de la tabla mensajes
            $conn=mysqli_connect('localHost','root','');
            echo mysqli_error($conn);
            mysqli_select_db($conn,'gimvm');
            echo mysqli_error($conn);
            //Elejimos la consulta
            $consulta= "SELECT * FROM noticias";
            $res=mysqli_query($conn, $consulta);
            echo mysqli_error($conn);
            //mostramos los datos por filas
            while ($mostrar = mysqli_fetch_array($res)) {
                //Guardamos el id de emisor y receptor
                $Autor=$mostrar['Id_Admin'];
                //creamos consulta para obtener nombre
            $ConsultaAutor="SELECT Nombre FROM usuarios WHERE Id_Usuario='$Autor'";
            $NombreAutor=mysqli_query($conn, $ConsultaAutor);
            $rowAutor=mysqli_fetch_assoc($NombreAutor);
            $Autor=$rowAutor['Nombre'];

             ?>
             
             <tr><!--Si el mensje esta leido muestra una imagen y sino otra-->
                
                <td><?php echo $Autor?></td>
                <td><?php echo $mostrar['Fecha']?></td>
                <td><img src="../images/leermsn.jpg" alt="leer" onclick="leer('<?php echo $mostrar['Id_Admin']?>' , '<?php echo $mostrar['Fecha']?>' , '<?php echo $mostrar['Noticia']?>' ,'<?php echo $Autor?>')"></td>
                
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
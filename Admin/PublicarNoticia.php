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
    <title>Noticias</title>
    <script>
        function leer(autor,fecha,noticia,nomAutor){
            window.location="http://localhost/VegaGym/Admin/VerNoticia.php?Autor="+autor+"&Fecha="+fecha+"&Noticia="+noticia+"&nomAutor="+nomAutor;
        }
    </script>
</head>
<?php
        include("./HeaderAdmin.php");
    ?>
		
    <section class="row justify-content-center">
    	<article class="col-8">
            
            <form action="" method="post" enctype="multipart/form-data" class="row justify-content-center">
            <table class="col-12 table table-striped">
                <tr>
                    <th colspan="4"><h3><?php echo $textos['PublicarNoticia'];?></h3></th>
                </tr>
                
                <tr>
                    <td><?php echo $textos['Noticia'];?></td> <td><input type="text" name="Noticia" required></td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="button" value="<?php echo $textos['Enviar'];?>" ></td>
                </tr>
                
            </table>
            </form>
            <?php
                if(!empty($_POST['Noticia'])&&isset($_POST['Noticia'])){
                    //Obtenemos valores de Noticia y fecha
                    $Noticia=$_POST['Noticia'];
                    $Fecha=date("j-m-Y h:i");
                    //REalizamos cONEXION
                    $conexion=mysqli_connect('localHost','root','');
                    echo mysqli_error($conexion);
                    mysqli_select_db($conexion, 'gimvm');
                    echo mysqli_error($conexion);
                    //Realizamos la insercion
                    $consulta="INSERT INTO noticias(Id_Admin,Fecha,Noticia) VALUE('$Id','$Fecha','$Noticia')";
                    mysqli_query($conexion,$consulta);
                    echo mysqli_error($conexion);
                    echo "Noticia Publicada con Exito";
                    mysqli_close($conexion);
                  
                }

            ?>
        </article>
        <article>
            
            <form action="" method="POST" class="row justify-content-center" style="margin-top: 45px;">
            <h3><?php echo $textos['Publicadas'];?></h3>
            <table border="1px" class="col-12 table table-striped">
            
            <tr>
                <th><?php echo $textos['Autor'];?></th>
                <th><?php echo $textos['Fecha'];?></th>
                <th><?php echo $textos['Noticia'];?></th>
            </tr>
        
            <?php
            //Realizamos consulta para mostrar todo de la tabla noticias
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
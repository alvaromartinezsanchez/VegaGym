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
    <title><?php echo $textos['EnviarMensaje'];?></title>
    <script>
        function leer(emisor,receptor,fecha,mensaje){
            window.location="http://localhost/VegaGym/Admin/LeerMensaje.php?Emisor="+emisor+"&Receptor="+receptor+"&Fecha="+fecha+"&Mensaje="+mensaje;
        }
        function borrar(emisor,receptor,fecha,mensaje){
            window.location="http://localhost/VegaGym/Admin/BorrarMensaje.php?Emisor="+emisor+"&Receptor="+receptor+"&Fecha="+fecha+"&Mensaje="+mensaje;
        }
    </script>
</head>
<?php
        include("./HeaderAdmin.php");
    ?>
		
    <section class="row justify-content-center">
    	<article class="col-10">
            
            <form action="" method="post" enctype="multipart/form-data" class="row justify-content-center">
            <table class="table table-striped col-12">
                <tr>
                    <td colspan="4"><h3><?php echo $textos['EnviarMensaje'];?></h3></td>
                </tr>
                
                <tr>
                    <td><h5><?php echo $textos['Nombre'];?></h5></td> <td><input type="text" name="Nombre" required></td>
                    <td><h5><?php echo $textos['Apellido'];?></h5></td> <td><input type="text" name="Apellido" required></td>
                </tr>

                
                <tr>
                    <td><h5><?php echo $textos['Asunto'];?></h5></td> <td><input type="text" name="Asunto" required></td>
                    <td><h5><?php echo $textos['Mensaje'];?></h5></td> <td><input type="text" name="Mensaje" required></td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="button" value="<?php echo $textos['Enviar'];?>" class="btn btn-dark"></td>
                </tr>
            </table>
            </form>
            <?php
                if(!empty($_POST['Nombre'])&&isset($_POST['Nombre'])&&isset($_POST['Apellido'])){
                    //Obtenemos valores de nombre y apellido introducidos por usuario
                    $NuevoNombre=$_POST['Nombre'];
                    $NuevoApellido=$_POST['Apellido'];
                    //REalizamos consulta para ver si el nombre y el apellido existes y averiguar su id
                    $conexion=mysqli_connect('localHost','root','');
                    echo mysqli_error($conexion);
                    mysqli_select_db($conexion, 'gimvm');
                    echo mysqli_error($conexion);
                    //consulta
                    $consulta="SELECT Id_Usuario FROM usuarios WHERE Nombre='$NuevoNombre' and Apellido='$NuevoApellido'";
                    //Ejecutamos la consulta y la almacenamos en variable $resultId(array)
                    //(debe contener una linea si existe usuario y contraseña o ninguna si no existe)
                    $resultId=mysqli_query($conexion, $consulta);
                    //La función mysqli_fetch_assoc () obtiene una fila de resultado como una matriz asociativa
                    $row=mysqli_fetch_assoc($resultId);
                    //Ahora podemos acceder a los datos pos su nombre de campo($row-->Array ['Nombre campo']-->Indice)
                    //Si el resultado de la consulta es 1 el usuario receptor existe si es 0 no existe
                    if(mysqli_num_rows($resultId)==1){
                    //Guardamos el Id del Emisor obtenido en la consulta
                    $Id_Receptor=$row['Id_Usuario'];
                    $Asunto=$_POST['Asunto'];
                    $Mensaje=$_POST['Mensaje'];
                    //Guardamos la fecha actual "Dia-Mes-Año hora:minuto:segundo" almacenamos como datos numericos en una cadena String
                    $Fecha=date("j-m-Y h:i:s ");
                    //Realizamos la insercion
                    $consulta="INSERT INTO mensajes(Id_Emisor,Id_Receptor,Fecha,Leido,Asunto,Mensaje) VALUE('$Id','$Id_Receptor','$Fecha',0,'$Asunto','$Mensaje')";
                    mysqli_query($conexion,$consulta);
                    echo mysqli_error($conexion);
                    echo "Mensaje Enviado";
                    mysqli_close($conexion);
                    }
                    //si la respuesta de la consulta es 0 indicamos que no existe el usuario
                    else{
                        ?>
                        <p class="mensaje"><?php echo "El usuario indicado no se encuentra en el sistema"; ?></p> <?php 
                    }
                }

            ?>
        
        </article>
        
            <form action="" method="POST" class="row justify-content-center">
            <h3>Filtrado:</h3> 
            <select name="filtrado" id="filtrado" onChange="submit()">
                <?php
                    if (isset($_POST['filtrado'])&&$_POST['filtrado']=="Todos") {
                    ?>  
                        <option value="Todos">Todos</option>
                        <option value="Usuario">Usuario</option>
                    <?php  
                    }else{
                ?>
                <option value="Usuario">Usuario</option>
                <option value="Todos">Todos</option>
                <?php
                    }
                ?>
                
            </select>
            <table border="1px" class="table table-striped col-12">
            
            <tr>
                <th><strong><?php echo $textos['Leido'];?></strong></th>
                <th><strong><?php echo $textos['EnviadoPor'];?></strong></th>
                <th><strong><?php echo $textos['Fecha'];?></strong></th>
                <th><strong><?php echo $textos['Asunto'];?></strong></th>
                <th><strong><?php echo $textos['Leer'];?></strong></th>
                <th><strong><?php echo $textos['Borrar'];?></strong></th>
            </tr>
        
            <?php
            //Realizamos consulta para mostrar todo de la tabla mensajes
            $conn=mysqli_connect('localHost','root','');
            echo mysqli_error($conn);
            mysqli_select_db($conn,'gimvm');
            echo mysqli_error($conn);
            //Elejimos la consulta segun el filtro para todos o solo los mensajes del usuario
            if(isset($_POST['filtrado'])&&$_POST['filtrado']=="Todos"){
                $consulta= "SELECT * FROM mensajes" ;
            }else{
                $consulta= "SELECT * FROM mensajes WHERE Id_Receptor='$Id'" ;
            }
            
            $resultado=mysqli_query($conn, $consulta);
            echo mysqli_error($conn);
            //mostramos los datos por filas
            while ($mostrar = mysqli_fetch_array($resultado)) {
                //Guardamos el id de emisor y receptor
                $id_Em=$mostrar['Id_Emisor'];
                $id_Re=$mostrar['Id_Receptor'];
                //creamos consulta para obtener nombre
            $ConsultaEmisor="SELECT Nombre FROM usuarios WHERE Id_Usuario='$id_Em'";
            $ConsultaReceptor="SELECT Nombre FROM usuarios WHERE Id_Usuario='$id_Re'";
            $NombreEmi=mysqli_query($conn, $ConsultaEmisor);
            $NombreRe=mysqli_query($conn, $ConsultaReceptor);
            $rowEmi=mysqli_fetch_assoc($NombreEmi);
            $rowRe=mysqli_fetch_assoc($NombreRe);
            $Emisor=$rowEmi['Nombre'];
            $Receptor=$rowRe['Nombre'];

             ?>
             
             <tr><!--Si el mensje esta leido muestra una imagen y sino otra-->
                <td><?php if($mostrar['Leido']==0){?>
                    <img src="../images/msn.jpg" alt="mensaje">
                <?php
                }else{?>
                    <img src="../images/msnAbierto.jpg" alt="mensaje">
                <?php
                }
                ?>
                    
                </td>
                <td><?php echo $Emisor?></td>
                <td><?php echo $mostrar['Fecha']?></td>
                <td><?php echo $mostrar['Asunto']?></td>
                <td><img src="../images/leermsn.jpg" alt="leer" onclick="leer('<?php echo $mostrar['Id_Emisor']?>' , '<?php echo $mostrar['Id_Receptor']?>' , '<?php echo $mostrar['Fecha']?>' ,'<?php echo $mostrar['Mensaje']?>')"></td>
                <td><img src="../images/borrar.jpg" alt="borrar" onclick="borrar('<?php echo $mostrar['Id_Emisor']?>' , '<?php echo $mostrar['Id_Receptor']?>' , '<?php echo $mostrar['Fecha']?>' ,'<?php echo $mostrar['Mensaje']?>')"></td>
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
<?php
/*Cargamos el idioma y el resto de variables de sesion*/
include("../cargarIdioma.php");
//Cargamos datos de sesion
 $Id=$_SESSION['Id_Usuario'];
 $Nombre=$_SESSION['Nombre'];
 $Apellido=$_SESSION['Apellido'];
 $Clave=$_SESSION['Clave'];
 $Rol=$_SESSION['Rol'];
 $Activo=$_SESSION['Activo'];
 $Sexo=$_SESSION['Sexo'];
 $Edad=$_SESSION['Edad'];

 //efectuamos cambios
 if(isset($_POST['selector'])){
     $NuevoEstado=$_POST['selector'];
     if($NuevoEstado=="Si"){
         $NuevoEstado=0;
     }else{
         $NuevoEstado=1;
     }
     echo $NuevoEstado;
     $Id_U=$_POST['Id_U'];
    $conexion=mysqli_connect('localHost','root','');
    echo mysqli_error($conexion);

    mysqli_select_db($conexion, 'gimvm');
    echo mysqli_error($conexion);
    $consulta="UPDATE usuarios SET Activo='$NuevoEstado' WHERE Id_Usuario='$Id_U' ";
    mysqli_query($conexion,$consulta);
    echo mysqli_error($conexion);
    echo "Cambios realizados";
    mysqli_close($conexion);
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="">
        <meta name="description" content="">
        <link href="../css/estilosInicio.css" rel="stylesheet" type="text/css">
		<title>PruebaUsuario</title>
	</head>
	<body>
    <?php
        include("../Inicio/HeaderInicio.php");
        include("./MenuAdmin.php");
    ?>
		
		<section>
            <article>
            <form action="" method="POST">
            <table border="1px">
            <tr>
                <td>Id_Usuario:</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Clave</td>
                <td>Rol</td>
                <td>Sexo</td>
                <td>Edad</td>
                <td>Activo</td>
            </tr>
        
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
                <td><?php echo $mostrar['Nombre']?></td>
                <td><?php echo $mostrar['Apellido']?></td>
                <td><?php echo $mostrar['Clave']?></td>
                <td><?php echo $mostrar['Rol']?></td>
                <td><?php echo $mostrar['Sexo']?></td>
                <td><?php echo $mostrar['Edad']?></td>
                <td><select name="selector<?php echo $cont;?>" onChange="cambiar(<?php echo $cont;?>)">
                    <?php if($mostrar['Activo']==0){
                        ?>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                        <?php
                    }else{
                        ?>
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                        <?php
                    }
                    ?>
                    
                </select></td>
            </tr>
        <?php
        }
        
         //efectuamos cambios
        function cambiar($Id_cambio){
        $NuevoEstado=$_POST['selector'];
        if($NuevoEstado=="Si"){
            $NuevoEstado=0;
        }else{
            $NuevoEstado=1;
        }
        echo $NuevoEstado;
        $Id_U=$Id_cambio;
        $conexion=mysqli_connect('localHost','root','');
        echo mysqli_error($conexion);

        mysqli_select_db($conexion, 'gimvm');
        echo mysqli_error($conexion);
        $consulta="UPDATE usuarios SET Activo='$NuevoEstado' WHERE Id_Usuario='$Id_U' ";
        mysqli_query($conexion,$consulta);
        echo mysqli_error($conexion);
        echo "Cambios realizados";
        mysqli_close($conexion);
        header("Location: PruebaUsuario.php");
        }
        ?>
            </table>
        </form>
            </article>
		</section>
		
		<aside>
		
		</aside>
		
		<footer>
		
		</footer>
	</body>
</html>
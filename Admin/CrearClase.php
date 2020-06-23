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
    <title><?php echo $textos['CrearClase'];?></title>
    <style>
        td{ font-size: 15px bold;}
    </style>
</head>
<?php
        include("./HeaderAdmin.php");
    ?>
		
<section class="row justify-content-center">
    <article class="col-10">
            
        <form action="" method="post" enctype="multipart/form-data">
            <table width="400" class="table table-striped">
                <tr>
                    <th colspan="4"><h3><?php echo $textos['CrearClase'];?></h3></th>
                </tr>
                <tr>
                    <td><?php echo $textos['Nombre'];?></td> <td><input type="text" name="Nombre" required ></td>
                </tr>
                <tr>
                    <td><?php echo $textos['Plazas'];?></td> <td><input type="text" name="Plazas" required></td>
                    <td><?php echo $textos['PlazasDisponibles'];?></td> <td><input type="text" name="Plazas_Disponibles" required></td>
                </tr>

                <tr>
                    <td><?php echo $textos['Horario'];?></td> <td><input type="text" name="Horario" required></td>
                    <td>dd/mm  hh:mm</td>
                </tr>
                <tr>
                    <td><?php echo $textos['Profesor'];?></td> <td><input type="text" name="Profesor" required ></td>
                    <td><?php echo $textos['Descripcion'];?></td> <td><input type="text" name="Descripcion" required></td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="button" value="<?php echo $textos['Crear'];?>" ></td>
                </tr>
            </table>
            </form>
            <?php
                if(!empty($_POST['Nombre'])&&isset($_POST['Nombre'])&&isset($_POST['Plazas'])&&isset($_POST['Plazas_Disponibles'])&&isset($_POST['Horario'])&&isset($_POST['Profesor'])&&isset($_POST['Descripcion'])){
                    //Obtenemos valores y los almacenamos
                    $Nombre=$_POST['Nombre'];
                    $Horario=$_POST['Horario'];
                    $Plazas=$_POST['Plazas'];
                    $Plazas_Disponibles=$_POST['Plazas_Disponibles'];
                    $Profesor=$_POST['Profesor'];
                    $Descripcion=$_POST['Descripcion'];

                    $conexion=mysqli_connect('localHost','root','');
                    echo mysqli_error($conexion);

                    mysqli_select_db($conexion, 'gimvm');
                    echo mysqli_error($conexion);
                    //Realizamos la insercion
                    $consulta="INSERT INTO clases (Nombre,Horario,Plazas,Plazas_Disponibles,Profesor,Descripcion) VALUES ('$Nombre','$Horario','$Plazas','$Plazas_Disponibles','$Profesor','$Descripcion')";
                    mysqli_query($conexion,$consulta);
                    echo mysqli_error($conexion);
                    echo "Clase Insertada";
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
<?php  
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
    <title><?php echo $textos['Historial'];?></title>
</head>

<script>
    function Reservas() {
        window.location="http://localhost/VegaGym/Usuario/verReservas.php";
    }
    function Actividades() {
        window.location="http://localhost/VegaGym/Usuario/Actividades.php";
    }
</script>
   <?php
   $Id_Usuario=$_SESSION["Id_Usuario"];
   ?>
   <?php
        include("./HeaderUsuario.php");
    ?> 
   <section class="row justify-content-center">
    	<article class="col-10">
            <form action="" method="POST">
                <h3><?php echo $textos['HistorialActividades'];?></h3>
            <table border="1px" class="table table-striped">
            <tr>
                
                <td><?php echo $textos['Nombre'];?></td>
                <td><?php echo $textos['Horario'];?></td>
                <td><?php echo $textos['Profesor'];?></td>
            </tr>
        
        <?php
            $conn=mysqli_connect('localHost','root','');
            echo mysqli_error($conn);
            mysqli_select_db($conn,'gimvm');
            echo mysqli_error($conn);
            $consulta= "SELECT * FROM reservas WHERE Id_Usuario='$Id_Usuario' AND Asiste=1 " ;
            $resultado=mysqli_query($conn, $consulta);
            echo mysqli_error($conn);

            while ($mostrar = mysqli_fetch_assoc($resultado)) {
             ?>
             
             <tr>
                
                <td><strong><?php echo $mostrar['Nombre']?></strong></td>
                <td><?php echo $mostrar['Horario']?></td>
                <td><?php echo $mostrar['Profesor']?></td>
                
            </tr>
        <?php
        }

        ?>
            </table>
            <input type="button" onclick="Reservas()" value="<?php echo $textos['Reservas'];?>">
            <input type="button" onclick="Actividades()" value="<?php echo $textos['Actividades'];?>">
        </form>
            </article>
        </section>
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
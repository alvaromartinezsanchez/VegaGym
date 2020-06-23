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
    <title>Document</title>
</head>
    
    <script>
       //Cambia el numero de plazas +1 y borra el registro a reservas
       function cancelar(nombre,horario,profesor,plazas,plazas_disponibles){
            window.location="http://localhost/VegaGym/Usuario/Cancelar.php?Nombre="+nombre+"&Horario="+horario+"&Profesor="+profesor+"&Plazas="+plazas+"&Plazas_Disponibles="+plazas_disponibles;
            
        }

        //Boton Asiste para activar la asistencia a la clase
        function Asiste(nombre,horario,profesor) {
            window.location="http://localhost/VegaGym/Usuario/Asiste.php?Nombre="+nombre+"&Horario="+horario+"&Profesor="+profesor; 
        }
        //Ver Historial de Actividades
        function verHistorial() {
            window.location="http://localhost/VegaGym/Usuario/Historial.php";
        }
        //Volver a Actividades
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
            <form action="" method="POST" class="row">
            <h3><?php echo $textos['Reservas'];?></h3>
            <table border="1px" class="table col-12">
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
            $consulta= "SELECT * FROM reservas WHERE Id_Usuario='$Id_Usuario' AND Asiste=0 " ;
            $resultado=mysqli_query($conn, $consulta);
            echo mysqli_error($conn);

            while ($mostrar = mysqli_fetch_assoc($resultado)) {
             ?>
             
             <tr>
                
                <td><?php echo $mostrar['Nombre']?></td>
                <td><?php echo $mostrar['Horario']?></td>
                <td><?php echo $mostrar['Profesor']?></td>
                <td>
                    <?php
                    //consulta tabla clases,obtenemos plazas disponibles y plazas para poder cancelar
                    $nom=$mostrar['Nombre'];
                    $hora=$mostrar['Horario'];
                    $pro=$mostrar['Profesor'];
                    $consultaClase= "SELECT * FROM clases WHERE Nombre='$nom' AND Horario='$hora' AND Profesor='$pro'" ;
                    $resultadoClase=mysqli_query($conn, $consultaClase);
                    echo mysqli_error($conn);
                    //Utilizamos variable row para poder pasarle los parametros de las plazas y las plazas disponibles 
                    $row=mysqli_fetch_assoc($resultadoClase);
                    ?>
                    <input type="button" onclick="cancelar('<?php echo $mostrar['Nombre']?>','<?php echo $mostrar['Horario']?>','<?php echo $mostrar['Profesor']?>','<?php echo $row['Plazas']?>','<?php echo $row['Plazas_Disponibles']?>')" value="cancelar">
                    <input type="button" onclick="Asiste('<?php echo $mostrar['Nombre']?>','<?php echo $mostrar['Horario']?>','<?php echo $mostrar['Profesor']?>')" value="Asiste">
                </td>
            </tr>
        <?php
        }

        ?>
            </table>
            <input type="button" onclick="verHistorial()" value="Historial">
            <input type="button" onclick="Actividades()" value="Actividades">
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

<?php
include("../cargarIdioma.php");
if(isset($_SESSION['Id_Usuario'])){
//datos de usuario con sesion abierta
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
    <title><?php echo $textos['Actividades'];?></title>
    <script>
        //Ver Reservas
        function verReservas(Usuario){
            window.location="http://localhost/VegaGym/Usuario/verReservas.php?Id_Usuario="+Usuario;
        }

        //Cambia el numero de plazas -1 y añade el registro a reservas
        function cambiar(nombre,horario,profesor,plazas,plazas_disponibles){
            //Comprovamos que hay plazas disponibles
            if(plazas_disponibles==0){
                alert("Lo sentimos..No quedan plazas disponibles");
            }else{
                window.location="http://localhost/VegaGym/Usuario/Reservar.php?Nombre="+nombre+"&Horario="+horario+"&Profesor="+profesor+"&Plazas="+plazas+"&Plazas_Disponibles="+plazas_disponibles;
            }
            
        }
        //Cambia el numero de plazas +1 y borra el registro a reservas
        function cancelar(nombre,horario,profesor,plazas,plazas_disponibles){
            window.location="http://localhost/VegaGym/Usuario/Cancelar.php?Nombre="+nombre+"&Horario="+horario+"&Profesor="+profesor+"&Plazas="+plazas+"&Plazas_Disponibles="+plazas_disponibles;
            
        }
        //Generar pdf de Justificante
        function verJustificante(nombre,horario,profesor){
            window.location="http://localhost/VegaGym/app/reportes/justificante.php?Nombre="+nombre+"&Horario="+horario+"&Profesor="+profesor;
            
        }
    </script>
    
</head>
<?php
        include("./HeaderUsuario.php");
    ?>
		
    <section class="row justify-content-center">
    	<article class="col-10">
            <form action="" method="POST" class="row justify-content-center" style="margin: 15px">
            <h3><?php echo $textos['Actividades'];?></h3>
            <table border="1px" class="table table-striped table-hover col-12">
            <tr>
                
                <th><?php echo $textos['Nombre'];?></th>
                <th><?php echo $textos['Horario'];?></th>
                <th><?php echo $textos['Plazas'];?></th>
                <th><?php echo $textos['PlazasDisponibles'];?></th>
                <th><?php echo $textos['Profesor'];?></th>
                <th><?php echo $textos['Descripcion'];?></th>
                <th><?php echo $textos['Reservada'];?></th>
            </tr>
        
        <?php
            $conn=mysqli_connect('localHost','root','');
            echo mysqli_error($conn);
            mysqli_select_db($conn,'gimvm');
            echo mysqli_error($conn);
            $consulta= "SELECT * FROM clases" ;
            $resultado=mysqli_query($conn, $consulta);
            echo mysqli_error($conn);

            while ($mostrar = mysqli_fetch_assoc($resultado)) {
                //Filtro para que no aparezca una clase a la que ya hemos asistido
                $nom=$mostrar['Nombre'];
                $hora=$mostrar['Horario'];
                $pro=$mostrar['Profesor'];
                $consultaAsiste= "SELECT * FROM reservas WHERE Nombre='$nom' AND Horario='$hora' AND Profesor='$pro' AND Id_Usuario='$Id' " ;
                $resultadoAsiste=mysqli_query($conn, $consultaAsiste);
                echo mysqli_error($conn);
                //Utilizamos variable row para poder pasarle los parametros de las plazas y las plazas disponibles 
                $row2=mysqli_fetch_assoc($resultadoAsiste);
                if($row2['Asiste']==0){
             ?>
             
             <tr>
                
                <td><?php echo $mostrar['Nombre']?></td>
                <td><?php echo $mostrar['Horario']?></td>
                <td><?php echo $mostrar['Plazas']?></td>
                <td><?php echo $mostrar['Plazas_Disponibles']?></td>
                <td><?php echo $mostrar['Profesor']?></td>
                <td><?php echo $mostrar['Descripcion']?></td>
                <td>
                    <?php
                    //Filtro para mostrar botones reservar o cancelar y justificante
                    $nom=$mostrar['Nombre'];
                    $hora=$mostrar['Horario'];
                    $pro=$mostrar['Profesor'];
                    $ConsultaReserva="SELECT * FROM reservas WHERE Nombre='$nom' AND Horario='$hora' AND Profesor='$pro' AND Id_Usuario='$Id' ";
                    $reservada=mysqli_query($conn, $ConsultaReserva);
                    echo mysqli_error($conn);
                    $row=mysqli_fetch_assoc($reservada);
                    //si el resultado es 0 es que no tiene reserva
                    if(mysqli_num_rows($reservada)==0){
                    ?>
                    <input type="button" onclick="cambiar('<?php echo $mostrar['Nombre']?>','<?php echo $mostrar['Horario']?>','<?php echo $mostrar['Profesor']?>','<?php echo $mostrar['Plazas']?>','<?php echo $mostrar['Plazas_Disponibles']?>')" value="reservar">
                    <?php
                    }else{
                    ?>
                    <input type="button" onclick="cancelar('<?php echo $mostrar['Nombre']?>','<?php echo $mostrar['Horario']?>','<?php echo $mostrar['Profesor']?>','<?php echo $mostrar['Plazas']?>','<?php echo $mostrar['Plazas_Disponibles']?>')" value="cancelar">
                    <input type="button" onclick="verJustificante('<?php echo $mostrar['Nombre']?>','<?php echo $mostrar['Horario']?>','<?php echo $mostrar['Profesor']?>')" value="ver Justificante">
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        }

        ?>
            </table>
        </form>
            </article>
            <div class="col align-self-center">
                <button onclick="verReservas('<?php echo $Id ?>')">Ver reservas</button>
            </div>
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
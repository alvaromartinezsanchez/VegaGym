<?php
include("../idioma.php");
function guardarSesion($row2){
    $_SESSION['Id_Usuario']=$row2['Id_Usuario'];
    $_SESSION['Nombre']=$row2['Nombre'];
    $_SESSION['Apellido']=$row2['Apellido'];
    $_SESSION['Clave']=$row2['Clave'];
    $_SESSION['Rol']=$row2['Rol'];
    $_SESSION['Activo']=$row2['Activo'];
    $_SESSION['Sexo']=$row2['Sexo'];
    $_SESSION['Edad']=$row2['Edad'];
}
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
    <title><?php echo $textos['InicioTitulo'];?></title>
</head>
<?php
    //CARGA EL ESTILO , LA APERTURA DEL BODY Y EL HEADER
    include("./HeaderInicio.php");
    ?>
    <section class="row justify-content-center">
        <article class="col-9">
            <form method="post" action="" class="row justify-content-center">
            
            <legend class="col-6"><?php echo $textos['Cabecera'];?></legend>
            <!-- Nombre -->
            <div id="BloqueFormulario" class="col-8 p-1">
                <!-- Icono Usuario Y texto -->
	            <label for="Email"><strong><img src="../images/usuario.png" width="24" height="24" align="left"><?php echo $textos['Nombre'];?></strong>:</label>
                <!-- Cuadro de texto  -->
                <input name="nombre" id="nombre" value="" size="40" maxlength="100" type="text" class="CampoFormulario" required>
            </div>
            <!-- Clave -->
            <div id="BloqueFormulario" class="col-8 p-1">
                <!-- Icono y texto -->
	            <label for="Contrasena"> <strong><img src="../images/usuario.png" width="24" height="24" align="left"><?php echo $textos['Contraseña'];?></strong>:</label>
                <!-- Cuadro de texto -->
                <input name="clave" id="clave" value="" size="40" maxlength="50" type="password" class="CampoFormulario" required>
            </div>
            <!-- Idioma -->
            <div id="BloqueFormulario" class="col-8 p-1">
                <!-- Imagenes y texto -->
                <label for="Idioma"> <strong><img src="../images/idiomas.jpg" width="48" height="24" align="left"><?php echo $textos['Idioma'];?></strong>:</label>
                <!-- Selector  -->
                <select name="idioma" id="idioma" class="CampoFormulario" onChange="submit()";>
            <img src="idiomas.jpg">
            <?php
            if (isset($_SESSION["idioma"])){
                if ($_SESSION["idioma"]=="en"){
                ?>
                    <option value="en"><?php echo $textos['Ingles'];?></option>
                    <option value="es"><?php echo $textos['Espanol'];?></option>
                    <?php
                }
            else{
            ?>
            <option value="es"><?php echo $textos['Espanol'];?></option>
            <option value="en"><?php echo $textos['Ingles'];?></option>
            <?php }
                }else{
                ?>
            <option value="es"><?php echo $textos['Espanol'];?></option>
            <option value="en"><?php echo $textos['Ingles'];?></option>
            <?php }
            ?>
            </select>
            <input name="boton" type="submit" value="<?php echo $textos['Boton-Entrar'];?>">
            
            </form>
        </article>
    </section>
     
    <?php
        /*Esto se ejecuta si hemos introducido valores y pulsamos el boton*/
        if(isset($_POST['nombre'])&&isset($_POST['clave'])){
           //Almacenamos el valor de los campos en variables
            $nombre=$_POST['nombre'];
            $clave=$_POST['clave'];
            //Indicamos la conexion con servidor
            $conn=mysqli_connect('localHost','root','');
            echo mysqli_error($conn);
            //Indicamos nombre Base de Datos
            mysqli_select_db($conn,'gimVM');
            echo mysqli_error($conn);
            //Indicamos la Consulta selecciona todo del usuario con nombre y clave introducidas en campos
            $consultaId= "SELECT * FROM usuarios WHERE Nombre='$nombre' AND Clave='$clave'";
            //Ejecutamos la consulta y la almacenamos en variable $resultId(array)
            //(debe contener una linea si existe usuario y contraseña o ninguna si no existe)
            $resultId=mysqli_query($conn, $consultaId);
            //La función mysqli_fetch_assoc () obtiene una fila de resultado como una matriz asociativa
            $row=mysqli_fetch_assoc($resultId);
            //Ahora podemos acceder a los datos pos su nombre de campo($row-->Array ['Nombre campo']-->Indice)
            
            //si el resultado es una linea
            if(mysqli_num_rows($resultId)==1){
                //Usuario normal Rol-->0  Activo-->0
                if ($row['Activo']==0 && $row['Rol']==0 ){
                    header("Location: ../Usuario/Bienvenida.php");
                    guardarSesion($row);

                }
                //Administrador Rol-->1  Activo-->0
                elseif($row['Activo']==0 && $row['Rol']==1 ){
                    header("Location: ../Admin/Bienvenida.php");
                    guardarSesion($row);
                }
                //Usuario o admin que no este activo Activo-->1
                elseif($row['Activo']==1 ){
                    ?>
                    <p class="mensaje"><?php echo "USUARIO BLOQUEADO, CONTACTA CON EL ADMINISTRADOR..!!"; ?></p>   
                    
                    <?php
                }
            }
            //si el resultado de la consulta es vacio
            else{
                //evita que se ejecute al cargar la pagina con los campos vacios
                if($nombre!=""||$clave!=""){
                    //se ejecuta si introducimos datos y el resultado de la consulta es vacio(no registrado en el sitema)
                    ?>
                    <p class="mensaje"><?php echo "USUARIO NO REGISTRADO"; ?></p>   
                    
                    <?php
                }
                
            }

        }
    //CARGA EL FOOTER CON ESTILOS DEFINIDOS EN HEADER
    include("./FooterInicio.php");
    ?>    
            
      
</body>
</html>
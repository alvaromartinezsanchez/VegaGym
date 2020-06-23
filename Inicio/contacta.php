<?php  include("../cargarIdioma.php")?>
<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1, shrinkto-fit=no">
    <meta name="keywords" content="Gimnasio Murcia, Fitnes, Ejercicio">
	<meta name="description" content="Gimnasio Murcia, Fitnes, Ejercicio">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
		<title>Contacto</title>
	</head>
	<?php
    include("./HeaderInicio.php");
    ?>
		
	<section class="row justify-content-center">
    	<article class="col-10">
            <hr>
            <br>
            <div class="row">
                <h3 class="col-12" style="color: white;"><?php echo $textos['ContactaAdministracion'];?></h3>
            </div>
            <div class="row">
                <form action="" method="post" enctype="multipart/form-data" class="col-8">
                    <table width="400">
                        <tr>
                            <td colspan="2"> Nombre: Admin</td><td colspan="2"> Apellido: Alvaro</td>
                        </tr>

                        <tr>
                            <td><?php echo $textos['Nombre'];?></td> <td><input type="text" name="Nombre" required></td>
                            <td><?php echo $textos['Apellido'];?></td> <td><input type="text" name="Apellido" required></td>
                        </tr>


                        <tr>
                            <td><?php echo $textos['Asunto'];?></td> <td><input type="text" name="Asunto" required></td>
                            <td><?php echo $textos['Mensaje'];?></td> <td><input type="text" name="Mensaje" required></td>
                        </tr>

                        <tr>
                            <td><input type="submit" name="button" value="<?php echo $textos['Enviar'];?>" ></td>
                        </tr>
                    </table>
                </form>
            </div>
            
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
                    $consulta="INSERT INTO mensajes(Id_Emisor,Id_Receptor,Fecha,Leido,Asunto,Mensaje) VALUE(666,'$Id_Receptor','$Fecha',0,'$Asunto','$Mensaje')";
                    mysqli_query($conexion,$consulta);
                    echo mysqli_error($conexion);
                    echo "Mensaje Enviado";
                    mysqli_close($conexion);
                    }
                    //si la respuesta de la consulta es 0 indicamos que no existe el usuario
                    else{
                         echo "El usuario indicado no se encuentra en el sistema";
                    }
                }

            ?>
            <br>
            <hr>
            <h3 style="color: white;"><?php echo $textos['Registrate'];?></h3>
			<form action="" method="post" enctype="multipart/form-data" class="col-8">
            <table width="400">
                <tr>
                    <td colspan="4">Registro Usuario</td>
                </tr>
                
                <tr>
                    <td><?php echo $textos['Nombre'];?></td> <td><input type="text" name="Nombre" required></td>
                    <td><?php echo $textos['Apellido'];?></td> <td><input type="text" name="Apellido" required></td>
                </tr>

                <tr>
                    <td><?php echo $textos['Clave'];?></td> <td><input type="text" name="Clave" required></td>
                </tr>
                <tr>
                    <td><?php echo $textos['Sexo'];?></td> <td><input type="text" name="Sexo" required></td>
                    <td><?php echo $textos['Edad'];?></td> <td><input type="text" name="Edad" required></td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="button" value="<?php echo $textos['Enviar'];?>" ></td>
                </tr>
            </table>
            </form>
            <?php
                if(!empty($_POST['Nombre'])&&isset($_POST['Nombre'])&&isset($_POST['Apellido'])&&isset($_POST['Clave'])&&isset($_POST['Sexo'])&&isset($_POST['Edad'])){
                    //Obtenemos nuevos valores y los almacenamos
                    $NuevoNombre=$_POST['Nombre'];
                    $NuevoApellido=$_POST['Apellido'];
                    $NuevoClave=$_POST['Clave'];
                    $NuevoEdad=$_POST['Edad'];
                    $NuevoSexo=$_POST['Sexo'];

                    $conexion=mysqli_connect('localHost','root','');
                    echo mysqli_error($conexion);

                    mysqli_select_db($conexion, 'gimvm');
                    echo mysqli_error($conexion);
                    //Realizamos la insercion
                    $consulta="INSERT INTO usuarios (Id_Usuario,Nombre,Apellido,Clave,Rol,Activo,Sexo,Edad) VALUES (null,'$NuevoNombre','$NuevoApellido','$NuevoClave',0,1,'$NuevoSexo','$NuevoEdad')";
                    mysqli_query($conexion,$consulta);
                    echo mysqli_error($conexion);
                    echo "Usuario Insertado";
                    mysqli_close($conexion);
                    
                    }
            ?>
			</article>
		
			
		
		</section>
		
		<aside class="row justify-content-center">
			<p class="col-8 h3 mensaje"><?php echo $textos['AsideParrafo1']; ?></p>
			<p class="col-8 h3 mensaje"><?php echo $textos['AsideParrafo2']; ?></p>
        </aside>
        <article>
				<header class="row">
                    <h1 class="col-8"><?php echo $textos['DondeEstamos']; ?></h1>
                </header>
                <div class="row justify-content-center">
                <iframe class="col-8" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1575.2153204331062!2d-1.4234472060078185!3d37.85021297093089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd648ef3082b53ad%3A0xdacc71c0ee263a07!2sCalle%20Gral.%20Garc%C3%ADa%20D%C3%ADaz%2C%2030840%20Alhama%20de%20Murcia%2C%20Murcia!5e0!3m2!1ses!2ses!4v1571133283007!5m2!1ses!2ses"  frameborder="0" height="400px" wheiht="600px" style="border:0;" Scroll="yes" ></iframe>
                </div>
				
			</article>
			
			<article style="color: white;">
				<header><h1><?php echo $textos['ModosContacto']; ?></h1></header>
				<ul>
					<li><?php echo $textos['Tlf']; ?></li>
					<li><?php echo $textos['Email']; ?><a href="http://www.ces-vegamedia.es/">gimnasio@ces-vegamedia.es</a></li>
					<li><?php echo $textos['Twitter']; ?><a href="http://www.ces-vegamedia.es/">@cesvegamedia</a></li>
				</ul>
			</article>
		
		<?php include("./FooterInicio.php"); ?>
	</body>
</html>
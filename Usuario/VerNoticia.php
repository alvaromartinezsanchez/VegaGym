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
<?php
        include("./HeaderUsuario.php");
    ?>
    <?php
        $Autor=$_GET['Autor'];
        $Fecha=$_GET['Fecha'];
        $Noticia=$_GET['Noticia'];
        $nomAutor=$_GET['nomAutor'];
        ?>
        
    <section class="row justify-content-center">
    	<article class="col-10 mensaje">
            <h3>Autor:</h3>
            <p class="h5"><?php echo $Autor ?></p>
            <hr>
            <h3>Fecha: </h3>
            <p class="h5"><?php echo $Fecha ?> </p>
            <hr>
            <h3>Noticia:</h3>
            <p class="h5"><?php echo $Noticia ?></p>
            <hr>
            <h3>NomAutor: </h3>
            <hr>
            <p class="h5"><?php echo $nomAutor ?></p>
            <br>
            <div class="row justify-content-end">
                <a href="PublicarNoticia.php" class="btn btn-dark text-right mr-5">Volver</a>
            </div>
            
        </article>
        
    </section>
    
</body>
</html>
<?php
}else{
    header("Location: ../Inicio/index.php");
}
?>
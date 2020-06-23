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
		<title>Principal</title>
	</head>
	<?php
    include("./HeaderInicio.php");
    ?>
		
		<section class="row justify-content-center">
        	<article class="col-10">
				<header>
					<hgroup>
						<h1 class="col-12"><?php echo $textos['Equipos'] ?></h1>
						<h2 class="col-12"><?php echo $textos['MejoresMarcas'] ?></h2>
					</hgroup>
					<div class="row justify-content-start no-gutters">
						<figure class="col-4"><image src="../images/foto1.jpg" class="img-fluid "></image><figcaption style="color: white;">Bodytone Ciclo Indoor EX-1</figcaption></figure>
						<p style="color: white;" class="col"><?php echo $textos['Texto1'] ?></p>
					</div>
				</header>
				
				
				
			</article>
			
			<article class="col-10">
				<header>
					<h1><?php echo $textos['NuestrosServicios'] ?></h1>
					<div class="row no-gutters">
						<figure class="col-4"><img src="../images/foto2.jpg" class="img-fluid "><figcaption>Technogym Synchro Forma</figcaption></figure>
						<div class="col">
							<div class="row">
								<p class="col-12"><?php echo $textos['Texto2'] ?></p>
								<div class="col-12">
									<p><?php echo $textos['Texto3'] ?><p>
									<ul>
										<li><?php echo $textos['Plan1'] ?></li>
										<li><?php echo $textos['Plan2'] ?></li>
										<li><?php echo $textos['Plan3'] ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					
					
				</header>
				
			</article>
		
		</section>
		
		<?php include("./FooterInicio.php"); ?>
	</body>
</html>
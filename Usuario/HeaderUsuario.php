
<style>
	body { background-image: url(../images/fondoGYM.jpg); }
	header{ background-color: rgba(27,27,27,0.9); color: white; border-radius: 10px; border: 1px solid grey; margin-top: 5px; margin-bottom: 45px; padding:15px;}
	.btn{ color: white; font-size: 25px; border-radius: 10px; margin: 5px;}
	footer{ background-color: rgba(27,27,27,0.9); color: white; border-radius: 10px; border: 1px solid grey; margin-top: 5px; padding: 5px;}
	form{ background-color: rgba(97,97,97,0.9); color white; border-radius: 10px; border: 5px solid white; margin-top: 5px; padding: 15px;}
	article header{ background-color: rgba(97,97,97,0.9); color: white; border-radius: 10px; border: 1px solid white; margin: 20px; padding: 5px;}
	tr td{ padding: 5px;}
	aside{ color:white; margin-top:20px; }
	.mensaje{ background:rgba(97,97,97,0.9); border-radius:25px; border: 1px solid white; padding:10px; text-align:justify;}
</style>
<body>
	<div class="container">
		<header class="row justify-content-center">
			
			<!--TITULO-->
			<div class="col-10">
				<h2 class="text-center"><?php echo $textos['CabeceraTitulo'];?><img src="../images/VegaGym.jpg" alt=""></h2>
			</div>
			<!--BARRA DE MENU-->
			<div class="col-10">
				<div class="row justify-content-center">
				<a class="btn col" href="./Bienvenida.php"  role="button"><?php echo $textos['Bienvenida'];?></a></li>
		            <a class="btn col" href="./CambiarDatos.php"  role="button"><?php echo $textos['Usuario'];?></a></li>
		            <a class="btn col" href="./EnviarMensaje.php"  role="button"><?php echo $textos['Mensajes'];?></a></li>
		            <a class="btn col" href="./PublicarNoticia.php" role="button"><?php echo $textos['Noticias'];?></a></li>
		            <a class="btn col" href="./Actividades.php" role="button"><?php echo $textos['Actividades'];?></a></li>
		            <a class="btn col" href="../CerrarSesion.php" role="button"><?php echo $textos['CerrarSesion'];?></a></li>
				</div>
			</div>			
		</header>
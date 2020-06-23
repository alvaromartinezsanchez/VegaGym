<?php
session_start();
//Si aun no se ha cargado ningun idioma cargamos el espa�ol por defecto
if(!isset($_SESSION['idioma']) && empty($_SESSION['idioma'])) {
	include("../lang/lang_es.php");
	$textos=$lang_es;
	//s
}else{
	/*Cargamos el idioma de sesion*/
	$idioma=$_SESSION['idioma'];
	//si idioma es distinto de vacio
	if(!empty($idioma)){
		if ($idioma=='es'){
			include("../lang/lang_es.php");
			$textos=$lang_es;
		}
		else if ($idioma=='en'){
			include("../lang/lang_en.php");
			$textos=$lang_en;
		}
		
	}
}

?>
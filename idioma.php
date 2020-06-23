<?php session_start(); 
//Si aun no se ha cargado ningun idioma cargamos el espa�ol por defecto
if(!isset($_POST['idioma']) && empty($_POST['idioma'])) {
	include("lang/lang_es.php");
	$textos=$lang_es;
	echo "es";
}

//Si elijo el idioma sin poner el email o la contraseña cambio solo el idioma
if(isset($_POST['idioma'])) {
    $idioma=$_POST['idioma'];
	if ($idioma=='es'){
		include("lang/lang_es.php");
		$textos=$lang_es;
	}
	else if ($idioma=='en'){
		include("lang/lang_en.php");
		$textos=$lang_en;
	}
	$_SESSION["idioma"]=$idioma;
}

//Vemos en que idioma vamos a usar la pagina web
	
if(isset($idioma)){
	if ($idioma=='es'){
		include("lang/lang_es.php");
		$textos=$lang_es;
	}
	else if ($idioma=='en'){
		include("lang/lang_en.php");
		$textos=$lang_en;
	}
	//Guardamos el idioma en una varible de sesi�n para usarla por todo nuestro portal web
	$_SESSION["idioma"]=$idioma;
}
echo '<div id="middle">';
?>
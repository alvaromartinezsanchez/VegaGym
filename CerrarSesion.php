<?php
    session_start();
    echo  $_SESSION['Id_Usuario'];
    session_destroy();
    header("Location: ./Inicio/Index.php");
?>
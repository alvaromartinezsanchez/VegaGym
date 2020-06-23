<?php
    //importamos libreria de mpdf
    require_once('../lib/pdf/mpdf.php');
    //cargamos valores
    //cargamos valores necesarios 
    $asistencias=0;
    $Id_Usuario=$_GET["Id"];
    //conexion
    $conn=mysqli_connect('localHost','root','');
    echo mysqli_error($conn);
    mysqli_select_db($conn,'gimvm');
    echo mysqli_error($conn);
    //consulta
    //DATOS de USUARIO
    $ConDatosUsuario="SELECT * FROM usuarios WHERE Id_Usuario='$Id_Usuario' " ;
    $usuario=mysqli_query($conn, $ConDatosUsuario);
    echo mysqli_error($conn);
    $row=mysqli_fetch_assoc($usuario);
    print_r($row);
    
    
    //creamos variable con formato del pdf
    $html.=
    '<header class="clearfix">
        <div id="logo">
            <img src="./img/VegaGym.jpg">
        </div>
        <h1>VegaGim</h1>
    </header>
        <main>
            <h3>Datos de Usuario</h3>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th class="service">ID</th>
                        <th class="desc">Nombre</th>
                        <th>Apellido</th>
                        <th class="service">Clave</th>
                        <th class="desc">Rol</th>
                        <th>Activo</th>
                        <th class="desc">Sexo</th>
                        <th>Edad</th>
                    </tr>
                </thead>
                <tbody>';
    

    
        
            $html.='<tr>
                        <td class="service">'.$row['Id_Usuario'].'</td>
                        <td class="desc">'.$row['Nombre'].'</td>
                        <td class="unit">'.$row['Apellido'].'</td>
                        <td class="service">'.$row['Clave'].'</td>
                        <td class="desc">'.$row['Rol'].'</td>
                        <td class="unit">'.$row['Activo'].'</td>
                        <td class="desc">'.$row['Sexo'].'</td>
                        <td class="unit">'.$row['Edad'].'</td>
                    </tr>';
                    
           
    
                    $html.='
                    </tbody>
                </table>
                <h3>Ficha de Sesiones</h3>    
        <table>
            <thead>
                <tr>
                    <th class="service">Nombre</th>
                    <th class="desc">Horario</th>
                    <th>Profesor</th>
                </tr>
            </thead>
            <tbody>';
            
            //DATOS DE HISTORIAL DE ACTIVIDADES
            $consulta= "SELECT * FROM reservas WHERE Id_Usuario='$Id_Usuario' AND Asiste=1 " ;
            $resultado=mysqli_query($conn, $consulta);
            echo mysqli_error($conn);

            while ($mostrar = mysqli_fetch_assoc($resultado)) {
                $asistencias++;
            $html.='<tr>
                        <td class="service">'.$mostrar['Nombre'].'</td>
                        <td class="desc">'.$mostrar['Horario'].'</td>
                        <td class="unit">'.$mostrar['Profesor'].'</td>
                    </tr>';

            }
            $html.='
            </tbody>
        </table>
        <div id="notices">
            <div>Nº Asistencias:</div>
            <div class="notice">'.$asistencias.'</div>
        </div>
    </main> ';
    //creamos objeto mpdf
    $mpdf = new mPDF('c', 'A5');
    $css= file_get_contents('css/style.css');
    $mpdf -> WriteHTML($css, 1);
    $mpdf -> WriteHTML($html);
    $mpdf->Output('reporte.pdf','I');


?>
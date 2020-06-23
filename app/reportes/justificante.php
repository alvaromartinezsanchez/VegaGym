<?php
    //importamos libreria de mpdf
    require_once('../lib/pdf/mpdf.php');
    //cargamos valores
    //cargamos valores necesarios 
    $Nombre=$_GET["Nombre"];
    $Horario=$_GET["Horario"];
    $Profesor=$_GET["Profesor"];
    session_start();
    $Id_Usuario=$_SESSION["Id_Usuario"];
    //conexion
    $conn=mysqli_connect('localHost','root','');
    echo mysqli_error($conn);
    mysqli_select_db($conn,'gimvm');
    echo mysqli_error($conn);
    //consulta
    $ConsultaReserva="SELECT * FROM reservas WHERE Nombre='$Nombre' AND Horario='$Horario' AND Profesor='$Profesor' AND Id_Usuario='$Id_Usuario' ";
    $reservada=mysqli_query($conn, $ConsultaReserva);
    echo mysqli_error($conn);
    $row=mysqli_fetch_assoc($reservada);
    print_r($row);
    //creamos variable con formato del pdf
    $html='
    <header class="clearfix">
        <div id="logo">
            <img src="./img/VegaGym.jpg">
        </div>
        <h1>VegaGim</h1>
        <div id="company" class="clearfix">
            <div>VegaGim S.L.</div>
            <div>Alguazas <br /> CP 85004, ES</div>
            <div>(968) 635 957</div>
            <div><a href="mailto:company@example.com">VegaGym@example.com</a></div>
        </div>
    
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Nombre</th>
                    <th class="desc">Horario</th>
                    <th>Profesor</th>
                </tr>
            </thead>
            <tbody>';
            $html.='<tr>
                        <td class="service">'.$row['Nombre'].'</td>
                        <td class="desc">'.$row['Horario'].'</td>
                        <td class="unit">'.$row['Profesor'].'</td>
                    </tr>';
            $html.='
            </tbody>
        </table>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">Justificante emitido por vegaGim S.L.</div>
        </div>
    </main> ';
    //creamos objeto mpdf
    $mpdf = new mPDF('c', 'A5');
    $css= file_get_contents('css/style.css');
    $mpdf -> WriteHTML($css, 1);
    $mpdf -> WriteHTML($html);
    $mpdf->Output('reporte.pdf','I');


?>
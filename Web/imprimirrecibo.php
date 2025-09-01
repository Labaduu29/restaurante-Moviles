<?php
@session_start();

include_once("../Lib/Config/connection.php");
$objOs= new Connection();

$num_doc=$_GET['num_doc'];
$codigoHTML="";

    
    $sqlCT="";
    $orden="select * from recibo_caja natural join cliente where rc_num='$num_doc'";  
    $cabeceras=$objOs->execute($orden); 

    $Dorden="select * from recibo_caja_detalle where rcd_num='$num_doc'";  
    $detalle=$objOs->execute($Dorden); 

    foreach($cabeceras as $cabecera){}

    date_default_timezone_set('America/Bogota');    
    $fechaImp=date('d-m-Y H:i:s');    

  
    $codigoHTML.='  
    <h4>Fecha Imp: '.$fechaImp.'</h4>
            <table >
                <tr>
                    <td style="text-align: left;line-height:10px;">Recibo No:</td>
                    <td>'.$cabecera['rc_num'].'</td>
                    <td style="text-align: left;line-height:10px;">Fecha:</td>
                    <td>'.$cabecera['rc_fecha'].'</td>
                    <td rowspan="2" colspan="6" align="right"><img src="img/logo.png" style="margin:0px 0px 0px 50px" width="120" height="0" /></td>           
                </tr> 
                
                <tr>
                    <td  style="text-align: left;">Estado:</td>
                    <td>'.$cabecera['rc_estado'].'</td>
                </tr>
                
                <tr>
                    <th style="text-align: left;">Cliente: </th>
                    <td colspan="5">'.$cabecera['cli_nombre'].' '.$cabecera['cli_apellidos'].'</td>            
                </tr>
                
                      
        
               
            </table>';
    

$codigoHTML=utf8_encode(utf8_decode($codigoHTML));

require'../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf= new Html2PDF();
$html2pdf->writeHTML($codigoHTML);
$html2pdf->output();

<?php

include 'conexion.php';



$nreporte=$_POST['numreporte'];

$salida="";

//echo 'hola mundo'.$nreporte;



//para insertar reporte



//valida si el numero de reporte ya se encuentra registrado

$vreporte = select('estado,comentario_externo,NumeroReporte,FechaIngreso,Valuacion,PresupuestoEnviado,PresupuestoAceptado,'

        . 'SolicitudRefacciones,refacciones_faltantes,ReparacionUnidadPorcentaje,'

        . 'UnidadProgRampa,Deducible,MontoDeducible,FechaEntrega', 'reporte', 'NumeroReporte=\''.$nreporte.'\'');

//$arreglo = arreglo($vreporte);



if (num($vreporte)>0){

    

    $salida.="<table class='tablaClienteReporte col-lg-12'> <thead class='thead-yellow'><tr><th>Reporte</th><th>Fecha de Ingreso</th><th>Valuación</th><th>Presupuesto Enviado</th>"

            . "<th>Presupuesto Aceptado</th><th>Solicitud Refacciones</th><th>Refacciones faltantes</th>"

            . "<th>Unidad en Rampa</th><th>Reparación Unidad %</th><th>Deducible</th><th>Monto Deducible</th><th>Fecha de Entrega</th><th>Estado</th></tr></thead>";

    $comentarioExterno = "";

    while($fila=$vreporte->fetch_assoc()){
        $estado = "";
        switch ($fila['estado']) {
            case '1':
                $estado = "EN TRANSITO";
                break;
             case '2':
                $estado = "PISO";
                break;
             case '3':
                $estado = "RAMPA";
                break;
             case '3':
                $estado = "TERMINADO";
                break;
        }
        
        $salida.="<tbody class='tbody-gris'><tr>"
        
                . "<td data-th='Número de reporte'>".$fila['NumeroReporte']."</td>"

                . "<td data-th='Fecha de ingreso'>".date('d-m-Y', strtotime($fila['FechaIngreso']))."</td>"

                . "<td data-th='Valuación'>".$fila['Valuacion']."</td>"

                ."<td data-th='Presupuesto enviado'>".$fila['PresupuestoEnviado']."</td>"

                ."<td data-th='Presupuesto aceptado'>".$fila['PresupuestoAceptado']."</td>"

                ."<td data-th='Solicitud de refacciones'>".$fila['SolicitudRefacciones']."</td>"

                ."<td data-th='Refacciones faltantes'>".$fila['refacciones_faltantes']."</td>"

                ."<td data-th='En rampa'>".$fila['UnidadProgRampa']."</td>"

                ."<td data-th='Reparación de unidad %'>".$fila['ReparacionUnidadPorcentaje']."%</td>"

                ."<td data-th='Deducible'>".$fila['Deducible']."</td>"

                ."<td data-th='Monto Deducible'>$".$fila['MontoDeducible']."</td>"

                ."<td data-th='Fecha de entrega'>".$fila['FechaEntrega']."</td>"
                
                . "<td data-th='Estado'>".$estado."</td>"
                
                . "</tr>";
                $comentarioExterno = $fila["comentario_externo"];
    }

    $salida.="</tbody></table>";
    
    // rwd-table
    $salida .= "<br><table class='tablaClienteReporte col-lg-12'><thead class='thead-yellow'><tr><th style='text-align:left;'>Comentarios</th></tr></thead><tbody class='tbody-gris'><tr><td data-th='Comentarios' style='text-align:left;'>".$comentarioExterno."</td></tr></tbody></table>";

}else{

    $salida.='No hay resultados';

}



echo $salida;






?>


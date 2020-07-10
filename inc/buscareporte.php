<?php

include 'conexion.php';



$nreporte=$_POST['numreporte'];

$salida="";

//echo 'hola mundo'.$nreporte;



//para insertar reporte



//valida si el numero de reporte ya se encuentra registrado

$vreporte = select('NumeroReporte,FechaIngreso,Valuacion,PresupuestoEnviado,PresupuestoAceptado,'

        . 'SolicitudRefacciones,RefaccionesDispoiblesPorcentaje,ReparacionUnidadPorcentaje,'

        . 'UnidadProgRampa,Deducible,MontoDeducible,FechaEntrega', 'reporte', 'NumeroReporte=\''.$nreporte.'\'');

//$arreglo = arreglo($vreporte);



if (num($vreporte)>0){

    

    $salida.="<table class='rwd-table'> <tbody><tr><th>Reporte</th><th>Fecha de Ingreso</th><th>Valuación</th><th>Presupuesto Enviado</th>"

            . "<th>Presupuesto Aceptado</th><th>Solicitud Refacciones</th><th>Refacciones Disponibles %</th>"

            . "<th>Unidad en Rampa</th><th>Reparación Unidad %</th><th>Deducible</th><th>Monto Deducible</th><th>Fecha de Entrega</th></tr>";

    

    while($fila=$vreporte->fetch_assoc()){

        $salida.="<tr>"

                . "<td data-th='Número de reporte'>".$fila['NumeroReporte']."</td>"

                . "<td data-th='Fecha de ingreso'>".$fila['FechaIngreso']."</td>"

                . "<td data-th='Valuación'>".$fila['Valuacion']."</td>"

                ."<td data-th='Presupuesto enviado'>".$fila['PresupuestoEnviado']."</td>"

                ."<td data-th='Presupuesto aceptado'>".$fila['PresupuestoAceptado']."</td>"

                ."<td data-th='Solicitud de refacciones'>".$fila['SolicitudRefacciones']."</td>"

                ."<td data-th='Refacciones disponibles %'>".$fila['RefaccionesDispoiblesPorcentaje']."%</td>"

                ."<td data-th='En rampa'>".$fila['UnidadProgRampa']."</td>"

                ."<td data-th='Reparación de unidad %'>".$fila['ReparacionUnidadPorcentaje']."%</td>"

                ."<td data-th='Deducible'>".$fila['Deducible']."</td>"

                ."<td data-th='Monto Deducible'>$".$fila['MontoDeducible']."</td>"

                ."<td data-th='Fecha de entrega'>".$fila['FechaEntrega']."</td>"

                . "</tr>";

    }

    $salida.="</tbody></table>";

    

}else{

    $salida.='No hay resultados';

}



echo $salida;






?>


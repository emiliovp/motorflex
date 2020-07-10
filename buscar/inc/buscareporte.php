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
    
    
    
    while($fila=$vreporte->fetch_assoc()){
        $salida.="  "
                . "Número de reporte:".$fila['NumeroReporte']." \n  "
                . "Fecha de ingreso:".$fila['FechaIngreso']."   "
                ."Presupuesto enviado:".$fila['PresupuestoEnviado']."  "
                ."Presupuesto aceptado:".$fila['PresupuestoAceptado']."  "
                ."Solicitud de Refacciones:".$fila['SolicitudRefacciones']."  "
                ."Refacciones Disponibles:".$fila['RefaccionesDispoiblesPorcentaje']."  "
                ."Reparación de unidad:".$fila['ReparacionUnidadPorcentaje']."  "
                ."Unidad programada para rampa:".$fila['UnidadProgRampa']."  "
                ."Deducible:".$fila['Deducible']."  "
                ."Monto deducible:".$fila['MontoDeducible']."   "
                ."Fecha de entrega".$fila['FechaEntrega']."   "
                . "  ";
    }
    
    
}else{
    $salida.='No hay resultados';
}

echo $salida;

//echo $arreglo['NumeroReporte'];
//echo num($vreporte);
/*if(num($vreporte)>0){
    echo 'El número de reporte ya se encuentra registrado';
    //header('location: ../registro.php');
 }
 else {
     
     //obtiene el max id e incrementa uno en reporte
    $query = selects('max(IdReporte) as id', 'reporte');       
    $arreglo = arreglo($query);
    $idnew= $arreglo['id']+1;
    
    //inserta('reporte', 'IdReporte,NumeroReporte,FechaIngreso,Valuacion,PresupuestoEnviado,PresupuestoAceptado,SolicitudRefacciones,RefaccionesDispoiblesPorcentaje,ReparacionUnidadPorcentaje,UnidadProgRampa,Deducible,MontoDeducible,FechaEntrega',$idnew.',\''.$nreporte.'\',\''.$fechaInicio.'\',\''.$valuacion.'\',\''.$presupuesto.'\',\''.$presupuestoAceptado.'\',\''.$refacciones.'\',\''.$porcentajeRefacciones.'\',\''.$porcentajeReparado.'\',\''.$rampa.'\',\''.$deducible.'\',\''.$monto.'\',\''.$fechaFin.'\'');
    
    inserta('reporte', 'IdReporte,NumeroReporte,FechaIngreso,Deducible',$idnew.',\''.$nreporte.'\',\''.$fechaInicio.'\',\''.$deducible.'\'');
    
    echo 'el reporte '.$idnew.' se registro exitosamente';
 }*/
?>

<?php
include 'conexion.php';

$nreporte=$_POST['numreporte'];
//$fechaInicio=$_POST['fecinicio'];
$valuacion=$_POST['valuacion'];
$presupuesto=$_POST['presupuesto'];
$presupuestoAceptado=$_POST['presupuestoAc'];
$refacciones=$_POST['refacciones'];
//$porcentajeRefacciones=$_POST['porrefacciones'];
$porcentajeReparado=$_POST['porReparacion'];
$rampa=$_POST['rampa'];
//$deducible=$_POST['deducible'];
$monto=$_POST['monto'];
$fechaFin=$_POST['fecfin'];

$totalRefaccones=$_POST['totalRefacciones'];
$dispoRefacciones=$_POST['dispoRefacciones'];

echo 'hola mundo'.$nreporte.'_'.$valuacion.'_'.$presupuesto.'_'.$presupuestoAceptado.'_'.$refacciones.'_'.$porcentajeRefacciones.'_'.$porcentajeReparado.'_'.$rampa.'_'.$monto.'_'.$fechaFin;

//para insertar reporte

$porcentajeRefacciones= ($dispoRefacciones*100)/$totalRefaccones;

//valida si el numero de reporte ya se encuentra registrado
$vreporte = select('NumeroReporte', 'reporte', 'NumeroReporte=\''.$nreporte.'\'');

//echo num($vreporte);
if(num($vreporte)>0){
    //echo 'El número de reporte ya se encuentra registrado';
    //header('location: ../registro.php');
    
    //update('reporte', 'Valuacion=\''.$valuacion.'\',PresupuestoEnviado=\''.$presupuesto.'\',PresupuestoAceptado=\''.$presupuestoAceptado.'\',SolicitudRefacciones=\''.$refacciones.'\',RefaccionesDispoiblesPorcentaje=\''.$porcentajeRefacciones.'\',ReparacionUnidadPorcentaje=\''.$porcentajeReparado.'\',UnidadProgRampa=\''.$rampa.'\',MontoDeducible=\''.$monto.'\',FechaEntrega=\''.$fechaFin.'\'', 'NumeroReporte=\''.$nreporte.'\'');
    
     update('reporte', 'Valuacion=\''.$valuacion.'\',PresupuestoEnviado=\''.$presupuesto.'\',PresupuestoAceptado=\''.$presupuestoAceptado.'\',SolicitudRefacciones=\''.$refacciones.'\',RefaccionesDispoiblesPorcentaje=\''.$porcentajeRefacciones.'\',ReparacionUnidadPorcentaje=\''.$porcentajeReparado.'\',UnidadProgRampa=\''.$rampa.'\',MontoDeducible=\''.$monto.'\',FechaEntrega=\''.$fechaFin.'\',TotalRefacciones=\''.$totalRefaccones.'\',CantidadRefacciones=\''.$dispoRefacciones.'\'', 'NumeroReporte=\''.$nreporte.'\'');
     echo 'Datos acualizados';
 }
 else {
     
     //obtiene el max id e incrementa uno en reporte
    //$query = selects('max(IdReporte) as id', 'reporte');       
    //$arreglo = arreglo($query);
    //$idnew= $arreglo['id']+1;
    
    //inserta('reporte', 'IdReporte,NumeroReporte,FechaIngreso,Valuacion,PresupuestoEnviado,PresupuestoAceptado,SolicitudRefacciones,RefaccionesDispoiblesPorcentaje,ReparacionUnidadPorcentaje,UnidadProgRampa,Deducible,MontoDeducible,FechaEntrega',$idnew.',\''.$nreporte.'\',\''.$fechaInicio.'\',\''.$valuacion.'\',\''.$presupuesto.'\',\''.$presupuestoAceptado.'\',\''.$refacciones.'\',\''.$porcentajeRefacciones.'\',\''.$porcentajeReparado.'\',\''.$rampa.'\',\''.$deducible.'\',\''.$monto.'\',\''.$fechaFin.'\'');
    
    //inserta('reporte', 'IdReporte,NumeroReporte,FechaIngreso,Deducible',$idnew.',\''.$nreporte.'\',\''.$fechaInicio.'\',\''.$deducible.'\'');
    
    echo 'el reporte no existe ';
 }
?>


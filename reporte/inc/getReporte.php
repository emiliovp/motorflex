<?php
include 'conexion.php';

$nreporte=$_POST['numreporte'];
$fechaInicio=$_POST['fecinicio'];
/*$valuacion=$_POST['valuacion'];
$presupuesto=$_POST['presupuesto'];
$presupuestoAceptado=$_POST['presupuestoAc'];
$refacciones=$_POST['refacciones'];
$porcentajeRefacciones=$_POST['porrefacciones'];
$porcentajeReparado=$_POST['porReparacion'];
$rampa=$_POST['rampa'];*/
$deducible=$_POST['deducible'];
//$monto=$_POST['monto'];
//$fechaFin=$_POST['fecfin'];

//echo 'hola mundo'.$nreporte.'_'.$fechaInicio.'_'.$valuacion.'_'.$presupuesto.'_'.$presupuestoAceptado.'_'.$refacciones.'_'.$porcentajeRefacciones.'_'.$porcentajeReparado.'_'.$rampa.'_'.$deducible.'_'.$monto.'_'.$fechaFin;

//para insertar reporte

//valida si el numero de reporte ya se encuentra registrado
$vreporte = select('NumeroReporte', 'reporte', 'NumeroReporte=\''.$nreporte.'\'');

//echo num($vreporte);
if(num($vreporte)>0){
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
 }
?>

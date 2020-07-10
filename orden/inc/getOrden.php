<?php
include 'conexion.php';

$fechaIngreso=$_POST['fechaingreso'];
$estatus=$_POST['estatus'];
$caracteristicas=$_POST['caracteristicas'];
$serie=$_POST['serie'];
$motor=$_POST['motor'];
$placas=$_POST['placas'];
$nombre=$_POST['nombre'];
$papellido=$_POST['papellido'];
$sapellido=$_POST['sapellido'];
$tel=$_POST['tel'];
$correo=$_POST['correo'];
$rfc=$_POST['rfc'];
//$rfc=$_POST['rfc'];
$estado=$_POST['estado'];
$ciudad=$_POST['ciudad'];
$alcmun=$_POST['alcmun'];
$cp=$_POST['cp'];
$colonia=$_POST['colonia'];
$calle=$_POST['calle'];
$numero=$_POST['numero'];
$marca=$_POST['marca'];
$reporte=$_POST['reporte'];

//echo 'hola mundo'.$reporte.'_'.$fechaIngreso.'_'.$estatus.'_'.$caracteristicas.'_'.$serie.'_'.$motor.'_'.$placas.'_'.$marca.'_'.$nombre.'_'.
  //      $papellido.'_'.$sapellido.'_'.$tel.'_'.$correo.'_'.$rfc.'_'.
    //    $estado.'_'.$ciudad.'_'.$alcmun.'_'.$cp.'_'.$colonia.'_'.$calle.'_'.$numero;

//para insertar reporte

//valida si el numero de reporte ya se encuentra registrado
$vreporte = select('IdReporte', 'reporte', 'NumeroReporte=\''.$reporte.'\'');
$areporte=  arreglo($vreporte);

//echo num($vreporte);
if(num($vreporte)>0){
    //echo 'El número de reporte ya se encuentra registrado';
    //header('location: ../registro.php');    
     $areporte['IdReporte'];
     
     //obtiene el maximo Id de direccion
     
    $dirquery = selects('max(IdDireccion) as id', 'direccion');       
    $dirarreglo = arreglo($dirquery);
    $idnewdir= $dirarreglo['id']+1;
    
    inserta('direccion', 'IdDireccion,Estado,Ciudad,AlcaldiaMunicipio,CP,Colonia,Calle,Numero',$idnewdir.',\''.$estado.'\',\''.$ciudad.'\',\''.$alcmun.'\',\''.$cp.'\',\''.$colonia.'\',\''.$calle.'\',\''.$numero.'\'');
    
    $vndir=select('IdDireccion', 'direccion', 'IdDireccion=\''.$idnewdir.'\'');
    
    if(num($vndir)>0){
        
         //obtiene el maximo Id de persona
     
    $perquery = selects('max(IdPersona) as id', 'persona');       
    $perarreglo = arreglo($perquery);
    $idnewper= $perarreglo['id']+1;
    
    inserta('persona', 'IdPersona,Nombre,PrimerApellido,SegundoApellido,Telefono,Correo,RFC,IdDireccion',$idnewper.',\''.$nombre.'\',\''.$papellido.'\',\''.$sapellido.'\',\''.$tel.'\',\''.$correo.'\',\''.$rfc.'\',\''.$idnewdir.'\'');
    
    //obtiene el maximo Id de motocicleta
     
    $motquery = selects('max(IdMotocicleta) as id', 'motocicleta');       
    $motarreglo = arreglo($motquery);
    $idnewmot= $motarreglo['id']+1;
    
    $marquery = select('max(IdMarca) as id', 'cat_marca','Descripcion=\''.$marca.'\'');
    $mararreglo = arreglo($marquery);
    $idnew= $mararreglo['id']+1;
    
    inserta('motocicleta', 'IdMotocicleta,NumeroSerie,NumeroMotor,Placas,IdMarca',$idnewmot.',\''.$serie.'\',\''.$motor.'\',\''.$placas.'\',\''. $mararreglo['id'].'\'');
    
     //obtiene el maximo Id de os
     
    $osquery = selects('max(IdMotocicleta) as id', 'orden_servicio');       
    $osarreglo = arreglo($osquery);
    $idnewos= $osarreglo['id']+1;
    
    inserta('orden_servicio', 'IdOrden,FechaIngreso,Estatus,Caracteristicas,IdPersona,IdMotocicleta,IdReporte', $idnewos.',\''.$fechaIngreso.'\',\''.$estatus.'\',\''.$caracteristicas
            .'\',\''.$idnewper.'\',\''.$idnewmot.'\',\''.$areporte['IdReporte'].'\'');
    
    echo 'Orden generada asociada al numero de reporte '.$reporte;
    
    } else{
        
        echo 'Algo salio mal, valida los datos de entrada';
    }       
      
}
 else {
          
    echo 'el reporte '.$reporte.' no se encuentra registrado';
 }
?>



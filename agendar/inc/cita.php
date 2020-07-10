<?php 
include 'conexion.php';

$errorMSG = "";

// NAME
if (empty($_POST["nombre"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["nombre"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// MESSAGE
if (empty($_POST["observ"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["observ"];
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$correo=$_POST['correo'];
$telefono=$_POST['telefono'];
$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$matricula=$_POST['matricula'];
$fecha=$_POST['fecha'];
$observaciones=$_POST['observa'];

//echo 'hola mundo'.$nombre.'_'.$apellido.'_'.$telefono.'_'.$matricula.'_'.$fecha;

//valida cuantas citas están registradas en día
$q=  select('count(idCita) as numCitas', 'tmp_cita', 'fecha=\''.$fecha.'\'');
$arrCita = arreglo($q);
$numCita=$arrCita['numCitas'];

//capacidad de citas por día
$qCitas = selects('citasDia', 'capacidad_citas');
$arrCitasDia=arreglo($qCitas);
$capCita=$arrCitasDia['citasDia'];


if ($numCita>=  $capCita){
    echo '<div class="alert alert-danger"><i class="icon-remove-sign"></i>Por favor agenda cita para otro día</div>';  
    //echo $capCita;
    
}else{
//obtiene el max id e incrementa uno en usuario datos
    $query = selects('max(idCita) as id', 'tmp_cita');       
    $arreglo = arreglo($query);
    $idnew= $arreglo['id']+1;

    //inserta('tmp_cita','idCita,nombre,apellido,correo,telefono,marca,modelo,placas,fecha,observaciones',$idnew.',\''.$nombre.'\',\''.$apellido.'\',\''.$telefono.'\',\''.$matricula.'\',\''.$fecha.'\'');
    inserta('tmp_cita','idCita,nombre,apellido,correo,telefono,marca,modelo,placas,fecha,observacioes',$idnew.',\''.$nombre.'\',\''.$apellido.'\',\''.$correo.'\',\''.$telefono.'\',\''.$marca.'\',\''.$modelo.'\',\''.$matricula.'\',\''.$fecha.'\',\''.$observaciones.'\'');
    //echo $arreglo['id'];

    
    echo 'Gracias '.$_POST['nombre'].' - '.$_POST['email'].'  - '.$_POST['placas'].' . Tu cita ha sido recibida correctamente!';
    
    
    
    

   
    
}
?>




 
<?php

include 'conexion.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$fecha=$_POST['fecha'];


//valida cuantas citas están registradas en día
$q= select('count(idCita) as numCitas', 'tmp_cita', 'fecha=\''.$fecha.'\'');
$arrCita = arreglo($q);
$numCita=$arrCita['numCitas'];


echo $numCita;
?>


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'conexion.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$disponible=$_POST['numcitas'];


//cambia disponibilidad
$actualizaCitas = update('capacidad_citas','citasDia='.$disponible , 'idCita=1');
echo 'Se cambio el número de citas por día';

?>
<?php
include 'conexion.php';

$marca=$_POST['marca'];
$modelo=$_POST['modelo'];

//echo 'modelo_'.$modelo.'*';
//pasa a mayusculas
$marca = strtoupper($marca);
$modelo=  strtoupper($modelo);

//echo 'hola mundo'.$marca.'_'.$modelo;

//para insertar marca y modelo

//valida si la marca ya existe 
$vmarca = select('IdMarca', 'cat_marca', 'Descripcion=\''.$marca.'\'');
$vmodelo= select('IdModelo', 'cat_modelo', 'Descripcion=\''.$modelo.'\'');

 //obtiene el max id de marca e incrementa uno en reporte
    $query = selects('max(IdMarca) as id', 'cat_marca');       
    $arreglo = arreglo($query);
    $idnew= $arreglo['id']+1;
    
 //obtiene el max id de modelo e incrementa uno en reporte
    $querym = selects('max(IdModelo) as id', 'cat_modelo');       
    $arreglom = arreglo($querym);
    $idnewm= $arreglom['id']+1;

//echo 'aqui'.strlen($modelo);
if (strlen($modelo)>0){
        if((num($vmarca)>0)&&(num($vmodelo)>0)){
            echo 'Marca y modelos existente';
            //header('location: ../registro.php');
         /*}elseif (num($vmarca==0)&&  num($vmodelo==0)) {    

            inserta('cat_marca', 'IdMarca,Descripcion',$idnew.',\''.$marca.'\'');
            inserta('cat_modelo', 'IdModelo,Descripcion,IdMarca',$idnewm.',\''.$modelo.'\',\''.$idnew.'\'');

            echo "Marca y modelos registrados";
         } */
        }elseif (num($vmarca)>0 &&  num($vmodelo)==0) {    

            inserta('cat_modelo', 'IdModelo,Descripcion,IdMarca',$idnewm.',\''.$modelo.'\',\''.$arreglo['id'].'\'');

            echo "Marca existente y modelos registrado a la marca";
         } 
         elseif (num($vmarca)==0 &&  num($vmodelo)==0){   
                echo num($vmodelo);
            inserta('cat_marca', 'IdMarca,Descripcion',$idnew.',\''.$marca.'\'');
            inserta('cat_modelo', 'IdModelo,Descripcion,IdMarca',$idnewm.',\''.$modelo.'\',\''.$idnew.'\'');

            echo "Marca y modelos registrados";
         }//elseif  (num($vmarca==0)&&  num($vmodelo!=0)){
}else{
    if(num($vmarca)>0){
            echo 'Marca existente';
    }
    else{
        inserta('cat_marca', 'IdMarca,Descripcion',$idnew.',\''.$marca.'\'');
        echo 'Marca registrada';
    }
}
    
 //}
?>


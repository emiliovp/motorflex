<?php

/*
 * Edgar Ruiz
 * 2013
 */

/*función que permite la conexión a la base de datos, es invocada desde
 * las funciones de base de datos, insert, select, update, etc.
 */

function db($modulo){
 switch ($modulo){
        case "certificaciontitulacion":
            $basedatos="estudyct";
            break; 
        case "pagos":
            $basedatos="estudymp";
            break;                     
        default:
            $basedatos="";
            break;
        }
        return $basedatos;
}

function conecta($tipo)
{
    $server = 'localhost';
    $port = '3306';
    $db = "motorfle_motor_flex";
    //$db = "TEC_IFT";
    switch ($tipo){
        case 1://case que permite solo seleccionar
            $user="";
            $pass="";
            break;
        case 2://case que permite actualizar e insertar, pero no borrar
            $user="";
            $pass="";
            break;
        case 3://case que permite modificar todos los datos (insert, update, delete)
            // $user = "motorfle";
            // $pass ='1y*S7fcN.Rw16Y';
            $user = "root";
            $pass = '';
            break;
        default://nada
            $user="";
            $pass="";
            break;
        }


    $con = mysqli_connect($server, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        echo "Error de base de datos. <br>Intente m&aacute;s tarde o consulte al administrador." . mysqli_connect_error();
    }

    return $con;
}

function cierra($conexion)
{
    mysqli_close($conexion);
}

function inserta($tabla, $cols, $values)
{
    $conexion = conecta(3);
    $ins = "insert into $tabla ($cols) values ($values);";
    mysqli_query($conexion, "SET NAMES 'utf8'");
    $res = mysqli_query($conexion, $ins);
    cierra($conexion);  
    return $res;
}

function inserta_last_id($tabla, $cols, $values)
{
    $conexion = conecta(3);
    $ins = "insert into $tabla ($cols) values ($values);";
    mysqli_query($conexion, "SET NAMES 'utf8'");
    mysqli_query($conexion, $ins);
    $last_id = mysqli_insert_id($conexion);
    cierra($conexion);
    return $last_id;
}

function selects($campos, $tabla)
{
    $conexion = conecta(3);
    $sel = 'select ' . $campos . ' from ' . $tabla . '';
    mysqli_query($conexion, "SET NAMES 'utf8'");
    $res = mysqli_query($conexion, $sel);
    cierra($conexion);
    return $res;
}

function select($campos, $tabla, $cond)
{
    $conexion = conecta(3);
    $sel = 'select ' . $campos . ' from ' . $tabla . ' where ' . $cond . '';
    mysqli_query($conexion, "SET NAMES 'utf8'");
    $res = mysqli_query($conexion, $sel);
    cierra($conexion);
    return $res;
}

function update($tabla, $valor, $cond)
{
    $conexion = conecta(3);
    mysqli_query($conexion, "SET NAMES 'utf8'");
    $upd = "update $tabla set $valor where $cond;";
    $res = mysqli_query($conexion, $upd);
    cierra($conexion);
    return $res;
}

function delete($tabla, $cond)
{
    $conexion = conecta(3);
    $del = "delete from $tabla where $cond;";
    $res = mysqli_query($conexion, $del);
    //cierra();
    return $res;
}

function num($query)
{
    $res = mysqli_num_rows($query);
    //cierra();
    return $res;
}

function arreglo($query)
{
    $res = mysqli_fetch_array($query, MYSQLI_BOTH);
    //cierra();
    return $res;
}

function escape_cara($query)
{
    $conexion = conecta(3);
    $res = mysqli_real_escape_string($conexion, $query);
    //cierra();
    return $res;
}

function error_base()
{
    $res = mysqli_error();
    //cierra();
    return $res;
}

function row($query)
{
    $res = mysqli_fetch_row($query);
    return $res;
}

function query($query)
{
    $conexion = conecta(3);
    mysqli_query($conexion, "SET NAMES 'utf8'");
    $res = mysqli_query($conexion, $query);
    return $res;
}

?>

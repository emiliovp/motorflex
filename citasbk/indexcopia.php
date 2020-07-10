<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        
        <title>Registro Cita</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href="ccs/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="js/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
        <!--<script src="js/custom.js" type="text/javascript"></script>-->
        <script src="js/cita/registro.js" type="text/javascript"></script>
       
    </head>
    <body>
        <?php
        // put your code here
        
        ?>
      <div class="container">
	<div class="dates" style="margin-top:100px;color:#2471a3;">
            <label>Nombre</label>
            <input type="text" id="nombre" required>
            <label>Apellido</label>
            <input type="text" id="apellido" required/>
            <br/>
            <label>Teléfono</label>
            <input type="tel" id="tel" required/>
            <label>Placas</label>
            <input type="text" id="placas" />
            <br/>
            <label>Selecciona la fecha</label>
            <input type="text" style="width:200px;background-color:#aed6f1;" class="form-control" id="usr1" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off" >
        </div>  
          <!--<div class="button button-full button-round-small top-30 bottom-30">                           -->
          <br>  
          <input id="enviar" name="enviar" type="button" value="Enviar" > 
                      
                 <!--  </div> -->
      </div>
      <div id="resultado"></div>
      <!--<div id="mensaje">
          <p onmouseup="mousefec()">Aqui va un mensaje</p>            
       </div>-->
        
    </body>
</html>

<html>
    <head>
        <meta charset="UTF-8">
        
        <title>Consulta Cita</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href="ccs/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="js/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
        <!--<script src="js/custom.js" type="text/javascript"></script>-->
        <script src="js/cita/gestorCita.js" type="text/javascript"></script>
       
    </head>
    <body>
        <?php
        // put your code here
        
        ?>
      <div class="container">
	<div class="dates" style="margin-top:100px;color:#2471a3;">
            <label>Introduce el número de citas por día</label>
            <br>
            <input type="text" id="numeroCitas" required>
        </div>  
          <!--<div class="button button-full button-round-small top-30 bottom-30">                           -->
          <br>  
          <input id="disponibilidad" name="disponibilidad" type="button" value="Cambiar" > 
                      
                 <!--  </div> -->
      </div>
      <div id="cambioCitas"></div>
      <!--<div id="mensaje">
          <p onmouseup="mousefec()">Aqui va un mensaje</p>            
       </div>-->
        
    </body>
</html>

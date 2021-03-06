
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<style type="text/css">
.nosamepass {
  display: none;
}

</style>

<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Reporte        <small><?= cclang('new', ['Reporte']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/reporte'); ?>">Reporte</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Reporte</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Reporte']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_reporte', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_reporte', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NumeroReporte" class="col-sm-2 control-label">Número De Reporte 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NumeroReporte" id="NumeroReporte" placeholder="Número De Reporte" value="<?= set_value('NumeroReporte'); ?>">
                                <p id="errorNoReporteDuplicado" style="display: none;color: red;">No. de reporte duplicado - Favor de ingresar otro no. de reporte</p>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="cliente" class="col-sm-2 control-label">Cliente 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="cliente" id="cliente" data-placeholder="Seleccionar Cliente" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('persona') as $row): ?>
                                    <option value="<?= $row->IdPersona ?>"><?php if ($row->Nombre == $row->Apellidos){
                                        $nombre = $row->Nombre;
                                    }else{$nombre =$row->Apellidos." ".$row->Nombre; } echo $nombre; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="fechaingreso" class="col-sm-2 control-label">Fecha De Ingreso 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="fechaingreso"  placeholder="Fecha De Ingreso" id="fechaingreso">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="orden" class="col-sm-2 control-label">Orden 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="orden" id="orden" placeholder="Orden" value="<?= set_value('orden'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="marca" class="col-sm-2 control-label">Marca 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="marca" id="marca" data-placeholder="Select Marca" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('cat_marca') as $row): ?>
                                    <option value="<?= $row->IdMarca ?>"><?= $row->Descripcion; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="modelo" class="col-sm-2 control-label">Modelo 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo" value="<?= set_value('modelo'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ano" class="col-sm-2 control-label">Año 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ano" id="ano" placeholder="Año" value="<?= set_value('ano'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="comentario_interno" class="col-sm-2 control-label">Comentario Interno 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="comentario_interno" id="comentario_interno" ><?= set_value('comentario_interno'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="comentario_externo" class="col-sm-2 control-label">Comentario Externo 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="comentario_externo" id="comentario_externo" ><?= set_value('comentario_externo'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="Valuacion" class="col-sm-2 control-label">Valuacion 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="Valuacion" id="Valuacion" data-placeholder="Seleccionar Valuacion" >
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="perdida_total" class="col-sm-2 control-label">Perdida Total 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="perdida_total" id="perdida_total" data-placeholder="Seleccionar una opción" >
                                    <option value="">Seleccione una opción</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="pago_danos" class="col-sm-2 control-label">Pago de Daños 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="pago_danos" id="pago_danos" data-placeholder="Seleccionar una opción" >
                                    <option value="">Seleccione una opción</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="PresupuestoEnviado" class="col-sm-2 control-label">Presupuesto Enviado 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="PresupuestoEnviado" id="PresupuestoEnviado" data-placeholder="Presupuesto enviado" >
                                    <option value="-" selected>-</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PresupuestoAceptado" class="col-sm-2 control-label">Valuación Autorizada 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="PresupuestoAceptado" id="PresupuestoAceptado" data-placeholder="Presupuesto Aceptado" >
                                  <option value="-" selected>-</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SolicitudRefacciones" class="col-sm-2 control-label">Solicitud De Refacciones 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="SolicitudRefacciones" id="SolicitudRefacciones" data-placeholder="Solicitud de Refacciones" >
                                      <option value="-" selected>-</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="refaccionesact" class="col-sm-2 control-label">Refacciones Necesarias 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="refaccionesact" id="refaccionesact" placeholder="Refacciones Necesarias" value="<?= set_value('refaccionesact'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TotalRefacciones" class="col-sm-2 control-label">Refacciones Conseguidas 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TotalRefacciones" id="TotalRefacciones" placeholder="Refacciones Conseguidas" value="<?= set_value('TotalRefacciones'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="CantidadRefacciones" class="col-sm-2 control-label">Cálculo Refacciones Disponibles  
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="CantidadRefacciones" id="calculo" placeholder="Cálculo Refacciones Disponibles " value="<?= set_value('CantidadRefacciones'); ?>" >
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                        <div id="choosepass" class="form-group ">
                            <label for="RefaccionesDispoiblesPorcentaje" class="col-sm-2 control-label">Refacciones Faltantes
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" name="RefaccionesDispoiblesPorcentaje" id="RefaccionesDispoiblesPorcentaje" placeholder="Refacciones Faltantes" value="<?= set_value('refacciones_faltantes'); ?>">
                                <small class="info help-block">
                                    <b>Refacciones Faltantes Calculadas</b>
                                </small>
                                
                                <small style="color:#FF0000;" class="nosamepass">
                                    <b>El porcentaje no coincide con el cálculo.</b>
                                </small>
                            </div>
                        </div>
                        
                                                <!-- <div id="choosepass" class="form-group ">
                            <label for="RefaccionesDispoiblesPorcentaje" class="col-sm-2 control-label">Refacciones Disponibles % 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="RefaccionesDispoiblesPorcentaje" id="RefaccionesDispoiblesPorcentaje" placeholder="Refacciones Disponibles %" value="<?= set_value('RefaccionesDispoiblesPorcentaje'); ?>">
                                <small class="info help-block">
                                    <b>Confirma el porcentaje calculado</b>
                                </small>
                                
                                <small style="color:#FF0000;" class="nosamepass">
                                    <b>El porcentaje no coincide con el cálculo.</b>
                                </small>
                            </div>
                        </div> -->
                        
                        
                        <div class="form-group conditional" data-cond-option="RefaccionesDispoiblesPorcentaje" data-cond-value="100" >
                            <label for="ReparacionUnidadPorcentaje" class="col-sm-2 control-label">Reparación de partes % 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ReparacionUnidadPorcentaje" id="ReparacionUnidadPorcentaje" placeholder="Reparación Unidad %" value="-">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        
   
                        <div class="form-group conditional" data-cond-option="RefaccionesDispoiblesPorcentaje" data-cond-value="100">
                            <label for="UnidadProgRampa" class="col-sm-2 control-label">Unidad En Rampa 
                            </label>
                            <div class="col-sm-8">
                                
                                <div style="display:none;" class="col-md-3 padding-left-0" >
                                    <label>
                                    <input type="radio" class="flat-red" name="UnidadProgRampa" id="UnidadProgRampa"  value="-" checked> -</label>
                                    </div>
                                
                                <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="UnidadProgRampa" id="UnidadProgRampa"  value="SI"> SI</label>
                                    </div>
                                <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="UnidadProgRampa" id="UnidadProgRampa" value="NO"> No</label>
                                    </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>    
                        
                        
                                                
                                                 
                                                <div class="form-group conditional" data-cond-option="RefaccionesDispoiblesPorcentaje" data-cond-value="100">
                            <label for="Deducible" class="col-sm-2 control-label">Deducible 
                            </label>
                            <div class="col-sm-8">
                                
                                <div style="display:none;" class="col-md-3 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="Deducible" id="Deducible"  value="-" checked>-</label>
                                    </div>
                                
                                <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="Deducible" id="Deducible"  value="SI"> SI</label>
                                    </div>
                                <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input type="radio" class="flat-red" name="Deducible" id="Deducible" value="NO"> NO</label>
                                    </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group conditional" data-cond-option="RefaccionesDispoiblesPorcentaje" data-cond-value="100">
                            <label for="MontoDeducible" class="col-sm-2 control-label">Monto Deducible 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="MontoDeducible" id="MontoDeducible" placeholder="Monto Deducible" value="-">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group conditional" data-cond-option="RefaccionesDispoiblesPorcentaje" data-cond-value="100">
                            <label for="FechaEntrega" class="col-sm-2 control-label">Fecha Promesa 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="FechaEntrega"  placeholder="Fecha Promesa" id="FechaEntrega">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<!-- Page script -->
<script>
    $(document).ready(function(){
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/reporte';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_reporte = $('#form_reporte');
        var data_post = form_reporte.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/reporte/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
       
 
$(function(){
    
    $('#refaccionesact').on('input', function() {
      calculate();
    });
    $('#TotalRefacciones').on('input', function() {
     calculate();
    });
    function calculate(){
        var pPos = parseInt($('#refaccionesact').val()); 
        var pEarned = parseInt($('#TotalRefacciones').val());
        var refacFaltantes = "";
        var perc="";
        if(isNaN(pPos) || isNaN(pEarned)){
            perc=" ";
            refacFaltantes = "";
        }else{
           perc = ((pEarned/pPos) * 100).toFixed();
           refacFaltantes = pPos-pEarned;
        }
        
        $('#RefaccionesDispoiblesPorcentaje').val(refacFaltantes);
        $('.conditional').conditionize();
        $('#calculo').val(perc);
    }

});
       
$("#RefaccionesDispoiblesPorcentaje").keyup(function() {
//   if ($("#calculo").val() != $("#RefaccionesDispoiblesPorcentaje").val()) {
if ($("#RefaccionesDispoiblesPorcentaje").val() != 0) {
//     $(".nosamepass").fadeIn('slow');
//     $("#choosepass > input").css("border", "5px solid #ff0033");
//   } else {
    $(".nosamepass").fadeOut('slow');
    $("#choosepass > input").css("border", "5px solid #232323");
  }
});
    
    
    }); /*end doc ready*/
</script>
<script>
(function($) {
    $('#NumeroReporte').keyup(function () {
        var form_reporte = $('#form_reporte');
        var data_post = form_reporte.serializeArray();
        var numReporte = $(this).val();
        data_post.push({name: 'NumeroReporte', value: numReporte});

        $.ajax({
          url: BASE_URL + 'administrator/reporte/searchReporte',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        }).done(function(res) {
            if(res >= 1) {
                $("#errorNoReporteDuplicado").css("display", "block");
                $(".btn_action").prop("disabled", true);
            } else {
                $("#errorNoReporteDuplicado").css("display", "none");
                $(".btn_action").prop("disabled", false);
            }
        }).fail(function() {
            // $('.message').printMessage({message : 'Error save data', type : 'warning'});
        });
    });

    $("#perdida_total").change(function() {
        var perdidatotal = $(this).val();
        var pagodanos = $("#pago_danos").val();
        if(perdidatotal == "SI" && pagodanos == "NO" || perdidatotal == "SI" && pagodanos == "") {
            $('#PresupuestoEnviado').prop("disabled", true);
            $('#PresupuestoEnviado').trigger('chosen:updated');
            $('#PresupuestoAceptado').prop("disabled", true);
            $('#PresupuestoAceptado').trigger('chosen:updated');
            $('#SolicitudRefacciones').prop("disabled", true);
            $('#SolicitudRefacciones').trigger('chosen:updated');
            $('#refaccionesact').prop("disabled", true);
            $('#TotalRefacciones').prop("disabled", true);
            $('#calculo').prop("disabled", true);
            $('#RefaccionesDispoiblesPorcentaje').prop("disabled", true);
            $('#ReparacionUnidadPorcentaje').prop("disabled", true);
            $('#UnidadProgRampa').prop("disabled", true);
            $('#Deducible').prop("disabled", true);
            $('#MontoDeducible').prop("disabled", true);
            $('#FechaEntrega').prop("disabled", true);
        } else if(perdidatotal == "NO" && pagodanos == "NO" || perdidatotal == "NO" && pagodanos == "" || perdidatotal == "" && pagodanos == "") {
            $('#PresupuestoEnviado').prop("disabled", false);
            $('#PresupuestoEnviado').trigger('chosen:updated');
            $('#PresupuestoAceptado').prop("disabled", false);
            $('#PresupuestoAceptado').trigger('chosen:updated');
            $('#SolicitudRefacciones').prop("disabled", false);
            $('#SolicitudRefacciones').trigger('chosen:updated');
            $('#refaccionesact').prop("disabled", false);
            $('#TotalRefacciones').prop("disabled", false);
            $('#calculo').prop("disabled", false);
            $('#RefaccionesDispoiblesPorcentaje').prop("disabled", false);
            $('#ReparacionUnidadPorcentaje').prop("disabled", false);
            $('#UnidadProgRampa').prop("disabled", false);
            $('#Deducible').prop("disabled", false);
            $('#MontoDeducible').prop("disabled", false);
            $('#FechaEntrega').prop("disabled", false);
        }
    });
    $("#pago_danos").change(function(){
        var perdidatotal = $("#perdida_total").val();
        var pagodanos = $(this).val();
        if(pagodanos == "SI" && perdidatotal == "NO" || pagodanos == "SI" && perdidatotal == "") {
            $('#PresupuestoEnviado').prop("disabled", true);
            $('#PresupuestoEnviado').trigger('chosen:updated');
            $('#PresupuestoAceptado').prop("disabled", true);
            $('#PresupuestoAceptado').trigger('chosen:updated');
            $('#SolicitudRefacciones').prop("disabled", true);
            $('#SolicitudRefacciones').trigger('chosen:updated');
            $('#refaccionesact').prop("disabled", true);
            $('#TotalRefacciones').prop("disabled", true);
            $('#calculo').prop("disabled", true);
            $('#RefaccionesDispoiblesPorcentaje').prop("disabled", true);
            $('#ReparacionUnidadPorcentaje').prop("disabled", true);
            $('#UnidadProgRampa').prop("disabled", true);
            $('#Deducible').prop("disabled", true);
            $('#MontoDeducible').prop("disabled", true);
            $('#FechaEntrega').prop("disabled", true);
        } else if(pagodanos == "NO" && perdidatotal == "NO" || pagodanos == "NO" && perdidatotal == "" || pagodanos == "" && perdidatotal == "") {
            $('#PresupuestoEnviado').prop("disabled", false);
            $('#PresupuestoEnviado').trigger('chosen:updated');
            $('#PresupuestoAceptado').prop("disabled", false);
            $('#PresupuestoAceptado').trigger('chosen:updated');
            $('#SolicitudRefacciones').prop("disabled", false);
            $('#SolicitudRefacciones').trigger('chosen:updated');
            $('#refaccionesact').prop("disabled", false);
            $('#TotalRefacciones').prop("disabled", false);
            $('#calculo').prop("disabled", false);
            $('#RefaccionesDispoiblesPorcentaje').prop("disabled", false);
            $('#ReparacionUnidadPorcentaje').prop("disabled", false);
            $('#UnidadProgRampa').prop("disabled", false);
            $('#Deducible').prop("disabled", false);
            $('#MontoDeducible').prop("disabled", false);
            $('#FechaEntrega').prop("disabled", false);
        }
    });
  $.fn.conditionize = function(options){ 
    
     var settings = $.extend({
        hideJS: true
    }, options );
    
    $.fn.showOrHide = function(listenTo, listenFor, $section) {
        // console.log(listenTo +"=="+ listenFor);
    //   if ($(listenTo).is('select, input[type=text]') && $(listenTo).val() == listenFor ) {
      if ($(listenTo).is('select, input[type=text]') && $(listenTo).val() == "0" ) {
        $section.slideDown();
      }
      else if ($(listenTo + ":checked").val() == "0") {
        $section.slideDown();
      }
      else {
        $section.slideUp();
      }
    } 

    return this.each( function() {
      var listenTo = "[name=" + $(this).data('cond-option') + "]";
      var listenFor = $(this).data('cond-value');
      var $section = $(this);
  
      //Set up event listener
      $(listenTo).on('change', function() {
        $.fn.showOrHide(listenTo, listenFor, $section);
      });
      //If setting was chosen, hide everything first...
      if (settings.hideJS) {
        $(this).hide();
      }
      //Show based on current value on page load
      $.fn.showOrHide(listenTo, listenFor, $section);
    });
  }
}(jQuery));
  
 $('.conditional').conditionize();

</script>




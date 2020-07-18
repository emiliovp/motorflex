
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Reporte      <small><?= cclang('detail', ['Reporte']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/reporte'); ?>">Reporte</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Reporte</h3>
                     <h5 class="widget-user-desc">Detail Reporte</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_reporte" id="form_reporte" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">IdReporte </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->IdReporte); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Número De Reporte </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->NumeroReporte); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Cliente </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->persona_Apellidos); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Fecha De Ingreso </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->fechaingreso); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Orden </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->orden); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Marca </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->cat_marca_Descripcion); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Modelo </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->modelo); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Año </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->ano); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Comentario Interno </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->comentario_interno); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Comentario Externo </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->comentario_externo); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Valuacion </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->Valuacion); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Perdida Total </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->perdida_total); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Pago de Daños </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->pago_danos); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Presupuesto Enviado </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->PresupuestoEnviado); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Presupuesto Aceptado </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->PresupuestoAceptado); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Solicitud De Refacciones </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->SolicitudRefacciones); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Refacciones Necesarias </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->refaccionesact); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Refacciones Conseguidas </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->TotalRefacciones); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Refacciones Faltantes </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->refacciones_faltantes); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Unidad En Rampa </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->UnidadProgRampa); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Reparación Unidad % </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->ReparacionUnidadPorcentaje); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Deducible </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->Deducible); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Monto Deducible </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->MontoDeducible); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Fecha Promesa </label>

                        <div class="col-sm-8">
                           <?= _ent($reporte->FechaEntrega); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('reporte_update', function() use ($reporte){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit reporte (Ctrl+e)" href="<?= site_url('administrator/reporte/edit/'.$reporte->IdReporte); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Reporte']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/reporte/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Reporte']); ?></a>
                     </div>
                    
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->

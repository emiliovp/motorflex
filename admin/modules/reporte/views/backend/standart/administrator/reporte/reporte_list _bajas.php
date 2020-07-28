<style type="text/css">
#circulo1 {
	width: 2rem;
	height: 2rem;
	border-radius: 50%;
	background: #008000;
	display: flex;
	justify-content: center;
	align-items: center;
	text-align: center;
}
#circulo2 {
	width: 2rem;
	height: 2rem;
	border-radius: 50%;
	background: #FFEA00;
	display: flex;
	justify-content: center;
	align-items: center;
	text-align: center;
}
#circulo3 {
	width: 2rem;
	height: 2rem;
	border-radius: 50%;
	background: red;
	display: flex;
	justify-content: center;
	align-items: center;
	text-align: center;
}
</style>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Reporte/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Reporte<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Reporte</li>
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
                     <div class="row pull-right">
                        <?php is_allowed('reporte_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Reporte" href="<?= site_url('administrator/reporte/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('reporte_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Reporte" href="<?= site_url('administrator/reporte/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Reporte</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Reporte']); ?>  <i class="label bg-yellow"><?= $reporte_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_reporte" id="form_reporte" action="<?= base_url('administrator/reporte/reporteBajas'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>PT</th>
                           <th>PE</th>
                           <th>Número De Reporte</th>
                           <th>Cliente</th>
                           <th>Fecha De Ingreso</th>
                           <th>Fecha Reporte</th>
                           <th>Orden</th>
                           <th>Marca</th>
                           <th>Modelo</th>
                           <th>Año</th>
                           <th>Valuacion</th>
                           <th>Perdida Total</th>
                           <th>Presupuesto Enviado</th>
                           <th>Valuación Autorizada</th>
                           <th>Solicitud De Refacciones</th>
                           <th>Refacciones Necesarias</th>
                           <th>Refacciones Conseguidas</th>
                           <th>Refacciones Disponibles %</th>
                           <th>Unidad En Rampa</th>
                           <th>Reparación Unidad %</th>
                           <th>Deducible</th>
                           <th>Monto Deducible</th>
                           <th>Fecha Promesa</th>
                           <th>Estatus</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_reporte">
                     <?php foreach($reportes as $reporte): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $reporte->IdReporte; ?>">
                           </td>
                           <td><?php if($reporte->dias <= 10){
                              $circulo = 'circulo1';
                           }else if ($reporte->dias > 10 && $reporte->dias <= 20) {
                              $circulo = 'circulo2';
                           }else if ($reporte->dias > 20){
                              $circulo = 'circulo3';
                           }
                           ?><div id="<?php echo($circulo); ?>"></div></td>
                           <td><?php $circulo_pe = 'circulo1';
                           if($reporte->dias_presupuesto <= 1){
                              $circulo_pe = 'circulo1';
                           }else if ($reporte->dias_presupuesto > 1 && $reporte->PresupuestoEnviado == 'SI' && $reporte->PresupuestoAceptado == 'NO') {
                              $circulo_pe = 'circulo3';
                           }else if ($reporte->dias_presupuesto >= 1 && $reporte->PresupuestoAceptado == 'SI') {
                              $circulo_pe = 'circulo1';
                           }
                           ?><div id="<?php echo($circulo_pe); ?>"></div></td>
                           <td><?= _ent($reporte->NumeroReporte); ?></td> 
                           <td><?= _ent($reporte->persona_Apellidos); ?></td>
                             
                           <td><?= _ent($reporte->fechaingreso); ?></td> 
                           <td><?= _ent($reporte->created_at); ?></td>
                           <td><?= _ent($reporte->orden); ?></td> 
                           <td><?= _ent($reporte->cat_marca_Descripcion); ?></td>
                             
                           <td><?= _ent($reporte->modelo); ?></td> 
                           <td><?= _ent($reporte->ano); ?></td> 
                           <td><?= _ent($reporte->Valuacion); ?></td> 
                           <td><?= _ent($reporte->perdida_total); ?></td> 
                           <td><?= _ent($reporte->PresupuestoEnviado); ?></td> 
                           <td><?= _ent($reporte->PresupuestoAceptado); ?></td> 
                           <td><?= _ent($reporte->SolicitudRefacciones); ?></td> 
                           <td><?= _ent($reporte->refaccionesact); ?></td> 
                           <td><?= _ent($reporte->TotalRefacciones); ?></td> 
                           <td><?= _ent($reporte->RefaccionesDispoiblesPorcentaje); ?></td> 
                           <td><?= _ent($reporte->UnidadProgRampa); ?></td> 
                           <td><?= _ent($reporte->ReparacionUnidadPorcentaje); ?></td> 
                           <td><?= _ent($reporte->Deducible); ?></td> 
                           <td><?= _ent($reporte->MontoDeducible); ?></td> 
                           <td><?= _ent($reporte->FechaEntrega); ?></td>
                           <td><?php $var= $reporte->estado; switch ($var) {
                              case '1':
                                 $estado = "EN TRANSITO";
                                 break;
                              case '2':
                                 $estado = "PISO";
                                 break;
                              case '3':
                                 $estado = "RAMPA";
                                 break;
                              case '3':
                                 $estado = "TERMINADO";
                                 break;
                           } echo($estado); ?></td> 
                           <td width="200">
                              <?php is_allowed('reporte_delete', function() use ($reporte){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/reporte/activar/' . $reporte->IdReporte); ?>" class="label-default remove-data"><i class="fa fa-close"></i> Recuperar</a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($reporte_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Reporte data is not available
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row" id="tiempos" style="display:none">
                  <div class="col-md-12">
                     <div class="col-sm-4 padd-left-0">
                        <label class="form-control">Los valores para el filtrado son: En tiempo = V</label>
                     </div>
                     <div class="col-sm-1 padd-left-0">
                        <div id="circulo1"></div>
                     </div>
                     <div class="col-sm-2 padd-left-0">
                        <label class="form-control">Por vencer = A</label>
                     </div>
                     <div class="col-sm-1 padd-left-0">
                        <div id="circulo2"></div>
                     </div>
                     <div class="col-sm-2 padd-left-0">
                        <label class="form-control">Vencido = R</label>
                     </div>
                     <div class="col-sm-2 padd-left-0">
                        <div id="circulo3"></div>
                     </div>
                  </div>
               </div>
               <div class="row" id="tiempos2" style="display:none">
                  <div class="col-md-12">
                     <div class="col-sm-4 padd-left-0">
                        <label class="form-control">Los valores para el filtrado son: En tiempo = V</label>
                     </div>
                     <div class="col-sm-1 padd-left-0">
                        <div id="circulo1"></div>
                     </div>
                     <div class="col-sm-2 padd-left-0">
                        <label class="form-control">Vencido = R</label>
                     </div>
                     <div class="col-sm-2 padd-left-0">
                        <div id="circulo3"></div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <!--<option value="delete">Delete</option>-->
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value="todo"><?= cclang('all'); ?></option>
                           <option <?= $this->input->get('f') == 'pt' ? 'selected' :''; ?> value="pt">PT</option>
                           <option <?= $this->input->get('f') == 'pe' ? 'selected' :''; ?> value="pe">PE</option>
                           <option <?= $this->input->get('f') == 'NumeroReporte' ? 'selected' :''; ?> value="NumeroReporte">Numero Reporte</option>
                           <option <?= $this->input->get('f') == 'cliente' ? 'selected' :''; ?> value="cliente">Cliente</option>
                           <option <?= $this->input->get('f') == 'fechaingreso' ? 'selected' :''; ?> value="fechaingreso">Fecha ingreso</option>
                           <option <?= $this->input->get('f') == 'orden' ? 'selected' :''; ?> value="orden">Orden</option>
                           <option <?= $this->input->get('f') == 'marca' ? 'selected' :''; ?> value="marca">Marca</option>
                           <option <?= $this->input->get('f') == 'modelo' ? 'selected' :''; ?> value="modelo">Modelo</option>
                           <option <?= $this->input->get('f') == 'ano' ? 'selected' :''; ?> value="ano">Ano</option>
                           <option <?= $this->input->get('f') == 'Valuacion' ? 'selected' :''; ?> value="Valuacion">Valuacion</option>
                           <option <?= $this->input->get('f') == 'PresupuestoEnviado' ? 'selected' :''; ?> value="PresupuestoEnviado">Presupuesto Enviado</option>
                           <option <?= $this->input->get('f') == 'PresupuestoAceptado' ? 'selected' :''; ?> value="PresupuestoAceptado">Presupuesto Aceptado</option>
                           <option <?= $this->input->get('f') == 'SolicitudRefacciones' ? 'selected' :''; ?> value="SolicitudRefacciones">Solicitud Refacciones</option>
                           <option <?= $this->input->get('f') == 'refaccionesact' ? 'selected' :''; ?> value="refaccionesact">Refaccionesact</option>
                           <option <?= $this->input->get('f') == 'TotalRefacciones' ? 'selected' :''; ?> value="TotalRefacciones">Total Refacciones</option>
                           <option <?= $this->input->get('f') == 'RefaccionesDispoiblesPorcentaje' ? 'selected' :''; ?> value="RefaccionesDispoiblesPorcentaje">RefaccionesDispoiblesPorcentaje</option>
                           <option <?= $this->input->get('f') == 'UnidadProgRampa' ? 'selected' :''; ?> value="UnidadProgRampa">Unidad Prog Rampa</option>
                           <option <?= $this->input->get('f') == 'ReparacionUnidadPorcentaje' ? 'selected' :''; ?> value="ReparacionUnidadPorcentaje">ReparacionUnidadPorcentaje</option>
                           <option <?= $this->input->get('f') == 'Deducible' ? 'selected' :''; ?> value="Deducible">Deducible</option>
                           <option <?= $this->input->get('f') == 'MontoDeducible' ? 'selected' :''; ?> value="MontoDeducible">Monto Deducible</option>
                           <option <?= $this->input->get('f') == 'FechaEntrega' ? 'selected' :''; ?> value="FechaEntrega">Fecha Entrega</option>
                           <option <?= $this->input->get('f') == 'estatus' ? 'selected' :''; ?> value="estatus">Estatus</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/reporte/reporteBajas');?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>
                  </form>                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
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

<!-- Page script -->
<script>
  $(document).ready(function(){
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('are_you_sure_to_activate_the_registration'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_activate_registration'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_reporte').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('are_you_sure_to_activate_the_registration'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_activate_registration'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/reporte/activar?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });
    $(document).on('change','#field',function(){
      var tiempo = $(this).val();
      if (tiempo == 'pt'){
         $('#tiempos').show();
         $('#tiempos2').hide();
      }else if(tiempo == 'pe'){
         $('#tiempos2').show();
         $('#tiempos').hide();
      }else{
         $('#tiempos').hide();
         $('#tiempos2').hide();
      }
   });
  }); /*end doc ready*/
</script>
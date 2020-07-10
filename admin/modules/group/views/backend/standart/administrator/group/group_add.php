<!-- Fine Uploader Gallery CSS file
====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-new.css" rel="stylesheet">

<!-- Fine Uploader jQuery JS file
====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
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
      Group
      <small><?= cclang('new', 'Group'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/group'); ?>">Group</a></li>
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
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="Group Avatar">
                     </div>
                     <!-- /.widget-group-image -->
                     <h3 class="widget-user-username">Group</h3>
                     <h5 class="widget-user-desc"><?= cclang('new', 'Group'); ?></h5>
                     <hr>
                  </div>

                   <?= form_open('', [
                    'name'    => 'form_group', 
                    'class'   => 'form-horizontal', 
                    'id'      => 'form_group', 
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST'
                  ]); ?>

                    <div class="form-group ">
                        <label for="name" class="col-sm-2 control-label">Name <i class="required">*</i></label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= set_value('name'); ?>">
                           <small class="info help-block">The name of group.</small>
                        </div>
                     </div>

                     <div class="form-group ">
                        <label for="definition" class="col-sm-2 control-label">Definition </label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" name="definition" id="definition" placeholder="Definition" value="<?= set_value('definition'); ?>">
                           <small class="info help-block">The definition of group.</small>
                        </div>
                     </div>
                    <div class="message">
                      
                    </div>

                    <div class="row-fluid col-md-7">
                        <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="save (Ctrl+s)"><i class="fa fa-save" ></i> <?= cclang('save_button'); ?></button>
                     <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)"><i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?></a>
                     <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)"><i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?></a>
                     <span class="loading loading-hide"><img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> <i><?= cclang('loading_saving_data'); ?></i></span>
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


<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
  $(document).ready(function() {

      $('.show-password').mousedown(function() {
          $(this).parent().parent().find('.password').attr('type', 'text');
      });
      $('.show-password').mouseup(function() {
          $(this).parent().parent().find('.password').attr('type', 'password');
      });


      $('#btn_cancel').click(function() {
          swal({
                  title: "Are you sure?",
                  text: "the data that you have created will be in the exhaust!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes!",
                  cancelButtonText: "No!",
                  closeOnConfirm: true,
                  closeOnCancel: true
              },
              function(isConfirm) {
                  if (isConfirm) {
                      window.location.href = HTTP_REFERER;
                  }
              });

          return false;
      }); /*end btn cancel*/

      $('.btn_save').click(function() {
          $('.message').fadeOut();

          var form_group = $('#form_group');
          var data_post = form_group.serializeArray();
          var save_type = $(this).attr('data-stype');

          data_post.push({
              name: 'save_type',
              value: save_type
          });

          $('.loading').show();

          $.ajax({
                  url: BASE_URL + '/administrator/group/add_save',
                  type: 'POST',
                  dataType: 'json',
                  data: data_post,
              })
              .done(function(res) {
                  if (res.success) {
                      var id = $('#group_avatar_galery').find('li').attr('qq-file-id');

                      if (save_type == 'back') {
                          window.location.href = res.redirect;
                          return;
                      }

                      $('.message').printMessage({
                          message: res.message
                      });
                      $('form input[type != hidden], form textarea, form select').val('');
                      $('#group_avatar_galery').fineUploader('deleteFile', id);

                  } else {
                      $('.message').printMessage({
                          message: res.message,
                          type: 'warning'
                      });
                  }

              })
              .fail(function() {
                  $('.message').printMessage({
                      message: 'Error save data',
                      type: 'warning'
                  });
              })
              .always(function() {
                  $('.loading').hide();
                  $('html, body').animate({
                      scrollTop: $(document).height()
                  }, 1000);
              });

          return false;
      }); /*end btn save*/

  }); /*end doc ready*/
</script>

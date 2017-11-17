<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?php $this->load->view('backend/admin_css') ?>     
  <?php $this->load->view('backend/modules/'.$module_name.'/css/'.$additional_css) ?>        

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/dist/css/skins/_all-skins.min.css">
  <!-- jQuery 2.1.4 -->
<script src="<?= base_url() ?>assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
  
</head>
<!-- ADD THE CLASS sidedar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition <?=$this->session->userdata('skin');?> sidebar-collapse sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<?php $this->load->view('backend/partials/header') ?>  

  <!-- =============================================== -->

<?php $this->load->view('backend/partials/left_side') ?>    

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <?php $this->load->view('backend/modules/'.$module_name.'/pages/'.$page) ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> <?=APP_VERSION?>
    </div>
    <strong>Copyright &copy; <?=date('Y')?> </strong><?= APP_NAME ?>. All rights
    reserved.
  </footer>

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php $this->load->view('backend/admin_js') ?>

<!-- SlimScroll -->
<script src="<?= base_url() ?>assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>assets/adminlte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/adminlte/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/adminlte/dist/js/demo.js"></script>

<!-- /.box -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<!-- date range -->
<script src="<?=base_url()?>assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<?php $this->load->view('backend/modules/'.$module_name.'/css/'.$additional_js) ?>        
<script type="text/javascript">
  //Date range picker
    $(function() {
    $('input[name="daterange"]').daterangepicker({
        timePickerIncrement: 30,
        locale: {
            format: 'YYYY'
        }
    });
});
</script>
</body>
</html>

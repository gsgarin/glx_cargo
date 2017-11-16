<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_NAME?>|<?php echo $var_title?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php $this->load->view('backend/modules/'.$module_name.'/css/general') ?>    

    <?php $this->load->view('backend/modules/'.$module_name.'/css/'.$css_files) ?>
  </head>
  <body class="hold-transition login-page">

    <?php $this->load->view("backend/modules/$module_name/pages/$page"); ?> 

    <?php $this->load->view('backend/modules/'.$module_name.'/js/general') ?>  
    <?php $this->load->view('backend/modules/'.$module_name.'/js/'.$js_files) ?>
  </body>
</html>
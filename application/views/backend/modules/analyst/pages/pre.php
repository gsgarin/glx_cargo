<!-- daterange picker -->
<link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datepicker/datepicker3.css">

<?= form_open('backoffice/analyst/pre') ?>
<div class="box box-primary">
<div class="box-header">
  <h3 class="box-title"><?=$page_name?></h3>
</div>
<div class="box-body">
  <div class="row">
  	<div class="col-md-6">
  		<!-- Date and time range -->
		  <div class="form-group">
		    <label>Pilih Jarak Waktu Analisa:</label>
		    <div class="input-group">
		      <div class="input-group-addon">
		        <i class="fa fa-clock-o"></i>
		      </div>
		      <input type="text" class="form-control pull-right" name="daterange" value="2016 - 2017" />
		    </div>
		  </div>
		  <div class="box-footer clearfix no-border">
		<input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
	</div>
		  
  	</div>
  </div>


  

</div>
<!-- /.box-body -->
</div>
<?= form_close()?>
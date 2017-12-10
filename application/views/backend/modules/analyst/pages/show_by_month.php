<div class="box box-primary">
  <div class="box-header">
    <i class="ion ion-clipboard"></i>
    
    <h3 class="box-title" align="center"><?=$page_name?></h3>
    <a href="<?=$next_step?>" class="btn btn-success pull-right">Next &raquo; </a>
    <br><br>

    <div class="box-tools pull-right">
      <ul class="pagination pagination-sm inline">
        <!-- <li class="active[0]?>"><a href="#">1</a></li>
        <li class="$active[1]?>"><a href="#">2</a></li>
        <li class="$active[2]?>"><a href="#">3</a></li>
        <li class="$active[3]?>"><a href="#">4</a></li>
        <li class="$active[4]?>"><a href="#">5</a></li> -->
      </ul>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <b>Jumlah data</b> dari data tahun <?=$startYear?> sampai tahun <?=$endYear?> =  <b><?=$count_data_rule?> data</b>
    <br><br>
    <b>Total akumulasi qty</b> dari data tahun <?=$startYear?> sampai tahun <?=$endYear?> = <b><?=$total_qty?></b>
    <br><br><br>
    


<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">
<table id="example1" class="table table-bordered table-striped">
  <thead>
  <tr>
    <th>Prob Qty</th>
    <th>Jumlah Nilai Qty</th>
    <th>Percentage</th>
    <th>Kota dan Qty</th>
    <th>Hasil Bagi(Kota & Qty)</th>
    <th>Bulan dan Qty</th>
    <th>Hasil Bagi(Bulan & Qty)</th>
    <th>Bayes</th>
  </tr>
  </thead>

  <tbody>
    <?php foreach ($result_by_month as $item) {
        if ($item['bayes'] == $max_value) { ?>
          <tr style="background-color: red">
            <td><?=$item['prob_qty']?></td>
            <td><?=$item['percentage']?></td>
            <td><?=$item['nilai_qty']?></td>
            <td><?=$item['cond_kota_qty']?></td>
            <td><?=$item['bagi_kota_qty']?></td>
            <td><?=$item['cond_bulan_qty']?></td>
            <td><?=$item['bagi_bulan_qty']?></td>
            <td><?=$item['bayes']?></td>
          </tr>
        <?php } else{
     ?>
    <tr>
      <td><?=$item['prob_qty']?></td>
      <td><?=$item['nilai_qty']?></td>
      <td><?=$item['percentage']?></td>
      <td><?=$item['cond_kota_qty']?></td>
      <td><?=$item['bagi_kota_qty']?></td>
      <td><?=$item['cond_bulan_qty']?></td>
      <td><?=$item['bagi_bulan_qty']?></td>
      <td><?=$item['bayes']?></td>
    </tr>
    <?php } } ?>
    
  </tbody>
  
  <tfoot>
  <tr>
    <th>Prob Qty</th>
    <th>Jumlah Nilai Qty</th>
    <th>Percentage</th>
    <th>Kota dan Qty</th>
    <th>Hasil Bagi(Kota & Qty)</th>
    <th>Bulan dan Qty</th>
    <th>Hasil Bagi(Bulan & Qty)</th>
    <th>Bayes</th>
  </tr>
  </tfoot>
</table>


  </div>
  <!-- /.box-body -->
  <div class="box-footer clearfix no-border">
    <?php if ($previous == true) { ?>
      <a href="<?=$prev_step?>" class="btn btn-warning pull-left">&laquo;  Previous </a>
    <?php } ?>
    
    <a href="<?=$next_step?>" class="btn btn-success pull-right">Next &raquo; </a>
  </div>
</div>
<!-- /.box -->
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      responsive: true,
    });
  });


</script>


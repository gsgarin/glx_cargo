<div class="box box-primary">
  <div class="box-header">
    <i class="ion ion-clipboard"></i>
    
    <h3 class="box-title" align="center"><?=$page_name?></h3>
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
    
    
    


<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">
<table id="example1" class="table table-bordered table-striped">
  <thead>
  <tr>
    <th>#</th>
    <th>Bulan</th>
    <th>Hasil Probabilitas</th>
    <th>Probabilitas Tertinggi</th>
    <th>Qty</th>
  </tr>
  </thead>

  <tbody>
    <?php $count = 1; foreach ($get_result_by_rule as $item) { ?>
      <tr>
        <td><?=$count?></td>
        <td><?=$item['bulan']?></td>
        <td><?=$item['hasil_probabilitas']?></td>
        <td><?=$item['probabilitas_tertinggi']?></td>
        <td><?=$item['qty']?></td>
      </tr>
    <?php $count++; } ?>
    
  </tbody>
  
  <tfoot>
  <tr>
    <th>#</th>
    <th>Bulan</th>
    <th>Hasil Probabilitas</th>
    <th>Probabilitas Tertinggi</th>
    <th>Qty</th>
  </tr>
  </tfoot>
</table>


  </div>
  <!-- /.box-body -->
  <div class="box-footer clearfix no-border">
    <a href="<?=$prev_step?>" class="btn btn-warning pull-left">&laquo;  Previous </a>
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

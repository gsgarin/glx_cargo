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
    <th>Tahun Mulai</th>
    <th>Tahun Berakhir</th>
    <th>Total Qty Pada Jangka</th>
    <th>Aksi</th>
  </tr>
  </thead>

  <tbody>
    <?php $count = 1; foreach ($rule_list as $item) { ?>
      <tr>
        <td><?=$count?></td>
        <td><?=$item['year_start']?></td>
        <td><?=$item['year_end']?></td>
        <td><?=$item['total_qty']?></td>
        <td>
        	<a class="btn btn-primary" href="<?=base_url()?>backoffice/analyst/show_by_year/<?=$item['year_start']?>/<?=$item['year_end']?>"><i class="fa fa-gears"></i> Analisa</a>
        	|
        	<a class="btn btn-success" href="<?=base_url()?>backoffice/laporan/<?=$item['year_start']?>/<?=$item['year_end']?>"><i class="fa fa-book"></i> Laporan</a>
        </td>
      </tr>
    <?php $count++; } ?>
    
  </tbody>
  
  <tfoot>
  <tr>
    <th>#</th>
    <th>Tahun Mulai</th>
    <th>Tahun Berakhir</th>
    <th>Total Qty Pada Jangka</th>
    <th>Aksi</th>
  </tr>
  </tfoot>
</table>


  </div>
  <!-- /.box-body -->
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

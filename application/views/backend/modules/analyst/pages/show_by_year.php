<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">
<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
    <th>#</th>
    <th>Kota</th>
    <th>Kuantitas</th>
  </tr>
  </thead>
  
  <tfoot>
  <tr>
    <th>#</th>
    <th>Kota</th>
    <th>Kuantitas</th>
  </tr>
  </tfoot>
</table>
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });

/* Formatting function for row details - modify as you need */
function format ( d ) {
  
    // `d` is the original data object for the row
    return '<table id="table'+d.id+'" class="table table-bordered table-striped">'+
  '<thead>'+
  '<tr>'+
    '<th>Customer</th>'+
    '<th width="30px">Kuantitas</th>'+
    '<th width="100px">Tanggal</th>'+
  '</tr>'+
  '</thead>'+
  '<tfoot>'+
  '<tr>'+
    '<th>Customer</th>'+
    '<th width="30px">Kuantitas</th>'+
    '<th width="100px">Tanggal</th>'+
  '</tr>'+
  '</tfoot>'+
'</table>';
}
 
$(document).ready(function() {
  
    var table = $('#example').DataTable( {
        data: <?=json_encode($annually)?>,
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '',
                "width": "1%",
            },
            { "data": "kota" },
            { "data": "qty" },
        ],
        "order": [[2, 'asc']],
    } );
     
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
          //console.log(row.data()['kota']);
            var virtual_task_kota = row.data()['kota'];
            var subtable_id = row.data()['id'];
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
            sub_DataTable(virtual_task_kota, subtable_id);
        }
    } );

    function sub_DataTable(vtask_kota, table_id) {
    var subtable = $('#table'+table_id).DataTable({
        ajax: "<?=base_url()?>backoffice/dataByCity/<?= $startYear ?>/<?=$endYear ?>/"+vtask_kota,
        columns: [
                  {"data": "customer"},
                  {"data": "qty"},
                  {"data": "tanggal"},
            ],
        order: [[2, 'asc']]
    }); console.log(vtask_kota);
  }
} );

</script>
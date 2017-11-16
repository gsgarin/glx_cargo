<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url() ?>assets/adminlte/dist/img/avatar25.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?=$nama_user?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class=""><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class=""><a href="<?=base_url()?>backoffice/raw_data"><i class="fa fa-database"></i> <span>Raw Data</span></a></li>
      <!-- <li><a href="<?=base_url()?>backoffice/transaksi"><i class="fa fa-credit-card"></i> <span>Transaksi</span></a></li>
      <li><a href="<?=base_url()?>backoffice/analisa/pre"><i class="fa fa-cogs"></i> <span>Analisis</span></a></li>
      <li><a href="<?=base_url()?>backoffice/laporan"><i class="fa fa-line-chart"></i> <span>Laporan</span></a></li>
      <li class="header">SERVICES</li>
      <li><a href="<?=base_url()?>backoffice/menu_utama"><i class="fa fa-shopping-bag"></i> <span>Menu</span></a></li> -->
      <li class="header">USER MANAGEMENT</li>
      <li><a href="<?=base_url()?>backoffice/user"><i class="icon ion-happy-outline"></i><span>&nbsp;&nbsp;&nbsp;&nbsp;User</span></a></li>
      
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>  
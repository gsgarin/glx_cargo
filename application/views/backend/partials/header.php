<header class="main-header">
  <!-- Logo -->
  <a href="<?= base_url() ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><?=INITIAL?></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b style="text-transform: capitalize;"><?=$this->session->userdata('user_level'); ?></b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= base_url() ?>assets/adminlte/dist/img/avatar25.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?=$nama_user?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?= base_url() ?>assets/adminlte/dist/img/avatar25.png" class="img-circle" alt="User Image">

              <p style="text-transform: capitalize;">
                <?=$nama_user?> | <?=$this->session->userdata('user_level'); ?>
              </p>
            </li>
            
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="<?= base_url() ?>backoffice/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
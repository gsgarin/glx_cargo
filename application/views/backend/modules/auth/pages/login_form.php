<div class="login-box">
  <div class="login-logo">
    <!-- <a href="<?=base_url(); ?>"><b><?=APP_NAME?></b></a> -->
    <img src="<?=base_url(); ?>assets/logo.png">
  </div>
  <div class="login-box-body">
    <form action="<?=base_url(); ?>backoffice/login" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

  </div>
</div>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>登录</title>
<?php $this->load->view('tq_head'); ?>
</head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-box-body">
        <p class="login-box-msg">登录</p>
        <form action="<?php echo site_url('login/testphp'); ?>" method="get">

          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password" name="password" placeholder="密码:" required="required"/>
            <span class="fa fa-key form-control-feedback"></span>
          </div>
        

        <br>
        <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button><br>
        <a type="button" href="<?php echo site_url('forgetpassword'); ?>">忘记密码？</a><br>

        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>public/plugins/js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>

  </body>
</html>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>登录</title>
<?php $this->load->view('tq_head'); ?>
</head>
  <body class="hold-transition login-page">
    <div class="login-box">
    <?php $this->load->view('tq_alerts'); ?>
      <div class="login-logo">
        <b>使命</b>青年团契
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">登录</p>
        <form action="<?php echo base_url('login'); ?>" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control"  id="user_name" name="user_name" placeholder="邮箱账号:" required="required" />
            <span class="fa fa-envelope-o  form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password" name="password" placeholder="密码:" required="required"/>
            <span class="fa fa-key form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="form-group col-xs-4">
               <input type="text" class="form-control" id="checkcode" name="checkcode" placeholder="验证码:" required="required" AUTOCOMPLETE="off"/>
            </div><!-- /.col -->
            <div class="form-group col-xs-4">
               <img id="checkpic" onclick="changing()" src='public/images/checkcode.php'>
            </div><!-- /.col -->
            <div class="form-group col-xs-4">
               <a href="javascript:;"  onclick="changing()" style="color:red;"><small style="width:80px;height:34px">看不清，点击刷新</small></a>
            </div><!-- /.col -->
          </div>

        <br>
        <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button><br>
        <a type="button" href="<?php echo base_url('forgetpassword'); ?>">忘记密码？</a><br>

        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>public/plugins/js/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function  changing() {
          document.getElementById('checkpic').src="public/images/checkcode.php?"+Math.random();
      }

    </script>
    
  </body>
</html>



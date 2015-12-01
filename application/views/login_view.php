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
       <form id="check_user_login" method="post" action="<?php echo site_url('login'); ?>">
          <div class="form-group has-feedback">
            <span class="fa fa-envelope-o  form-control-feedback"></span>
            <input type="email" class="form-control"  id="user_name" name="user_name" placeholder="邮箱账号:"  />
          </div>
          <div class="form-group has-feedback">
            <span class="fa fa-key form-control-feedback"></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="密码:" />
          </div>
          <div class="row">
            <div class="form-group col-xs-4">
               <input type="text" class="form-control" id="checkcode" name="checkcode" placeholder="验证码:"  AUTOCOMPLETE="off"/>
            </div><!-- /.col -->
            <div class="form-group col-xs-4">
               <img id="checkpic" onclick="changing()" src='<?php echo base_url();?>public/images/checkcode.php'>
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
    <script src="<?php echo base_url(); ?>public/plugins/js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/js/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>public/js/login_chekc.js"></script>
    <style type="text/css" >  

      input.error { border: 1px solid red; }
      label.error {

        padding-left: 16px;

        padding-bottom: 2px;

        font-weight: bold;

        color: #EA5200;
      }

    </style>
  </body>
</html>



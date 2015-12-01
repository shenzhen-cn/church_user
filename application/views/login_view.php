<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>登录</title>

</head>
  <body class="hold-transition login-page">
    
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

  </body>
</html>



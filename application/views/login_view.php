<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>登录</title>

</head>
  <body >
    <form action="<?php echo site_url('login/testphp'); ?>" method="get" autocomplete="on">
    First name: <input type="text" name="fname" required="required" /><br />
    Last name: <input type="text" name="lname"  required="required"/><br />
    E-mail: <input type="text" name="email" autocomplete="off"  required="required" /><br />
    <input type="submit" />
    </form>

  </body>
</html>



<?php  $nick = isset($nick) ? $nick : ''; ?>
    

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>完善个人信息</title>
  <?php $this->load->view('tq_head'); ?>
</head>
  <body class="hold-transition login-page">

   <div class="register-box">
     <?php $this->load->view('tq_alerts'); ?>
     <div class="register-logo">
       <b>使命</b>青年团契
     </div>
     <div class="register-box-body">
      <h3 class="profile-username text-center"><?php echo $nick; ?></h3>             
       <p class="login-box-msg">请您完善个人信息完善个人信息</p>
        <form action="<?php echo site_url('register/improveInformation'); ?>" method="post">
          <div class="box-body box-profile">

            <div class="form-group">
              <label for="sex">性别：</label>
              <select class="form-control select2" style="width: 100%;" name="sex">
                <option selected="selected">男</option>
                <option>女</option>
              </select>
            </div>

            <div class="form-group">
              <label>小组选择</label>
              <select class="form-control select2" style="width: 100%;" name="group_id">
              <?php if (isset($groupName)) {
                      foreach ($groupName as $k => $v) {
               ?>
                    <option value="<?php echo $v->id; ?>"><?php echo $v->group_name; ?></option>
              <?php }
                      }?>
              </select>
            </div><!-- /.form-group -->
          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-block">提交</button>
          </div>
        </form>       
     </div><!-- /.form-box -->
   </div><!-- /.register-box -->

   <!-- jQuery 2.1.4 -->
   <script src="<?php echo base_url(); ?>public/plugins/js/jquery-2.1.4.min.js"></script>
   <!-- Bootstrap 3.3.5 -->
   <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>   
   
  </body>
</html>

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
       <p class="login-box-msg">完善个人信息</p>
        <form action="<?php echo base_url('register/improveInformation'); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body box-profile">
            <img id="userHead_logo_preview"  class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>public/images/mrpho.jpg" style="width:150px;height:150px;" alt="上传头像">
            <h3 class="profile-username text-center"><?php echo $nick; ?></h3>  

            <div class="form-group">
              <div class="btn btn-primary btn-file">
                <i class="fa fa-picture-o"></i> 上传头像
                <input type="file" id="userHead_src" class="btn btn-primary btn-block" name="uploadphoto" onchange="loadUserHeadAsURL();" >
                <input type="hidden" id="userHead_logo" style="width:100px;" /> 
              </div>
              <p class="help-block">文件大小：2M</p>
            </div>

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
   <script src="<?php echo base_url(); ?>public/plugins/js/jQuery-2.1.4.min.js"></script>
   <!-- Bootstrap 3.3.5 -->
   <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>   
   <script src="<?php echo base_url(); ?>public/js/uploadUserHead.js"></script>  
   
  </body>
</html>

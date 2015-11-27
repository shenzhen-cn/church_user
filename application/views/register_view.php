<?php  
  $user_name = isset($user_name) ? $user_name : ''; 
  $created_by_admin_id = isset($created_by_admin_id) ? $created_by_admin_id : "";
  $get_op = isset($get_op) ? $get_op : "" ;
  // var_dump($get_op);exit();
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
<?php   if (empty($get_op)) {?>
    <title>注册</title>
<?php } else { ?>
    <title>重置密码</title>
 <?php  } ?>
  <link href="<?php echo base_url(); ?>public/css/registerStyle.css" rel="stylesheet" />
  <?php $this->load->view('tq_head'); ?>
</head>
  <body class="hold-transition login-page">
   <div class="register-box">
  <?php if ( empty($get_op)){ ?>
     <?php $this->load->view('tq_alerts'); ?>
  <?php } ?>
     <div class="register-logo">
       <b>使命</b>青年团契
     </div>
     <div class="register-box-body">
        <?php if ( empty($get_op) ){ ?>
           <p class="login-box-msg">注册</p>
        <?php }else { ?>
           <p class="login-box-msg">重置密码</p>

        <?php  } ?>
       <form action="<?php echo base_url('register/sbumit_register'); ?>" method="post">
         <div class="form-group has-feedback">
           <input type="email" class="form-control" name="user_name" placeholder="<?php echo $user_name; ?>" value="<?php echo $user_name; ?>" disabled="disabled">
           <span class="fa fa-envelope-o form-control-feedback"></span>
         </div>
            <?php if ( empty($get_op)){ ?>
             <div class="form-group has-feedback">
               <input type="text" class="form-control"  id="nick" name="nick" placeholder="昵称" AUTOCOMPLETE="off"  >
               <span class="fa fa-male form-control-feedback"></span>
               <p class="msg"><i class="ati"></i></p><b id="count"></b>
             </div>
            <?php } else{ ?>
              <div class="form-group has-feedback">
                <input type="text" class="form-control"  id="nick" name="nick" placeholder="<?php echo $nick; ?>" AUTOCOMPLETE="off"  disabled="disabled">
                <span class="fa fa-male form-control-feedback"></span>
                <p class="msg"><i class="ati"></i></p><b id="count"></b>
              </div>
            <?php  } ?>
           
        <div class="clearfix"></div>
        <div class="form-group has-feedback">
           <input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="密码" AUTOCOMPLETE="off"  >
           <span class="fa fa-key form-control-feedback"></span>
           <p class="msg"><i class="ati"></i></p>
         </div>
         <div class="clearfix"></div>
         <div>  
            <label>
                <span></span><em class="active">弱</em><em>中</em><em>强</em>
            </label>
         </div> 
         <div class="clearfix"></div>    
         <div class="form-group has-feedback">
           <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="确认密码" required="required" disabled="" />
           <span class="fa fa-key form-control-feedback"></span>
           <p class="msg"><i class="ati"></i>再输入一次</p>
         </div>
         <div class="clearfix"></div> 
        <div class="social-auth-links text-center">
            <input type="hidden" name="re_user_id" value="<?php echo $id;?>">
            <input type="hidden" name="user_name" value="<?php echo $user_name;?>">
         <?php if ( empty($get_op)){ ?>
            <input type="hidden" name="created_by_admin_id" value="<?php echo $created_by_admin_id;?>">
            <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="if(!checkRegister()){return false;}">注册</button><br>
           
         <?php } else{ ?>
            <input type="hidden" name="get_op" value="<?php echo $get_op; ?>" >
            <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="if(!checkRegister()){return false;}">提交</button><br>
          <?php } ?>
        </div>
       </form>  
     </div><!-- /.form-box -->
   </div><!-- /.register-box -->

   <!-- jQuery 2.1.4 -->
   <script src="<?php echo base_url(); ?>public/plugins/js/jQuery-2.1.4.min.js"></script>
   <!-- Bootstrap 3.3.5 -->
   <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>public/js/formValidation.js"></script>
  </body>
</html>

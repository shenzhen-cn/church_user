<?php   
    $userHeadSrc_info = isset($userHeadSrc_info) ? $userHeadSrc_info : "";
    $user_nick =  isset($user_info->nick) ? $user_info->nick : "";
    $user_info_group_id = isset($user_info->group_id) ?  $user_info->group_id : "";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>个人中心-使命青年团契</title>
  <?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php  $this->load->view('tq_header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        设置
        <small>IN GOD WE TRUST</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>设置</li>
        <li class="active">修改资料</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-md-4">
          <?php $this->load->view('tq_alerts'); ?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">更改基本资料</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('personal/modify_user_data'); ?>" method='post'>
              <div class="box-body box-profile">
                 <a href="<?php echo site_url("personal/replace_headSrc"); ?>">
                    <?php  if(!empty($userHeadSrc_info)){ ?>
                          <img id="userHead_pho_preview" class="profile-user-img img-responsive img-circle" src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc_info"; ?>" style="width:150px;height:150px;" alt="上传头像">
                          <input type="hidden" name="userHeadSrc" id="userHeadSrcId" value="<?php echo $userHeadSrc_info; ?>">
                     <?php }else{ ?>
                          <img id="userHead_pho_preview" class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>public/images/mrpho.jpg" style="width:150px;height:150px;" alt="上传头像">
                          <input type="hidden" name="userHeadSrc" id="userHeadSrcId" value="<?php echo $userHeadSrc_info; ?>">
                    <?php } ?>
                  </a>

                <h3 class="profile-username text-center"><?php echo $user_nick; ?></h3>                
                </div><!-- /.box-body -->

                <div class="box-body">                 
                  <div class="form-group">
                    <label for="user_nick">昵称：</label>
                    <?php   if (! empty($user_info)) { ?>
                        <input type="text" class="form-control" id="user_nick" name="user_nick" required="required" value="<?php  echo $user_info->nick; ?>">
                    <?php } else{?>
                      <input type="text" class="form-control" id="user_nick" name="user_nick" required="required" >
                    <?php }?>
                  </div>

                  <div class="form-group">
                    <label for="sex">性别：</label>
                    <select class="form-control select2" style="width: 100%;" id="sex" name="sex">
                      <?php   if (! empty($user_info)) {
                        if ($user_info->sex == '男') { ?>
                        <option selected="selected">男</option>
                        <option>女</option>
                        <?php } else{ ?>
                        <option>男</option>
                        <option selected="selected">女</option>
                        <?php }?> 
                        <?php }else{ ?>
                          <option>男</option>
                          <option>女</option>
                        <?php  } ?>

                      </select>
                    </div>

                    <div class="form-group">
                      <label for="group_id">小组选择</label>
                      <select class="form-control select2" style="width: 100%;" id="group_id" name="group_id">
                        <?php if (! empty($group_info) ) {
                          foreach ($group_info as $k => $v) {
                            if (($user_info_group_id) == ($v->id) ) {?>
                            <option value="<?php echo $v->id; ?>" selected="selected"><?php echo $v->group_name; ?></option>                            
                            <?php  }else{ ?>
                            <option value="<?php echo $v->id; ?>" ><?php echo $v->group_name; ?></option>                            
                            <?php }
                          }
                        }?>
                      </select>
                    </div><!-- /.form-group -->
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">提交</button>
                  </div>
                </form>
              </div><!-- /.box -->          
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php $this->load->view('tq_footer'); ?>
       

    
  </body>
  </html>
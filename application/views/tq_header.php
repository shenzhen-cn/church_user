
<?php
  $user_info            =     isset($user_info)  ?  $user_info : '';
//  var_dump($user_info);exit;
  $users_id             =     isset($user_info->user_id) ? $user_info->user_id : "" ; 
  $group_info           =     isset($group_info) ?  $group_info : "";
  $userHeadSrc_info     =     isset($userHeadSrc_info) ?  $userHeadSrc_info : "";
//  var_dump($userHeadSrc_info);exit;
  $clas_p_p             =     isset($clas_p_p) ?  $clas_p_p : "";
  $reminder_days        =     isset($reminder_days) ? $reminder_days : "";
  
  $is_readed_count_c_p_p_id 
  = isset($is_readed_count_c_p_p_id) ? $is_readed_count_c_p_p_id : "";   
  $count_p_p_id =  key($is_readed_count_c_p_p_id)? key($is_readed_count_c_p_p_id) : "";

  $count_content_priest_preach_messages       
  =     isset($count_content_priest_preach_messages) ? $count_content_priest_preach_messages : "";
  $count_user_album_src_messages    
  =     isset($count_user_album_src_messages) ? $count_user_album_src_messages : "";
  $count_notice_groups_messages = isset($count_notice_groups_messages) ? $count_notice_groups_messages : "";

  //点赞通知
  $data_return_of_praise_of_spirituality = isset($data_return_of_praise_of_spirituality) ? $data_return_of_praise_of_spirituality : "";
  $count_praise_of_spirituality_messages = isset($count_praise_of_spirituality_messages) ? $count_praise_of_spirituality_messages : "";

  //灵修评论
  $data_return_of_comments_of_spirituality = isset($data_return_of_comments_of_spirituality) ? $data_return_of_comments_of_spirituality : "" ;
  // var_dump($data_return_of_comments_of_spirituality);exit;
  $count_praise_of_comments_of_spirituality_messages = isset($count_praise_of_comments_of_spirituality_messages) ? $count_praise_of_comments_of_spirituality_messages : "";
  //回复灵修评论
  $data_return_of_replies_of_spirituality = isset($data_return_of_replies_of_spirituality) ? $data_return_of_replies_of_spirituality : "" ;
  // var_dump($data_return_of_replies_of_spirituality);exit;
  $count_praise_of_replies_of_spirituality_messages = isset($count_praise_of_replies_of_spirituality_messages) ? $count_praise_of_replies_of_spirituality_messages : "";
  
  // $messages_total = $count_content_priest_preach_messages + $count_user_album_src_messages + ($reminder_days-1 != 0) + $count_notice_groups_messages;
  $messages_total = $count_content_priest_preach_messages + $count_user_album_src_messages  + $count_notice_groups_messages + $count_praise_of_comments_of_spirituality_messages + $count_praise_of_replies_of_spirituality_messages;
  // var_dump($messages_total);exit;



?>
<script>
  userHeadSrc = '<?php echo ROLE_USER_HEAD_BASE_SRC ?>' ; 
</script>
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>盟约</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>使命</b>青年团契</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top " role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
              
            <ul class="nav navbar-nav">
              <?php if (!empty($messages_total)) { ?>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu messages-menu prompts_container">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning" ><?php echo $messages_total; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">你收到系统 <?php echo $messages_total; ?> 条提示</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <li>
                          <?php if (!empty($reminder_days)) { ?>                        
                            <a href="<?php echo site_url('calendar'); ?>">
                              <i class="fa fa-bullhorn text-yellow"></i>
                              <?php if ($reminder_days-1 == 0) { ?>                              
                                  今天你还没有灵修呢！
                              <?php }else { ?>
                                  已经连续<?php echo $reminder_days-1;?>天没有灵修了
                              <?php  } ?>
                            </a>
                          <?php } ?>
                        </li>
                        <?php if (!empty($count_content_priest_preach_messages)) { ?>                      
                          <li>
                            <a href="<?php echo site_url('priest_preach?id='.$count_p_p_id); ?>">
                              <i class="fa fa-files-o text-aqua"></i> 牧师讲道 更新<?php echo $count_content_priest_preach_messages; ?>篇文章
                            </a>
                          </li>                                       
                        <?php } ?>
                        <?php if (!empty($count_user_album_src_messages)) { ?>                        
                          <li class="open_wall_photos">
                            <a href="<?php echo site_url('fellowship_life'); ?>">
                              <i class="fa fa-users text-red"></i> 团契生活 更新 <?php echo $count_user_album_src_messages; ?>张照片
                            </a>
                          </li>                      
                        <?php } ?>
                        <?php if (!empty($count_notice_groups_messages)) { ?>
                          <li>
                            <a href="<?php echo site_url('ranking'); ?>">
                              <i class="fa fa-graduation-cap text-aqua"></i> 你收到组长通知 <?php echo $count_notice_groups_messages; ?> 条
                            </a>
                          </li>
                        <?php } ?>
                        <?php if (!empty($data_return_of_comments_of_spirituality)) {                           
                                  foreach ($data_return_of_comments_of_spirituality as $key => $value) {
                                    $commenter_id = $value->commenter_id;
                                    $nick = $value->nick;
                                    $userHead_src = $value->userHead_src;
                                    $comment_id = $value->comment_id;
                                    $spirituality_id = $value->spirituality_id;
                                    $tranTime_created_at = $value->tranTime_created_at;
                                    $directory = $value->directory;
                                    $chapter_id = $value->chapter_id; ?>                                
                              <li>
                                <a href="<?php echo site_url('personal?spirituality_id='."$spirituality_id"); ?>">
                                  <div class="pull-left">
                                    <?php if (empty($userHead_src)) {?>
                                       <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="fa img-circle">
                                    <?php } else { ?>
                                     <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHead_src"; ?>" class="fa img-circle">
                                     <?php   } ?>                                
                                  </div>
                                  <h4>
                                    <?php  if(empty($nick)) echo "&nbsp&nbsp;"; else echo $nick; ?> 
                                    <small><i class="fa fa-clock-o"></i> <?php echo $tranTime_created_at; ?></small>
                                  </h4>
                                  <p>评论了我（<?php echo $directory; ?>--<?php echo $chapter_id; ?>章）灵修</p>
                                </a>
                              </li>
                        <?php } ?>
                        <?php } ?>
                        <?php if (!empty($data_return_of_replies_of_spirituality)) {
                                foreach ($data_return_of_replies_of_spirituality as $key => $value) {
                                  $replier_id = $value->replier_id;
                                  $replier_nick = $value->replier_nick;
                                  $replier_userHead_src = $value->replier_userHead_src;
                                  $tranTime_created_at = $value->tranTime_created_at;
                                  $comments_id = $value->comments_id;
                                  $spirituality_id = $value->spirituality_id;
                                  $directory = $value->directory;
                                  $chapter_id = $value->chapter_id; ?>
                                <li>
                                  <a href="<?php echo site_url('personal?spirituality_id='."$spirituality_id"); ?>">
                                    <div class="pull-left">
                                      <?php if (empty($replier_userHead_src)) {?>
                                         <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle">
                                      <?php } else { ?>
                                       <img src="<?php echo base_url()."public/uploads/userHeadsrc/$replier_userHead_src"; ?>" class="fa img-circle">
                                       <?php   } ?>                                
                                    </div>
                                    <h4>
                                      <?php echo $replier_nick; ?> 
                                      <small><i class="fa fa-clock-o"></i> <?php echo $tranTime_created_at; ?></small>
                                    </h4>
                                    <p>回复了我（<?php echo $directory; ?>--<?php echo $chapter_id; ?>章）评论</p>
                                  </a>
                                </li>                                    
                            <?php }
                         ?>                          
                        <?php } ?>
                      </ul>
                      <li>
                        
                      </li>
                      <li class="footer"><a href="javascript:;" class="del_prompt_alerts" >忽略全部</a></li>
                    </li>
                  </ul>
                </li>
              <?php } ?>

              <?php if (!empty($count_praise_of_spirituality_messages)) { ?>                              
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown messages-menu praise_container">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa  fa-thumbs-up"></i>
                  <span class="label label-danger"><?php echo $count_praise_of_spirituality_messages; ?></span>
                </a>
                <ul class="dropdown-menu" >
                  <li class="header">你收到<?php echo $count_praise_of_spirituality_messages;?>个赞</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php if (!empty($data_return_of_praise_of_spirituality)){ 
                              foreach ($data_return_of_praise_of_spirituality as $k => $v) {
                                $praise_of_spirituality_id = $v->praise_of_spirituality_id;
                                $praiser = $v->praiser;                                
                                $nick = $v->nick;
                                $userHead_src = $v->userHead_src;
                                $spirituality_id = $v->spirituality_id;
                                $directory = $v->directory;
                                $chapter_id = $v->chapter_id;
                                $created_at = $v->created_at; ?>
                            <?php if (!empty($users_id) && $users_id != $praiser) { ?>                            
                              <li>
                                <a href="javascript:;">
                                  <div class="pull-left">
                                    <?php if (empty($userHead_src)) {?>
                                       <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle">
                                    <?php } else { ?>
                                     <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHead_src"; ?>" class="img-circle" >
                                     <?php   } ?>                                
                                  </div>
                                  <h4>
                                    <?php if($praiser == $user_id) echo '我';else echo $nick; ?> 
                                    <small><i class="fa fa-clock-o"></i> <?php echo $created_at; ?></small>
                                  </h4>
                                  <p>赞了我（<?php echo $directory; ?>--<?php echo $chapter_id; ?>章）灵修</p>
                                </a>
                              </li>                                
                            <?php } ?>

                        <?php }
                        ?>                                                
                      <?php } ?>                       
                     
                    </ul>
                  </li>
                  <li class="footer"><a href="javascript:;" class="all_praise">我知道了</a></li>
                </ul> 
              </li>
              <?php } ?>  
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                    <?php if (!empty($user_info)) { ?>
                      <a href="" class="dropdown-toggle" data-toggle="dropdown">
                         <?php if (empty($userHeadSrc_info)) {?>
                            <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="user-image" alt="User Image">
                         <?php } else { ?>
                          <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc_info"; ?>" class="user-image" alt="User Image">
                          <?php   } ?>

                            <span class="hidden-xs">
                                 <?php echo $user_info->nick; ?>
                            </span>
                      </a>
                    <?php } ?>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                      <?php if (empty($userHeadSrc_info)) {?>
                         <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle" alt="User Image">
                      <?php } else { ?>
                       <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc_info"; ?>" class="img-circle" alt="User Image">
                       <?php   } ?>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-6 text-center">
                      <a href="<?php echo site_url('home#spiritual_learning'); ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span>我要灵修</a>
                    </div>
                    <div class="col-xs-6 text-center">
                      <a href="<?php echo site_url('wallofprayer/prayer#urgent_prayer'); ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-grain" aria-hidden="true"></span>我要祷告</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url('setPersonalData'); ?>" class="btn btn-default btn-flat">个人</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('sign_out'); ?>" class="btn btn-default btn-flat">退出</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

        </nav>
      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
                <?php if (empty($userHeadSrc_info)) {?>
                   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle"  alt="User Image" >
                <?php } else { ?>
                 <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc_info"; ?>" class="img-circle" alt="User Image">
                 <?php   } ?>
            </div>
            <div class="pull-left info">
              <p>
                <?php if (!empty($user_info)) { ?>
                   <?php echo $user_info->nick; ?><br><br>
                   <i class="fa fa-home text-success">
                      <?php  echo $user_info->group_name; ?> 
                   </i> 
                <?php } ?>
              </p>
            </div>
          </div>
          <!-- search form -->
          <form action="<?php echo site_url('onlineBibile'); ?>" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="search_keyword" class="search_keyword form-control" placeholder="在线圣经查找"/>
              <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li>
              <a href="<?php echo site_url('bibile'); ?>">
                <i class="fa fa-book"></i> <span>在线圣经</span>
              </a>
            </li>
            <li class="header">目录</li>
            <li class="treeview">
              <a href="<?php echo site_url('home'); ?>">
                <i class="fa fa-dashboard"></i> <span>首页</span> 
              </a>
            </li>
            <?php if (!empty($clas_p_p)) { ?>           
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-files-o"></i>
                  <span>牧师讲道</span>
                  <?php if (!empty($count_content_priest_preach_messages)) { ?>                    
                    <span class="label label-primary pull-right"><?php echo $count_content_priest_preach_messages; ?></span>
                  <?php } else{ ?>
                    <i class="fa fa-angle-left pull-right"></i>
                  <?php  }?>
                </a>
                <ul class="treeview-menu">                                
                  <li><a href="<?php  echo site_url('priest_preach?id=1'); ?>"><i class="fa fa-circle-o"></i> 牧师课程
                        <?php if(isset($count_content_priest_preach_messages) && $count_content_priest_preach_messages > 0){ ?>
                          <small class="label pull-right bg-yellow"><?php echo $count_content_priest_preach_messages; ?></small>
                        <?php  } ?>
                      </a>
                  </li>
                  <li><a href="<?php  echo site_url('read_myEdit'); ?>"><i class="fa fa-circle-o"></i> 在线阅读</a></li>
                </ul>
              </li>
            <?php } ?>

            <li class="treeview">
              <a href="">
                <i class="fa fa-pie-chart"></i>
                <span>小组</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if (!empty($group_info)) {
                        foreach ($group_info as $k => $v) {
                          $group_id   = $v->id;
                          $group_name = $v->group_name; ?>
                        <li><a href="<?php echo site_url()."/group?group_id=".$group_id; ?>"><i class="fa fa-circle-o"></i><?php echo $group_name; ?></a></li>

                  <?php }?>
                <?php } ?>

              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>团契生活</span>
                <?php if (!empty($count_user_album_src_messages)) { ?>
                  <span class="label label-primary pull-right"><?php echo $count_user_album_src_messages; ?></span>
                <?php } else { ?>
                  <i class="fa fa-angle-left pull-right"></i>
                <?php  }?>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> 相册 <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php  echo site_url('album'); ?>"><i class="fa fa-circle-o"></i> 家人相册集</a></li>
                    <li><a href="<?php  echo site_url('fellowship_life/see_user_albums'); ?>"><i class="fa fa-circle-o"></i> 我的相册</a></li>
                  </ul>
                </li>
                <li><a href="<?php  echo site_url('upload_photos'); ?>"><i class="fa fa-circle-o"></i> 上传相片</a></li>

              </ul>
            </li>
           
            <li class="open_wall_photos">
              <a href="<?php  echo site_url('fellowship_life'); ?>">
                <i class="fa  fa-image"></i> <span>照片墙</span>
                <?php if (!empty($count_user_album_src_messages)) { ?>                  
                  <span class="label label-primary pull-right">
                  <?php echo $count_user_album_src_messages; ?></span>
                <?php } ?>
              </a>
            </li>


            <li>
              <a href="<?php echo site_url('Wallofprayer'); ?>">
                <i class="fa fa-fire"></i> <span>祷告墙</span>
              </a>
            </li>
                        
            <li>
              <a href="<?php echo site_url('personal/get_honor_list'); ?>">
                <i class="fa fa-graduation-cap"></i> <span>光荣榜</span>
              </a>
            </li>

            <li>
              <a href="<?php echo site_url('calendar'); ?>">
                <i class="fa fa-calendar"></i> <span>灵修日历</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i>
                <span>设置</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('setPersonalData'); ?>"><i class="fa fa-circle-o"></i> 修改资料</a></li>
                <li><a href="<?php echo site_url('resetpassword'); ?>"><i class="fa fa-circle-o"></i> 修改密码</a></li>
              </ul>
            </li>
           

            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-word-o"></i>
                <span>关于使命青年团契</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('tq_about'); ?>"><i class="fa fa-circle-o"></i> 信仰根基</a></li>
                <li><a href="<?php echo site_url('tq_statement'); ?>"><i class="fa fa-circle-o"></i> 使用声明</a></li>
              </ul>  
            </li>
          
            <li>
              <a href="<?php echo site_url('sign_out'); ?>">
                <i class="fa fa-toggle-off"></i> <span>退出</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      

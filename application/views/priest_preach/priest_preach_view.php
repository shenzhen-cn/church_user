<?php 
  $content  = isset($content) ?  $content : "" ;
  $is_readed_count_c_p_p_id = isset($is_readed_count_c_p_p_id) ? $is_readed_count_c_p_p_id : "";
  $data_return_of_content_priest_preach
   = isset($data_return_of_content_priest_preach) ? $data_return_of_content_priest_preach : "";

  $class_name_title  = isset($content[0]->class_name) ? $content[0]->class_name : "" ;
  $class_priest_id = $this->input->get('id') ? $this->input->get('id') : "";
  $role_file_priest_preach_base_url = ROLE_FILE_PRIEST_PREACH_BASE_URL;
 ?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>牧师讲道</title>
  <?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php  $this->load->view('tq_header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        牧师讲道
        <small>IN GOD WE TRUST</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">牧师讲道</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">分类</h3>
              <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
              <?php if (!empty($clas_p_p)) { 
                $fa_style = null;
                $active = null;

                foreach ($clas_p_p as $k => $v) {
                  $p_p_c_n_id = $v->id; 
                  $class_name = $v->class_name; 

                  switch ($p_p_c_n_id) {
                    case $p_p_c_n_id== 1:
                      $fa_style = 'fa-yelp';
                      break;
                    case $p_p_c_n_id==2:
                      $fa_style= 'fa-file-text-o' ;
                      break;
                    case $p_p_c_n_id==3:
                      $fa_style= 'fa-filter' ;
                      break;
                    case $p_p_c_n_id==4:
                      $fa_style= 'fa-male' ;
                      break;
                    default:
                      $fa_style= 'fa-book' ;
                      break;
                  }

                  if ($class_priest_id == $p_p_c_n_id) {
                    $active = 'active';
                  }else{
                    $active=null;
                  }
                  ?>
                  <li class="<?php echo $active; ?>">
                    <a href="<?php  echo base_url('priest_preach?id='."$p_p_c_n_id"); ?>"><i class="fa  <?php echo $fa_style; ?>"></i><?php echo $class_name; ?>
                      <?php
                          $is_not_readed_count =  isset($is_readed_count_c_p_p_id->$p_p_c_n_id) ? $is_readed_count_c_p_p_id->$p_p_c_n_id : ""; 
                          if (isset($is_not_readed_count) && !empty($is_not_readed_count)) { 
                        ?>                        
                        <span class="label label-warning pull-right"><?php echo $is_not_readed_count; ?></span>
                      <?php } ?>
                    </a>
                  </li>
                <?php }
                 } ?>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /. box -->
        </div><!-- /.col -->
        
        <?php   if (!empty($content)) { ?>
          
            
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $class_name_title; ?></h3>
              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <div class="pull-right">
                    <?php if (isset($page)) echo ($page-1)*10+1; ?>
                    -<?php if (isset($page) && isset($total) && $page*10 < $total ){
                         echo $page*10;
                         }else {
                          echo $total ;
                          } ?>
                    /<?php if (isset($total)) echo $total; ?>
                  </div><!-- /.pull-right -->                 
                </div>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php foreach ($content as $k => $v){ 
                      $content_p_p_id =  $v->content_p_p_id;    
                      $class_priest_id =  $v->class_priest_id;    
                      $class_name =  $v->class_name;    
                      $course_title =  $v->course_title;    
                      $share_from =  $v->share_from;    
                      $file_name = $v->file_name;
                      $full_path = $v->full_path;
                      $orig_name = $v->orig_name;
                      $file_size =  $v->file_size;
                      $course_keys =  $v->course_keys;    
                      $content_p_p_created_at =  $v->content_p_p_created_at;  

                      switch ($class_priest_id) {
                        case $class_priest_id== 1:
                          $fa_style = 'fa-yelp';
                          break;
                        case $class_priest_id==2:
                          $fa_style= 'fa-file-text-o' ;
                          break;
                        case $class_priest_id==3:
                          $fa_style= 'fa-filter' ;
                          break;
                        case $class_priest_id==4:
                          $fa_style= 'fa-male' ;
                          break;
                        default:
                          $fa_style= 'fa-book' ;
                          break;
                      }

                      $text_color = 'text-gray';
                      foreach ($data_return_of_content_priest_preach as $key => $value) {
                              $alert_id = $value->id;
                              $table_id = $value->table_id;

                              if ($table_id == $content_p_p_id) {
                                  $text_color = 'text-yellow';
                                  break;
                              }
                      }
                      $alert_id = ($text_color== 'text-gray') ? '' : $alert_id;   
                    ?>
                    <tr>
                      <td class="mailbox-star"><i class="fa  <?php echo $fa_style; ?> <?php echo $text_color; ?> alert_id_<?php echo $alert_id; ?>"></i></td>
                      <td class="mailbox-name"><?php echo $share_from; ?></td>
                      <td class="mailbox-subject">
                          <a href="<?php echo $role_file_priest_preach_base_url.$file_name; ?>" class="del_alerts"  data-alert-id="<?php echo $alert_id; ?>" onclick=" return disp_confirm()" title="下载"><b><?php echo $course_title; ?></b></a>
                      </td>
                      <td class="mailbox-subject"> - <?php echo $course_keys; ?> - </td>
                      <td class="mailbox-subject"> <?php echo $file_size; ?> M </td>
                      <td class="mailbox-date"><?php  echo date("Y/m/d",strtotime( $content_p_p_created_at));?></td>                     
                    </tr>
                  <?php } ?>
                  </tbody>
                </table><!-- /.table -->
              </div><!-- /.mail-box-messages -->
            </div><!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <div class="pull-right">
                  <div class="box-tools">
                    <div class="span8 columns" style="float:left">
                        <?php if (isset($pagination)) echo $pagination['html']; ?>
                    </div>
                  </div>
                </div><!-- /.pull-right -->
              </div>
            </div>
          </div><!-- /. box -->
        </div><!-- /.col -->
        <?php  } ?>   

      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?php  $this->load->view('tq_footer'); ?>
  <script type="text/javascript">
    function disp_confirm()
    {
      var r=confirm("你确定下载此文件么?建议您使用WiFi或电脑下载观看！");
      if (r==true)
      {        
        return true;
      }
      else
      {
        return false;
      }
    }      
  </script>
</body>
</html>
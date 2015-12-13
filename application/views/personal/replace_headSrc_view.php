<?php 
    $userHeadSrc_info = isset($userHeadSrc_info) ? $userHeadSrc_info : "";
    // var_dump($userHeadSrc_info);exit;    
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>个人中心-使命青年团契</title>
  <?php  $this->load->view('tq_head'); ?>
  <style>
    #clipArea {
      margin: 20px;
      height: 300px;
    }
    #file,
    #clipBtn {
      margin: 20px;
    }
    #view {
      margin: 0 auto;
      width: 200px;
      height: 200px;
    }
  </style>
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
            <article class="htmleaf-container">   
              <div id="clipArea"></div>
              <input type="file" id="file">
              <button id="clipBtn">截取</button>
              <div id="view"></div>              
            </article>
            <br>
            <div class="box-footer no-padding">
              <button class="btn btn-warning pull-right" onclick="window.history.back()">返回</button>
              <form action="<?php echo site_url('personal/upload_headSrc'); ?>" method='post' enctype="multipart/form-data"  onSubmit="return checkUserHeadSrc();">
                  <input type="hidden" value="" id="data_userHeadSrc" name="userHeadSrc">
                  <input type="hidden" name="oldUserHeadSrc"  value="<?php echo $userHeadSrc_info; ?>">
                  <button type="submit" class="btn btn-primary pull-left">设置</button>
              </form> 
            </div>
          </div><!-- /.box -->  
        </div>
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?php $this->load->view('tq_footer'); ?>
  <script src="<?php echo base_url(); ?>public/js/iscroll-zoom.js"></script>
  <script src="<?php echo base_url(); ?>public/js/hammer.js"></script>
  <script src="<?php echo base_url(); ?>public/js/jquery.photoClip.js"></script>
  
  <script>
    // document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    $("#clipArea").photoClip({
      width: 128,
      height: 128,
      file: "#file",
      view: "#view",
      ok: "#clipBtn",
      strictSize:true,
      loadStart: function() {
        console.log("照片读取中");
      },
      loadComplete: function() {
        console.log("照片读取完成");
      },
      clipFinish: function(dataURL) {      

        if(dataURL==''){
          alert("你还没有选择头像照片呢？");
          return;
        }else{
          $("#data_userHeadSrc").attr('value',dataURL);
        }        
            
      }
    });
  
    function checkUserHeadSrc(argument) {
      var data_userHeadSrc = $("#data_userHeadSrc").val(); 
      if(data_userHeadSrc == ''){
        alert('还是选个好看的头像吧！');
        return false;        
      }      
    }
  </script>

 


</body>
</html>
<?php 

	$user_album_names = isset($user_album_names) ? $user_album_names : "" ;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>团契生活-使命青年团契</title>
	<?php $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				团契生活
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li>团契生活</li>
				<li class="active"><a href="<?php echo site_url('album'); ?>">我的相册集</a></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<h4>我的相册集</h4>
			<div class="row">
				<?php  if (!empty($user_album_names)) { 
					$folder_color=null;

					foreach ($user_album_names as $k => $v) { 
						// var_dump($user_album_names);exit;
						$album_id = $v->album_id;
						$album_name = $v->album_name;
						$photos_count = isset($v->photos_count) ? $v->photos_count : '0';

						switch ($group_id) {
							case $group_id=='1':
								$folder_color = 'bg-aqua';								
							break;
							case $group_id=='2':
								$folder_color = 'bg-green';
							break;
							case $group_id=='3':
								$folder_color = 'bg-yellow';
							break;
							case $group_id=='4':
								$folder_color = 'bg-red';
							break;
							case $group_id=='5':
								$folder_color = 'bg-purple';
							break;
							case $group_id=='6':
								$folder_color = 'bg-fuchsia';
							break;
							case $group_id=='7':
								$folder_color = 'bg-orange';
							break;
							case $group_id=='8':
								$folder_color = 'bg-maroon';
							break;		
							default:
								$folder_color = '';
							break;
						}
						?>
						<?php if ( $photos_count != '0') { ?>							
							<!-- Group photo album -->
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box <?php echo $folder_color; ?>">
										<a  class="href_type" href="<?php echo site_url('fellowship_life/see_user_photos?album_id='."$album_id".'&create_by='."$user_id"); ?>" title="">
											<span class="info-box-icon"><i class="fa fa-folder"></i></span>
										</a>
										<div class="info-box-content">
											<span class="info-box-text album_name_<?php echo $album_id; ?>"><?php echo $album_name; ?></span>
											<span class="info-box-number"> 相片个数：<?php echo $photos_count; ?></span>
											<span class="progress-description pull-right">
											<br>
											<button type="button" class="btn btn-primary btn-xs"  data-album-id="<?php echo $album_id; ?>">重命名</button>
											</span>
										</div><!-- /.info-box-content -->
									</div><!-- /.info-box -->
								</div><!-- /.col -->
						<?php } else { ?>
							<!-- Group photo album -->
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box <?php echo $folder_color; ?>">
									<a href="javascript:;" class="href_type" onclick=" return check_isnull_file()">
										<span class="info-box-icon"><i class="fa fa-folder"></i></span>
									</a>	
										<div class="info-box-content">
											<span class="info-box-text album_name_<?php echo $album_id; ?>"><?php echo $album_name; ?></span>
											<span class="info-box-number"> 相片个数：<?php echo $photos_count; ?></span>
											<span class="progress-description pull-right">
											<br>
											<button type="button" class="btn btn-primary btn-xs" data-album-id="<?php echo $album_id; ?>">重命名</button>												
											</span>
										</div><!-- /.info-box-content -->
									</div><!-- /.info-box -->
								</div><!-- /.col -->
						<?php	} ?> 	     				     	
					<?php }
						?>
				<?php } ?>	       
			</div><!-- /.row -->

		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

    <?php  $this->load->view('tq_footer'); ?>
    <style type="text/css" >
    		/*.href_type a {
    		    color:white;
    		    cursor:hand;
    		    background:white;
    		}*/
    		 	
    </style>
    <script>	
    	function check_isnull_file () {			
    		alert('该文件夹为空！');
    		return false;
    	}	
    </script>
    <script type="text/javascript">
	    $(document).ready(function(){
		      $("button").click(function (){		      
			      var album_id = $(this).attr('data-album-id');
			      var name = prompt("请输入您的相册名字","");
			        if (name!=null && name!="")
			        {
			          	$(".album_name_"+album_id).load("<?php echo site_url('fellowship_life/rename_album_name') ?>",{album_name:name,album_id:album_id},function(responseTxt,statusTxt,xhr){
			          	   if(statusTxt=="success")
			          	     alert("重命名成功！");
			          	   if(statusTxt=="error")
			          	     alert("Error: "+xhr.status+": "+xhr.statusText);
			          	 });
			        }else {
			        	return;
			        }
		      });

		     $("a.href_type ").click(function(){
		          $(this).css("color","white");
		     });
		     $("a.href_type").mouseover(function(){
		          $(this).css("color","white");
		          
		     });
		     $("a.href_type").mouseout(function(){
		          $(this).css("color","Bule");
		          
		     }) 
		     $("a.href_type").css("color","white");
	    });
    </script>
</body>
</html>
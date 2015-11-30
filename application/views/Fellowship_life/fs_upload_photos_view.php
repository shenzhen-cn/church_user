<?php 
		$group_id      = isset($user_info->group_id) ? $user_info->group_id : "";  
		$album_names   = isset($album_names) ? $album_names : "";  

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>团契生活-使命青年团契</title>
	<?php  $this->load->view('tq_head'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/plugins/css/fileinput.min.css">
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
					<li><a href="<?php echo site_url('fellowship_life/see_user_albums'); ?>">相册</a></li>
					<li class="active">上传照片</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<?php $this->load->view('tq_alerts'); ?>

						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">上传照片</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
								<div class="box-body">																		
									<ul class="list-inline upload_area" style="display:block">									 	
									<?php if (!empty($album_names)) { ?>
									  <li>
									  	<div class="form-group " >
									  		<label>选择我的相册:</label>
									  		<select class="form-control"  id="album_id" name="album_name" required="required">

									<?php 		foreach ($album_names as $k => $v) {
												$album_id = $v->id;
												$album_name = $v->album_name; ?>
									  			<option value="<?php echo $album_id; ?>"><?php echo $album_name; ?></option>

										<?php 	}
									 ?>										
									  		</select>
									  	</div>
									  </li>
									<?php } ?>
									  <li>
									  	<a  type='button' class="btn btn-primary">新建相册</a>
									  </li>
									</ul>
									<div class="create_new_album" style="display:none"> 										
										<form action="<?php echo site_url('fellowship_life/create_album'); ?>" method="post">
											<ul class="list-inline">
												<li>
													<div class="form-group">																							
														<input type="text" class="form-control"  name="album"  placeholder="输入相册名字..." required="required" maxlength="10">
													</div>											
												</li>
												<li>
													<div class="form-group">																																					
														<input   type="hidden" id = "album_group_id" name="group_id" value="<?php echo $group_id; ?>">
													  	<button type='summit' class="btn btn-success">确认</button>											
													</div>											
												</li>
												<li>
													<div class="form-group">																							
													  	<button type='button' class="btn btn-primary">取消</button>											
													</div>											
												</li>										
											</ul>
										</form>
									</div>

									<br>
									<div class="clearfix"></div>
									<div>
									<div class="form-group upload_area" style="display:block">
										<label for="file-upload">插入图片:</label>
										<input type="file" class="file" name="images[]" id="file-upload" data-preview-file-type="text" multiple >
										<div id="errorBlock" class="help-block"></div>										
									</div>
									</div>
								</div><!-- /.box-body -->								
						</div><!-- /.box -->
					</div><!--/.col (left) -->


				</div>   <!-- /.row -->
			</section><!-- /.content -->
		</div><!-- /.content-wrapper -->

		<?php  $this->load->view('tq_footer'); ?>
		<script src="<?php echo base_url(); ?>public/plugins/js/fileinput.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>public/plugins/js/fileinput_locale_zh.js" type="text/javascript"></script>
		<script>   
		$("#file-upload").fileinput({
	        uploadUrl: "<?php echo site_url('fellowship_life/photos_upload') ?>", // you must set a valid URL here else you will get an error
		    uploadAsync: false,
		    showPreview: true,
			browseClass: "btn btn-info",		    
		    allowedFileExtensions: ['jpg', 'png'],
		    maxFileSize: 2048,
		    maxFileCount: false,
		    allowedFileTypes: ['image'],
		    elErrorContainer: '#errorBlock',

	    	uploadExtraData: function() {
	    	            return {
	    	                album_id: $("#album_id").val(),
	    	                group_id: $("#album_group_id").val(),
	    	            };
	    	}
		}).on('filebatchpreupload', function(event, data, id, index) {//Y
			console.log("pre-upload");				
		}).on('filebatchuploadsuccess', function(event, data, id, index) {//Y
			console.log("filebatchuploadsuccess");				
		}).on('filebatchuploaderror', function(event, data, id, index) {//Y
			var statu = confirm("上传照片时候出错，请重试?");
	    		if(statu){
			    	$('#file-upload').fileinput('clear');	    				
	    		}	
		}).on('fileuploaderror', function(event, data, id, index) {//Y
	    	$('#file-upload').fileinput('disable');			
			var statu = confirm("上传照片时候出错，请重试?");
		       if(statu){
			    	$('#file-upload').fileinput('refresh');
			    	$('#file-upload').fileinput('enable');
		           return false;
		       };
			console.log("fileuploaderror");	
		}); 	
			
		$(document).ready(function(){				
		    $(".btn-primary").click(function(){			 
		  	 if($(".create_new_album").css("display")=="none"){ 
		  		 $(".create_new_album").css("display","block");
		  		 $(".upload_area").css("display","none");

		  	 } else{ 
		  		 $(".create_new_album").css("display","none"); 
		  		 $(".upload_area").css("display","block"); 
		  	 }
		    });
		  
		});		 
</script>
</body>
</html>
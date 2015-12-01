<?php 
	$user_nick = isset($use_nick_Hsrc->nick) ? $use_nick_Hsrc->nick : "" ;
	$user_Hsrc = isset($use_nick_Hsrc->userHead_src) ? $use_nick_Hsrc->userHead_src : "" ;
	$album_name  = isset($user_album_photos['0']->album_name) ? $user_album_photos['0']->album_name : "" ; 
	$user_album_photos = isset($user_album_photos) ? $user_album_photos : "";

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>团契生活-使命青年团契</title>	
	<?php  $this->load->view('tq_head'); ?>
	<link rel="stylesheet" href="<?php echo base_url() ; ?>public/css/blueimp-gallery.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ; ?>public/css/bootstrap-image-gallery.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse" data-spy="scroll" data-target=".navbar-example">
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
				<li><a href="<?php echo site_url('album'); ?>" >家人相册集</a></li>
				<li class="active"><?php echo $album_name; ?></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<h4><button  onclick="window.history.back()" class="btn ">返回</button></h4>
			<?php $this->load->view('tq_alerts'); ?>
			<!-- Post -->	   	     	
			<div class="row">
				<div class="col-md-12">
				  <div class="box box-solid">
				    <div class="box-header with-border">
				      <?php  if(!empty($user_nick)){ ?>
					      <h3 class="box-title"><?php echo $user_nick; ?>的《<?php echo $album_name;?>》</h3>
				      	<?php } ?>		
				    </div><!-- /.box-header -->
				    <div class="box-body">
				     <?php if (!empty($user_album_photos)){ ?>
				     	<div class="content_pul">
				     	  <div id="device" class="gridalicious">
				     	    <div class="galcolumn">
							  <?php  foreach ($user_album_photos as $key => $value) { 
							  			$src_id = $value->src_id;
							  			$created_user_id = $value->created_user_id;
							  			$album_id = $value->album_id;
							  			$album_name = $value->album_name;
							  			$paths = $value->paths;
							  			$src_created_at = $value->src_created_at; 
							  	?>	
     	             			<?php if(!empty($paths)){ ?>     	             			
     	   			            <div class="item item_src_<?php echo $src_id;?>">
     	               			    <a href="<?php echo base_url().$paths; ?>" title="《<?php echo $album_name; ?>》第<?php echo $key+1; ?>张" data-gallery>
     	               	                <img src="<?php echo base_url().$paths; ?>"  class="img-responsive">
     	               			    </a>
     	               			    <br>
     	   			            	<p><span class="pull-right">上传于：<?php echo $src_created_at;?></span>
     	   			            		<?php if($user_id == $created_user_id){ ?>
	     	   			            		<a  href="javascript:void(0);"  onclick="del_photos(<?php echo $src_id; ?>);" class="btn btn-danger  pull-left reomvePhoto  btn-xs">删除</a>
	     	   			            		<input type="hidden" name="paths_src" id="paths_src_<?php echo $src_id;?>" value="<?php echo $paths; ?>">
     	   			            		<?php 	} ?>
     	   			            	</p> <br>    	   			            
     	   			            </div>
     	             			<?php	} ?>					  	
							  <?php } ?>				     	      
				     	    </div>				     	    
				     	  </div>
				     	</div>
				     <?php } ?>
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
				      </div> <!-- box-footer -->
				  </div><!-- /.box -->
				</div><!-- /.col (left) -->
			</div>
			
	       <div class="col-md-12">
	       	<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
	       	<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
	       	    <!-- The container for the modal slides -->
	       	    <div class="slides"></div>
	       	    <!-- Controls for the borderless lightbox -->
	       	    <h3 class="title"></h3>
	       	    <a class="prev">‹</a>
	       	    <a class="next">›</a>
	       	    <a class="close">×</a>
	       	    <a class="play-pause"></a>
	       	    <ol class="indicator"></ol>
	       	    <!-- The modal dialog, which will be used to wrap the lightbox content -->
	       	    <div class="modal fade">
	       	        <div class="modal-dialog">
	       	            <div class="modal-content">
	       	                <div class="modal-header">
	       	                    <button type="button" class="close" aria-hidden="true">&times;</button>
	       	                    <h4 class="modal-title"></h4>
	       	                </div>
	       	                <div class="modal-body next"></div>
	       	                <div class="modal-footer">
	       	                    <button type="button" class="btn btn-default pull-left prev">
	       	                        <i class="glyphicon glyphicon-chevron-left"></i>
	       	                        Previous
	       	                    </button>
	       	                    <button type="button" class="btn btn-primary next">
	       	                        Next
	       	                        <i class="glyphicon glyphicon-chevron-right"></i>
	       	                    </button>
	       	                </div>
	       	            </div>
	       	        </div>
	       	    </div>
	       	</div>
          </div>	<!-- .col -->

		</section><!-- /.content -->
		</div><!-- /.content-wrapper -->
		<?php  $this->load->view('tq_footer'); ?>
		<script src="<?php echo base_url(); ?>public/js/jquery.blueimp-gallery.min.js"></script>		
		<script src="<?php echo base_url(); ?>public/plugins/js/jquery.grid-a-licious.min.js"></script> 
		<script>

			// function del_photos (argument) {
			// 	var src_id = argument;
			// 	var r = confirm("你确定删除此文件么");

			// 	if (r==true && src_id != null)
			// 	{
			// 		var paths_src = $('#paths_src_'+src_id).val();
			// 		if(src_id != null){				
			// 			$(".item_src_"+src_id).load("<?php echo base_url('fellowship_life/del_photos') ?>",{src_id:src_id,paths_src:paths_src},function(responseTxt,statusTxt,xhr){
			// 			   if(statusTxt=="success")
			// 			 	$(".item_src_"+src_id).remove();	
			// 			   if(statusTxt=="error")
			// 			     alert("删除失败！");
			// 			 });				
			// 		}

			// 	}else {
			// 		return false;
			// 	}					
			// };		

			function del_photos (argument) {
				var src_id = argument;
				console.log(src_id)
				var r = confirm("你确定删除此文件么");

				if(r == true && src_id != null){
					
					var paths_src = $('#paths_src_'+src_id).val();
					var Ajaxurl = 'del_photos';

					$.ajax({
						url: Ajaxurl,
						type: 'POST',
						dataType: 'json',
						data:{src_id:src_id,paths_src:paths_src},
					})
					.done(function(data) {
						console.log(data);
						if(data.status == 200){

							$(".item_src_"+src_id).remove();
						}else{
							alert(data.message);
						}	
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});	
				}else{
					return false;
				}				
											
			}		

		//主要部分
        $("#device").gridalicious({
            gutter: 20,
            width: 300,
            animate: true,
            animationOptions: {
                    speed: 150,
                    duration: 400,
                    complete:function(data){
						console.log("shimingqingniantuanqi");	
					}
            },
        });

			        
    </script>	
	</body>
	</html>



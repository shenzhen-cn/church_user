<?php 
	$user_photos_results = isset($user_photos_results) ? $user_photos_results : "";
	$role_user_photos_url =  ROLE_USER_PHOTOS_URL;
	// var_dump($role_user_photos_url);exit;
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>团契生活-使命青年团契</title>
	<?php $this->load->view('tq_head'); ?>
	<link rel="stylesheet" href="<?php echo base_url() ; ?>public/css/blueimp-gallery.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ; ?>public/css/bootstrap-image-gallery.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse"  data-spy="scroll" data-target="navbar-example">
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
				<li class="active">团契生活</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
		<h4><button  onclick="window.history.back()" class="btn ">返回</button></h4>
	       <!-- row -->
	       <div class="row">
	       	 <div class="col-md-12">
	       	 	  <div class="box box-solid">
	       	 	    <div class="box-header with-border">
	       	 	      <h3 class="box-title">照片墙</h3>
	       	 	    </div><!-- /.box-header -->
	       	 	    <div class="box-body">
	       	 	      <div class="content_pbl">
	       	 	        <div id="device" class="gridalicious">
	       	 	          <div class="galcolumn">
	       	 	          	<?php if (!empty($user_photos_results)) { 
	       	 	          			foreach ($user_photos_results as $key => $value) {
	       	 	          				$user_album_src_id =$value->user_album_src_id;
	       	 	          				$user_album_src = $value->user_album_src;
	       	 	          				$temp = site_url().$user_album_src;
	       	 	          				var_dump($temp);exit;
	       	 	          				$user_album_id  =$value->user_album_id;
	       	 	          				$album_src_created_at = $value->album_src_created_at;
	       	 	          				$user_album_name = $value->user_album_name;
	       	 	          				$album_user_id = $value->album_user_id;
	       	 	          				$user_nick = $value->user_nick;
	       	 	          				$userHead_src = $value->userHead_src; ?>
		       	 	            <div class="item">
		       	 	            	<?php if (empty($user_album_src)) {?>
		       	 	            	   <img src="<?php echo base_url(); ?>public/images/no_img.jpg" class="user-image">
		       	 	            	<?php } else { ?>
	   	 	            			    <a href="<?php echo site_url().$user_album_src; ?>" title="《<?php echo $user_album_name; ?>》" data-gallery>
	   	 	            	                <img src="<?php echo base_url().$user_album_src; ?>"  class="img-responsive">			        
	   	 	            			    </a>

		       	 	            	 <?php   } ?>
		       	 	            	<p><i class="fa  fa-photo"></i><?php echo $user_nick.'的《'.$user_album_name.'》'.'时间：'.$album_src_created_at; ?></p>
		       	 	            </div>	       	 	          		
	       	 	          		<?php 	}
	       	 	          	?>
	       	 	          	<?php } ?>	       	 	          
	       	 	          </div>	       	 	          
	       	 	        </div>
	       	 	      </div>
	       	 	    </div><!-- /.box-body -->	       	 	     
	       	 	  </div><!-- /.box -->
	       	 </div><!-- .col -->
	       </div><!-- /.row -->

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
	<input type="hidden" name="currentPage" id="currentPage" value="<?php echo $pagination['page']; ?>">
	<input type="hidden" name="totalPage" id="totalPage" value="<?php echo $pagination['total_pages']; ?>">
	<input type="hidden" name="role_user_photos_url" id="role_user_photos_url"  value="<?php echo $role_user_photos_url; ?>">

	<?php  $this->load->view('tq_footer'); ?>
	<script src="<?php echo base_url(); ?>public/js/jquery.blueimp-gallery.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/bootstrap-image-gallery.min.js"></script>
	<script>
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

	</script>
	<script src="<?php echo  base_url();?>public/plugins/js/jquery.grid-a-licious.min.js"></script>
	<script>
			//模拟滚动条滚动时随机添加内容
        	var currentPage = $("#currentPage").val();
        	var totalPage = $("#totalPage").val();
        	var role_user_photos_url = $("#role_user_photos_url").val();
            makeboxes = function() {            	

            	currentPage = parseInt(currentPage);
            	totalPage = parseInt(totalPage);

            	currentPage = parseInt(currentPage) + 1;

				var url = "<?php echo site_url('fellowship_life/load_images'); ?>";

				var boxes = new Array; 		
				$.ajax({ 
					type: "post", 
					url: url, 
					cache:false, 
					async:false, 
					dataType: "json",
					data: {page: currentPage},
					success: function(json){ 
						var items = json.user_photos_results;
						for (var i = items.length - 1; i >= 0; i--) {
							var item = items[i];
							// console.log(item);
							var src_old = item.user_album_src;
							var  src    = src_old.replace("\\", '/')
							// console.log(src);
							var user_nick = item.user_nick;
							var user_album_name = item.user_album_name;
							var album_src_created_at = item.album_src_created_at;
							var randTxt = [user_nick+'的《'+user_album_name+'》 时间：'+album_src_created_at];	
							div = $('<div></div>').addClass('item'); 
		                    content = 		                    
		                    "<a href='"+role_user_photos_url+src+"' title='《"+user_album_name+"》' data-gallery><img src='"+role_user_photos_url+src+"'/></a><p>"+randTxt+"</p>";
		                    div.append(content);
		                    boxes.push(div);
						};
					}
				});

				if(currentPage <= totalPage){
	            	$("#currentPage").val(currentPage);
				};				
				return boxes;            	                

            }

			//滚动条事件
			$(document).ready(function () {         
				$(window).scroll(function () {
					if(($(window).scrollTop() + $(window).height()) == $(document).height())
					{		
						if(currentPage<= totalPage){
							$("#device").gridalicious('append', makeboxes());
						}else{
							alert('所有图片已加载完毕！');
						}
					}
			});

			//主要部分
            $("#device").gridalicious({
                gutter: 20,
                width: 300,
                animate: true,
                animationOptions: {
                        speed: 150,
                        duration: 400,
                        complete:function(data){
							console.log("success");	
						}
                },
            });
        });
    </script>
	
</body>
</html>
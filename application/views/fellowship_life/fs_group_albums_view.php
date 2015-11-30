<?php 
	// $group_info = isset($group_info) ? $group_info : "" ;	
	// $group_albums_names = isset($group_albums_names) ? $group_albums_names : "" ;
	$album_results = isset($album_results) ? $album_results : "" ;
//	 var_dump($album_results);exit;

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
				<li class="active"><a href="<?php echo site_url('album'); ?>">家人相册集</a></li>

			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<h4>家人相册集</h4>
			<div class="row">
				<?php  if (!empty($album_results)) { 
					$folder_color=null;

					foreach ($album_results as $k => $v) {
						$album_id = $v->album_id;
						$album_name = $v->album_name;
						$photos_count = $v->photos_count;
//						var_dump($photos_count);exit;

						$nick = $v->nick;
						$create_by = $v->user_id;

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
						<?php if (  $photos_count != "0") { ?>
							
							<!-- Group photo album -->
							<a href="<?php echo site_url('fellowship_life/see_user_photos?create_by='."$create_by".'&album_id='."$album_id"); ?>" >
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box <?php echo $folder_color; ?>">
										<span class="info-box-icon"><i class="fa fa-folder"></i></span>
										<div class="info-box-content">
											<span class="info-box-text"><?php echo $album_name; ?></span>
											<span class="info-box-number">照片个数：<?php echo $photos_count; ?></span>
											<span class="progress-description pull-right"><br>相册主人：<?php echo $nick; ?></span>
										</div><!-- /.info-box-content -->
									</div><!-- /.info-box -->
								</div><!-- /.col -->
							</a>
						<?php }else{ ?>
							<!-- Group photo album -->
							<a href="javascript:;" class="href_type" onclick=" return check_isnull_file()" >
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box <?php echo $folder_color; ?>">
										<span class="info-box-icon"><i class="fa fa-folder"></i></span>
										<div class="info-box-content">
											<span class="info-box-text"><?php echo $album_name; ?></span>
											<span class="info-box-number">照片个数：<?php echo $photos_count; ?></span>
											<span class="progress-description pull-right"><br>相册主人：<?php echo $nick; ?></span>
										</div><!-- /.info-box-content -->
									</div><!-- /.info-box -->
								</div><!-- /.col -->
							</a>
						<?php } ?>
					<?php }
						?>
				<?php } ?>	       
			</div><!-- /.row -->

		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

    <?php  $this->load->view('tq_footer'); ?>
	<script>
		function check_isnull_file () {
			alert('该文件夹为空！');
			return false;
		}
	</script>

</body>
</html>
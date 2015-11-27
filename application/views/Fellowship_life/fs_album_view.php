<?php 
	// $group_info = isset($group_info) ? $group_info : "" ;	
	$group_albums_counts   = isset($group_albums_counts) ? $group_albums_counts : "" ;
	// var_dump($group_albums_counts);exit;

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
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="">团契生活</li>
				<li class="active"><a href="<?php echo base_url('album'); ?>">家人相册集</a></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<h4>家人相册集</h4>
			<div class="row">
				<?php  if (!empty($group_albums_counts)) { 
					$folder_color=null;

					foreach ($group_albums_counts as $k => $v) { 
						$group_id = $v->group_id;
						$group_name = $v->group_name;
						$group_album_count = isset($v->group_album_count) && !empty($v->group_album_count) ? $v->group_album_count: '0';

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
						<?php if ( $group_album_count != '0') { ?>
							
							<!-- Group photo album -->
							<a href="<?php echo base_url('fellowship_life/group_albums?group_id='."$group_id"); ?>">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box <?php echo $folder_color; ?>">
										<span class="info-box-icon"><i class="fa fa-folder"></i></span>
										<div class="info-box-content">
												<span class="info-box-text"><?php echo $group_name; ?></span>																															
												<span class="info-box-number">相册个数：<b><?php echo $group_album_count; ?></b></span>
												<input type="hidden" calss="albums_count" value="<?php echo $group_album_count; ?>">
												<span class="progress-description">
											<br>
											</span>
										</div><!-- /.info-box-content -->
									</div><!-- /.info-box -->
								</div><!-- /.col -->
							</a>										
						<?php }else { ?>
							<a href="#" onclick=" return check_isnull_file()">						
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="info-box <?php echo $folder_color; ?>">
									<span class="info-box-icon"><i class="fa fa-folder"></i></span>
									<div class="info-box-content">
											<span class="info-box-text"><?php echo $group_name; ?></span>																															
											<span class="info-box-number">相册个数：<b><?php echo $group_album_count; ?></b></span>
											<input type="hidden" calss="albums_count" value="<?php echo $group_album_count; ?>">
											<span class="progress-description">
											<br>
										</span>
									</div><!-- /.info-box-content -->
								</div><!-- /.info-box -->
							</div><!-- /.col -->
							</a>																	
						<?php 	} ?>   	
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
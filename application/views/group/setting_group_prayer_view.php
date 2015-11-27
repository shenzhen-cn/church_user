<?php 
	$today_group_prayer  = isset($today_group_prayer) ? $today_group_prayer : "" ;
	// var_dump($today_group_prayer);exit;
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>小组-使命青年团契</title>
	<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				小组
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li>小组</li>
				<li class="active">小组祷告设置</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-6 ">
					<?php $this->load->view('tq_alerts'); ?>				
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">小组今日祷告</h3>
							<div class="pull-right">
								今天是：<i><?php echo   date("Y年m月d日",time());?></i>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body no-padding">
							<div class="table-responsive mailbox-messages">
								<form action="<?php echo base_url('setting_group_prayer'); ?>" method="post">									
									<div class="box-body">
										<div class="form-group">
											<label for="group_prayer_days">设置天数：</label>
											<input type="number" step="1" min="1"  class="form-control" placeholder="1" disabled >
										</div>
										<?php if (!empty($today_group_prayer)): ?>										
											<div class="form-group">
												<label for="group_prayer_content">今日已提交祷告内容：</label>
												<textarea  class="form-control"  placeholder='<?php echo $today_group_prayer->group_prayer_content; ?>' rows="5" required='required' disabled ></textarea>
											</div>
										<?php endif ?>
										<div class="form-group">
											<label for="group_prayer_content">设置祷告内容：</label>
											<textarea  class="form-control" id="group_prayer_content" name="group_prayer_content" rows="5" required='required'></textarea>
										</div>
									</div><!-- /.box-body -->

									<div class="box-footer">
										<button type="submit" class="btn btn-primary pull-right">提交</button>
										<a type="button" class="btn btn-warning pull-left" onclick="window.history.back()">返回</a>
									</div>
								</form>
									
							</div><!-- /.mail-box-messages -->
						</div><!-- /.box-body -->						
					</div><!-- /. box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	
</body>
</html>
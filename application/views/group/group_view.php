<?php 	
		$group_id 				= isset($results->id) ? $results->id : "";		
		$group_name 			= isset($results->group_name) ? $results->group_name : "";
		$group_leader_id 		= isset($results->group_leader_id) ? $results->group_leader_id : "";		
		$user_id 				= isset($user_id) ? $user_id : "" ;
		$user_group_id          = isset($user_info->group_id) ? $user_info->group_id : "";
		$group_users 			= isset($group_users) ? $group_users : "" ;
//		var_dump($group_users);exit;
		$group_name 			= isset($group_name) ? $group_name : "" ;
		$week_s_report 			= isset($week_s_report) ? $week_s_report : "" ;
		$week_firstday 			= isset($week_firstday) ? $week_firstday : "" ;
		$week_lastday 			= isset($week_lastday) ? $week_lastday : "" ;

 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>小组-使命青年团契</title>
<?php $this->load->view('tq_head'); ?>
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
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">小组</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<?php if (!empty($group_leader_id) && !empty($user_id) && ($group_leader_id == $user_id) ) { ?>
					
						<!-- only group leader -->
						<div class="row">

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
								<div class="info-box-content">
									<a href="<?php echo site_url('spirituality'); ?>" >
										<span class="info-box-text">设置小组当日灵修</span>
									</a>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->


						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-red"><i class="fa  fa-pencil"></i></span>
								<div class="info-box-content">
									<a href="<?php echo site_url('checkSpiri'); ?>" >
										<span class="info-box-text">审核小组成员灵修和祷告</span>
									</a>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->

							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="info-box">
									<span class="info-box-icon bg-yellow"><i class="fa fa-file"></i></span>
									<div class="info-box-content">
										<a href="<?php echo site_url('setting_group_prayer'); ?>">
											<span class="info-box-text">小组今日代祷</span>
										</a>
									</div><!-- /.info-box-content -->
								</div><!-- /.info-box -->
							</div><!-- /.col -->
						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-trophy"></i></span>
								<div class="info-box-content">
									<a href="<?php echo site_url('ranking'); ?>">
										<span class="info-box-text">小组团契排名</span>
									</a>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				
			<?php } ?>

			<?php if (!empty($group_users)){ ?>
				<div class="row">
					<div class="col-md-12 ">
						<!-- USERS LIST -->
						<div class="box box-danger">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $group_name; ?>成员列表</h3>
								<div class="box-tools pull-right">
									<span class="label label-danger"><?php echo count($group_users); ?>人小组</span>
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div><!-- /.box-header -->
							<div class="box-body no-padding">
								<div class="row">
									<div class="col-md-12">
										<ul class="users-list">
											<?php foreach ($group_users as $k => $v) {
													$group_user_id = $v->user_id;
													// var_dump($group_user_id);exit;
													$nick    = $v->nick;
													$count_spirituality    = $v->count_spirituality;
													$userHead_src    = isset($v->userHead_src) ? $v->userHead_src : "";
											 ?>
												<li>
													<a href="<?php echo site_url('seeMember?user_id='.$group_user_id); ?>" onclick="return seeUser(<?php echo $count_spirituality; ?>)">
													<?php if (empty($userHead_src)) {?>
													   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg"   alt="User Image" >
													<?php } else { ?>
													 	<img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHead_src"; ?>"  alt="User Image">
													 <?php   } ?>
													</a>
													 <p class="users-list-name" ><?php echo  ($group_user_id == $user_id) ? '我' : $nick; ?></p>
													<span class="users-list-date">灵修：<p class="label label-success"><?php echo $count_spirituality; ?>次</p></span>
												</li>
											<?php } ?>

										</ul><!-- /.users-list -->
									</div>
								</div>
							</div><!-- /.box-body -->
						</div><!--/.box -->
					</div><!-- /.col -->
				</div>   <!-- /.row -->
			<?php } ?>

			<?php if (!empty($week_s_report) && $user_group_id == $group_id ) { ?>
				
			<div class="row">
				<div class="col-md-12 ">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">本周<?php echo $group_name; ?>灵修</h3>
						</div><!-- /.box-header -->
						<div class="box-body no-padding">
							<div class="table-responsive mailbox-messages">
								<table class="table table-hover table-striped">
									<thead>
										<tr>
											<th>编号</th>
											<th>昵称</th>
											<th>本周灵修(天)</th>
											<th>剩余灵修(天)</th>
											<th>完成进度</th>
											<th>灵修率</th>
											<th>本周小组排名</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($week_s_report as $k => $v) { 
											$group_user_id = $v->group_user_id;
											$group_user_nick = $v->group_user_nick;
											$this_week_count = $v->this_week_count;
											$should_completed_counts = $v->should_completed_counts;
											$progress = $v->progress;
											$group_user_rank = $v->group_user_rank;
											$danger ="";

											if($group_user_id == $user_id ){
												$danger = "danger";		
											}
										?>

										<tr class="<?php echo $danger; ?>">
											<td><?php echo $k+1; ?></td>
											<td><?php echo $group_user_nick; ?></td>
											<td><?php echo $this_week_count; ?></td>
											<td><?php echo $should_completed_counts - $this_week_count; ?></td>
											<td>
												<div class="progress progress-xs">
												  <div class="progress-bar progress-bar-danger" style="width: <?php echo $progress; ?>"></div>
												</div>
											</td>
											<td><?php echo $progress; ?></td>
											<td>
											<?php if ($group_user_rank > 0) { ?>
												<p class="label label-success"><?php echo $group_user_rank; ?></p>	
											<?php } ?>
											</td>										
										</tr>
										
									<?php } ?>

									</tbody>
								</table><!-- /.table -->
							</div><!-- /.mail-box-messages -->
						</div><!-- /.box-body -->
						<div class="box-footer no-padding">
							<div class="mailbox-controls">
								<div class="box-tools pull-left">
									<div class="has-feedback">
										<i>(<?php echo date("Y/m/d",strtotime( $week_firstday)); ?>-<?php echo date("Y/m/d",strtotime($week_lastday)) ; ?>)</i>
									</div>
								</div><!-- /.box-tools -->
							</div>
							<br>
						</div>
					</div><!-- /. box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			<?php } ?>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	<script>
		function seeUser(count_spirituality) {
			if(count_spirituality == 0){
				alert('这人太懒，还没有灵修呢！');
				return false;				
			}
		}
	</script>
</body>
</html>
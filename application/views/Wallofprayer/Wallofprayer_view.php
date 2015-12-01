<?php
//	echo "sdfsd";exit;
	$content_prayer       = isset($content_prayer) ? $content_prayer : '' ;
//	var_dump($content_prayer);exit;
	$urgent_prayer        = isset($urgent_prayer) ? $urgent_prayer : "" ;

	$total                = isset($total) ? $total : "" ;
	$is_send              = isset($is_send) ? $is_send : "" ;
	$group_leader_id      = isset($user_info->group_leader_id) ? $user_info->group_leader_id : "" ;
	$leader_group_id      = isset($user_info->group_id) ? $user_info->group_id : "" ;
	$today_group_prayer   = isset($today_group_prayer) ? $today_group_prayer : "";
	$content_group_prayer = isset($content_group_prayer) ? $content_group_prayer : "";
	$group_prayer_total   = isset($group_prayer_total) ? $group_prayer_total : "";
	$is_send_group_prayer = isset($is_send_group_prayer) ? $is_send_group_prayer : "";
	// var_dump($is_send_group_prayer);exit;


?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>祷告墙-使命青年团契</title>
	<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				祷告墙
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li>祷告墙</li>
				<li class="active">今日祷告</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<ul class="list-unstyled">						
						<?php  if (! empty($urgent_prayer)) {
								$urgent_prayer_id = isset($urgent_prayer->id) ? $urgent_prayer->id : "";
							 ?>							
						<li id="urgent_prayer">
							<div class="row">
								<div class="col-md-12">
									<?php $this->load->view('tq_alerts'); ?>								
									<!-- DIRECT CHAT DANGER -->
									<div class="box box-primary direct-chat direct-chat-danger">
										<div class="box-header with-border">
											<h3 class="box-title">团契祷告</h3>
											<div class="box-tools pull-right">
												<span data-toggle="tooltip" title="祷告人数：<?php echo $total;?>" class="badge bg-aqua">祷告人数：<?php echo $total;?></span>
												<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											</div>
										</div><!-- /.box-header -->
										<div class="box-body">
											<span class="direct-chat-timestamp pull-left">祷告期限：<?php echo date("Y:m:d",strtotime( $urgent_prayer->create_at)); ?> -- <?php echo date("Y:m:d",strtotime( $urgent_prayer->overdue_at)); ?></span>											
											<div class="text-center">
												<div class="direct-chat-info clearfix">
													<h3><b>紧急代祷</b></h3>
												</div><!-- /.direct-chat-info -->
												<strong>
													<?php echo $urgent_prayer->urgent_prayer_content; ?>
												</strong>
											</div><!-- /.direct-chat-msg -->

											<div class="direct-chat-messages">

												<?php if (! empty($content_prayer)){ ?>
													<?php foreach ($content_prayer as $k => $v) {
														// var_dump($content_prayer);exit;
														$urgent_id = $v->urgent_id;
														$prayer_user_id = $v->user_id;
														$nick = $v->nick;
														$content_prayer = $v->content_prayer;
														$created_at = $v->created_at;
														$conversion_time = $v->conversion_time;
														$user_group_id = $v->group_id;
														$userHeadSrc = $v->userHeadSrc;?>

												<?php if ($prayer_user_id == $user_id ){ ?>
												<br><br>
												<!-- Message to the right -->
												<div class="direct-chat-msg right">
													<div class="direct-chat-info clearfix">
														<span class="direct-chat-name pull-right">我&nbsp; &nbsp; </span>
														<span class="direct-chat-timestamp pull-left"><?php echo $conversion_time; ?></span>
													</div><!-- /.direct-chat-info -->
													<?php if (empty($userHeadSrc)) {?>
													   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="direct-chat-img" alt="用户头像">
													<?php } else { ?>
													 <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc"; ?>" class="direct-chat-img" alt="用户头像">
													 <?php   } ?>
													<div class="direct-chat-text">
														<?php echo $content_prayer; ?>
														<!-- <p class="pull-right">&times;</p> -->
															<div class="clearfix">															
															</div>
															<br>
										      				<a href="<?php echo site_url('Wallofprayer/del_payer?urgent_id='.$urgent_id.'&del_by='.$user_id); ?>" type="button" class="btn btn-warning btn-xs" onclick=" return drop_confirm()"><span class="pull-right">删除</span></a>
													</div><!-- /.direct-chat-text -->
												</div><!-- /.direct-chat-msg -->																

												<?php } else { ?>
												<!-- Message to the right -->
												<div class="direct-chat-msg ">
													<div class="direct-chat-info clearfix">
														<span class="direct-chat-name pull-left"><?php  echo $nick; ?></span>
														<span class="direct-chat-timestamp pull-right"><?php echo $conversion_time; ?></span>
													</div><!-- /.direct-chat-info -->
													<?php if (empty($userHeadSrc)) {?>
													   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="direct-chat-img" alt="用户头像">
													<?php } else { ?>
													 <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc"; ?>" class="direct-chat-img" alt="用户头像">
													 <?php   } ?>
													<div class="direct-chat-text">
														<?php echo $content_prayer; ?>	
														<?php if ($group_leader_id == $user_id && $leader_group_id == $user_group_id ) { ?>
															<div class="clearfix">															
															</div>
															<br>
										      				<a href="<?php echo site_url('Wallofprayer/del_payer?urgent_id='.$urgent_id.'&del_by='.$user_id); ?>" type="button" class="btn btn-warning btn-xs" onclick=" return drop_confirm()"><span class="pull-right">删除</span></a>
														<?php } ?>													
													</div><!-- /.direct-chat-text -->
												</div><!-- /.direct-chat-msg -->

												<?php } ?>			
												<?php 	}
												 ?>
												<?php } ?>																																																
												
											</div><!--/.direct-chat-messages-->

										</div><!-- /.box-body -->
										<?php if ($is_send == 'N') { ?>

											<div class="box-footer">
												<form action="<?php echo site_url('wallofprayer/send_prayer'); ?>" method="post">
													<div class="input-group">

														<textarea onpropertychange="if(value.length>400) value=value.substr(0,400)" onKeyDown="LimitTextArea(this)" onKeyUp="LimitTextArea(this)" onkeypress="LimitTextArea(this)" name="content_prayer" placeholder="祷告内容..." class="form-control" required="required" style="width: 100%; height: 34px; font-size: 14px; line-height: 20px;  solid #dddddd; padding: 10px; resize: none;"></textarea>

														<input type="hidden" name="urgent_prayer_id" value="<?php echo $urgent_prayer_id; ?>">
														<span class="input-group-btn">
															<button type="submit" class="btn btn-danger btn-flat">发送</button>
														</span>
													</div>
												</form>
											</div><!-- /.box-footer-->
										<?php } ?>
									</div><!--/.direct-chat -->
								</div>
							</li>

						<?php } ?>	
						<?php if (!empty($today_group_prayer)) { 
							$group_prayer_id = $today_group_prayer->id;
							// var_dump($group_prayer_id);exit;
							$group_prayer_content = $today_group_prayer->group_prayer_content;
							$group_prayer_created_at = $today_group_prayer->created_at;

							?>
							
							<li id="group_prayer">
								<div class="row">										
									<div class="col-md-12">
										<!-- DIRECT CHAT DANGER -->
										<div class="box box-danger direct-chat direct-chat-danger">
											<div class="box-header with-border">
												<h3 class="box-title">小组祷告</h3>
												<div class="box-tools pull-right">
													<span data-toggle="tooltip" title="祷告人数：<?php echo $group_prayer_total; ?> " class="badge bg-red">祷告人数：<?php echo $group_prayer_total; ?></span>
													<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
												</div>
											</div><!-- /.box-header -->
											<div class="box-body">
												<span class="direct-chat-timestamp pull-left">祷告发布时间：<?php echo date("Y:m:d",strtotime( $group_prayer_created_at)); ?></span>																						
												<div class="text-center">
													<div class="direct-chat-info clearfix">
														<h3><b>今日代祷事项</b></h3>
													</div><!-- /.direct-chat-info -->
													<strong>
														<?php echo $group_prayer_content; ?>
													</strong>
												</div><!-- /.direct-chat-msg -->

												<div class="direct-chat-messages">
													<!-- Message to the right -->
														<?php if (! empty($content_group_prayer)){ ?>
															<?php foreach ($content_group_prayer as $k => $v) {
																// var_dump($content_group_prayer);exit;
																$prayer_for_group_id = $v->prayer_for_group_id;
																$group_prayer_user_id = $v->user_id;
																$nick = $v->nick;
																$group_prayer_contents = $v->group_prayer_contents;
																$created_at = $v->created_at;
																$conversion_time = $v->conversion_time;
																$user_group_id = $v->group_id;
																$userHeadSrc = $v->userHeadSrc;	?>	 												

														<?php if ($group_prayer_user_id == $user_id ){ ?>
														<br><br>
														<!-- Message to the right -->
														<div class="direct-chat-msg right">
															<div class="direct-chat-info clearfix">
																<span class="direct-chat-name pull-right">我&nbsp; &nbsp; </span>
																<span class="direct-chat-timestamp pull-left"><?php echo $conversion_time; ?></span>
															</div><!-- /.direct-chat-info -->
															<?php if (empty($userHeadSrc)) {?>
															   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="direct-chat-img" alt="用户头像">
															<?php } else { ?>
															 <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc"; ?>" class="direct-chat-img" alt="用户头像">
															 <?php   } ?>
															<div class="direct-chat-text">
																<?php echo $group_prayer_contents; ?>
																<!-- <p class="pull-right">&times;</p> -->
																	<div class="clearfix">															
																	</div>
																	<br>
												      				<a href="<?php echo site_url('Wallofprayer/del_group_payer?prayer_for_group_id='.$prayer_for_group_id.'&del_by='.$user_id); ?>" type="button" class="btn btn-warning btn-xs" onclick=" return drop_confirm()"><span class="pull-right">删除</span></a>
															</div><!-- /.direct-chat-text -->
														</div><!-- /.direct-chat-msg -->																

														<?php } else { ?>
														<!-- Message to the right -->
														<div class="direct-chat-msg ">
															<div class="direct-chat-info clearfix">
																<span class="direct-chat-name pull-left"><?php  echo $nick; ?></span>
																<span class="direct-chat-timestamp pull-right"><?php echo $conversion_time; ?></span>
															</div><!-- /.direct-chat-info -->
															<?php if (empty($userHeadSrc)) {?>
															   <img src="<?php echo base_url(); ?>images/mrpho.jpg" class="direct-chat-img" alt="用户头像">
															<?php } else { ?>
															 <img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc"; ?>" class="direct-chat-img" alt="用户头像">
															 <?php   } ?>
															<div class="direct-chat-text">
																<?php echo $group_prayer_contents; ?>	
																<?php if ($group_leader_id == $user_id && $leader_group_id == $user_group_id ) { ?>
																	<div class="clearfix">															
																	</div>
																	<br>
												      				<a href="<?php echo site_url('Wallofprayer/del_group_payer?prayer_for_group_id='.$prayer_for_group_id.'&del_by='.$user_id); ?>" type="button" class="btn btn-warning btn-xs" onclick=" return drop_confirm()"><span class="pull-right">删除</span></a>
																<?php } ?>													
															</div><!-- /.direct-chat-text -->
														</div><!-- /.direct-chat-msg -->

														<?php } ?>			
														<?php 	}
														 ?>
														<?php } ?>																																																
												</div><!--/.direct-chat-messages-->
											</div><!-- /.box-body -->
											<?php if ($is_send_group_prayer == 'N') { ?>												
												<div class="box-footer">
													<form action="<?php echo site_url('Wallofprayer/send_group_prayer'); ?>" method="post">
														<div class="input-group">
															<textarea onpropertychange="if(value.length>400) value=value.substr(0,400)" onKeyDown="LimitTextArea(this)" onKeyUp="LimitTextArea(this)" onkeypress="LimitTextArea(this)" name="group_prayer_contents" placeholder="祷告内容..." class="form-control" required="required" style="width: 100%; height: 34px; font-size: 14px; line-height: 20px;  solid #dddddd; padding: 10px; resize: none;"></textarea>
															<input type="hidden" name="group_prayer_id" value="<?php echo $group_prayer_id; ?>">
															<span class="input-group-btn">
																<button type="submit" class="btn btn-danger btn-flat">发送</button>
															</span>
														</div>
													</form>
												</div><!-- /.box-footer-->
											<?php } ?>
										</div><!--/.direct-chat -->
									</div>
								</li>								
						<?php } ?>														
							</ul>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<?php  $this->load->view('tq_footer'); ?>
			<script>
				function LimitTextArea(field){ 
				    maxlimit=400; 
				    if (field.value.length > maxlimit){
				     	field.value = field.value.substring(0, maxlimit); 
					 	alert('系统提示，只可以输入400字！');
				    } 
				}

				function drop_confirm()
				{
					var r=confirm("你确定删除此文件么");
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
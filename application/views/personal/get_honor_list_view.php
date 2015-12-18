<?php 
	$user_info_count_spirit_results   = isset($user_info_count_spirit_results) ? $user_info_count_spirit_results : "" ; 	
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>光荣榜-使命青年团契</title>
<?php $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				光荣榜
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">光荣榜</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">

			<div class="row">
				<div class="col-md-12">
					<div id="honor_list_panel">
						<!-- Chat box -->
					     <div class="box box-success">
					       <div class="box-header">
					         <i class="fa fa-child"></i>
					         <h3 class="box-title">灵修光荣榜 <small>前十名</small> </h3>				        				       
					         <div class="box-tools pull-right">
		                        <div class="btn-group">
		                          <button type="button" class="btn btn-danger btn-sm prayer">查看祷告排名</button>	                          
		                        </div>
		                      </div>
					       </div>
					       <div class="box-body chat" id="chat-box">
							<!-- table -->
							<div class="table-responsive mailbox-messages">
								<table class="table table-hover table-striped">
									<thead>
										<tr>
											<th>编号</th>
											<th>头像</th>
											<th>昵称</th>
											<th>性别</th>
											<th>所在小组</th>
											<th>何时加入</th>
											<th>在线天数</th>
											<th>灵修总数</th>
											<th>比率条</th>
											<th>灵修率</th>
										</tr>
									</thead>
									<tbody>		
										<?php $i = 1; ?>
										<?php if (!empty($user_info_count_spirit_results)) {
											foreach ($user_info_count_spirit_results as $key => $value) { 
													$spirit_honor_list_user_id = $value->user_id;
													$user_userHead_src = $value->user_userHead_src;
													$spirit_honor_list_user_nick = $value->user_nick;
													$spirit_honor_list_user_sex = $value->user_sex;
													$user_group_name = $value->user_group_name;
													$user_created_at = $value->user_created_at;
													$user_already_reg_day = $value->already_reg_day;
													$user_count_spirit = $value->user_count_spirit;
													$user_spirit_rate = $value->spirit_rate;
											?>
												<tr>
													<td><?php echo $i; ?></td>
													<td class="item">												
														<?php if (empty($user_userHead_src)) {?>
														   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" alt="user image" class="online">
														<?php } else { ?>
														 <img src="<?php echo base_url()."public/uploads/userHeadsrc/$user_userHead_src"; ?>"  alt="user image" class="online">
														 <?php   } ?> 
													</td>
													<td>
														<a href="<?php echo site_url('seeMember?user_id=').$spirit_honor_list_user_id."&content=coments"; ?>" class="name">
														  <?php echo $spirit_honor_list_user_nick; ?>
														</a>
													</td>
													<td>
														<?php echo $spirit_honor_list_user_sex; ?> 
													</td>
													<td>
														<?php echo $user_group_name; ?>
													</td>
													<td>
														<?php echo $user_created_at; ?>
													</td>
													<td>
														<?php echo $user_already_reg_day; ?>
													</td>
													<td>
														<?php echo $user_count_spirit; ?>
													</td>												
													<td>
														<div class="progress progress-xs">
														  <div class="progress-bar progress-bar-danger" style="width: <?php echo $user_spirit_rate; ?>; ?>"></div>
														</div>
													</td>
													<td>
														<?php echo $user_spirit_rate; ?>
													</td>										
												</tr>
												<?php $i++; ?>
										<?php	}
										} ?>																											
									</tbody>
								</table><!-- /.table -->
							</div><!-- /.mail-box-messages -->							
							<!-- end table -->					         
					       </div><!-- /.chat -->					       
					     <!-- /.box (chat box) -->
					</div> <!-- honor_list_panel -->
				</div>	
			</div> <!-- row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>	
	<script>
		$(function() {
			$('.prayer').click(function(event) {
				var Ajaxurl = 'get_honor_list'
				listType = 'prayer';
				 htmlobj  =  $.ajax({
					url: Ajaxurl,
					type: 'GET',
					dataType: 'json',
					async:false,
					data: {listType: listType},
				});						 
				$('#honor_list_panel').html(htmlobj.responseText);
			});
		});
	</script>
</body>
</html>	
<?php 
	$user_info_count_prayer_results  = isset($user_info_count_prayer_results) ? $user_info_count_prayer_results : "";
?>
	<!-- Chat box -->
	 <div class="box box-danger">
	   <div class="box-header">
	     <i class="fa fa-child"></i>
	     <h3 class="box-title">祷告光荣榜 <small>前十名</small> </h3>				        				       
	     <div class="box-tools pull-right">
	        <div class="btn-group">
	          <a  href="" type="button" class="btn btn-success btn-sm">查看灵修排名</a>
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
						<th>祷告总数</th>
						<th>比率条</th>
						<th>祷告率</th>
					</tr>
				</thead>
				<tbody>		
					<?php $i = 1; ?>
					<?php if (!empty($user_info_count_prayer_results)) {
						foreach ($user_info_count_prayer_results as $key => $value) { 
								$spirit_honor_list_user_id = $value->user_id;
								$user_userHead_src = $value->user_userHead_src;
								$spirit_honor_list_user_nick = $value->user_nick;
								$spirit_honor_list_user_sex = $value->user_sex;
								$user_group_name = $value->user_group_name;
								$user_created_at = $value->user_created_at;
								$user_already_reg_day = $value->already_reg_day;
								$user_count_prayer = $value->user_count_prayer;
								$user_prayer_rate = $value->prayer_rate;
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td class="item">												
									<?php if (empty($user_userHead_src)) {?>
									   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" alt="user image" class="online">
									<?php } else { ?>
									 <img src="<?php echo base_url()."public/uploads/userHeadsrc/$user_userHead_src"; ?>"  alt="user image" class="offline">
									 <?php   } ?> 
								</td>
								<td>
									<a href="<?php echo site_url('seeMember?user_id=').$spirit_honor_list_user_id."&content=replies"; ?>" class="name">
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
									<?php echo $user_count_prayer; ?>
								</td>												
								<td>
									<div class="progress progress-xs">
									  <div class="progress-bar progress-bar-danger" style="width: <?php echo $user_prayer_rate; ?>; ?>"></div>
									</div>
								</td>
								<td>
									<?php echo $user_prayer_rate; ?>
								</td>										
							</tr>
							<?php $i++; ?>
					<?php	}
					} ?>																											
				</tbody>
			</table><!-- /.table -->
		</div><!-- /.mail-box-messages -->							
		<!-- end table -->					         
	   </div>
	   <!-- /.chat -->					       
	 <!-- /.box (chat box) -->

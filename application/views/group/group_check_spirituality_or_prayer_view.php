<?php 	
		$users_results    = isset($users_results) ? $users_results : ""; 
		$check_results    = isset($check_results) ? $check_results:"";
		$prayer_results   = isset($prayer_results) ? $prayer_results :"";
		$group_leader_id  = isset($user_info->group_leader_id) ? $user_info->group_leader_id : ""; 

		$starttime = $this->input->post('starttime');
		$endtime = $this->input->post('endtime');
		$users_id = $this->input->post('users_id');
		$check_class = $this->input->post('check_class');
		// var_dump($check_class);exit;

 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>小组-使命青年团契</title>
<?php $this->load->view('tq_head'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/css/bootstrap-datetimepicker.css'); ?>">
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
				<li>小组</li>
				<li class="active">小组灵修审核</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<form action="<?php echo site_url('checkSpiri'); ?>" method="post">
						<div class="box box-danger">
						  <div class="box-header">
						    <h3 class="box-title">搜索框</h3>
						  </div>
						  <div class="box-body">

						    <!-- Date dd/mm/yyyy -->
						    <div class="form-group">
						      <label>选择起始日期:</label>
						      <div class="input-group">
						        <div class="input-group-addon">
						          <i class="fa fa-calendar"></i>
						        </div>
						        <input type="text" class="form-control starttime" name="starttime" readonly="readonly"  value="<?php echo $starttime; ?>">
						      </div><!-- /.input group -->
						    </div><!-- /.form group -->														

						    <!-- Date mm/dd/yyyy -->
						    <div class="form-group">
						      <div class="input-group">
						        <div class="input-group-addon">
						          <i class="fa fa-calendar"></i>
						        </div>
						        <input type="text" class="form-control endtime" name="endtime" readonly="readonly" value="<?php echo $endtime; ?>">
						      </div><!-- /.input group -->
						    </div><!-- /.form group -->

						    <!-- phone mask -->
						    <?php  if(!empty($users_results)){ ?>
						    <div class="form-group">
						      <label>选择成员:</label>
						      <div class="input-group">
						        <div class="input-group-addon">
						          <i class="fa  fa-user"></i>
						        </div>
						        <select class="form-control" name="users_id">
						    		<?php
						    			foreach ($users_results as $k => $v) {
							    			$selected = "";
						    				$group_user_id = $v->id;
							    			if(!empty($users_id) && $users_id == $group_user_id ){
							    				$selected  = "selected";
							    			}
						    				$group_user_nick = $v->nick;?>
								    <option <?php echo $selected; ?>  value="<?php echo $group_user_id; ?>"><?php echo $group_user_nick; ?></option>
								    <?php	} ?>							    
							  </select>
						      </div><!-- /.input group -->
						    </div><!-- /.form group -->						   
						    <?php } ?>
							
							<div class="form-group">
							  <label>选择查询项目:</label>							  							  	
								<div class="radio">
								  <label>
								    <input type="radio" name="check_class"  value="spirituality" <?php if($check_class == 'spirituality' ) echo "checked"; ?>>
								    灵修
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="check_class"  value="prayer" <?php if($check_class =='prayer' ) echo "checked"; ?>>
								    祷告
								  </label>
								</div>	
							</div>						    

						  </div><!-- /.box-body -->
						  <div class="box-footer">
		                    <button type="submit" class="btn btn-primary">查询</button>						    
						  </div>		
						</div><!-- /.box -->										
					</form>				
				</div> <!-- .col -->

				<?php if(!empty($check_results)){ ?>
					<!-- check_results -->
					<div class="col-md-12">
					 <div class="box box-solid">
					   <div class="box-header with-border">
					     <i class="fa fa-text-width"></i>
					     <h3 class="box-title">灵修查询结果：</h3><small>(<?php echo count($check_results); ?>条数据)</small>
					   </div><!-- /.box-header -->
					   <div class="box-body">
					     <blockquote>
					     	<div class="active tab-pane" id="activity">
							 <?php foreach ($check_results as $key => $value) {
									 	$spirituality_id = $value->id;
									 	$directory = $value->directory;
									 	$user_id = $value->user_id;
									 	$book_id = $value->book_id;
									 	$chapter_id = $value->chapter_id;
									 	$gold_sentence = $value->gold_sentence;
									 	$heart_feeling = $value->heart_feeling;
									 	$response = $value->response;
									 	$conversion_time = $value->conversion_time;
									 	$user_userHead_src = $value->user_userHead_src;
									 	$group_user_nick = $value->group_user_nick;
									 	$comments_of_spirituality_result = $value->results_comments_and_replaies;
							 ?>

					     	  <!-- Post -->
					     	  <div class="post spirit_container_<?php echo $spirituality_id;?>">
					     	    <div class="user-block">
					     	      <?php if (empty($user_userHead_src)) {?>
					     	         <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle img-bordered-sm">
					     	      <?php } else { ?>
					     	       <img src="<?php echo base_url()."public/uploads/userHeadsrc/$user_userHead_src"; ?>" class="img-circle img-bordered-sm">
					     	       <?php   } ?> 
					     	      <span class='username'>
					     	        <a href="<?php echo site_url('seeMember?user_id='."$users_id".'&content=coments'); ?>"><?php echo $group_user_nick; ?></a>
					     	      </span>
					     	      <span class='description'>灵修：<?php echo $directory; ?>:<?php echo $chapter_id; ?> 章节	<span class="pull-right"><?php echo $conversion_time; ?></span></span>
					     	    </div><!-- /.user-block -->
					     	    <p><strong>金句：</strong><?php echo $gold_sentence; ?> </p>
					     	    <p class="text-yellow"><strong>心得：</strong><?php echo $heart_feeling; ?> </p>
					     	    <p class="text-green"><strong>回应：</strong><?php echo $response; ?> </p>

					     	    <ul class="list-inline">
					     	      <li><a href="javascript:;" class="link-black label label-danger text-sm del_spirit" data-spirituality-id="<?php echo $spirituality_id; ?>"><i class="fa fa-trash-o margin-r-5"></i> 删除</a></li>
					     	      <li class="pull-right"><a href="javascript:;" class="link-black text-sm comments" data-spirituality-id="<?php echo $spirituality_id; ?>"><i class="fa fa-comments-o margin-r-5"></i>评论 (<span class="total_comments_<?php echo $spirituality_id; ?>" data-comments-total="<?php echo count($comments_of_spirituality_result); ?>"><?php echo count($comments_of_spirituality_result); ?></span>)</a></li>
					     	    </ul>
					     	    <!-- 评论 -->
					     	    <?php if(!empty($comments_of_spirituality_result)){ ?>
						     	   	<ul class="list-unstyled box-comments_<?php echo $spirituality_id; ?>" style="display:none">
					     	    		<?php foreach ($comments_of_spirituality_result as $k_c => $v_c) {
					     	    			$comments_id = $v_c->comments_id;
					     	    			$contents = $v_c->contents;
					     	    			$commenter_id = $v_c->commenter_id;
					     	    			$commenter_nick = $v_c->commenter_nick;
					     	    			$commenter_userHead_src = $v_c->commenter_userHead_src;
					     	    			$comments_tran_created_at = $v_c->comments_tran_created_at;
					     	    			$replies_of_spirituality_result = $v_c->replies_of_spirituality_result; ?>
											<li class="box-comments del_comments_<?php echo $comments_id;?>">
												<div class="box-comment">
													<?php if (empty($commenter_userHead_src)) {
														?>
														<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle img-sm" alt="用户头像">
														<?php } else { ?>
														<img src="<?php echo base_url()."public/uploads/userHeadsrc/$commenter_userHead_src"; ?>" class="img-circle img-sm" alt="用户头像">
													<?php   } ?>
													<div class="comment-text">
														<span class="username">
														  <?php if($commenter_id == $user_id) echo "我";else  echo $commenter_nick; ?>
														  <span class='text-muted pull-right'><?php echo $comments_tran_created_at; ?></span>
														</span><!-- /.username -->
												 	    <?php echo $contents; ?>
												 	    <div class="pull-right tool_replay_<?php echo $comments_id;?>">
													 	    <ul class="list-unstyled list-inline">
													 	    	<li>
									 	    			      		<button class='btn btn-default btn-xs'>																				      																			      			
									 	    			      			<span class="del_comment" data-spirituality-id="<?php echo $spirituality_id; ?>" data-del-comment-id="<?php echo $comments_id;?>"><i class="fa  fa-trash-o margin-r-5"></i>删除</span>																		      			
									 	    		      			</button>
													 	    	</li>
													 	    </ul>												 	    													 	    															
														</div>	
														<?php if(!empty($replies_of_spirituality_result)){ ?>
															<ul class="list-unstyled reply_style">
																<?php foreach ($replies_of_spirituality_result as $k_r => $v_r) {
																	 		$reply_id = $v_r->reply_id;
																	 		$reply_nick = $v_r->reply_nick;
																	 		$replier_id = $v_r->replier_id;																				
																	 		$reply_comments_id = $v_r->reply_comments_id;
																	 		$reply_contents = $v_r->reply_contents;
																	 		$reply_created_at = $v_r->reply_created_at; ?>
																<li>
																	<div class="comment-text">
																		<span class="username">
																			<span class='text-muted pull-right'><?php echo $reply_created_at; ?></span>
																			<?php echo $reply_nick; ?> 回复 <?php echo $commenter_nick;  ?>																			
																		</span>
														 	  			<?php echo $reply_contents; ?>																		
																	</div>
																</li>
																<?php } ?>
															</ul>
														<?php } ?>												
													</div>													 	    														
												</div>
											</li>
					     	    		<?php } ?>
						     	   	</ul>
					     	    <?php } ?>
					     	  </div><!-- /.post -->				     	 
							<?php } ?>	
					     	</div><!-- /.tab-pane -->
					     </blockquote>
					   </div><!-- /.box-body -->
					 </div><!-- /.box -->
					</div><!-- ./col -->				
				<?php } else if (!empty($prayer_results)){ ?>
						<div class="col-md-12">
						  <div class="box box-solid">
						    <div class="box-header with-border">
						      <i class="fa fa-text-width"></i>
						      <h3 class="box-title">祷告查询结果：</h3><small>(<?php echo count($prayer_results); ?>条数据)</small>
						    </div><!-- /.box-header -->
						    <div class="box-body">
						      <blockquote>
						      	<?php foreach ($prayer_results as $k_p => $v_p) {
						      			$prayer_id =  isset($v_p->id) ? $v_p->id: "";
						      			$group_prayer_contents =  isset($v_p->group_prayer_contents) ? $v_p->group_prayer_contents: "";
						      			$content_prayer =  isset($v_p->content_prayer) ? $v_p->content_prayer: "";
						      			$prayer_userHead_src =  isset($v_p->prayer_userHead_src) ? $v_p->prayer_userHead_src: "" ;
						      			$prayer_nick =  isset($v_p->prayer_nick) ? $v_p->prayer_nick :'';
						      			$conversion_time =  isset($v_p->conversion_time) ? $v_p->conversion_time :"" ; ?>
						      	<?php if(!empty($group_prayer_contents)){ ?>
							     	<div class="post prayer_container_<?php echo $prayer_id;?>">
							     	  <div class="user-block">
							     	    <?php if (empty($prayer_userHead_src)) {
							     	    	?>
							     	    	<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle img-sm" alt="用户头像">
							     	    	<?php } else { ?>
							     	    	<img src="<?php echo base_url()."public/uploads/userHeadsrc/$prayer_userHead_src"; ?>" class="img-circle img-sm" alt="用户头像">
							     	    <?php   } ?>
							     	    <span class='username'>
							     	      <?php echo $prayer_nick; ?>
							     	      <a href='javascript:;' class="pull-right del_prayer btn-box-tool" data-prayer-id="<?php echo $prayer_id; ?>" content-style="group_prayer" ><i class='fa fa-times'></i></a>
							     	    </span>
							     	    <span class='description'>  发表于-<?php echo $conversion_time; ?></span>
							     	  </div><!-- /.user-block -->
								     	  <p class="text-green">
								     	    <?php echo $group_prayer_contents; ?>
								     	  </p>							     	  							     	  
							     	</div><!-- /.post -->
						      	<?php }else if(!empty($content_prayer)){ ?>
							     	<div class="post prayer_container_<?php echo $prayer_id;?>">
							     	  <div class="user-block">
							     	    <?php if (empty($prayer_userHead_src)) {
							     	    	?>
							     	    	<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle img-sm" alt="用户头像">
							     	    	<?php } else { ?>
							     	    	<img src="<?php echo base_url()."public/uploads/userHeadsrc/$prayer_userHead_src"; ?>" class="img-circle img-sm" alt="用户头像">
							     	    <?php   } ?>
							     	    <span class='username'>
							     	      <?php echo $prayer_nick; ?>
							     	      <a href='javascript:;' class="pull-right del_prayer btn-box-tool" data-prayer-id="<?php echo $prayer_id; ?>" content-style="urgent_prayer"><i class='fa fa-times'></i></a>
							     	    </span>
							     	    <span class='description'>  发表于-<?php echo $conversion_time; ?></span>
							     	  </div><!-- /.user-block -->							     	  							     	  
											<p class="text-red"><?php echo $content_prayer; ?></p>
							     	</div><!-- /.post -->						     		
						      	<?php } ?>			
						      	<?php } ?>
						      </blockquote>
						    </div><!-- /.box-body -->
						  </div><!-- /.box -->
						</div><!-- ./col -->						
				<?php } ?>
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	<script src="<?php echo base_url('public/plugins/js/bootstrap-datetimepicker.js'); ?>" ></script>
	<script src="<?php echo base_url('public/plugins/js/bootstrap-datetimepicker.zh-CN.js'); ?>" ></script>
	<script src="<?php echo base_url('public/js/spirituality_comment.js'); ?>"></script>	
	<script>
		$('.starttime').datetimepicker({
			minView:2,
		    format: 'yyyy-mm-dd',
		    language: 'zh-CN',
		    autoclose: true,
		    todayBtn: true,
		    todayHighlight:true,
		}).on('changeDate',function (ev) {
				var starttime = $(".starttime").val();	
				$(".endtime").datetimepicker({
				    format: 'yyyy-mm-dd',					
				    language: 'zh-CN',
					minView:2,
				    autoclose: true,
				    todayBtn: true,
				    todayHighlight:true,				    									
				});
				$(".endtime").datetimepicker('setStartDate',starttime);
				$('.starttime').datetimepicker("hide");				
		});
			
	</script>
</body>
</html>
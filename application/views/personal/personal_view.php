<?php 

	$informations = isset($informations) ? $informations : ""; 
	$spirituality_result = isset($informations->spirituality_result) ? $informations->spirituality_result: "";
	$user_nick = 	isset($user_info->nick) ? $user_info->nick : "";
	$group_leader_id = 	isset($user_info->group_leader_id) ? $user_info->group_leader_id : "";
	$userHeadSrc_info = isset($userHeadSrc_info) ? $userHeadSrc_info : "";

 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>个人中心-使命青年团契</title>
	<?php $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				个人中心
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li>个人中心</li>
				<li class="active">我的灵修</li>
			</ol>
		</section>

		<?php if (!empty($spirituality_result)) { 
			$spirituality_user_nick = isset($spirituality_result->spirituality_user_nick) ? $spirituality_result->spirituality_user_nick: ""; 
			$spirituality_userHead_src = isset($spirituality_result->spirituality_userHead_src) ? $spirituality_result->spirituality_userHead_src: ""; 
			$spirituality_user_id = isset($spirituality_result->spirituality_user_id) ? $spirituality_result->spirituality_user_id: ""; 


			$spirituality_id  = isset($spirituality_result->spirituality_id) ? $spirituality_result->spirituality_id : "";
			$directory  = isset($spirituality_result->directory) ? $spirituality_result->directory : "";
			$chapter_id  = isset($spirituality_result->chapter_id) ? $spirituality_result->chapter_id : "";
			$gold_sentence = isset($spirituality_result->gold_sentence) ? $spirituality_result->gold_sentence:""; 
			$heart_feeling = isset($spirituality_result->heart_feeling) ? $spirituality_result->heart_feeling:""; 
			$response = isset($spirituality_result->response) ? $spirituality_result->response:""; 
			$tran_created_at = isset($spirituality_result->tran_created_at) ? $spirituality_result->tran_created_at:""; 

			$count_praises = isset($informations->count_praises) ? $informations->count_praises: "";

			$info_praises = isset($informations->info_praises) ? $informations->info_praises: "";
			$is_praised = isset($informations->is_praised) ? $informations->is_praised: "";
			$comments_and_replaies_result = isset($informations->comments_and_replaies_result) ? $informations->comments_and_replaies_result: "";
		?>												
		<!-- Main content -->
		<section class="content spirit_container_<?php echo $spirituality_id;?>">
			<div class="row">
					<div class="col-md-12">
						<div class="box">
						  <div class="box-header">
						    <h3 class="box-title">我的灵修</h3>
						  </div><!-- /.box-header -->
						  <div class="box-body">
								<!-- Box Comment -->
								<div class="box box-widget">
									<div class='box-header with-border'>
										<div class='user-block'>
											<?php if (empty($spirituality_userHead_src)) {?>
											   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle">
											<?php } else { ?>
											 <img src="<?php echo base_url()."public/uploads/userHeadsrc/$spirituality_userHead_src"; ?>" class="img-circle" >
											 <?php   } ?>
											<span class='username'><?php if($spirituality_user_id == $user_id) echo  "我"; else echo $spirituality_user_nick; ?></span>
											<span class='description'><?php echo $directory;?> - <?php echo $chapter_id; ?>章节 - <?php echo $tran_created_at; ?></span>
										</div><!-- /.user-block -->
										<div class='box-tools'>																				
											<?php if($spirituality_user_id == $user_id){ ?>
												<button class='btn btn-box-tool'  title="删除"><a href="javascript:;" class="link-black text-sm del_spirit pull-right" data-spirituality-id="<?php echo $spirituality_id; ?>"> <span class="pull-right"><i class="fa  fa-trash-o margin-r-5"></i> 删除</span></a></button>
											<?php } ?>
										</div><!-- /.box-tools -->
									</div><!-- /.box-header -->
									<div class='box-body'>								      
										<b>金句：</b><br>
										<p><?php echo $gold_sentence; ?></p>
										<b>心得：</b><br>
										<p><?php echo $heart_feeling; ?></p>
										<b>回应：</b><br>
										<p><?php echo $response; ?></p>
										<button class='btn btn-default btn-xs'>
											<i class="fa fa-comments-o margin-r-5"></i> 评论
										</button>
										<?php if (!empty($is_praised) && $is_praised == 'Y') { ?>					
											<button class='btn btn-default btn-xs' disabled="disabled">
												<i class='fa fa-thumbs-o-up '></i>已赞
											</button>
										<?php }else { ?>
											<button class='btn btn-danger btn-xs praise praise_content_<?php echo $spirituality_id; ?>' data-spirituality-id='<?php echo $spirituality_id; ?>'>
												<i class='fa fa-thumbs-o-up '></i> <span class="praised_<?php echo $spirituality_id; ?>">赞</span>
											</button>
										<?php } ?>	
										<span class='pull-right text-muted'><span class="data-total-praises_<?php echo $spirituality_id; ?>" data-total-praises="<?php echo $count_praises; ?>" ><?php echo $count_praises; ?></span>个赞 - <span class="total_comments_<?php echo $spirituality_id; ?>" data-comments-total="<?php echo count($comments_and_replaies_result); ?>"><?php echo count($comments_and_replaies_result); ?></span>条评论</span>										
										<ul class="list-unstyled list-inline box-comments" style="color:red;">
											<li class="box-praise click_praised_<?php echo $spirituality_id; ?>" style="display:none;">我、</li>
										<?php foreach ($info_praises as $key => $value) {											
											$praiser_user_id = $value->praiser_user_id;
											$nick = $value->nick; ?>											
												<li class="box-praise click_praised_<?php echo $spirituality_id; ?>" ><?php if($praiser_user_id == $user_id) echo "我";else echo $nick; ?>、</li>						
										<?php } ?>
										<?php if(!empty($info_praises)){ ?>
											<li>...等赞了这条灵修！</li>
										<?php }else{ ?>
											<li class="box-praise click_praised_<?php echo $spirituality_id; ?>" style="display:none;">...等赞了这条灵修！</li>
										<?php } ?>
										</ul>
										
									</div><!-- /.box-body -->
									<div class='box-footer box-comments'>
										<?php if(!empty($comments_and_replaies_result)){
													foreach ($comments_and_replaies_result as $k => $v) {
															$comments_id = $v->comments_id;
															$contents = $v->contents;
															$commenter_id = $v->commenter_id;
															$commenter_nick = $v->commenter_nick;
															$commenter_userHead_src = $v->commenter_userHead_src;
															$comments_tran_created_at = $v->comments_tran_created_at;
															$replies_of_spirituality_result = $v->replies_of_spirituality_result;
										?>															
										<div class='box-comment del_comments_<?php echo $comments_id;?>'>
											<!-- User image -->
											<?php if (empty($commenter_userHead_src)) {
											?>
												<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle img-sm" alt="用户头像">
												<?php } else { ?>
												<img src="<?php echo base_url()."public/uploads/userHeadsrc/$commenter_userHead_src"; ?>" class="img-circle img-sm" alt="用户头像">
											<?php   } ?>
											<div class='comment-text'>
												<span class="username">
													<?php  
															if(!empty($commenter_nick)){																
																if($commenter_id == $user_id){																
																	 echo "我";
																}else 
																	echo $commenter_nick; 
															}else{
																echo "&nbsp;&nbsp;";
															}
													?>
													<span class='text-muted pull-right'><?php echo $comments_tran_created_at; ?></span>
												</span><!-- /.username -->
												<?php echo $contents; ?>
											 	    <?php  if (!empty($spirituality_user_id) && $spirituality_user_id == $user_id && empty($replies_of_spirituality_result)) { ?>																																																																																										
									 	    	      <div class="pull-right tool_replay_<?php echo $comments_id;?>">																	
									 	    	      	<ul class="list-unstyled list-inline">
									 	    		      	<li>
									 	    		      		<button class='btn btn-default btn-xs reply' data-comment-id="<?php echo $comments_id; ?>">
									 	    		      			<i class="fa fa-comments-o margin-r-5"></i> 回复
									 	    		      		</button>																		      			
									 	    	      		</li>
									 	    	      		<li>	
									 	    		      		<button class='btn btn-default btn-xs'>																				      																			      			
									 	    		      			 <span class="del_comment" data-spirituality-id="<?php echo $spirituality_id; ?>" data-del-comment-id="<?php echo $comments_id;?>"> <i class="fa  fa-trash-o margin-r-5"></i>删除</span>																		      			
									 	    	      			</button>
									 	    	      		</li>
									 	    	      	</ul>
									 	    	      </div>																		      	
											 	    <?php } ?>	

								 	    	 	    <div class="box-reply_<?php echo $comments_id; ?>" style="display:none;padding-top: 10px;">
								 	     	    		<form class="form-horizontal form_reply_<?php echo $comments_id; ?>">																												
								 	     	    			<div class='form-group margin-bottom-none'>
								 	     	    				<div class='col-sm-9'>
								 	     	    					<input class="form-control input-sm reply_content_<?php echo $comments_id; ?>" name="reply_content" placeholder="回复..." required="required">
								 	     	    					<input type="hidden" name="comments_id" value="<?php echo $comments_id; ?>">
								 	     	    					<input type="hidden" name="spirituality_user_id" value="<?php echo $spirituality_user_id; ?>">
								 	     	    				</div>     
								 	     	    				<div class='col-sm-3'>
								 	     	    					<button type="submint" class='btn btn-info pull-right btn-block btn-sm send_reply' data-id-comments="<?php echo $comments_id; ?>" >回复</button>
								 	     	    				</div>                          
								 	     	    			</div>                        
								 	     	    		</form>
								 	    	 	    </div>											 	    												 	  
											</div><!-- /.comment-text -->

											<!-- 评论回复 -->
											<ul class="list-unstyled reply_style relay_container_<?php echo $comments_id;?>" style="display:none">
												<li>
													<div class="comment-text">
														<span class="username">
															<span class='text-muted pull-right timeLabels timeLabels_<?php echo $comments_id;?>' >
																<time class="timeago timeago_<?php echo $comments_id;?>" datetime=""></time>													 	  					
															</span>
																我 回复 <?php echo $commenter_nick;?>													 	  					
															</span>
															<span class="relay_contents_<?php echo $comments_id;?>"></span>
														</span>
													</div>
												</li>
											</ul>

									 	  <?php if (!empty($replies_of_spirituality_result)){ ?>									 	  	
										 	  <ul class="list-unstyled reply_style">
										 	  <?php  foreach ($replies_of_spirituality_result as $k_r => $v_r) {
										 	  			$reply_id = $v_r->reply_id;
										 	  			$reply_nick = $v_r->reply_nick;
										 	  			$replier_id = $v_r->replier_id;																				
										 	  			$reply_comments_id = $v_r->reply_comments_id;
										 	  			$reply_contents = $v_r->reply_contents;
										 	  			$reply_created_at = $v_r->reply_created_at;  ?>
										 	  	<li>
										 	  		<div class="comment-text">
										 	  			<span class="username">
										 	  				<span class='text-muted pull-right'><?php echo $reply_created_at; ?></span>
										 	  				<?php if(!empty($replier_id) && $replier_id == $user_id) echo "我";else echo $reply_nick; ?> 回复 <?php  if($commenter_id == $user_id) echo "我";else  echo $commenter_nick;  ?>
										 	  			</span>
										 	  			<?php echo $reply_contents; ?>
										 	  		</div>
										 	  	</li>
										 	    <?php  } ?>
										 	  </ul>
									 	  <?php } ?>
										</div><!-- /.box-comment -->
										<?php	}
										} ?>										
									</div><!-- /.box-footer -->									
								</div><!-- /.box -->	    
						  </div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
			</div>

		</section><!-- /.content -->
		<?php } ?>
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	<script src="<?php echo base_url('public/plugins/js/timeago.js'); ?>"></script>
	<script src="<?php echo base_url('public/plugins/js/timeago.zh-cn.js'); ?>"></script>
	<script src="<?php echo base_url('public/js/spirituality_comment.js'); ?>"></script>			

</body>
</html>				
<?php 
		$group_userHead_src 						= isset($group_userHead_src->userHead_src) ? $group_userHead_src->userHead_src : "";
		$group_leader_id 							= isset($user_info->group_leader_id) ? $user_info->group_leader_id : ""; 
        $userHeadSrc_info                           = isset($userHeadSrc_info) ?  $userHeadSrc_info : "";
		$group_user_info 							= isset($group_user_info) ? $group_user_info : "";	
		$group_user_id                              = isset($group_user_info->user_id) ? $group_user_info->user_id : ""; 
		$group_user_nick                            = isset($group_user_info->nick) ? $group_user_info->nick: ""; 
 		$spirituality_results 						= isset($spirituality_results) ? $spirituality_results : "";
		$prayer_results 							= isset($prayer_results) ? $prayer_results : "";
		$page_array 							    = isset($page_array) ? $page_array : "";
		$spiri_total_count 							= isset($spiri_total_count) ? $spiri_total_count : "";	
		$spiri_week_count 							= isset($spiri_week_count) ? $spiri_week_count : "" ;
		$prayer_group_week_count 					= isset($prayer_group_week_count) ? $prayer_group_week_count : "";
		$urgent_group_week_count 					= isset($urgent_group_week_count) ? $urgent_group_week_count : "";
		$prayer_group_total_count 					= isset($prayer_group_total_count) ? $prayer_group_total_count : "";
		$urgent_group_total_count 					= isset($urgent_group_total_count) ? $urgent_group_total_count : "";
		$prayer_total                               = $urgent_group_total_count + $prayer_group_total_count; 
		$group_ranking_result 	    				= isset($group_ranking_result) ? $group_ranking_result : "";
		$tq_ranking_result 	        				= isset($tq_ranking_result) ? $tq_ranking_result : "";
		$spirituality_id_                           = !empty($this->input->get('spirituality_id_')) ? $this->input->get('spirituality_id_') : "";
		$content                                    = !empty($this->input->get('content')) ? $this->input->get('content') : "";
		
?>	
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>成员信息</title>
	<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				成员信息
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li>小组</li>
				<li class="active">成员信息</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
		    <div class="col-md-3">		      
		      <div class="box box-solid">
		        <div class="box-header with-border">
		          <h3 class="box-title">目录</h3>
		          <div class="box-tools">
		            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		          </div>
		        </div>
		        <div class="box-body no-padding">
		          <ul class="nav nav-pills nav-stacked">		          
		            <li class="<?php if(!empty($content) && $content=='coments') echo 'active';  ?>"><a href="<?php echo site_url('seeMember?user_id='.$group_user_id.'&content=coments'); ?>"><i class="fa fa-inbox"></i> 灵修 <span class="label label-primary pull-right"><?php if(!empty($spiri_total_count)) echo $spiri_total_count; else echo '0'; ?></span></a></li>
		            <li class="<?php if(!empty($content) && $content=='replies') echo 'active'; ?>"><a href="<?php echo site_url('seeMember?user_id='.$group_user_id.'&content=replies'); ?>" disabled＝"disabled"><i class="fa fa-envelope-o"></i> 祷告 <span class="label label-success pull-right"><?php echo $prayer_total; ?></span></a></li>
		          </ul>
		        </div><!-- /.box-body -->
		      </div><!-- /. box -->		      
		    </div><!-- /.col -->
		    <div class="col-md-9">
		      <?php if(!empty($content) && $content == 'coments' && !empty($spirituality_results)){ ?>
			      <div class="box box-primary">
			        <div class="box-header with-border">
			          <h3 class="box-title"><?php echo $group_user_nick; ?>的灵修</h3>
			          <div class="box-tools pull-right">
			            <div class="has-feedback">
			              <input type="button" value="返回上一步" onclick="window.history.back()">		              
			            </div>
			          </div><!-- /.box-tools -->
			        </div><!-- /.box-header -->
			        <div class="box-body no-padding">		          
			          <div class="table-responsive mailbox-messages">
			            <div class="col-md-12">		              	
			            	<div class="nav-tabs-custom">
			            	  <div class="tab-content">
			            	    <div class="active tab-pane" id="activity">
			            	    <?php if(!empty($spirituality_results)){ 
			            	    		foreach ($spirituality_results as $k => $v) {
			            	    			$spirituality_id = $v->spirituality_id;
			            	    			// var_dump($spirituality_id);exit;
			            	    			$spirituality_user_id = $v->spirituality_user_id;
			            	    			$book_id = $v->book_id;
			            	    			$directory = $v->directory;
			            	    			$chapter_id = $v->chapter_id;
			            	    			$gold_sentence = $v->gold_sentence;
			            	    			$heart_feeling = $v->heart_feeling;
			            	    			$response = $v->response;
			            	    			$created_at = $v->created_at;
			            	    			$count_praises = $v->count_praises;
			            	    			$is_praised = $v->is_praised;		            	    			
			            	    			$info_praises = $v->info_praises;
			            	    			$comments_of_spirituality_result = $v->comments_of_spirituality_result; ?>

				            	      <!-- Post -->
				            	      <div class="post spirit_container_<?php echo $spirituality_id;?>">
				            	        <div class="user-block">
				            	          <?php if (empty($group_userHead_src)) {
				            	          ?>
				            	          	<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle img-bordered-sm" alt="用户头像">
				            	          	<?php } else { ?>
				            	          	<img src="<?php echo base_url()."public/uploads/userHeadsrc/$group_userHead_src"; ?>" class="img-circle img-bordered-sm" alt="用户头像">
				            	          <?php   } ?>
				            	          <span class='username'>
				            	            <?php echo $group_user_nick; ?>			            	            
				            	          </span>
				            	          <span class='description'>灵修： <?php echo $directory; ?>--第<?php echo $chapter_id; ?>章<span class="pull-right"><?php echo $created_at; ?></span></span>
				            	        </div><!-- /.user-block -->
				            	        <p>
				            	          <p><?php echo $gold_sentence; ?></p>
				            	          <b>心得：</b><br>
				            	          <p><?php echo $heart_feeling; ?></p>
				            	          <b>回应：</b><br>
				            	          <p><?php echo $response; ?></p>
				            	        </p>
				            	        <ul class="list-inline tool_interaction_<?php echo $spirituality_id; ?>">			            	          
				            	          <li class="comments" data-spirituality-id="<?php echo $spirituality_id; ?>"><a class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> 评论 (<span class="total_comments_<?php echo $spirituality_id; ?>" data-comments-total="<?php echo count($comments_of_spirituality_result); ?>"><?php echo count($comments_of_spirituality_result); ?></span>)</a></li>
				            	          <?php if(!empty($is_praised) && $is_praised == 'Y'){ ?>
				            	          <li><a href="javascript:;" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> 已赞 (<?php echo $count_praises; ?>)</a></li>
				            	          <?php }else{ ?>
										  <li><a href="javascript:;" data-spirituality-id="<?php echo $spirituality_id; ?>"  class="btn link-black text-sm praise praise_style praise_content_<?php echo $spirituality_id; ?>"> <i class="fa fa-thumbs-o-up margin-r-5"></i> <span class="praised_<?php echo $spirituality_id; ?>">赞</span> (<span class="data-total-praises_<?php echo $spirituality_id; ?>" data-total-praises="<?php echo $count_praises; ?>"><?php echo $count_praises; ?></span>)</a></li>
				            	          <?php } ?>	
				            	          <?php if($spirituality_user_id == $user_id || $group_leader_id == $user_id){ ?>
				            	          <li class="pull-right"><a href="javascript:;" class="link-black text-sm del_spirit" data-spirituality-id="<?php echo $spirituality_id; ?>"> <span class="label label-danger pull-right"><i class="fa  fa-trash-o margin-r-5"></i> 删除</span>  </a></li>		            	          
				            	          <?php	} ?>
				            	        </ul>
										<input type="hidden" class="userHeadSrc_info" name="userHeadSrc_info" value="<?php echo $userHeadSrc_info; ?>">

										<!-- 赞 -->																							
										<ul class="list-unstyled list-inline box-comments box_praised_<?php echo $spirituality_id; ?>" style="color:red">
											<li class="box-praise click_praised_<?php echo $spirituality_id; ?>" style="color:red;display:none;">我、</li>
											<?php if(!empty($info_praises)){
												foreach ($info_praises as $k_p => $v_p) {
														$praiser_user_id = $v_p->praiser_user_id;
														$nick            = $v_p->nick; ?>
											<li class="box-praise"> 
												<?php echo  ($praiser_user_id == $user_id) ? '我' : $nick;	
												 ?>
											</li>
											<?php 	} 	
											} ?>
											<?php if(!empty($info_praises)){ ?>
											<li class="box-praise">觉得很赞!</li>
											<?php }else{ ?>
											<li class="box-praise click_praised_<?php echo $spirituality_id; ?>" style="display:none;">赞了这条灵修！</li>	
											<?php } ?>
										</ul>	
																															
										<!-- 评论 -->
										<?php if(!empty($comments_of_spirituality_result)){ ?>									
										<ul class=" list-unstyled box-comments_<?php echo $spirituality_id; ?> " style="display:none">
											<?php foreach ($comments_of_spirituality_result as $k_c => $v_c) {
													$comments_id = $v_c->comments_id;
													$contents = $v_c->contents;
													$commenter_id = $v_c->commenter_id;
													$commenter_nick = $v_c->commenter_nick;
													$commenter_userHead_src = $v_c->commenter_userHead_src;
													$comments_tran_created_at = $v_c->comments_tran_created_at;
													$replies_of_spirituality_result = $v_c->replies_of_spirituality_result; 												
											?>
										 	<li class="box-comments del_comments_<?php echo $comments_id;?>">
											 	<div class='box-comment'>
											 	  <!-- User image -->
											 	  <?php if (empty($commenter_userHead_src)) {
											 	  	?>
											 	  	<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle img-sm" alt="用户头像">
											 	  	<?php } else { ?>
											 	  	<img src="<?php echo base_url()."public/uploads/userHeadsrc/$commenter_userHead_src"; ?>" class="img-circle img-sm" alt="用户头像">
											 	  <?php   } ?>
											 	  <div class='comment-text '>
											 	    <span class="username">
											 	      <?php if($commenter_id == $user_id){ echo '我';}else{echo $commenter_nick;} ?>
											 	      <span class='text-muted pull-right'><?php echo $comments_tran_created_at; ?></span>
											 	    </span><!-- /.username -->
											 	    <?php echo $contents; ?>													 	    

											 	    <?php  if (!empty($spirituality_user_id) && $spirituality_user_id == $user_id && empty($replies_of_spirituality_result )) { ?>																																																																																										
									 	    	      <div class="pull-right tool_replay_<?php echo $comments_id;?>">																	
									 	    	      	<ul class="list-unstyled list-inline">
									 	    		      	<li>
									 	    		      		<button class='btn btn-default btn-xs reply' data-comment-id="<?php echo $comments_id; ?>">
									 	    		      			<i class="fa fa-comments-o margin-r-5"></i> 回复
									 	    		      		</button>																		      			
									 	    	      		</li>
									 	    	      		<li>	
									 	    		      		<button class='btn btn-default btn-xs'>																				      																			      			
									 	    		      			<span class="del_comment" data-spirituality-id="<?php echo $spirituality_id; ?>" data-del-comment-id="<?php echo $comments_id;?>"><i class="fa  fa-trash-o margin-r-5"></i>删除</span>																		      			
									 	    	      			</button>
									 	    	      		</li>
									 	    	      	</ul>
									 	    	      </div>																		      	
											 	    <?php } else if( $group_leader_id == $user_id){ ?>
												      <div class="pull-right tool_replay_<?php echo $comments_id;?>">																	
												      	<ul class="list-unstyled list-inline">													      	
												      		<li>	
													      		<button class='btn btn-default btn-xs'>																				      																			      			
													      			<span class="del_comment" data-spirituality-id="<?php echo $spirituality_id; ?>" data-del-comment-id="<?php echo $comments_id;?>"><i class="fa  fa-trash-o margin-r-5"></i>删除</span>																		      			
												      			</button>
												      		</li>
												      	</ul>
												      </div>
											 	    <?php 	}?>	

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
												 	  				<?php if(!empty($replier_id) && ($replier_id == $user_id)) {
												 	  					echo '我';	
												 	  				}else{
												 	  					echo $reply_nick;	
												 	  				}  
												 	  				?>
												 	  				 回复 
												 	  				<?php 
												 	  					 if($commenter_id == $user_id) {
												 	  					 	echo '我';
												 	  					 }else {
												 	  					 	 echo $commenter_nick;
												 	  					} 
												 	  				 ?>
												 	  			</span>
												 	  			<?php echo $reply_contents; ?>
												 	  		</div>
												 	  	</li>
												 	    <?php  } ?>
												 	  </ul>
											 	  <?php } ?>
											 	</div><!-- /.box-comment -->										 	
										 	</li>
											<?php } ?>
										</ul>	
										<?php } ?>
										<br>

										<!-- 评论 -->
										<?php if(!empty($spirituality_user_id) && $spirituality_user_id != $user_id){ ?>
					            	        <form class='form-horizontal form_comment_<?php echo $spirituality_id; ?>'>
					            	          <div class='form-group margin-bottom-none'>
					            	            <div class='col-sm-9'>
					            	              <input class="form-control input-sm coments_innput_<?php echo $spirituality_id; ?>" name="comments_contents" placeholder="评论..." required="required">
					            	              <input type="hidden" name="spirituality_id" value="<?php echo $spirituality_id; ?>">
												  <input type="hidden" name="spirituality_user_id" value="<?php echo $spirituality_user_id; ?>">
					            	            </div>                          
					            	            <div class='col-sm-3'>
					            	              <button class='btn btn-primary pull-right btn-block btn-sm send_comments' data-spirituality-id = "<?php echo $spirituality_id; ?>">发表</button>
					            	            </div>                          
					            	          </div>                        
					            	        </form>
										<?php } ?>	
				            	      </div><!-- /.post -->		            	    			
			            	    <?php }
			            	    ?>
			            	    <?php } ?>		            	     
			            	      
			            	    </div><!-- /.tab-pane -->		                                    
			            	  </div><!-- /.tab-content -->
			            	</div><!-- /.nav-tabs-custom -->
			            </div><!-- /.col -->		            
			          </div><!-- /.mail-box-messages -->
			        </div><!-- /.box-body -->
			          <div class="box-footer no-padding">
			            <div class="mailbox-controls">
			              <!-- Check all button -->
			              <div class="pull-right">
			                <div class="box-tools">
			                  <div class="span8 columns" style="float:left">
	        					  <?php if (isset($pagination)) echo $pagination['html']; ?>
	        				  </div>
			                </div>
			              </div><!-- /.pull-right -->
			            </div>
			          </div>
			      </div><!-- /. box -->
		      <?php }else if(!empty($content) && $content== 'replies' && !empty($prayer_total)) { ?>
					<div class="box box-success">
					  <div class="box-header with-border">
					    <h3 class="box-title"><?php echo $group_user_nick; ?>的祷告</h3>
					    <div class="box-tools pull-right">
					      <div class="has-feedback">
					       <input type="button" value="返回上一步" onclick="window.history.back()">
					      </div>
					    </div><!-- /.box-tools -->
					  </div><!-- /.box-header -->
					  <div class="box-body no-padding">					    
					    <div class=" mailbox-messages">
				          <div class="col-md-12">
		          	          <?php if (!empty($prayer_results)) { ?>					          	
		          		      <div class="tab-pane" id="timeline">
		          		        <!-- The timeline -->
		          		        <ul class="timeline timeline-inverse">
		          		        	<?php foreach ($prayer_results as $k => $v){
		          		        		// var_dump($prayer_results);exit;
		          		        		$group_prayer_id = isset($v->group_prayer_id) ? $v->group_prayer_id : '';
		          		        		$group_prayer_contents = isset($v->group_prayer_contents) ? $v->group_prayer_contents : '';
		          		        		$user_id = isset($v->user_id) ? $v->user_id : '';
		          		        		$userHeadSrc = isset($v->userHeadSrc) ? $v->userHeadSrc : '';
		          		        		$conversion_time = isset($v->conversion_time) ? $v->conversion_time : '';
		          		        		$urgent_id = isset($v->urgent_id) ? $v->urgent_id : '';
		          		        		$content_prayer = isset($v->content_prayer) ? $v->content_prayer : ''; 
		          		        		?>
		          		        		<?php  if (!empty($group_prayer_id)) { ?>
		          		        		<li class="time-label">
		          		        			<span class="ion-android-people bg-green">
		          		        				：<?php echo $group_user_nick; ?>
		          		        			</span>
		          		        		</li>	
		          		        		<li>									
		          	        			<?php if (empty($group_userHead_src)) {?>
		          	        			<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="fa direct-chat-img" alt="用户头像">
		          	        			<?php } else { ?>
		          	        			<img src="<?php echo base_url()."public/uploads/userHeadsrc/$group_userHead_src"; ?>" class="fa direct-chat-img" alt="用户头像">
		          	        			<?php   } ?>
		          	        			<div class="row">
		          	        				<div class="box-body prayer_container">
		          	        					<div class="col-md-12">
		          	        						<!-- Message to the right -->
		          	        						<div class="direct-chat-msg ">
		          	        							<div class="direct-chat-info clearfix">
		          	        								<span class="direct-chat-timestamp pull-right"><?php echo $conversion_time; ?></span>
			          	        							<!-- <span class="time "><i class="fa fa-clock-o"></i> 27 mins ago</span> -->
		          	        							</div><!-- /.direct-chat-info -->														
		          	        							<div class="direct-chat-text">
		          	        								<?php echo $group_prayer_contents; ?>
		          	        							</div><!-- /.direct-chat-text -->
		          	        						</div>
		          	        					</div>
		          	        				</div><!-- /.direct-chat-msg -->
		          	        			</div>
		          		        		</li>
		          		        		<?php }else { ?>
		          		        		<li class="time-label">
		          		        			<span class="ion-ios-people bg-red">
		          		        				：<?php echo $group_user_nick; ?>										
		          		        			</span>
		          		        		</li>	
		          		        		<li>									
		          	        			<?php if (empty($group_userHead_src)) {?>
		          	        			<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="fa direct-chat-img" alt="用户头像">
		          	        			<?php } else { ?>
		          	        			<img src="<?php echo base_url()."public/uploads/userHeadsrc/$group_userHead_src"; ?>" class="fa direct-chat-img" alt="用户头像">
		          	        			<?php   } ?>
		          	        			<div class="row">
		          	        				<div class="box-body prayer_container">
		          	        					<div class="col-md-12">
		          	        						<!-- Message to the right -->
		          	        						<div class="direct-chat-msg ">
		          	        							<div class="direct-chat-info clearfix">
		          	        								<span class="direct-chat-timestamp pull-right"><?php echo $conversion_time; ?></span>
		          	        							</div><!-- /.direct-chat-info -->														
		          	        							<div class="direct-chat-text">
		          	        								<?php echo $content_prayer; ?>
		          	        							</div><!-- /.direct-chat-text -->
		          	        						</div>
		          	        					</div>
		          	        				</div><!-- /.direct-chat-msg -->
		          	        			</div>
		          	        		</li>									
		          	        		<?php } ?>	

		          	        		<?php } ?>
		          	        		<li>
		          	        			<i class="fa ion-android-arrow-down fa-3x"></i>
		          	        		</li>
		          		        </ul>
		          		      </div><!-- /.tab-pane -->
		          	          <?php } ?>
				          </div> <!-- col -->
					    </div><!-- /.mail-box-messages -->
					  </div><!-- /.box-body -->
					  
					  <?php if(!empty($page_array)){
					  	$countpage = $page_array->countpage;
					  	$uppage    = $page_array->uppage;
					  	$nextpage  = $page_array->nextpage;					   
					  ?>
						  <div class="box-footer no-padding">
						    <div class="mailbox-controls">					      
						      <div class="text-center">					        
						      	<?php if(!empty($countpage) && $countpage >1) { ?>
						        <div class="btn-group">									
						          <a href="<?php echo site_url('seeMember?user_id='.$group_user_id.'&content=replies'.'&page='.$uppage); ?>" title="上一页"><button class="btn btn-default btn-sm" ><i class="fa fa-chevron-left"></i></button></a>
						          <?php if($nextpage <= $countpage) {?>
						          <a href="<?php echo site_url('seeMember?user_id='.$group_user_id.'&content=replies'.'&page='.$nextpage); ?>" title="下一页"><button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button></a>
						          <?php }?>
						        </div><!-- /.btn-group -->
						      	<?php 	}?>
						      </div><!-- /.pull-right -->
						    </div>
						  </div>
					  <?php	} ?>
					</div><!-- /. box -->
		      <?php } ?>
		    </div><!-- /.col -->
		  </div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->	
	<?php  $this->load->view('tq_footer'); ?>	
	<script src="<?php echo base_url('public/plugins/js/timeago.js'); ?>"></script>
	<script src="<?php echo base_url('public/plugins/js/timeago.zh-cn.js'); ?>"></script>
	<script src="<?php echo base_url('public/js/spirituality_comment.js'); ?>"></script>

	<style type="text/css">
		.praise_style{
			color: red;
		}
		.reply_style{
			padding-left: 20px;
		}
		.direct-chat-msg {
			margin:-25px 0 0 0px;
		}		

	</style>
</body>
</html>
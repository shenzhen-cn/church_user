<?php 
	$group_id                = 		isset($user_info->group_id) ? $user_info->group_id : "";	
	$nick                    =      isset($user_info->nick) ? $user_info->nick : "" ;	
	$sex                     =      isset($user_info->sex) ? $user_info->sex : "" ;	
	$home_inform             = 		isset($home_inform) ? $home_inform : "";
	$urgent_prayer           = 		isset($urgent_prayer) ? $urgent_prayer : "";
	$bible_section           = 		isset($bible_section) ? $bible_section : "" ; 
	$bible_note              = 		isset($bible_note) ? $bible_note : "" ; 
	$volume_name             = 		isset($volume_name) ? $volume_name : "" ; 
	$current_chapter_id      = 		isset($current_chapter_id) ? $current_chapter_id : "" ; 
	$current_book_id         = 		isset($current_book_id) ? $current_book_id : "" ; 
	$is_send                 = 		isset($is_send) ? $is_send : "" ; 
	$user_spirituality       = 		isset($user_spirituality) ? $user_spirituality : "" ; 
	$status_spirituality     =      isset($status_spirituality)?$status_spirituality:"";
	$online_read             = 		isset($online_read) ? $online_read : "" ; 
	$group_leader_id         =      isset($user_info->group_leader_id) ? $user_info->group_leader_id : "" ;
	$reminder_days           =      isset($reminder_days) ? $reminder_days : "" ; 
	$recently_photos         =      isset($recently_photos) ? $recently_photos : "" ; 
	$today_group_prayer      =      isset($today_group_prayer) ? $today_group_prayer : "" ;
	$todayScriptures         =      isset($todayScriptures) ? $todayScriptures : "" ;
	$count_users_group       =      isset($count_users_group) ? $count_users_group : "" ;

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>首页-使命青年团契</title>
	<?php $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini ">
	<?php $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				首页
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="javascript:;"><i class="fa fa-dashboard"></i> 首页</a></li>
				
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Info boxes -->
			<?php if (!empty($reminder_days)&& $reminder_days > 1) { ?>				
				<div class="row">
					<div class="col-md-12">
						<div class="box box-default">
							<div class="box-header with-border">
								<i class="fa fa-bullhorn"></i>
								<h3 class="box-title">灵修系统提示</h3>
								<button class="btn btn-box-tool pull-right" data-widget="remove"><i class="fa fa-times"></i></button>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="callout callout-warning">									
									<h4><?php echo $nick; ?>
									<?php $is_bother=null;
									    if (! empty($sex)) {
										switch ($sex) {
											case $sex== '男':
												  $is_bother='弟兄';
												break;
											case $sex== '女':
												  $is_bother='姊妹';
												break;
											
											default:
												$is_bother= '';
												break;
										}
									 ?>										
									<?php } echo $is_bother; ?>
									：</h4>
									<p>您好！ 你已经连续<span style="font-size: 20px;color: Blue"><?php echo $reminder_days-1; ?>天</span>没有灵修了，今天开始灵修吧！&nbsp; &nbsp; <i class="fa fa-smile-o  fa-2x"></i> </p>
								</div>								
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!-- /.col -->
				</div>
			<?php } ?>

			<!-- Urgent prayer -->
			<div class="row">
				<?php 	if (! empty($home_inform)) { ?>
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title" id="urgent-prayer">团契公告</h3>&nbsp;
							<i style="font-size: 8px"><?php  echo date("Y年m月d日",strtotime( $home_inform->create_at));?></i>
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body">								
							<span class="info-box-icon bg-blue"><i class="fa fa-bell"></i></span>
							<div class="info-box-content">
								<span class="chart"><?php echo $home_inform->home_inform_content; ?></span>
							</div><!-- /.info-box-content -->
						</div><!-- ./box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
				<?php } ?>
				<?php if (! empty($urgent_prayer)){ 
						$tq_prayer_id = $urgent_prayer->id;	
					?>				
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title" id="urgent-prayer">紧急代祷 </h3>&nbsp;
							<i style="font-size: 8px"><?php  echo date("Y年m月d日",strtotime( $urgent_prayer->create_at));?></i>
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body">
							<span class="info-box-icon bg-red"><i class="ion ion-ios-people"></i></span>
							<div class="info-box-content">
								<span class="chart"><?php echo $urgent_prayer->urgent_prayer_content; ?></span>
							</div><!-- /.info-box-content -->
							<a href="<?php echo base_url('wallofprayer/prayer#urgent_prayer'); ?>" class="btn btn-sm btn-info btn-flat pull-right">代祷</a>													
						</div><!-- ./box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
				<?php } ?>

				<?php if (! empty($today_group_prayer)){ 
						$group_prayer_id = $today_group_prayer->id;	
					// var_dump($urgent_prayer);exit;
					?>				
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">小组代祷 </h3>&nbsp;
							<i style="font-size: 8px"><?php  echo date("Y年m月d日",strtotime( $today_group_prayer->created_at));?></i>
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body">
							<span class="info-box-icon bg-green"><i class="ion ion-android-people"></i></span>
							<div class="info-box-content">
								<span class="chart"><?php echo $today_group_prayer->group_prayer_content; ?></span>
							</div><!-- /.info-box-content -->
							<a href="<?php echo base_url('wallofprayer/prayer#group_prayer'); ?>" class="btn btn-sm btn-info btn-flat pull-right">代祷</a>													
						</div><!-- ./box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
				<?php } ?>


			</div><!-- /.row -->


			<?php if (!empty($todayScriptures)) {
				$directory = $todayScriptures->directory; 
				$chapter_id = $todayScriptures->chapter_id; 
				$section_id = $todayScriptures->section_id; 
				$content = $todayScriptures->content; 
				$created_at = date("Y年m月d日",strtotime($todayScriptures->created_at));

			 ?>
				
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title" id="today-scripture">当日经文</h3>
							<i style="font-size: 8px"><?php  echo $created_at;?></i>							
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<!--today scripture-->
									<p style="font-size: 20px;" class="text-center"><?php echo $content; ?>【<?php echo $directory;?> <?php echo $chapter_id;?> : <?php echo $section_id;?>】</p> 
									<!-- /.today scripture -->
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- ./box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			<?php } ?>
			
			<!-- Group Spiritual Learning -->
			<?php 	if (!empty($bible_section)) { ?>
			<div class="row" id="spiritual_learning">
				<div class="col-md-12">
					<?php $this->load->view('tq_alerts'); ?>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title" id="group-spiritual-learning">今日小组灵修</h3>

							<div class="box-tools pull-right">
								<span class="label label-danger" >灵修人数：<?php if(empty($user_spirituality)) echo '0'; else  echo count($user_spirituality);?>/<?php echo $count_users_group;	 ?></span>
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
								<?php if(!empty($status_spirituality)){ ?>
									<a type='button' href='javascript:;' class="pull-left btn  btn-success"><i class="fa fa-smile-o"></i> 今天已灵修</a><br>
								<?php }else{ ?>
									<a type='button' href='javascript:;' class="pull-left btn  btn-info"><i class="fa  fa-frown-o"></i>  今天未灵修</a><br>
								<?php } ?>
									<h3 class="text-center"><b><?php echo $volume_name;?><i class="small"> (第<?php echo $current_chapter_id; ?> 章)</i> </b> </h3>
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tab_1" data-toggle="tab">经文</a></li>
											<li><a href="#tab_2" data-toggle="tab">解经</a></li>
											<li><a href="#tab_3" data-toggle="tab">已灵修</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="tab_1">
													<table class="table table-striped table-hover">
													<?php 	foreach ($bible_section as $k => $v) { 
														$content = $v->content;
														$chapter_id = $v->chapter_id;
														$section = $v->section;
													?>																
														  <tr class="insert_gold_sentence" data-section-id="<?php echo $section; ?>" data-chapter-section-id="<?php echo $chapter_id.":".$section; ?>">
														    <th><p><?php echo $chapter_id; ?>:<?php echo $section; ?></p></th>
														    <th><p class="content_<?php echo $section; ?>"><?php echo $content; ?></p></th>
														  </tr>
														<?php } ?>
													</table>	
																								
												</div><!-- /.tab-pane -->
												<div class="tab-pane" id="tab_2">
													<div class="">
														<?php 	foreach ($bible_note as $k => $v) {
															$note_title = $v->note_title;
															$chapter_id = $v->chapter_id;
															$section = $v->section;
															$content = $v->content;
															?>
															<?php if ($section == '0'){ ?>
															<p><?php echo $note_title;?><br><br><?php echo $content;?></p> 
															<?php } else {?>
															<p>【<?php echo $chapter_id ;?>:<?php echo $section; ?>】<b><?php echo $note_title;?></b><br><br><?php echo $content;?></p> 
															<?php 	} ?>
															<?php } ?>
														</div>    
													</div><!-- /.tab-pane -->
													<div class="tab-pane" id="tab_3">
														<?php if (	!empty($user_spirituality)) { ?>
														<div class="">
															<?php 	foreach ($user_spirituality as $k => $v) {
																$nick = isset($v->nick) ? $v->nick : "";
																$s_user_id = isset($v->user_id) ? $v->user_id : "";
																$userHead_src = isset($v->userHead_src) ? $v->userHead_src : "";
																$spirituality_id = isset($v->spirituality_id) ? $v->spirituality_id : "";
																$gold_sentence = isset($v->gold_sentence) ? $v->gold_sentence : "";
																$heart_feeling = isset($v->heart_feeling) ? $v->heart_feeling : "" ;
																$response = isset($v->response) ? $v->response : "";
																$created_at = isset($v->created_at) ? $v->created_at : "";
																$praise_count = isset($v->praise_count) ? $v->praise_count : "";
																$is_praised = isset($v->is_praised) ? $v->is_praised : "";


																
																if (!empty($spirituality_id)) { ?>
																
																<div class="direct-chat-msg">
																	<div class="direct-chat-info clearfix">
																		<span class="direct-chat-name pull-left"><?php if($s_user_id == $user_id) echo "&nbsp;&nbsp;&nbsp;我";else echo $nick; ?></span>
																		<span class="direct-chat-timestamp pull-right"><?php echo $created_at; ?></span>
																	</div><!-- /.direct-chat-info -->
																	<?php if (empty($userHead_src)) {?>
																	<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="direct-chat-img" alt="User Image">
																	<?php } else { ?>
																	<img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHead_src"; ?>" class="direct-chat-img" alt="User Image">
																	<?php   } ?>
																	<div class="direct-chat-text">
																		<b>金句：</b><br>
																		<p>&nbsp;<?php echo $gold_sentence; ?></p>
																		<b>心得：</b><br>
																		<p><?php echo $heart_feeling;	 ?></p>
																		<b>回应：</b><br>
																		<p><?php echo $response; ?></p>
																		<?php if ($user_id == $group_leader_id ) { 
																			?>																			
																 	        <div class="timeline-footer pull-right">										 	         
									      								        <a href="<?php echo base_url('delete_spirituality?s_id='."$spirituality_id"); ?>" class="btn btn-danger btn-xs">删除</a>
																 	        </div>
																		<?php } ?>
																			<?php if (!empty($is_praised) && $is_praised == 'Y'  ) { ?>																																						
																					<i class="fa fa-thumbs-o-up margin-r-5 "></i>
																						<span class="praise_content">已赞</span>
																			<?php } else{ ?>					
																			<span class="margin-r-5 praise" data-spirituality-id="<?php echo $spirituality_id; ?>">																		
																				<span class="badge bg-red praise_content_<?php echo $spirituality_id;?>">																				
																					<i class="fa fa-thumbs-o-up"></i>
																					<span>赞</span>
																				</span>
																			</span>
																			<?php }?>
														                <div class="data-total-praises_<?php echo $spirituality_id;?>" data-total-praises="<?php echo $praise_count; ?>" style="display: block;">
														                <?php echo $praise_count; ?>个人觉得很赞
														                </div>																		
																	</div><!-- /.direct-chat-text -->
																</div><!-- /.direct-chat-msg -->
																
																<?php }?>
																<?php } ?>	
															</div>    
															<?php } ?>	
														</div><!-- /.tab-pane -->
													</div><!-- /.tab-content -->
												</div><!-- nav-tabs-custom -->
											</div><!-- /.col -->
										</div><!-- /.row -->
									</div><!-- ./box-body -->
									<div class="box-footer clearfix">
										<div class="row">
											<div class="col-sm-12">																								
												<?php if(empty($status_spirituality)){ ?>
												<form action="<?php echo base_url('home/send_spirituality'); ?>" method="post">
													<div class="form-group">
														<label for="gold_sentence">选择金句：</label>
														<textarea type="textarea" class="form-control" name="gold_sentence" value="121212112"  id="gold_sentence" length="400" placeholder="请点击选择上面的经文:" style="width: 100%; height: 70px; font-size: 14px; line-height: 20px;  solid #dddddd; padding: 10px;"></textarea>
													</div>
													<div class="form-group">
														<label for="heart_feeling">心得：</label>
														<textarea onpropertychange="if(value.length>400) value=value.substr(0,400)"  maxlength="400"  onKeyDown="LimitTextArea(this)" onKeyUp="LimitTextArea(this)" onkeypress="LimitTextArea(this)" class="form-control" name="heart_feeling" placeholder="心得..." required="required" style="width: 100%; height: 70px; font-size: 14px; line-height: 20px;  solid #dddddd; padding: 10px;"></textarea>
													</div>
													<div class="form-group">
														<label for="response">回应：</label>
														<textarea onpropertychange="if(value.length>400) value=value.substr(0,400)"  maxlength="400"  onKeyDown="LimitTextArea(this)" onKeyUp="LimitTextArea(this)" onkeypress="LimitTextArea(this)"  class="form-control" name="response" placeholder="回应..." required="required" style="width: 100%; height: 125px; font-size: 14px; line-height: 20px; solid #dddddd; padding: 10px;"></textarea>
													</div>										 	        
													<input  type="hidden" name="current_chapter_id" value="<?php echo $current_chapter_id; ?>">
													<input  type="hidden" name="current_book_id" value="<?php echo $current_book_id; ?>">
													<button type='submint' class="pull-right btn btn-info">提交</button>
												</form>
												<?php	} ?>
												
											</div><!-- /.col -->

										</div><!-- /.row -->
									</div><!-- /.box-footer -->
								</div><!-- /.box -->
							</div><!-- /.col -->
						</div><!-- /.row -->
						<?php } ?>
						<?php if (!empty($online_read)) { 
								$document_id  = 	$online_read->id;
								$edit_content = 	$online_read->edit_content;
								$created_at   = 	$online_read->created_at;
								$updated_at   = 	$online_read->updated_at;
								// var_dump($online_read);exit;
							?> 													
							<!-- pastor preach -->
							<div class="row">
								<div class="col-md-12">
									<div class="box box-primary">
										<div class="box-header with-border">
											<h3 class="box-title" id="pastor-preach">分享文章</h3>
											<div class="box-tools pull-right">											
												<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											</div>
										</div><!-- /.box-header -->
										<div class="box-body no-padding">											
											<small class='pull-right'><i>更新时间：<?php if (! empty($updated_at)) echo date("Y/m/d",strtotime($updated_at)); else echo date("Y/m/d",strtotime($created_at));?></i>&nbsp;&nbsp;</small>											
											<div class="mailbox-read-message">
												<div class="col-md-12">
													<div class="col-md-12" >																										
														<div class="online_text" id="online_text">																
															<p><?php echo $edit_content; ?></p>
														</div>															
													</div>												
												</div>												
											</div><!-- /.mailbox-read-message -->
										</div><!-- /.box-body -->
										<div class="box-footer text-left">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href="<?php echo base_url('read_myEdit'); ?>" class="uppercase label-info">阅读更多<i class="fa  fa-angle-double-right"></i></a></strong>												
										</div><!-- /.box-footer -->
									</div><!-- /. box -->
								</div><!-- /.col -->
							</div>
						<?php } ?>						
					</section><!-- /.content -->
				</div><!-- /.content-wrapper -->

	<?php $this->load->view('tq_footer'); ?>
	<script>
		$(document).ready(function(){
		    $(".praise").click(function(){
		      var spirituality_id = $(this).attr('data-spirituality-id');
		      // alert(spirituality_id);
		      var total_praises = $('.data-total-praises_'+spirituality_id).attr('data-total-praises');

		     $.post("<?php echo base_url('add_praise') ?>",               
		        {
		          spirituality_id:spirituality_id,
		        },
		       function(data,status){               
		        if (data !== 'N') {
		        	$(".praise_content_"+spirituality_id).empty();	
		        	$(".praise_content_"+spirituality_id).removeClass("badge bg-red");
		        	$('.praise_content_'+spirituality_id).html('<i class="fa fa-thumbs-o-up margin-r-5 "></i><span class="praise_content">已赞</span>');;	
		           $(".data-total-praises_"+spirituality_id).html(++total_praises+'个人觉得很赞');		            

		        }
		       });
		    });
		    <?php if(empty($status_spirituality)){ ?>
			    //插入经文
			    $(".insert_gold_sentence").click(function() {
		    		var chapterSectionId = $(this).attr("data-chapter-section-id");
		    		var sectionId = $(this).attr("data-section-id");
			    	var str = $(".content_"+sectionId).html();

			    	var inserted   = $(this).hasClass("danger");


			    
			    	if(inserted == false){
			    		// console.log('inserted=false' + chapterSectionId + str);
				    	var t = confirm("你确定要经此经文"+chapterSectionId+"添加到金句中么？");
				    	if(t == true){
				     		$("#gold_sentence").append(chapterSectionId+str);
				     		// $(this).addClass("inserted");
				     		$(this).addClass("danger");

				    	}

			    	}else{
				    	var t = confirm("你确定要清除金句中"+chapterSectionId+"节经文么？");
				    	if(t == true){
				    		var str_g_s = $("#gold_sentence").val();
					    	var r_str_g_s = str_g_s.replace(chapterSectionId + str," ");
				    		$("#gold_sentence").empty();
				    		$("#gold_sentence").append(r_str_g_s);			    		
				     		$(this).removeClass("danger");		    		
				    	}
			    	}
			    });
		    <?php } ?>
		}); 

		function LimitTextArea(field){ 
		    maxlimit=400; 
		    if (field.value.length > maxlimit){
		        field.value = field.value.substring(0, maxlimit); 
		        alert('系统提示，只可以输入400字！');
		    } 
		}

		var tBox=document.getElementById('online_text');
		var online_textHtml = tBox.innerHTML.slice(0,4000)+'<br><br><p class="bg-success"><i class="fa fa-hand-o-down "></i>&nbsp; (只显示部分，看完整内容，请点击)</p>';
		tBox.innerHTML = online_textHtml;


	</script>
</body>
</html>
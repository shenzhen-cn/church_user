<?php  
	$s_user_id       = isset($s_user_id) ? $s_user_id : "";
	$created_at      = isset($created_at) ? $created_at : "" ;
	$userHead_src    =  isset($userHeadSrc_info) ? $userHeadSrc_info  : "";
	$gold_sentence   =  isset($gold_sentence) ? $gold_sentence : "";
	$heart_feeling   = isset($heart_feeling) ? $heart_feeling   : ""; 
	$response        = isset($response) ? $response   : ""; 
    $spirituality_id = isset($spirituality_id) ? $spirituality_id  : "";
	$group_leader_id =    isset($user_info->group_leader_id) ? $user_info->group_leader_id : "" ;
	$user_id   		 = isset($user_id) ? $user_id   : ""; 
	$s_user_id       = $user_id;


?>

<div class="direct-chat-msg">
	<div class="direct-chat-info clearfix">
		<span class="direct-chat-name pull-left"><?php echo "&nbsp;&nbsp;&nbsp;我"; ?></span>
		<span class="direct-chat-timestamp pull-right">刚刚</span>
	</div><!-- /.direct-chat-info -->
	<a href="<?php echo site_url("seeMember?user_id=".$s_user_id."&content=coments"); ?>" >																	
		<?php if (empty($userHead_src)) {?>
		<img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="direct-chat-img" alt="User Image">
		<?php } else { ?>
		<img src="<?php echo base_url()."public/uploads/userHeadsrc/$userHead_src"; ?>" class="direct-chat-img" alt="User Image">
		<?php   } ?>
	</a>
	<div class="direct-chat-text">
		<b>金句：</b><br>
		<p>&nbsp;<?php echo $gold_sentence; ?></p>
		<b>心得：</b><br>
		<p><?php echo $heart_feeling;	 ?></p>
		<b>回应：</b><br>
		<p><?php echo $response; ?></p>
		<?php if ($user_id == $group_leader_id ) { ?>																			

 	        <div class="timeline-footer pull-right">										 	         
					<a href="<?php echo site_url('delete_spirituality?s_id='."$spirituality_id"); ?>" class="btn btn-danger btn-xs" onclick="return is_del()">删除</a>
 	        </div>

		<?php } ?>

			<span class="margin-r-5 praise" data-spirituality-id="<?php echo $spirituality_id; ?>">																		
				<span class="badge bg-red praise_content_<?php echo $spirituality_id;?>">																				
					<i class="fa fa-thumbs-o-up"></i>
					<span>赞</span>
				</span>
			</span>

        <div class="data-total-praises_<?php echo $spirituality_id;?>" data-total-praises="0" style="display: block;">
        	0个人觉得很赞
        </div>																		
	</div><!-- /.direct-chat-text -->
</div><!-- /.direct-chat-msg -->

<script type="text/javascript">
	$(".praise").click(function(){
	  var spirituality_id = $(this).attr('data-spirituality-id');
	  var total_praises = $('.data-total-praises_'+spirituality_id).attr('data-total-praises');

	 $.post("add_praise",
	    {
	      spirituality_id:spirituality_id,
	    },

	   function(data,status){               
	    if (data !== 'N') {
	    	$(".praise_content_"+spirituality_id).empty();	
	    	$(".praise_content_"+spirituality_id).removeClass("badge bg-red");
	    	$('.praise_content_'+spirituality_id).html('<i class="fa fa-thumbs-o-up margin-r-5 "></i><span class="praise_content">已赞</span>');;	
	        $(".data-total-praises_"+spirituality_id).html(++total_praises+'个人觉得很赞');		        
			$('.praise_content_'+spirituality_id).unbind( "click" );
	    }
	   });
	});

	function is_del () {
		var delCon = confirm('确定要删除这条灵修么？');
		if(!delCon){
			return false;	
		}
	}	
</script>

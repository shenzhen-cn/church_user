function  getDateDiff() {
	var date = new Date();
 	var time = date;

 	var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + '-' + month + '-' + strDate
            + " " + date.getHours() + ':' + date.getMinutes()
            + ':' + date.getSeconds();
	return currentdate;
}

$(document).ready(function(){

	$(".comments").click(function(){
		var spirituality_id = $(this).attr('data-spirituality-id');
		var ajaxUrl ='alert_messages/del_alert_comments_by_spirituality_id?spirituality_id='+spirituality_id;	
		$.ajax({
			url: ajaxUrl,
			type: 'GET',
			dataType: 'json',
			data: {param1: 'value1'},
		})
		.done(function(data) {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
			alert('未知错误！');return false;
		})
		.always(function() {
		});
		
		$(".box-comments_"+spirituality_id).toggle();
	});

	// 点赞：	
	$(".praise").one("click",function(){		
      var spirituality_id = $(this).attr('data-spirituality-id');
	  var total_praises   = $('.data-total-praises_'+spirituality_id).attr('data-total-praises');
	  $.post("add_praise",               
	  {
	  	spirituality_id:spirituality_id,
	  },
	  function(data){  
	  	console.log(data);             
	  	console.log(total_praises);
	  	if (data !== 'N') {
	  		$('.click_praised_'+spirituality_id).show();
	  		$(".praise_content_"+spirituality_id).attr("disabled","disabled");			    
	  		$(".praise_content_"+spirituality_id).removeClass("praise_style");
	  		$(".praise_content_"+spirituality_id).removeClass("btn-danger");	  		
	  		$('.praised_'+spirituality_id).html('已赞');	
	  		$(".data-total-praises_"+spirituality_id).html(++total_praises);		            
	  	}
	  });
	
	});	

	$(".reply").click(function() {
		var comment_id = $(this).attr('data-comment-id');
		$(".box-reply_"+comment_id).toggle();
	});	

	//回复
	$(".send_reply").click(function() {
		var comment_id_ = $(this).attr('data-id-comments');									
		var reply_content = $(".reply_content_"+comment_id_).val();		
		var AjaxURL = "group/send_reply";
		$.ajax({
			type:"POST",
			 dataType: "JSON",
			 url:AjaxURL, 
			 async:false,
			 data: {reply_content:reply_content,comments_id:comment_id_},
			 success:function (data) {			 	
			 	var  currentdate = getDateDiff();
			 	$(".timeago_"+comment_id_).attr("datetime",currentdate);
				$(".timeLabels_" + comment_id_).timeago();
				$(".timeLabels_" + comment_id_).timeago('refresh');
		 	    var strresult = data;
		 	    $(".box-reply_"+comment_id_).hide();
		 	    $(".tool_replay_"+comment_id_).hide();
		 	    $(".relay_contents_"+comment_id_).text(strresult.reply_content);
		 	    $(".relay_container_"+comment_id_).show();	                        
			 },
			 error:function(data) {
			 	 alert("error:"+data);						 	
			 }
		});					
		return false;
		
	});

	//评论
	$(".send_comments").click(function () {
		var spiritualityId  = $(this).attr('data-spirituality-id');	
		var URL = "group/send_comments";
		// alert(userHeadSrc);
		var comments_contents = $(".coments_innput_"+spiritualityId).val();
		if(comments_contents == ''){
			alert('内容，不能为空！');
			return false;
		};
		$.ajax({
			type:"POST",
			dataType: "json",
			url:URL, 
			async:false,
			data: {comments_contents:comments_contents,spirituality_id:spiritualityId},
			success:function (data) {
				var  currentdate = getDateDiff();								
			 	var totalComments = $(".total_comments_"+spiritualityId).attr('data-comments-total');
  				var userHeadSrc_info = $(".userHeadSrc_info").val();	
	  			var total_praises = $('.data-total-praises_'+spiritualityId).attr('data-total-praises');			  			
				if(data.status == '200')
				{
			  		if(totalComments > 0){
			  			//评论不为0			  			
				  		$(".total_comments_"+spiritualityId).html(++totalComments);		            
						$(".total_comments_"+spiritualityId).attr('data-comments-total',totalComments);				  		
	  					$("ul.box-comments_"+spiritualityId).append(
	  						'<li class="box-comments">'+
		  						'<div class="box-comment">'+
		  							'<img src="'+userHeadSrc+userHeadSrc_info+'" class="img-circle img-sm">'+	
			  						'<div class="comment-text">'+
				  						'<span class="username"> 我 '+
				  						'<span class="text-muted pull-right timeLabels timeLabels_c_'+spiritualityId+'">'+
				  							'<time class="timeago" datetime="'+currentdate+'"></time>'+
				  						'</span>'+
				  						'</span>'+data.list.comments_contents+
			  						'</div>'+
		  						'</div>'+
	  						'</li>');
	  					$(".timeLabels_c_"+spiritualityId).timeago();
	  					$(".timeLabels_c_"+spiritualityId).timeago('refresh');							
	  					$(".box-comments_"+spiritualityId).show();
	  					$(".coments_innput_"+spiritualityId).val("").focus();
			  		}else{
			  			//赞不为0和评论都为0
			  			totalComments =  parseInt(totalComments);
			  			$(".total_comments_"+spiritualityId).html(++totalComments);
			  			$(".total_comments_"+spiritualityId).attr('data-comments-total',totalComments);
			  			$("ul.box_praised_"+spiritualityId).after(
			  				'<ul class=" list-unstyled box-comments_'+spiritualityId+'">'+
				  				'<li class="box-comments">'+
					  				'<div class="box-comment">'+
					  					'<img src="'+userHeadSrc+userHeadSrc_info+'" class="img-circle img-sm">'+
						  				'<div class="comment-text">'+
							  				'<span class="username"> 我 '+
								  				'<span class="text-muted pull-right timeLabels timeLabels_c_'+spiritualityId+'">'+
								  					'<time class="timeago" datetime="'+currentdate+'"></time>'+
								  				'</span>'+		
							  				'</span>'+data.list.comments_contents+
						  				'</div>'+
					  				'</div>'+
				  				'</li>'+
			  				'</ul>'
			  			);
	  					$(".coments_innput_"+spiritualityId).val("").focus();
	  					$(".timeLabels_c_"+spiritualityId).timeago();
	  					$(".timeLabels_c_"+spiritualityId).timeago('refresh');	
			  		}
				}
				else if(data.status == '400')
				{
					alert(data.message);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert('提交异常！');				
			},	
		});
		return false;		
	});

	//删除评论
	$(".del_comment").click(function() {
		
		var y=confirm("你确定要删除这条评论么？");	

		if(y == false){
			return false;
		};	

		var comment_id = $(this).attr("data-del-comment-id");
		var spirits_id = $(this).attr("data-spirituality-id");
		// console.log(spirits_id);
		var comments_total = $(".total_comments_"+spirits_id).attr("data-comments-total");
		$(".total_comments_"+spirits_id).html(--comments_total);
		$(".total_comments_"+spirits_id).attr("data-comments-total",comments_total);
		// console.log(comments_total);
		$(".del_comments_"+comment_id).remove();
		var str_url = 'group/del_comments_by_comment_id?comment_id='+comment_id;
		// console.log(str_url);
		$.ajax({
			url: str_url,
			type: 'get',
			dataType: 'json',			
		})
		.done(function(data) {
			// console.log(data);
			if(data.status==200){
				alert('删除成功！');	
			}else{
				alert('删除失败,请重试！');
			}
			// console.log("success");
		})
		.fail(function() {
			alert("提交异常！");
			return false;
		});		
		
	});

	//删除灵修	
	$(".del_spirit").click(function() {
		var spiritualityId = $(this).attr("data-spirituality-id");	
		var y = confirm("你确定要删除这条灵修么？");	

		if(y == false){
			return false;
		};

		var url = 'group/del_spirituality';	

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: {spirituality_id:spiritualityId},
		})
		.done(function(data) {
			// console.log(data);
			if(data.status == 200){
				$(".spirit_container_"+spiritualityId).remove();				
			}else{
				alert('未知错误！');	
			};
			// console.log(data);
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});		
	});

	//删除祷告
	$(".del_prayer").click(function(event) {
		var prayerId = $(this).attr("data-prayer-id");
		var contentStyle = $(this).attr("content-style");
		var y = confirm("你确定要删除这条祷告么？");	

		if(y == false){
			return false;
		};		

		var url = 'group/del_prayer';
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: {prayer_id: prayerId,contentStyle:contentStyle},
		})
		.done(function(data) {
			if(data.status == 200){
				$(".prayer_container_"+prayerId).remove();				
			}else{
				alert('未知错误！');	
			};

			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		

	});


});
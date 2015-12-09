		$(document).ready(function(){

			var statusSpirituality = $("#home_status_spirituality").val();
			// alert(statusSpirituality);

		    $(".praise").click(function(){
		    	// alert("nihao");
		      var spirituality_id = $(this).attr('data-spirituality-id');
		      // alert(spirituality_id);
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

		        }
		       });
		    });

		   	 
		    //插入经文
		    if(statusSpirituality == ''){			   


			    $(".insert_gold_sentence").click(function() {
			    	
		    		var chapterSectionId = $(this).attr("data-chapter-section-id");
		    		var sectionId = $(this).attr("data-section-id");
			    	var str = $(".content_"+sectionId).html();
			    	var inserted   = $(this).hasClass("danger");

			    
			    	if(inserted == false){	

			     		$("#gold_sentence").append(chapterSectionId+str);
			     		$(this).addClass("danger");
			     		$(this).css({
			     			"font-size": '18px'			     			
			     		});
			     		

			    	}else{				    	
				    	var str_g_s = $("#gold_sentence").val();
				    	var r_str_g_s = str_g_s.replace(chapterSectionId + str," ");
			    		$("#gold_sentence").empty();
			    		$("#gold_sentence").append(r_str_g_s);			    		
			     		$(this).removeClass("danger");	
			     		$(this).css({
			     			"font-size": '14px'			     			
			     		});	
			    	}
			    });
		    }

			//send_spiri		
			$(".send_spiri").click(function(event) {
				var  values = $("#form_send_spiri_panel").serializeArray();  
				var values, index;  

				for (index = 0; index < values.length; ++index){  

					if (values[index].value == ""){  
					 	alert("金句，心得，回应，内容都不能为空！");
					 	return false;
					}  
				}  			
				
				var ajaxUrl = "home/send_spirituality";				
				$.ajax({
					url: ajaxUrl,
					type: 'POST',
					dataType: 'json',
					data: $('#form_send_spiri_panel').serialize(),
				})
				.done(function(data) {
					// console.log(data);
					if(data.status == 200){
						//del_send_form

						$("#form_send_spiri_panel").remove();
						$("#status_spiri").remove();
						$("table tr").unbind( "click" );


						$("ul.home_nav_spiri_tabs").each(function() {
							var firstLi = $(this).children().first();
								firstLi.removeClass("active");

							var firstLi_a_href_tab_id = firstLi.children().attr('href');
							if($(firstLi_a_href_tab_id).hasClass("active")){
								$(firstLi_a_href_tab_id).removeClass("active");
							}							

							var lastLi  = $(this).children().last();
								lastLi.addClass("active");
							var lastLi_a_href_tab_id = lastLi.children().attr('href');

							if(! $(lastLi_a_href_tab_id).hasClass("active")){
								$(lastLi_a_href_tab_id).addClass("active");
							}

							var params = data.params;
							var gold_sentence  = params.gold_sentence;
							var heart_feeling  = params.heart_feeling;
							var response  = params.response;							
							var spirituality_id  = params.spirituality_id;							

							htmlobj = $.ajax({
								url:"home/ajax_load_html",
								type: 'POST', 
								dataType: 'json',
								async:false,
								data: {gold_sentence:gold_sentence,heart_feeling:heart_feeling,response: response,spirituality_id:spirituality_id},
							});   							

							$(lastLi_a_href_tab_id).before(htmlobj.responseText);  		    		
							
						});

						//count_spirit
						var total_spiri = $("#total_spiri").text();
						$("#total_spiri").html(++total_spiri);

						//scroll to  id
						$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body')
						$body.animate({scrollTop: $('#spiritual_learning').offset().top}, 1);

						console.log("success");

					}else{
						alert("异常错误！");
					}
				})
				.fail(function() {
					console.log("error");
				});
			});
		    
		}); 	

		var tBox=document.getElementById('online_text');
		var online_textHtml = tBox.innerHTML.slice(0,4000)+'<br><br><p class="bg-success"><i class="fa fa-hand-o-down "></i>&nbsp; (只显示部分，看完整内容，请点击)</p>';
		tBox.innerHTML = online_textHtml;

		function is_del () {
			var delCon = confirm('确定要删除这条灵修么？');
			if(!delCon){
				return false;	
			}
		}


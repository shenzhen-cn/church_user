
function  changing() {
	document.getElementById('checkpic1').src="../public/images/checkcode.php?"+Math.random();
}

//登录表单验证
(function($) {
	$().ready(function() {
	 $("#f_p_chekc").validate({
	  rules: {
	   f_user_email: "required",
	   checkcode_f: {
	    required: true,
	   }
	  },
	  messages: {
	   f_user_email: "*请输入用户名",
	   checkcode_f: {
	    required: "*请输入确认验证码",
	   }
	  }
	    });
	});

})(jQuery);







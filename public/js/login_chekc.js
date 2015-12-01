
function  changing() {
	document.getElementById('checkpic').src="../public/images/checkcode.php?"+Math.random();
}

//登录表单验证
(function($) {
	$().ready(function() {
	 $("#check_user_login").validate({
	  rules: {
	   user_name: "required",
	   password: {
	    required: true,
	   },
	   checkcode: {
	    required: true,
	   }
	  },
	  messages: {
	   user_name: "*请输入用户名",
	   password: {
	    required: "*请输入密码",
	   },
	   checkcode: {
	    required: "*请输入确认验证码",
	   }
	  }
	    });
	});

})(jQuery);







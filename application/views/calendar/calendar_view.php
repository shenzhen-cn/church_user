<?php 
		$user_create_at  = isset($user_create_at) ? $user_create_at : "" ;
		$spirituality  = isset($spirituality) ? $spirituality : "";
		$prayer_for_group = isset($prayer_for_group) ? $prayer_for_group : "";
		$prayer_for_urgent = isset($prayer_for_urgent) ? $prayer_for_urgent : "";
		// var_dump($prayer_for_urgent);exit;
 ?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>灵修日历-使命青年团契</title>
	<?php  $this->load->view('tq_head'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/css/fullcalendar.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/css/fullcalendar.print.css" media='print'>
</head>
<body class="hold-transition skin-blue sidebar-mini ">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				灵修日历
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">灵修日历</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-body no-padding">
							<!-- THE CALENDAR -->
							<div id="calendar"></div>
						</div><!-- /.box-body -->
					</div><!-- /. box -->
				</div><!-- /.col -->
			</div><!-- /.row -->

		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php $this->load->view('tq_footer'); ?>
	<script src="<?php echo base_url(); ?>public/plugins/js/fullcalendar.js"></script>
	<script src="<?php echo base_url(); ?>public/plugins/js/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>public/plugins/js/fullcalendar.min.js"></script>

	<script>
	  $(function () {

	    /* initialize the calendar
	     -----------------------------------------------------------------*/
	    //Date for the calendar events (dummy data)
	    var date = new Date();
	    var d = date.getDate(),
	            m = date.getMonth(),
	            y = date.getFullYear();

	    $('#calendar').fullCalendar({
	      header: {
	        left: 'prevYear,nextYear',
	        center: 'title',
	        right: 'prev,next today'
	      },
	      buttonText: {
	        today: '今天',
	        prevYear: '上一年',
	        nextYear: '下一年',
	      },
	      height:'auto',
	      // contentHeight:'150px',

	      monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
	      monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
	      dayNames: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
	      dayNamesShort: ['日', '一', '二', '三', '四', '五', '六'],
	      //Random default events
	      events: [
      		<?php if (!empty($spirituality)) { ?>
        	<?php foreach ($spirituality as $k => $v) {
        		$created_at = $v->created_at;
        		// var_dump($created_at);exit;
        	 ?>
	        {
    		  title: '已灵修',
    		  start: '<?php echo $created_at; ?>',	         
	          backgroundColor: "#f39c12", //red
	          borderColor: "#f39c12" //red
	        },
        	<?php } ?>
      		<?php }; ?>
      		<?php if (!empty($user_create_at)) { ?>
	        {
	          title: '注册时间',
	          start: '<?php echo $user_create_at; ?>',
	          // end: new Date(y, m, d - 2),
	          backgroundColor: "#f39c12", //yellow
	          borderColor: "#f39c12" //yellow
	        },
      		<?php }; ?>
      		<?php if (!empty($prayer_for_group)) {
      				foreach ($prayer_for_group as $k => $v) {
      					$created_at = $v->created_at; ?>
      		{
      		  title: '小组祷告',
      		  start: '<?php echo $created_at; ?>',
      		  allDay: false,
      		  backgroundColor: "#00a65a", //Blue
      		  borderColor: "#00a65a" //Blue
      		},			
      		<?php }
      		 ?> 
      		<?php }; ?>
	        <?php if (!empty($prayer_for_urgent)) {
	        		foreach ($prayer_for_urgent as $k => $v) {
	        				$created_at = $v->created_at;
	        		 ?>
	        {
	          title: '紧急代祷',
	          start: '<?php echo $created_at; ?>',
	          allDay: false,
	          backgroundColor: "#f56954", //Info (aqua)
	          borderColor: "#f56954" //Info (aqua)
	        },	        			
	        		<?php }
	         ?>
	        <?php }; ?>	        
	      ],	  
	      editable: false,
	      droppable: false, 
	    });

	  });

	</script>
</body>
</html>
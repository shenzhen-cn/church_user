<?php 
	$results = isset($results) ? $results : "";
	$book_name = isset($results[0]->name) ? $results[0]->name : "";
	// var_dump($book_name);exit;
	$testament = $this->input->get('testament') ? $this->input->get('testament') : "" ;
	$group_id = isset($user_info->group_id) ? ($user_info->group_id) : "";
	$get_book_id = $this->input->get('book_id') ? $this->input->get('book_id') : "" ;
	$chapter_id = $this->input->get('chapter_id') ? $this->input->get('chapter_id') : "" ;
	// var_dump($chapter_id);exit;
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>小组-使命青年团契</title>
	<?php  $this->load->view('tq_head'); ?>
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
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li>小组</li>
				<li class="active">小组灵修设置</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-3">
					<?php $this->load->view('tq_alerts'); ?>
					<form action="<?php echo base_url('spirituality'); ?>" method="get">
						<div class="box box-primary">
							<div class="box-body box-profile">
								<h3 class="profile-username text-center">设置当日经文</h3>
								<div class="form-group">
									<label>新约/旧约</label>
									<select class="form-control select2" style="width: 100%;"  class="testament" name='testament' id='testament' required/>
									<?php if ($testament == 'new'){ ?>
									<option value="new" selected="selected">新约</option>
									<option value="old" >旧约</option>
									<?php }else { ?>
									<option value="old"  selected="selected">旧约</option>
									<option value="new" >新约</option>
									<?php 	} ?>
								</select>
							</div><!-- /.form-group -->

							<div class="form-group">
								<label>选择卷</label>
								<select class="form-control select2" id='book_id' name='book_id' required/>

							</select>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label>选择章节</label>
							<select class="form-control select2" style="width: 100%;" id="chapter_id" name="chapter_id" required/>

							</select>
						</div><!-- /.form-group -->
					<button type="submit" class="btn btn-primary btn-block"><b>查找</b></button>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</form>

	</div><!-- /.col -->
	<?php if (!empty($results)) { ?>
	<div class="col-md-9">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#activity" data-toggle="tab">《<?php echo $book_name; ?>》</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="activity">
					<div class="direct-chat-messages">
						<?php foreach ($results as $k => $v) {
							$chapter_id = $v->chapter_id;
							$section = $v->section;
							$content = $v->content;?>
							<p><?php echo $chapter_id; ?>:<?php echo $section; ?>&nbsp; &nbsp;  <?php echo $content; ?></p>
							<?php } ?>
						</div>
					</div><!-- /.tab-pane -->
					<div class="box-footer no-padding">
						<br>
						<button class="btn btn-warning pull-right" onclick="window.history.back()">返回</button>
						<a type="button" href="<?php echo base_url('group/setting_spirituality?testament='."$testament".'&book_id='."$get_book_id".'&chapter_id='."$chapter_id".'&group_id='."$group_id"); ?>" class="btn btn-primary pull-left">设置</a>
					</div>

				</div><!-- /.tab-content -->
			</div><!-- /.nav-tabs-custom -->
		</div><!-- /.col -->
		<?php } ?>
	</div><!-- /.row -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php  $this->load->view('tq_footer'); ?>
<script>
	$(function () {
	  
	  load_testament_def();

	  function load_testament_def (argument) {
	     var testament = $("#testament").val();
	      var str_url = '<?php echo site_url("bibile/get_bibile_book_id_by_testament?testament="); ?>' + testament;
	      $.ajax({
	        url: str_url,
	        type: 'GET',
	        dataType: 'json',
	      })
	      .done(function(data) {
	        var book_id ="";

	          $.each(data, function(index,item) {
	          	<?php
	          		$selected = null;
	          	 if (!empty($get_book_id)) { 
	          		$selected= 'selected=""';
	          	 }; ?>	
	            $("#book_id").append(' <option  value="'+item.book_id+'">'+item.name +'</option>');

	          });
	            $("#chapter_id").empty(); 
	            var book_id =$("#book_id").val();
	            var str_url = '<?php echo site_url("bibile/get_bible_section_by_book_id?book_id="); ?>' + book_id;
	            // alert(testament);
	            $.ajax({
	              url: str_url,
	              type: 'GET',
	              dataType: 'json',
	            })
	            .done(function(data) {

	              $.each(data, function(index,item) {
	                
	                $("#chapter_id").append(' <option value="'+item.chapter_id+'">'+item.chapter_id +'</option>');
	              });

	              console.log("success");
	            })
	            .fail(function() {
	              console.log("error");
	            })
	            .always(function() {
	              console.log("complete");
	            });

	          console.log("success");
	        })
	      .fail(function() {
	        console.log("error");
	      })
	      .always(function() {
	        console.log("complete");
	      });

	  }
	  $('#testament').change(function(event) {
	    $("#book_id").empty();
	    $("#chapter_id").empty();
	    $("#chapter_id").append('<option value="1">1</option>');

	    var testament = $(this).val();
	      var str_url = '<?php echo site_url("bibile/get_bibile_book_id_by_testament?testament="); ?>' + testament;
	      // alert(testament);
	      $.ajax({
	        url: str_url,
	        type: 'GET',
	        dataType: 'json',
	      })
	      .done(function(data) {

	          $.each(data, function(index,item) {
	            $("#book_id").append(' <option value="'+item.book_id+'">'+item.name +'</option>');
	          });
	          $("#chapter_id").empty(); 

	            var book_id =$("#book_id").val();
	            var str_url = '<?php echo site_url("bibile/get_bible_section_by_book_id?book_id="); ?>' + book_id;
	            // alert(testament);
	            $.ajax({
	              url: str_url,
	              type: 'GET',
	              dataType: 'json',
	            })
	            .done(function(data) {

	              $.each(data, function(index,item) {
	                
	                $("#chapter_id").append(' <option value="'+item.chapter_id+'">'+item.chapter_id +'</option>');
	              });

	              console.log("success");
	            })
	            .fail(function() {
	              console.log("error");
	            })
	            .always(function() {
	              console.log("complete");
	            });

	          console.log("success");
	        })
	      .fail(function() {
	        console.log("error");
	      })
	      .always(function() {
	        console.log("complete");
	      });
	    });

	  $('#book_id').change(function(event) {
	      $("#chapter_id").empty(); 
	      var book_id = $(this).val();
	      var str_url = '<?php echo site_url("bibile/get_bible_section_by_book_id?book_id="); ?>' + book_id;
	      $.ajax({
	        url: str_url,
	        type: 'GET',
	        dataType: 'json',
	      })
	      .done(function(data) {

	        $.each(data, function(index,item) {
	          
	          $("#chapter_id").append(' <option value="'+item.chapter_id+'">'+item.chapter_id +'</option>');
	        });

	        // console.log("success");
	      })
	      .fail(function() {
	        console.log("error");
	      })
	      .always(function() {
	        console.log("complete");
	      });
	    });
	})
</script>


</body>
</html>
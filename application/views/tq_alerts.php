<?php if ($this->session->flashdata('warning')) : ?>
<div class="alert-message warning snb-fade"><p><?php echo $this->session->flashdata('warning'); ?></p></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')) : ?>

	<div class="alert alert-error alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <span><strong>^_^||| ！</strong><?php echo $this->session->flashdata('error'); ?></span>
	</div>

<?php endif; ?>


<?php if ($this->session->flashdata('success')) : ?>

	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <p class="text-center"><strong>(^_^)！</strong> <?php echo $this->session->flashdata('success'); ?></p>
	</div>

<?php endif; ?>



<?php if ($this->session->flashdata('info')) : ?>

	<div class="alert alert-info alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <p class="text-center"><strong>(^_^)！</strong> <?php echo $this->session->flashdata('info'); ?></p>
	</div>

<?php endif; ?>

<?php if (isset($warning)) : ?>
<div class="alert-message warning snb-fade"><p><?php echo $warning; ?></p></div>
<?php endif; ?>
<?php if (isset($error)) : ?>

	<div class="alert alert-error alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <span><strong>^_^||| ！</strong><?php echo $error; ?></span>
	</div>
<?php endif; ?>

<?php if (isset($success)) : ?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <p class="text-center"><strong>(^_^)！</strong> <?php echo $success; ?></p>
	</div>
<?php endif; ?>
<?php if (isset($info)) : ?>
<div class="alert-message info snb-fade"><p><?php echo $info; ?></p></div>
<?php endif; ?>
<style type="text/css" >
	.alert{
		/*padding:10px;*/
		padding-top: 7px;
		padding-bottom: 7px;
	}
</style>


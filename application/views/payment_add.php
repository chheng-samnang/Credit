<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</nav>
<?php if(isset($value)):?>
	<div id="page-wrapper">
		<div class="container_fluid" style="margin-top:40px;">
		<div class="row">
			<div class="col-lg-12">
				<?php echo form_open($action)?>
				<h1 class="page-header">Form Add <?php echo $pageHeader?></h1>
				<div class="row">
					<div class="col-lg-12">
					<?php
						if(!empty($error) OR validation_errors())
						{
					?>
						<div class="alert alert-danger" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
							<strong>Attention!</strong><?php if(!empty($error)){echo $error;}if(validation_errors()){echo validation_errors();}?>
						</div>
					<?php }?>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $pageHeader?> Information</h3>
					</div>
					<div class="panel-body">
					<input type="hidden" name="txtSaleId" value="<?php echo $value->sal_id;?>">
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label>Total</label>
									<input type="text" name="txtTotal" value="<?php echo $value->total_bal_sale1;?>" readonly class="form-control">
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label>Remaining</label>
									<input type="text" name="txtRemaining" readonly class="form-control" value="<?php 
										if(isset($remaining))
										{
											echo $remaining->remaining;
										}
										else{
											echo $value->total_bal_sale1;
										}
									?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label>Paid</label>
									<input type="text" name="txtPaid" class="form-control">
								</div>
							</div>
						</div>				
						
						
						<hr />
						<div class="row">
							<div class="col-lg-12">
								<?php echo form_submit('btnSubmit','Save','class="btn btn-success"');?>
								<?php echo form_button('btnCancel','Cancel','id="btnCancel" class="btn btn-default"');?>
							</div>
						</div>																			
						
					</div>
				</div>
				<?php echo form_close()?>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
<script>
	$("#btnCancel").click(function(){
    	window.location.assign('<?php echo base_url().$cancel?>');
	});
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
</script>

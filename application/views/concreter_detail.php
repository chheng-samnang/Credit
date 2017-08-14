<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</nav>
	<div id="page-wrapper">
		<div class="container_fluid" style="margin-top:40px;">
			<div class="row">
				<div class="col-lg-12">				
					<h1 class="page-header">Concreter Detail</h1>															
					 <div class="col-lg-12">
					 	<div class="panel panel-primary">
					 		<div class="panel-heading">
					 			<h3 class="panel-title">Concreter Information</h3>
					 		</div>
					 		<div class="panel-body">
					 		<?php if(isset($detail)):?>								 			
                                <p><b>Code: </b><?php echo $detail->con_code;?></p>
                               	<p><b>Name: </b><?php echo $detail->con_name;?></p>
                                <p><b>Gender: </b><?php echo $detail->con_gender=='m'?'Male':'Female';?></p>                                     
                                <p><b>Phone: </b><?php echo $detail->con_phone;?></p>                                        
                                <p><b>Status: </b><?php echo $detail->con_status==1?'Enable':'Disable';?></p>
                                <p><b>Address: </b><?php echo $detail->con_address;?></p>
                                <p><b>User create: </b><?php echo $detail->user_crea;?></p>                                                                        
                                <p><b>Date create: </b><?php echo $detail->date_crea==NULL?NULL:date("d-M-Y",strtotime($detail->date_crea));?></p>                                                                        
                                <p><b>User update: </b><?php echo $detail->user_updt;?></p>                                                                        
                                <p><b>Date update: </b><?php echo $detail->date_updt==NULL?NULL:date("d-M-Y",strtotime($detail->date_updt));?></p>                                                                                                                                                                                        
                                <p><b>Description: </b><div class="thumbnail"><?php echo $detail->con_desc;?></div></p>
                                <p><a href="<?php echo base_url("Concreter");?>" class="btn btn-default">Close</a></p>
                            <?php endif;?>
					 		</div>
					 	</div>	                                
                    </div>	                    
				</div>
			</div>
		</div>
</div> 

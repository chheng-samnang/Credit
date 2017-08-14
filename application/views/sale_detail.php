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
                               	<p><b>Concreter name: </b><?php echo $detail->con_name;?></p>
                                <p><b>Concreter phone: </b><?php echo $detail->con_phone;?></p>                                     
                                <p><b>Customer name: </b><?php echo $detail->customer_name;?></p>                                        
                                <p><b>Customer phone: </b><?php echo $detail->customer_phone;?></p>
                                <p><b>Customer address: </b><?php echo $detail->customer_address;?></p>
                                <p><b>Power: </b><?php echo $detail->power;?></p>
                                <p><b>Cost </b><?php echo '$'.number_format($detail->cost,2);;?></p>
                                <p><b>Slump: </b><?php echo $detail->slump;?></p>
                                <p><b>Payment duration: </b><?php echo $detail->payment_duration.' days';?></p>
                                <p><b>Pump cost: </b><?php echo '$'.number_format($detail->pump_cost,2);?></p>
                                <p><b>Distance: </b><?php echo $detail->distance.' km';?></p>
                                <p><b>Set: </b><?php echo $detail->set;?></p>
                                <p><b>Amount sale: </b><?php echo $detail->amount_sale;?></p>
                                <p><b>Amount sale1: </b><?php echo $detail->amount_sale1;?></p>
                                <p><b>Total Balance: </b><?php echo '$'.number_format($detail->total_bal_sale,2);?></p>
                                <p><b>Total Balance1: </b><?php echo '$'.number_format($detail->total_bal_sale1,2);?></p>
                                <p><b>P: </b><?php echo $detail->p;?></p>
                                <p><b>Payment status: </b><?php echo $detail->payment_status;?></p>
                                <p><b>Sale date: </b><?php echo date("d-M-Y",strtotime($detail->sale_date));?></p>
                                <p><b>User create: </b><?php echo $detail->user_crea;?></p>                                                                        
                                <p><b>Date create: </b><?php echo $detail->date_crea==NULL?NULL:date("d-M-Y",strtotime($detail->date_crea));?></p>                                                                        
                                <p><b>User update: </b><?php echo $detail->user_updt;?></p>                                                                        
                                <p><b>Date update: </b><?php echo $detail->date_updt==NULL?NULL:date("d-M-Y",strtotime($detail->date_updt));?></p>                                                                                                                                                                                        
                                <p><b>Sale description: </b><div class="thumbnail"><?php echo $detail->sale_desc;?></div></p>
                                <p><a href="<?php echo base_url("Sale");?>" class="btn btn-default">Close</a></p>
                            <?php endif;?>
					 		</div>
					 	</div>	                                
                    </div>	                    
				</div>
			</div>
		</div>
</div> 
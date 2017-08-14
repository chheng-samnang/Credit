<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>   
<style type="text/css">
    .yellow{background-color: yellow;}
    .red{background-color: red;}
</style>         
        <div id="page-wrapper">
           <div class="row">
              <div class="col-lg-12">
                 <h1 class="page-header">Main Form</h1>	        
             </div>
         </div>

         <div class="row">
            <div class="col-lg-12"><!--table-->                        
                <div class="panel panel-primary"><!--panel-->
                    <div class="panel-heading">Summary of Credit management</div>
                    <div class="panel-body table-responsive">
                        <table class="table" id="mydata">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>                             
                                <th>Concreter</th>                             
                                <th>Location</th>                             
                                <th>Cost</th>                             
                                <th>Pump cost</th>                             
                                <th>Amount</th>                             
                                <th>Amount1</th>                             
                                <th>Total</th>                             
                                <th>Total1</th>                             
                                <th>Status</th>                             
                                <th>Date</th>                             
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;if(isset($value)){foreach($value as $val){?>
                        <?php                                                                                 
                            $date_format=strtotime(date("Y-m-d"))."<br>";
                            $day30 = strtotime($val->sale_date. "+31 days");
                            $day60 = strtotime($val->sale_date. "+61 days"); 
                            if($date_format>$day60 && $val->payment_status=='Pending'){echo '<tr class="red">';}
                            elseif($date_format>$day30 && $val->payment_status=='Pending'){echo '<tr class="yellow">';}                          
                            else{echo "<tr style='display:none'>";}                          
                        ?>                                                        
                                <td><?php echo $i;$i++;?></td>
                                <td><?php echo $val->con_code;?></td>
                                <td><?php echo $val->con_name;?></td>
                                <td><?php echo $val->customer_address;?></td>
                                <td><?php echo "$".number_format($val->cost,2);?></td>
                                <td><?php echo "$".number_format($val->pump_cost,2);?></td>
                                <td><?php echo $val->amount_sale;?></td>
                                <td><?php echo $val->amount_sale1;?></td>
                                <td><?php echo "$".number_format($val->total_bal_sale,2);?></td>
                                <td><?php echo "$".number_format($val->total_bal_sale1,2);?></td>
                                <td><?php echo $val->payment_status;?></td>
                                <td><?php echo date("d-M-Y",strtotime($val->sale_date));?></td> 
                                <td>                                    
                                    <a href="<?php echo base_url('Sale/saleDetail/'.$val->sal_id);?>" class="btn btn-primary" title="Detail"> Detail</a>                                                                                                                 
                                </td>                               
                            </tr>                                                                    
                        <?php }};?>                           
                        </tbody>                         
                        </table>
                    </div>
                </div><!--end panel-->    
            </div><!--end table -->
            
        </div> 
<script>
    $(document).ready(function(){
        //data table
        $('#mydata').DataTable();        
    });
</script>         
    
            


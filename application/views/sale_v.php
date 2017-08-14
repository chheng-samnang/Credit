<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
    .yellow{background-color: yellow;}
    .red{background-color: red;}
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Form <?php if(isset($pageHeader)){echo $pageHeader;}?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row"><!--add and search-->
            <div class="col-lg-6">
                <?php if(isset($action_url[0])){ ?><a href="<?php echo base_url($action_url[0]);?>" class="btn btn-success">Add<?php }?> <?php if(isset($page_header)){echo $page_header;}?></a>
            </div>
            <div class="col-lg-6">
                <?php echo form_open(base_url('Sale'))?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-5">
                              <div class="input-group datetimepicker">
                                 <input type="text" name="txtFrom" class="form-control datetimepicker" placeholder="From" id="txtFrom" required>
                                 <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                          <div class="col-lg-5">
                              <div class="input-group datetimepicker">
                                 <input type="text" name="txtTo" class="form-control" placeholder="To" id="txtTo" required>
                                 <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                          <div class="col-lg-2">
                            <input type="submit" name="btnSubmit" value="Search" class="btn btn-primary">
                          </div>
                        </div>
                      <div id="chartMenu"></div>
                  </div>
                <?php form_close();?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"><?php if(isset($msg)){echo $msg;}?></div>
        </div>

        <div class="row">
            <div class="col-lg-12"><!--table-->
                <div class="panel panel-primary"><!--panel-->
                    <div class="panel-heading"><?php if(isset($pageHeader)){echo $pageHeader;}?> Information</div>
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
                            else{echo "<tr>";}
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
                                    <?php if(isset($action_url[4])){ ?><a href="<?php if(isset($action_url)){echo base_url($action_url[4]).'/'.$val->sal_id;}?>" class="btn btn-primary" title="Detail"> Detail</a><?php }?>
                                    <?php if(isset($action_url[1])){ ?><a href="<?php if(isset($action_url)){echo base_url($action_url[1]).'/'.$val->sal_id;}?>" class="btn btn-primary" title="Edit"> Edit</a><?php }?>
                                    <?php if(isset($action_url[2])){ ?><a href="<?php if(isset($action_url)){echo base_url($action_url[2]).'/'.$val->sal_id;}?>" class="btn btn-large confirModal del btn-danger" title="Delete" data-confirm-title="Confirm Delete !" data-confirm-message="Are you sure you want to Delete this ?">Delete</a><?php }?>
                                    <?php if(isset($action_url[3])){ ?><a href="<?php if(isset($action_url)){echo base_url($action_url[3]).'/'.$val->sal_id;}?>" class="btn btn-success" title="payment">Payment</a><?php }?>
                                </td>
                            </tr>
                        <?php }};?>
                        </tbody>
                        </table>
                    </div>
                </div><!--end panel-->
            </div><!--end table -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<script>
    $(document).ready(function(){
        //data table
        $('#mydata').DataTable();
        //comfirm delete
        $('.del').confirmModal();
    });
		$(document).ready(function(){
			$("#txtTo").click(function(){
				$(".input-group-addon").trigger("click");
			});
		});
</script>
</body>
</html>

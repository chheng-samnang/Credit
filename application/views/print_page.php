<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
</nav>
<style media="screen">
  body{
    background:#bcbcbc;
  }
  -webkit-print-color-adjust:exact;
  #content-wrapper{
    margin:0 auto;
    width:1440px;
  }

  .card-front{
    margin-top:50px;

  }


</style>

<form class="" action="print_page.php" id="myform" method="post">
  <button type="button" name="btnPrint" class="btn btn-default" onclick="PrintElem('content-wrapper')">Print</button>
  <div id="content-wrapper">

        <?php
          foreach ($staff as $key => $value) {
         ?>
        <div class="card-front" style="float:left;margin-left:20px;margin-right:50px;margin-bottom:70px;width:200px;height:315.08px;">
          <img src="<?php echo base_url('img')?>/front.jpg" style="position:absolute;" width="230" alt="">
          <img src="<?php echo base_url('assets/uploads')?>/<?php echo $value->img?>" style="width:100px;margin-left:62px;margin-top:115px; position:relative;" width="200" alt="">
          <table style="position:relative;width:121px;font-size:10px;font-weight:bold;margin-left:107px;margin-top:26px;">
            <tr>
              <td><?php echo $value->st_name ?></td>
            </tr>
            <tr>
              <td><?php echo $value->st_code ?></td>
            </tr>
            <tr>
              <td><?php echo $value->pos_name ?></td>
            </tr>
            <tr>
              <td><?php echo $value->dep_name ?></td>
            </tr>
            <tr>
              <td><?php echo $value->st_hired_date ?></td>
            </tr>
            <tr>
              <td><?php echo $value->st_validity ?></td>
            </tr>
          </table>
        </div>
      <?php
      if($key%4==0){
        //echo '<div style="clear:both"></div>';
      }
    } ?>

        <!-- <div class="card-front" style="float:left;margin-left:20px;margin-top:69px;margin-right:21px;">
          <img src="<?php echo base_url('img')?>/back.jpg" width="230" alt="">
        </div>
        <div class="card-front" style="float:left;margin-left:20px;margin-top:69px;margin-right:21px;">
          <img src="<?php echo base_url('img')?>/back.jpg" width="230" alt="">
        </div>
        <div class="card-front" style="float:left;margin-left:20px;margin-top:69px;margin-right:21px;">
          <img src="<?php echo base_url('img')?>/back.jpg" width="230" alt="">
        </div>
        <div class="card-front" style="float:left;margin-left:20px;margin-top:69px;margin-right:21px;">
          <img src="<?php echo base_url('img')?>/back.jpg" width="230" alt="">
        </div> -->
  </div>
</form>

<script type="text/javascript">
function PrintElem(elem)
{
  console.log(document.getElementById(elem).innerHTML);
    var mywindow = window.open('', 'PRINT');
    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');

    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>

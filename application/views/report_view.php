<?php
$user_id=$this->session->userdata('user_id');

if(!$user_id){

  redirect('user/login_view');
}
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>report-view</title>
  <meta name="description" content="Stock Portfolio Management">
  <meta name="keywords" content="user-management, content-management, codeigniter, stock, NSE, BSE"></meta>
  <meta name="copyright" content="Venkat Muthiah">
  <meta name="author" content="Venkat Muthiah">
  <link href="http://localhost/stock/assests/fav_icon.ico" type="image/x-icon" rel="icon"/>
  <link href="http://localhost/stock/assests/fav_icon.ico" type="image/x-icon" rel="shortcut icon"/>
  <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assests/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  <script src="<?php echo base_url('assests/jquery/equity_option.js')?>"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>


      <div class="container">
        <!-- navigation panel -->
        <nav class="navbar navbar-default navbar-fixed-top">

          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar" style="background-color: brown;"></span>
                <span class="icon-bar" style="background-color: brown;"></span>
                <span class="icon-bar" style="background-color: brown;"></span>
              </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right ml-auto">
                <li class="nav-item">
                  <a id="link1" class="nav-link js-scroll-trigger" href="<?php echo base_url('stock/index');?>">Home</a>
                </li>
                <li class="nav-item">
                  <a id="link5" class="nav-link js-scroll-trigger" href="<?php echo base_url('report/index');?>">Reports</a>
                </li>
                <li class="nav-item">
                  <a id="link6" class="nav-link js-scroll-trigger" href="<?php echo base_url('user/user_logout');?>">Logout</a>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

      </center>
      <h3 style="margin-top: 7%">Stock Folio Status</h3>
      <br />
      <br />
      <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
           <th>Exchange</th>
           <th>Company Name</th>
           <th>Face Value</th>
           <th>Total shares</th>
           <th>Value</th>
           <th>Market Value</th>
           <th>current price</th>
         </p></th>
       </tr>
     </thead>
     <tbody>
      <?php foreach($stock as $stocks){?>
      <tr>
       <td><?php echo $stocks->exchange;?></td>
       <td><?php echo explode("|", ($stocks->comp_name))[1];?></td>
       <!-- START - crawl current price value -->
       <?php 
       $key = "";
       $zb = explode('|', $stocks->comp_name)[0];
       $val=0;

       if ($stocks->exchange == "BSE" ){
        $contents = file_get_contents("https://www.quandl.com/api/v3/datasets/BSE/$zb.json?api_key=$key");  
        $contents = json_decode($contents, true);
        if( isset($contents['dataset']["data"][0][4])){
          $val = $contents['dataset']["data"][0][4];
        }
      }

      if ($stocks->exchange == "NSE" ){
        $contents = file_get_contents("https://www.quandl.com/api/v3/datasets/NSE/$zb.json?api_key=$key");
        $contents = json_decode($contents, true);
        if( isset($contents['dataset']["data"][0][4])){
          $val = $contents['dataset']["data"][0][4];
        }
      }

      $c_total = (int)$val * (int)$stocks->count;
      $count_old_value = $count_old_value + (int)$stocks->total;
      $count_current_value = $count_current_value + (int)$c_total;
      ?>
      <!-- END - crawl current price value -->

      <td><?php echo $stocks->face_value;?></td>
      <td><?php echo $stocks->count;?></td>
      <td><?php echo "₹ ".$stocks->total;?></td>
      
      <?php if($c_total == 0){?>
      <td><?php echo "undefiend" ;?></td>
      <td><?php echo "undefiend" ;?></td>
      <?php } elseif((int)$c_total >= (int)$stocks->total){?>
      <td><i style="color: green;"><?php echo "₹ ".$c_total ;?></i></td>
      <td><?php echo "₹ ".$val;?></td>
      <?php } else {?>
      <td><i style="color: red;"><?php echo "₹ ".$c_total ;?></i></td>
      <td><?php echo "₹ ".$val;?></td>
      <?php } ?>

    </tr>
    <?php }?>

      <!-- calcualting total assests column -->
      <td></td>
      <td></td>
      <td></td>
      <td style="background-color: green;color: white;">Total Assets</td>
      <?php if($c_total == 0){?>
        <td><?php echo "₹ ".$count_old_value;?></td>
        <td><?php echo "undefiend" ;?></td> 
      <?php } elseif((int)$count_current_value >= (int)$count_old_value){?>
        <td><?php echo "₹ ".$count_old_value;?></td>
        <td style="color: green;"><?php echo "₹ ".$count_current_value;?></td>
      <?php } else {?>
        <td><?php echo "₹ ".$count_old_value;?></td>
        <td style="color: red;"><?php echo "₹ ".$count_current_value;?></td>
      <?php } ?>
      <td></td>
      <!-- ends -->
  </tbody>

  <tfoot>
    <tr>
     <th>Exchange</th>
     <th>Company Name</th>
     <th>Face Value</th>
     <th>Total shares</th>
     <th>Value</th>
     <th>Market Value</th>
     <th>current price</th>
   </tr>
 </tfoot>
</table>

</div>

<script src="<?php echo base_url('assests/jquery/jquery-3.1.0.min.js')?>"></script>
<script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assests/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assests/datatables/js/dataTables.bootstrap.js')?>"></script>


<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


  </script>


  

</body>
</html>

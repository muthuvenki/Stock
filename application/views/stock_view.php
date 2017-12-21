<?php
$user_id=$this->session->userdata('user_id');

if(!$user_id){

  redirect('user/login_view');
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>stock-view</title>
  <meta name="description" content="Stock Portfolio Management">
  <meta name="keywords" content="user-management, content-management, codeigniter, stock, NSE, BSE"></meta>
  <meta name="copyright" content="Venkat Muthiah">
  <meta name="author" content="Venkat Muthiah">
  <link href="http://localhost/stock/assests/fav_icon.ico" type="image/x-icon" rel="icon"/>
  <link href="http://localhost/stock/assests/fav_icon.ico" type="image/x-icon" rel="shortcut icon"/>
  <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assests/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  <script src="<?php echo base_url('assests/jquery/equity_option.js')?>"></script>

  <script src="<?php echo base_url('assests/jquery/jquery-3.1.0.min.js')?>"></script>
  <script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assests/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assests/datatables/js/dataTables.bootstrap.js')?>"></script>

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
      <h3 style="margin-top: 7%">Stock Folio</h3>
      <br />
      <button class="btn btn-success" onclick="add_stock()"><i class="glyphicon glyphicon-plus"></i> Add Stock</button>
      <br />
      <br />
      <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
           <th>Date</th>
           <th>Exchange</th>
           <th>Company Name</th>
           <th>Face Value</th>
           <th>Number of shares</th>
           <th>Share Price</th>
           <th style="width:125px;">Action
           </p></th>
         </tr>
       </thead>
       <tbody>
        <?php foreach($stock as $stocks){?>
        <tr>
         <td><?php echo $stocks->date;?></td>
         <td><?php echo $stocks->exchange;?></td>
         <td><?php echo explode("|", ($stocks->comp_name))[1];?></td>
         <td><?php echo $stocks->face_value;?></td>
         <td><?php echo $stocks->num_shares;?></td>
         <td><?php echo $stocks->price_bought;?></td>
         <td>
           <button class="btn btn-warning" onclick="edit_stock(<?php echo $stocks->stock_id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
           <button class="btn btn-danger" onclick="delete_stock(<?php echo $stocks->stock_id;?>)"><i class="glyphicon glyphicon-remove"></i></button>


         </td>
       </tr>
       <?php }?>



     </tbody>

     <tfoot>
      <tr>
        <th>Date</th>
        <th>Exchange</th>
        <th>Company Name</th>
        <th>Face Value</th>
        <th>Number of shares</th>
        <th>Share Price</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>

</div>




<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add_stock()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
  }

  function edit_stock(id)
  {
    save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/stock/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

          $('[name="user_id"]').val(id);
          $('[name="stock_date"]').val(data.date);
          $('[name="stock_exc"]').val(data.exchange);
          $('[name="stock_name"]').append($("<option selected ></option>").val(data.comp_name).html(data.comp_name));
          $('[name="stock_val"]').val(data.face_value);
          $('[name="stock_num"]').val(data.num_shares);
          $('[name="stock_price"]').val(data.price_bought);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit stock'); // Set title to Bootstrap modal title

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('index.php/stock/stock_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/stock/stock_update')?>";
      }

       // ajax adding data to database
       $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              alert('Error adding / update data');
            }
          });
     }

     function delete_stock(id)
     {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('index.php/stock/stock_delete')?>/"+id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {

           location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
          alert('Error deleting data');
        }
      });

      }
    }

  </script>


  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Purchased Stock</h3>
        </div>
        <div class="modal-body form">
          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="stock_id"/>
            <div class="form-body">
              <div class="form-group">
                <label class="control-label col-md-3">Date of Purchase</label>
                <div class="col-md-9">
                  <input name="stock_date" placeholder="Date of Purchase" class="form-control" type="date">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Exchange</label>
                <div class="col-md-9">
                  <select name="stock_exc" class="form-control" onChange="getName(this.value);">
                    <option value="1">Select Exchange</option>
                    <option value="BSE">BSE</option>
                    <option value="NSE">NSE</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Company Name</label>
                <div class="col-md-9">
                  <select name="stock_name" id="stock_name" class="form-control">
                    <option value="1">Select Stock Name</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Face Value</label>
                <div class="col-md-9">
                  <input name="stock_val" placeholder="Face Value" class="form-control" type="text">

                </div>
              </div>
              <div class="form-group">
               <label class="control-label col-md-3">Number of Shares</label>
               <div class="col-md-9">
                <input name="stock_num" placeholder="Stock Number" class="form-control" type="text">

              </div>
            </div>
            <div class="form-group">
             <label class="control-label col-md-3">Share Price</label>
             <div class="col-md-9">
              <input name="stock_price" placeholder="Stock Price" class="form-control" type="text">
              <input name="user_id" type="hidden" value="<?php echo $user_id ?>">
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

</body>
</html>

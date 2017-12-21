<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>stock-user-reg</title>
  <meta name="description" content="Stock Portfolio Management">
  <meta name="keywords" content="user-management, content-management, codeigniter, stock, NSE, BSE"></meta>
  <meta name="copyright" content="Venkat Muthiah">
  <meta name="author" content="Venkat Muthiah">
  <link href="http://localhost/stock/assests/fav_icon.ico" type="image/x-icon" rel="icon"/>
  <link href="http://localhost/stock/assests/fav_icon.ico" type="image/x-icon" rel="shortcut icon"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">


</head>
<body>

  <span style="background-color:red;">
    <div class="container" style="margin-top: 10%"><!-- container class is used to centered  the body of the browser with some decent width-->
      <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
          <div class="login-panel panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Registration</h3>
            </div>
            <div class="panel-body">

              <?php
              $error_msg=$this->session->flashdata('error_msg');
              if($error_msg){
                echo $error_msg;
              }
              ?>

              <form role="form" method="post" action="<?php echo base_url('user/register_user'); ?>">
                <fieldset>
                  <div class="form-group">
                    <input class="form-control" placeholder="Name" name="user_name" type="text" autofocus>
                  </div>

                  <div class="form-group">
                    <input class="form-control" placeholder="E-mail" name="user_email" type="email" autofocus>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Password" name="user_password" type="password" value="">
                  </div>

                  <div class="form-group">
                    <input class="form-control" placeholder="Age" name="user_age" type="number" value="">
                  </div>

                  <div class="form-group">
                    <input class="form-control" placeholder="Mobile No" name="user_mobile" type="number" value="">
                  </div>

                  <input class="btn btn-lg btn-success btn-block" type="submit" value="Register" name="register" >

                </fieldset>
              </form>
              <center><b>Already registered ?</b> <br></b><a href="<?php echo base_url('user/login_view'); ?>">Login here</a></center><!--for centered text-->
            </div>
          </div>
        </div>
      </div>
    </div>





  </span>




</body>
</html>

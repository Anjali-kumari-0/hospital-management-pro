<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
  if($_SESSION["category"]=="Doctor"){
    //Redirect user to welcome page
  header("location: welcomeDoctor.php");
  }
  else if($_SESSION["category"]=="Admin"){
    //Redirect user to welcome page
  header("location: welcomeAdmin.php");
  }
  else{
    //Redirect user to welcome page
  header("location: welcomePatient.php");
  }
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username,name, password,category,date FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username,$name,$hashed_password,$category,$date);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["name"] = $name;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["pwdDate"]=$date;
                            $_SESSION["category"]=$category;

                            if($category=="Doctor"){
                              //Redirect user to welcome page
                            header("location: welcomeDoctor.php");
                            }
                            else if($category=="Admin"){
                              //Redirect user to welcome page
                            header("location: welcomeAdmin.php");
                            }
                            else{
                              //Redirect user to welcome page
                            header("location: welcomePatient.php");
                            }
                            
                        }
                    }

                }

    }
}    


}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    
    <title>INTERNSHIP</title>



    <link rel="stylesheet" type="text/css" href="animate.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="wow.min.js"></script>
  <script>
    new WOW().init();
   </script>
   
  </head>
  
  <body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    <header class="toparea">
        <div class="container">
            <div class="row">
                  <div class="logo">
                      <div class="col-md-3 col-12">
                        <img src="tata.png" class="img-fluid">
                      </div>
                  </div>
                  <div class="title">
                      <div class="col-md-9 col-12">
                        <img src="ta.png" class="img-fluid">    
                      </div>
                  </div>
              </div>
          </div>
  
    </header>


  
      <nav class="fix">
		<div class="container">
			<div class="row">
        <div class="col-10"><nav class="navbar navbar-expand-lg navbar-light bg-light">
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <?php
                    include_once("nav.php");
                  ?>
                   
                </div>
              </nav>
            </div>
            <div class="col-2 mt-2">
              <button type="button" class="btn btn-light">HELP</button>
            </div>
          </div>

		</div>
  </nav>
 
  <div class="container login-container">
    <div class="row">
      <div class="col-md-6 ads">
        <img src="PP.JPG" class="img-fluid">
      </div>


      <div class="col-md-6 login-form">
        <div class="profile-img">
         <img src="ss.jpg" alt="profile_img" height="140px" width="140px;">
         </div>

        <h2>LOGIN</h2>
        <form action="" method="post">
        
  <div class="form-group">
    <label for="exampleInputEmail1">Aadhar No.</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" data-inputmask='"mask": "999999999999"' data-mask>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
  </div>
  <br><center>
    
  <button type="submit" class="btn btn-primary">LOGIN</button></center>
</form>
<br>
<center>
          
          
              
              <a href="register.php">New User? Click here to register yourself</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="jquery.inputmask.js" type="text/javascript"></script>
        <script src="jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                
            });
        </script>
        
  <!-- Footer -->
<footer class="lastarea">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 mr-auto my-md-4 my-0 mt-4 mb-1">

        <!-- Content -->
        <h5 class="font-weight-bold text-uppercase mb-4">TATA MOTORS Ltd.</h5>
        <p>
          Tata motors hospital is a 404 bedded multi-specialty DNB accredited Post Graduate Teaching hospital in Jamshedpur. This hospital has been continuously striving to offer the highest standard of services to patients with great empathy and humanity.

    </p>
      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 mx-auto my-md-4 my-0 mt-4 mb-1">

        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mb-4">About</h5>

        <ul class="list-unstyled">
          <li>
            <p>
              <a href="home.html">PROJECTS</a>
            </p>
          </li>
          <li>
            <p>
              <a href="home.html">ABOUT US</a>
            </p>
          </li>
          <li>
            <p>
              <a href="home.html">BLOG</a>
            </p>
          </li>
          <li>
            <p>
              <a href="homt.html">AWARDS</a>
            </p>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 mx-auto my-md-4 my-0 mt-4 mb-1">

        <!-- Contact details -->
        <h5 class="font-weight-bold text-uppercase mb-4">Address</h5>

        <ul class="list-unstyled">
         
            
          <li>
            <p>
              <i class="fa fa-envelope mr-3"></i> tatamotorsltd.com</p>
          </li>
          <li>
            <p>
              <i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
          </li>
          <li>
            <p>
              <i class="fa fa-print mr-3"></i> + 01 234 567 89</p>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 text-center mx-auto my-4">

        <!-- Social buttons -->
        <h5 class="font-weight-bold text-uppercase mb-4">Follow Us</h5>

        <!-- Facebook -->
        <a type="button" class="btn-floating btn-fb" style="font-size:23px;">
          <i class="fa fa-facebook"></i>
        </a><br>
        <!-- Twitter -->
        <a type="button" class="btn-floating btn-tw" style="font-size:23px;">
          <i class="fa fa-twitter"></i>
        </a><br>
        <!-- Google +-->
        <a type="button" class="btn-floating btn-gplus" style="font-size:23px;">
          <i class="fa fa-google-plus"></i>
        </a><br>
        <!-- Dribbble -->
        <a type="button" class="btn-floating btn-dribbble" style="font-size:23px;">
          <i class="fa fa-youtube"></i>
        </a><br>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="home.html"> TATA MOTORS Ltd.</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
 







  
 
  </body>
</html>

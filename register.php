<?php
require_once "config.php";

$username = $password = $confirm_password = $name = $phone = $email= $category= "";
$username_err = $password_err = $confirm_password_err =$name_err= $phone_err= $email_err= $category_err= "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  // echo print_r($_POST);
  // check if name is empty
      if(empty(trim($_POST["name"]))){
        $name_err = "<li>Name cannot be blank</li>";
    }
    elseif(strlen(trim($_POST['name'])) < 3){
      $name_err = "<li>Name cannot be less than 2 characters</li> ";
    }
    else{
      $name=$_POST["name"];
    }

// check if email is empty
if(empty(trim($_POST["email"]))){
  $email_err = "<li>email cannot be blank</li>";
}
elseif(strlen(trim($_POST['email'])) < 3){
$email_err = "<li>email cannot be less than 2 characters</li> ";
}
else{
$email=$_POST["email"];
}

// check if category is empty
if(empty(trim($_POST["category"]))){
  $category_err = "<li>please select the login type</li>";
}

else{
$category=$_POST["category"];
}

    // check if phone is empty
    if(empty(trim($_POST["phone"]))){
      $phone_err = "<li>phone no. cannot be blank</li>";
  }
  elseif(strlen(trim($_POST['phone'])) < 10){
    $phone_err = "<li>phone no. cannot be less than 10 characters</li> ";
  }
  else{
    $phone=$_POST["phone"];
  }

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "<li>Username cannot be blank</li>";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "<li>This username is already taken</li>"; 
                }
                else{
                    $username = trim($_POST['username']);
                    // echo $username;
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "<li>Passwords should match</li>";
}

// echo $username_err;
// echo $password_err;
// echo $confirm_password_err;
// If there were no errors, go ahead and insert into the database
// if(2>1)
// echo $name;
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($phone_err) && empty($email_err) && empty($category_err) )
{
  
    $sql = "INSERT INTO users (username, name, password, phone, email, category,date) VALUES (?, ?,?,?, ?, ?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
      
      // Set these parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT);
      $param_name=$name;
      $param_phone=$phone;
      $param_email=$email;
      $param_category=$category;
      // Set timezone
      date_default_timezone_set('Asia/Kolkata');
      $date=date("Y-m-d h:i:s");
      echo $param_name;
      // echo $param_username;
      // echo $param_password;
        mysqli_stmt_bind_param($stmt, "ississs", $param_username, $param_name, $param_password, $param_phone, $param_email, $param_category,$date);

        

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
           header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="csssign.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>sign up</title>
    <link rel="stylesheet" type="text/css" href="animate.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
           
          </div>

		</div>
  </nav>




  
  

  
    <?php
   if(empty(!$username_err) || !empty($password_err) || !empty($confirm_password_err) || !empty($name_err) || !empty($phone_err) || !empty($email_err) || !empty($category_err)){
    echo "<div class='alert alert-danger'><ul>";
    
    if(!empty($username_err))
    {
      echo $username_err;
    }
    if(!empty($name_err))
    {
      echo $name_err;
    }
    if(!empty($email_err))
    {
      echo $email_err;
    }
    if(!empty($category_err))
    {
      echo $category_err;
    }
    if(!empty($phone_err))
    {
      echo $phone_err;
    }
      if(!empty($password_err) )
      {
        echo $password_err;
      }
      if(!empty($confirm_password_err)){
        echo $confirm_password_err;
      }
      echo "</ul></div>";
   } 
      
    
    ?>
<body>

<div class="container login-container" mt="50">
    <div class="row">
      <div class="col-md-6 ads">
        <img src="reg.JPG" class="img-fluid">
      </div>


      <div class="col-md-6 login-form" center>
        

        
        <form action="" method="post">


<!-- <div class="formarea">
<div class="container">
            <div class="row">
              <form action="" method="post">


  <hr>
  <h2 mt="50">Please Register Here</h2>
  <hr>
  -->

  <ul type="none">
  <li>
      
      Name<input type="text" class="form-control" name="name"  >
  </li>
    
    <li>
      <label for="inputEmail4">Email</label>
      <input type="text" class="form-control" name="email" id="inputEmail4">
  </li>
    
    <li>
      <label for="inputEmail4">Mobile No.</label>
      <input type="text" class="form-control" name="phone" data-inputmask='"mask": "9999999999"' data-mask>
  </li>
    
    <li>
      <label for="inputEmail4">Aadhar No.</label>
      <input type="text" class="form-control" name="username" required  data-inputmask='"mask": "999999999999"' data-mask >
  </li>
    
    <li>
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name ="password" id="inputPassword4">
  </li>
    
  
  <li>
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" name ="confirm_password" id="inputPassword">
  </li>
    
    <li>
      <label for="inputState">Register as</label>
      <select id="inputState" class="form-control" name="category">
        <option selected>Choose...</option>
        <option value="Admin">Admin</option>
        <option value="Doctor">Doctor</option>
        <option value="Patient">Patient</option>
            </select>
  </li>
  
<br>
    <li>
  <button type="submit" class="btn btn-primary">&nbsp &nbsp REGISTER &nbsp &nbsp</button>
  
  </li>

  
</form>
</div>
</div></center>
  </div> -->


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


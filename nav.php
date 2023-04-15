<?php
echo"<ul class='navbar-nav mr-auto'>
<li class='nav-item'>
  <a class='nav-link' href='index.php'>Home<span class='sr-only'></span></a>
</li>

<li class='nav-item'>
<a class='nav-link' href='register.php'>Register</a>
</li>
<li class='nav-item'>
<a class='nav-link' href='login.php'>Login</a>
</li>";
// check if the user is already logged in
if(isset($_SESSION['username']))
{
echo"<li class='nav-item'>
<a class='nav-link' href='logout.php'>Logout</a>
</li>";

}

echo"</ul>";
?>
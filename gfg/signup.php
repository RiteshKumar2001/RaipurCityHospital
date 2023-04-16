<?php
$insert = false;
$update = false;
$delete = false;

$servername="localhost";
$username="root";
$password="";
$database= "vacci";
$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}
$showAlert = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $code = $_POST["code"];
    //$exists=false;
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }

    else{
    if(($password == $cpassword)  && ($code =="1111")){
       
  $sql ="INSERT INTO users ( username, password, date) values ('$username', '$password', current_timestamp())";
  $result = mysqli_query($conn, $sql);
  if($result){
    $showAlert = true;
  }
}
else{
    $showError = "Password do not match or Hospital code is invalid or username exists";
}
    }

}

?>


<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Raiur City Hospital</title>
  </head>
  <body>

  <?php require '_nav.php' ?>

  <?php
  if($showAlert){
  echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success! </strong> Your account is now created and you can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!  </strong> '. $showError. '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
  ?>


<div class="container my-4"><div class=" mx-5 container">
<h1 > SignUp to our Web Site</h1>
<form class="my-4" action="/gfg/signup.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">User Name</label>
    <input type="text" class="form-control" id="username" name ="username" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="code" class="form-label">Hospital Code</label>
    <input type="password" class="form-control" id="code" name="code" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
  </div>
  
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>

</div></div>







<br><br><br><br><br>
  <?php require 'foot.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>
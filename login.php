<?php 
$login = false;
$ShowError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'database2.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $sql = "Select * from data where username='$username' AND password='$password'";
    $sql = "Select * from data where username='$username'";
      $result = mysqli_query($conn,$sql);
      $num = mysqli_num_rows($result);
      if($num == 1){
        while ($row = mysqli_fetch_assoc($result)){
          if (password_verify($password, $row['password'])){

            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: welcome.php");
          }
          else{
            $ShowError = "Invalid Credentials";
          }
        
        }
      }
      else{
        $ShowError = "Invalid Credentials";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <?php require 'nav.php' ?>
    <?php
    if($login){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>success</strong> Your are logged in..
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';

    }
    if($ShowError){
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '.$ShowError.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';

    }
   
?>
<style>
  .cen{
    width: 800px;
    margin: 0 auto;
  }
</style>
<div class="cen">
    <div class="container my-4 col-md-8">
    <h1 class="text-center">Login to our website</h1>
    <form action="/vikalp/Login/login.php" method="post">
  <div class="form-group">
    <label for="username">username</label>
    <input type="text" maxlength="11" class="form-control" id="username" aria-describedby="emailHelp" name="username" placeholder="username">
    
  </div>
  <div class="form-group">
    <label for="password">password</label>
    <input type="password" maxlength="23" class="form-control" id="password" name="password" placeholder="password">
  </div>
  
  <!-- <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Login</button>
  </form>
    </div>
</div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    
  </body>
</html>
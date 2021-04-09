<?php 
session_start();
    if(isset($_SESSION['uname'])){
      header("Location: index_.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}
form{
  position: fixed;
  width:26%;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}
p{
    margin:0;
    font-size: 90%;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
    </style>
</head>
<body>
<form action="Process/checklogin.php" method="post">
  <?php 
      // $reply = (isset($_GET['reply'])?$_GET['reply']:"10");
      // if($reply === '10'){
      //   echo "<center><P>ชื่อผู้ใช้รหัสผ่านไม่ถูกต้อง</P></center>";
      // }
      if(isset($_GET['reply'])){
        echo "<center><P>ชื่อผู้ใช้รหัสผ่านไม่ถูกต้อง</P></center>";
      }
      if(isset($_GET['SujiectArea'])){
        $_SESSION['SujiectArea']=$_GET['SujiectArea'];
      }
  ?>
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="Password" required>
        
    <button type="submit">Login</button>
    <center><p>Not a member? <a href="register.php">Sign up now</a></center>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</body>
</html>
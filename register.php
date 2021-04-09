<?php 
session_start();
    if(isset($_SESSION['uname'])){
      session_unset();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function preview(filesimg) {
        var files = filesimg.files;
        oFiles = this.file;
       const imgdiv = document.getElementById("img");
       imgdiv.innerHTML = "";
       console.log("เข้าฟังชั่น");
        const img = document.createElement("img");
        img.src = URL.createObjectURL(files[0]);
        // img.height = 30;
        // img.width= 30;
        imgdiv.appendChild(img);
}
</script>
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
input[type=text], input[type=password] ,input[type=email],input[type=date] {
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
p{
    margin:0;
    font-size: 90%;
}
/* #img{
    height:50px;
    width:50px;
} */
#img img{
    border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn {
     width: 100%;
  }
}
    </style>
</head>
<body>
<form action="Process/register.php" method="post">
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
   <?php   
    if(isset($_GET['fail'])){
        if($_GET['fail'] == 1){
            echo "<center><h4>Usernameนี้มีผู้ใช้แล้ว</h4></center>";
        }
        elseif($_GET['fail'] == 2) {
            echo "<center><h4>Emailนี้มีผู้ใช้แล้ว</h4></center>";
        }
    }
       
  ?>
  <div class="container">
 
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="Password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="Password" required>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="profilename"><b>ProfileName</b></label>
    <input type="text" placeholder="Enter ProfileName" name="profilename" required>

    <label for="Birthday"><b>Birthday</b></label>
    <input type="date" name="Birthday" required>
    <input type="file" id="gallery-photo-add" name="files" onchange="preview(this)">
        <div id="img">

        </div>
        
        
    <button type="submit">Register</button>
    <a href="login.php"><button type="button" class="cancelbtn">Cancel</button></a>
  </div>
</form>
</body>
</html>
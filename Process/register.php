<?php  
session_start();
include "../Connect.php";
    $uname = $_POST['uname'];
    $email = $_POST['email'];
$chaekuname = "SELECT userID FROM user WHERE UserName='$uname'";
$checkemail = "SELECT Email FROM user WHERE Email='$email'";
$queryuname = mysqli_query($conn,$chaekuname);
$queryemail = mysqli_query($conn, $checkemail);
// print_r($queryuname);
if(mysqli_num_rows($queryuname) >= 1) {
    header("Location: ../register.php?fail=1");
}elseif(mysqli_num_rows($queryemail) >= 1){
    header("Location: ../register.php?fail=2");
}else{
    $password = $_POST['Password'];
    $profilename = $_POST['profilename'];
    $barthday = $_POST['Birthday'];
    $datetime =date('Y-m-d H:i:s');
    $Profile = "INSERT INTO user (UserName,Password,Name,Email,UserDate,Birthday)
    VALUE ($uname,$password,'$profilename','$email','$datetime','$barthday')";
    if($conn ->query($Profile) === TRUE){
            $SELECTID ="SELECT userID FROM user WHERE UserName='$uname' AND Password='$password'";
            $query = mysqli_query($conn,$SELECTID);
            $user = mysqli_fetch_array($query);
            $userID = $user['userID'];
            $_SESSION['uname']=$profilename;
            $_SESSION['USERID']=$userID;
        // header("Location: ../login.php");
    }
  } 
    
?>
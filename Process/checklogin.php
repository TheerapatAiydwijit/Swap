<?php  
session_start();
include '../Connect.php';
    $uname = $_POST['uname'];
    $Password = $_POST['Password'];
    $selectcheck = "SELECT * FROM USER WHERE UserName='$uname' AND Password ='$Password'";
    $result = mysqli_query($conn, $selectcheck);
    
    if ($result->num_rows > 0) {
        $resultS = mysqli_fetch_array($result);
        $_SESSION['uname']=$resultS['Name'];
        $_SESSION['USERID']=$resultS['userID'];
        if(isset($_SESSION['SujiectArea'])){
            $link = "../SujiectArea.php?PostID=";
            $link .= $_SESSION['SujiectArea'];
            header("Location: $link");
        }
        else{
            header('Location: ../index_.php');
        }
    }else{
        header('Location: ../login.php?reply=0');
    }

?>
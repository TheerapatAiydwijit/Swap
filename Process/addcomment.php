<?php 
include '../Connect.php'; 
    $comment = $_POST['comment'];
    // echo $comment;
    $PostID = $_POST['PostID'];
    $username = $_POST['username'];
    $userID = $_POST['userID'];
    // echo $PostID;
    date_default_timezone_set('asia/bangkok');
    $datetime =date('Y:m:d H:i:s');
    $selectorderCom = "SELECT OrderCom FROM comments WHERE PostID='$PostID'";
    $query = mysqli_query($conn, $selectorderCom);
   $row = mysqli_num_rows ($query);
   $numrow = $row + 1;
    $insent = "INSERT INTO comments (PostID,userID,ComDetail,OrderOnPost,Date)
    VALUE ('$PostID','$userID','$comment','$numrow','$datetime')";
    $queryfs = mysqli_query($conn, $insent);
    $link = "../SujiectArea.php?PostID=";
    $link .= $PostID;
    header("Location: $link");
?>
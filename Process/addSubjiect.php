<?php 
session_start();
    include '../Connect.php';
    $Topic =$_POST['Topic'];
    $Detail=$_POST['Detail'];
    $UserPost = $_SESSION['USERID'];
    date_default_timezone_set('asia/bangkok');
    $datetime =date('Y:m:d H:i:s');
    // echo $datetime;
    $type = (isset($_POST['type'])?$_POST['type']:"");
    $insert ="INSERT INTO postdetail (Topic,Detail,UserPost,Date) VALUES ('$Topic','$Detail','$UserPost','$datetime')";
    if ($conn->query($insert) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $insert . "<br>" . $conn->error;
      }

    $SELECT = "SELECT PostID FROM Postdetail WHERE UserPost='$UserPost' AND Date='$datetime'";
    $resultPID = mysqli_query($conn,$SELECT);
    $resultPids = mysqli_fetch_array($resultPID);
    $PostID =  $resultPids['PostID'];
    foreach($type as $value){
        $insertTypr = "INSERT INTO categoryonpost (PostID,ID)
        VALUE ($PostID,$value)";
        $query =  mysqli_query($conn,$insertTypr);
    }
    
    // $result = mysqli_query($conn, $insert);
    // print_r($_SESSION);
    // print_r($type);
?>
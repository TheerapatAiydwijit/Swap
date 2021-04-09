<?php
include '../Connect.php';
    $PostID = $_GET['PostID'];
    $delete = "DELETE FROM postdetail WHERE PostID='$PostID'";
    if (mysqli_query($conn, $delete)) {
        header("Location: ../Profile.php");
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
?>
<?php
include '../Connect.php';
    $commentID = $_GET['OrderCom'];
    $PostID = $_GET['PostID'];
    $sqlDelete = "DELETE FROM comments WHERE OrderCom='$commentID'";
    if (mysqli_query($conn, $sqlDelete)) {
        $link = "../SujiectArea.php?PostID=";
        $link .= $PostID;
        header("Location: $link");
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }

?>
<?php
session_start();
if(isset($_SESSION['uname'])){
    session_unset();
    header('Location: index_.php');
}else{
    header('Location: login.php');
}

?>
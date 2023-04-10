<?php
require_once('./db_connect.php');
if(isset($_POST['codelike'])){
    $code = $_POST['codelike'];
    $like = $_POST['nlike'];
    $sql = "UPDATE video_uploads SET `like` = '$like' WHERE code = '$code'";

    if(mysqli_query($conn, $sql)){
    
    } 
  
}
// xuly dislike
if(isset($_POST['codeDlike'])){
    $code = $_POST['codeDlike'];
    $dlike = $_POST['nDlike'];
    $sql = "UPDATE video_uploads SET `dislike` = '$dlike' WHERE code = '$code'";

    if(mysqli_query($conn, $sql)){
    //  echo 'dislike thanh cong';
    } 
  
}
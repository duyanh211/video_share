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


// subcribe
if(isset($_POST['id_Channel'])){
    $id_Channel = $_POST['id_Channel'];
    $id_Subcr = $_POST['id_Subcr'];
    $sql = "INSERT INTO `subcribe` VALUES ($id_Subcr,$id_Channel)";

    if(mysqli_query($conn, $sql)){
        echo "Đăng ký thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
   }
}

// unsub

if(isset($_POST['idCN_unSub'])){
    $idCN_unSub = $_POST['idCN_unSub'];
    $idUser_unSub = $_POST['idUser_unSub'];
    $sql = "DELETE FROM `subcribe` WHERE id_subcriber = $idUser_unSub AND id_channel = $idCN_unSub";

    if(mysqli_query($conn, $sql)){
        echo "Huỷ đăng ký thành công";
    }  else {
	 	echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

<?php

$conn=new mysqli("localhost", "root", "", "sharingvideo");

if (!$conn) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Lưu trữ bình luận mới vào cơ sở dữ liệu
if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $id_user = $_POST['iduser']; // ID của người dùng đã đăng nhập
    $id_video = $_POST['id']; // ID của video mà bình luận liên quan đến

    $sql = "INSERT INTO comments (id_user, id_video, content, date_create)
            VALUES ('$id_user', '$id_video', '$comment', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "Bình luận của bạn đã được lưu trữ.";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Đóng kết nối tới cơ sở dữ liệu
mysqli_close($conn);
?>

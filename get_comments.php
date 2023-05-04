<?php

$conn=new mysqli("localhost", "root", "", "sharingvideo");

if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}
/*
// Lấy tất cả bình luận từ cơ sở dữ liệu
//$sql = "SELECT * FROM comments ORDER BY date_create DESC";
	$sql = "SELECT c.id, c.content, c.date_create, u.firstname, u.lastname, v.title 
			FROM comments c
			JOIN users u ON c.id_user = u.id
			JOIN video_uploads v ON c.id_video = v.id";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// Định dạng danh sách bình luận
		while ($row = mysqli_fetch_assoc($result)) {
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$comment = $row['content'];
			$created_at = $row['date_create'];
			$prof_pic = 'https://www.gravatar.com/avatar/' . '?s=60&d=mp';
			echo '<div class="comment" style="margin-bottom: 20px">';
				echo '<div class="avatar-box">';
					echo '<img class="avatar" src="' . $prof_pic . '" alt="Avatar">';
				echo '</div>';
				echo '<div class="comment-box">';
					echo '<h6><b>' . $firstname . ' ' . $lastname . ' </b></h6>';
					echo '<h5>' . $comment . '</h5>';
					echo '<small>' . $created_at . '</small>';
				echo '</div>';
			echo '</div>';
		}
	} else {
		echo "<p>Không có bình luận nào.</p>";
		}
*/ 
if (isset($_GET['id_video'])) {
	$video_id = $_GET['id_video'];
	$sql = "SELECT c.id, c.content, c.date_create, u.firstname, u.lastname, v.title 
			FROM comments c
			JOIN users u ON c.id_user = u.id
			JOIN video_uploads v ON c.id_video = v.id
			WHERE c.id_video = {$video_id}";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// Định dạng danh sách bình luận
		while ($row = mysqli_fetch_assoc($result)) {
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$comment = $row['content'];
			$created_at = $row['date_create'];
			$prof_pic = 'https://www.gravatar.com/avatar/' . md5(strtolower($lastname)) . '?s=60&d=mp';
			echo '<div class="comment" style="margin-bottom: 20px">';
				echo '<div class="avatar-box">';
					echo '<img class="avatar" src="' . $prof_pic . '" alt="Avatar">';
				echo '</div>';
				echo '<div class="comment-box">';
					echo '<h6><b>' . $firstname . ' ' . $lastname . ' </b></h6>';
					echo '<h5>' . $comment . '</h5>';
					echo '<small>' . $created_at . '</small>';
				echo '</div>';
			echo '</div>';
		}
	} else {
		echo "<p>Không có bình luận nào.</p>";
		}
} else {
    // Xử lý trường hợp không tồn tại tham số id
    echo "Không tìm thấy video cần xem bình luận.";
	}

// Đóng kết nối tới cơ sở dữ liệu
mysqli_close($conn);
?>

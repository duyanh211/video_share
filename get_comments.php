<?php

$conn=new mysqli("localhost", "root", "", "sharingvideo");

if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

	$sql = "SELECT * FROM comments c, users u
			WHERE c.id_user = u.id";
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

/*
if (isset($_GET['id'])) {
	$video_id = $_GET['id'];
	$sql = "SELECT * FROM comments c, users u, video_uploads v
			WHERE c.id_user = u.id AND c.id_video = v.id AND v.id = {$video_id}";
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
    echo "Không tìm thấy video cần xem bình luận.";
	}
*/
// Đóng kết nối tới cơ sở dữ liệu
mysqli_close($conn);
?>

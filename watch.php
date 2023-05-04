<?php include 'db_connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>


<?php
 function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
$upload = $conn->query("SELECT up.*,concat(u.firstname,' ',u.lastname) as name,u.avatar FROM video_uploads up inner join users u on u.id =up.user_id where up.code = '{$_GET['code']}' ");
foreach ($upload->fetch_array() as $k => $v) {
	$$k = $v;
}


if(isset($_SESSION['login_id'])){
	if($_SESSION['login_id'] != $user_id){
		$chk = $conn->query("SELECT * FROM views where upload_id = $id and user_id ={$_SESSION['login_id']} ")->num_rows;
		if($chk <= 0){
			$conn->query("INSERT INTO views set upload_id = $id , user_id = {$_SESSION['login_id']}");
		}
	}
	
}
$views = $conn->query("SELECT * FROM views where upload_id = $id ")->num_rows;
$conn->query("UPDATE video_uploads set total_views = $views where code = '$code'");
  




	


// if(isset($_POST['submit'])){
// 		$comment = $_POST['comment'];
// 		$Conn-> query("INSERT INTO comments (id_user,id_video, content, date_create) VALUES ( {$_SESSION['login_id']}, $id, '$comment', CURRENT_TIMESTAMP)");
// 	}


 ?>


 <style type="text/css">
 	.suggested-img{
 		width: calc(30%);
 		height: 15vh;
 		display:flex;
 		justify-content: center;
 		align-items: center;
 		background: black
 	}
 	.suggested-details{
 		width: calc(70%);
 	}
 	.suggested-img video{
 		width: calc(100%);
 		height: calc(100%);
 	}
 	.suggested:hover{
 		background: #00adff1c;
 	}
 	#vid-watch{
 		max-height: 80vh
 	}
	.card{
		height: 2000px;
	}

	.underTitle{
		display: flex;
		justify-content: space-between;
	}

	.likeAndDis{
		display: flex;
		flex-wrap: wrap;
		
	}

	.likeAndDis div {
		margin-right: 20px;
		display: flex;
		Flex-direction:  column;
		align-items: center;
		flex-wrap: wrap;
	}

	.likeAndDis div i {
		cursor: pointer;
	}
	/* .likeAndDis div i:hover {
		color: blue;
	} */

	
	.description{
		margin-top:12px; 
		border-radius: 5px; 
		background-color:#EEEEEE;"
	}
	
	.description h5{
		margin:8px;
	}
	
	.description p{
		margin:8px;
	}
	
	.avtiveBlue{
		color: blue;
	}
	
	.comment-box {
		font-family: Arial, Helvetica, sans-serif;
		margin: 40px 20px;
		max-width: auto;
	}

	.comment-heading {
		font-size: 20px;
		margin: 20px 0;
	}

	.comment-list {
		max-height: 400px;
		overflow-y: auto;
	}

	.avatar-box {
		float: left;
		margin-right: 10px;
	}

	.avatar {
		border-radius: 50%;
		width: 60px;
		height: 60px;
	}

	.comment-input-box {
		overflow: hidden;
	}

	.comment-input {
		width: 100%;
		resize: none;
		padding: 10px;
		margin-top: 5px;
		margin-bottom: 5px;
		border-radius: 5px;
		box-sizing: border-box;
	}

	.comment-submit {
		display: inline-block;
		width: 60px;
		height: 40px;
		text-align: center;
		line-height: 40px;
		background-color: #007bff;
		color: #fff;
		border-radius: 5px;
		margin-bottom: 50px;
		text-decoration: none;
	}

	.comment-submit:hover {
		background-color: #0062cc;
		cursor: pointer;
	}


 </style>
<div class="container-fluid py-2">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-8">
						<div class="d-block w-100 vid-watch-feild bg-dark border border-dark p-0" style="border-width: 2px">
							<video class="w-100" autoplay="true" controls id="vid-watch">
								<source src="<?php echo "assets/uploads/videos/".$video_path ?>">
							</video>
						</div>
						<div class="col-md-12 py-2">
							<div class="row">
								<h5 class="text-dark"><b><?php echo $title ?></b></h5>
							</div>
						</div>
						<div class="col-md-12 underTitle">
							<div class="row">
								<span class="badge badge-white"><b><?php echo date("M d, Y",strtotime($date_created)) ?></b></span>
								<span class="badge badge-primary" style="height: 20px;"><b><?php echo $views.($views > 1 ? ' views':' view') ?></b></span>
							</div>

							<!-- like btn -->
							<?php 
								$conn = mysqli_connect("localhost", "root", "", "sharingvideo");
								$sql = "SELECT * FROM `video_uploads` WHERE id= $id";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_array($result, 1);

							?>
							<div class="likeAndDis">
								<div class="btnLike"><i id="btnLike" class="material-icons">thumb_up</i> <p id="valLike"><?php echo $row['like']?></p>  </div>
								<div class="btnDis"><i id="btnDisLike" class="material-icons">thumb_down</i >  <p id="valDisLike"><?php echo $row['dislike']?></p></div>
							</div>

						</div>
						<hr>
						<div class="col-md-12">
							<div class="d-flex w-100 align-items-center">
								<div class="d-flex w-100 align-items-center">
									<?php if(!empty($avatar)): ?>
										<img src="assets/uploads/<?php echo $avatar ?>" class="rounded-circle" width="50px" height="50px" alt="">
									<?php else: ?>
										<span class="d-flex justify-content-center bg-primary align-items center rounded-circle border py-2 px-3" ><h3 class="text-white m-0"><b><?php echo substr($name,0,1) ?></h3></b></span>
									<?php endif; ?>
										<h6 class="mx-3"><b><?php echo $name ?></b></h6>
								</div>

									<!-- btn subcribe -->
									<?php 
										$idsubcriber = $_SESSION['login_id'];
										$sql = "SELECT * FROM `subcribe` WHERE id_subcriber= $idsubcriber and id_channel = $id";
										$result = mysqli_query($conn, $sql);
										$idcn =  json_encode($id);
										$row = mysqli_fetch_assoc($result);
										if ($row > 0) {
											?>
											<button id="unSubcribe" class="btn" value="<?php echo $_SESSION['login_id']; ?>" style="width: 140px; background: #ccc;" onclick = "unSubcribe()">Đã dăng ký</button>
											<?php
										  } else {
											?>
												<button id="subcribe" class="btn btn-danger" value="<?php echo $_SESSION['login_id']; ?>" style="width: 140px;" onclick = "subcribe()"> Đăng ký </button>
											
											<?php
										  }
									?>
							</div>
							<div class="description">
								<h5><b>Description</b></h5>
								<p><?php echo str_replace(array("\n","\r"),'<br/>',$description) ?></p>
							</div>
						</div>
							<div style="height: 100px; width: 500px: z-index: 1; margin-top:20px; position: relative;"> 
<!--
								<form action="./watch.php" method="post">
									<div class="mb-3 mt-3">
										<h1>Bình luận</h1>
									<textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
									</div>
									<button type="submit" class="btn btn-primary btn-cus" name = "submit">Submit</button>
								</form>
-->
								<div class="comment-box">
									<h3 class="comment-heading"><b>Comment:</b></h3>
									<form id="comment-form">
										<div class="avatar-box">
											<img class="avatar" src="https://www.gravatar.com/avatar/?s=60&d=mp" alt="Avatar">
										</div>
										<div class="comment-input-box">
											<textarea id="comment-input" class="comment-input" rows="3" placeholder="Nhận xét của bạn"></textarea>
											<a id="comment-submit" class="comment-submit" href="#">Gửi</a>
										</div>
									</form>
									<div class="comment-list">
										<!-- Danh sách bình luận sẽ được hiển thị tại đây -->
									</div>
								</div>
							</div>
					</div>
					<div class="col-md-4">
						<?php 
							$qry = $conn->query("SELECT * FROM video_uploads where id !=$id order by total_views asc,rand() limit 10");
							while($row= $qry->fetch_assoc()):
						?>
						<a class="d-flex w-100 border-bottom pb-1 suggested" href="index.php?page=watch&code=<?php echo $row['code'] ?>">
							<div class="img-thumbnail suggested-img border-dark border" poster="assets/uploads/thumbnail/<?php echo $row['thumbnail_path'] ?>">
								<video class="img-fluid" id="<?php echo $row['code'] ?>" muted>
									<source src="assets/uploads/videos/<?php echo $row['video_path'] ?>" alt="" >
								</video>
							</div>
							<div class="suggested-details px-2 py-2">
								<h6 class="truncate-2 text-dark"><b><?php echo $row['title'] ?></b></h6>
								<small class="text-muted"><i>Posted:<?php echo date("M, d Y",strtotime($row['date_created'])) ?></i></small>
							</div>
						</a>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="./jquery.js"> </script> 
<script>
	$('.suggested').hover(function(){
		$(this).addClass('active')
		var vid = $(this).find('video')
		var id = vid.get(0).id;
			setTimeout(function(){
				vid.trigger('play')
				document.getElementById(id).playbackRate = 2.0
			},500)
	})
	$('.suggested').mouseout(function(){
		var vid = $(this).find('video')
			setTimeout(function(){
				vid.trigger('pause')
			},500)
	})


	const S = document.querySelector.bind(document)
	const SS = document.querySelectorAll.bind(document)

	var like = S('#btnLike')
	var dislike = S('#btnDisLike')
	var valLike = S('#valLike')
	var valDisLike = S('#valDisLike')

	var nuLike = Number(valLike.innerText)
	var nuDisLike = Number(valDisLike.innerText)

<?php 
	if(isset($_SESSION['login_id'])){
	?>
	var islike = true
	var isDisliked = true
	 like.onclick= function(){
		if(like.classList.contains('avtiveBlue')){
			like.classList.remove('avtiveBlue')
			nuLike -= 1
			valLike.innerText = nuLike
		} else {
			nuLike += 1
			valLike.innerText = nuLike
			like.classList.add('avtiveBlue')
			dislike.classList.remove('avtiveBlue')
			islike = false
		}
		if(!isDisliked){
		nuDisLike -= 1
		valDisLike.innerText = nuDisLike
		isDisliked = true
	}

	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	var code = urlParams.get('code');
	
	
	$(document).ready(function(){
		var data = {
			codelike: code,
			nlike: nuLike
		};
		
		$.ajax({
			url: 'update.php',
			type: 'post',
			data: data, 
			success: function(response){
				//  alert(response);
			}
		});
	});
}


dislike.onclick= function(){
	if(dislike.classList.contains('avtiveBlue')){
		dislike.classList.remove('avtiveBlue')
		nuDisLike -= 1
		valDisLike.innerText = nuDisLike
	} else {
		nuDisLike += 1
		valDisLike.innerText = nuDisLike
		dislike.classList.add('avtiveBlue')
		like.classList.remove('avtiveBlue')
		isDisliked = false
	}
	if(!islike){
		nuLike -= 1
		valLike.innerText = nuLike
		islike = true
	}

	const urlParams = new URLSearchParams(window.location.search);
	var code = urlParams.get('code');
	// console.log(code)
	
	$(document).ready(function(){
		var data = {
			codeDlike: code,
			nDlike: nuDisLike
		};
		
		$.ajax({
			url: 'update.php',
			type: 'post',
			data: data, 
			success: function(response){
				//  alert(response);
			}
		});
	});
	}

	// subcribe
  var $idcn  = <?php echo $idcn; ?>;
	function subcribe(){
		$(document).ready(function(){
			var data = {
				id_Channel: $idcn,
				id_Subcr: $('#subcribe').val()
			};
			// console.log(data);
			$.ajax({
				url: 'update.php',
				type: 'post',
				data: data,
				success: function(rsp){
					alert(rsp)
					location.reload();
				}
			})
		})
	}

	//UnSubcribe
	function unSubcribe(){
		$(document).ready(function(){
			var data = {
				idCN_unSub: $idcn,
				idUser_unSub: $('#unSubcribe').val()
			}
			// console.log(data);
			$.ajax({
				url: 'update.php',
				type: 'post',
				data: data,
				success: function(rsp){
					alert(rsp)
					location.reload();
				}
			})


		})
	}


<?php

	} else {
	?>
	like.onclick= function(){
			alert("hay dang nhap")
	}
	dislike.onclick = function(){
		alert("hay dang nhap")
	}
	<?php
	}
?>

// Gửi bình luận mới lên máy chủ và lưu trữ vào cơ sở dữ liệu
function addComment() {
  var commentInput = $('#comment-input').val();

  if (commentInput == '') {
    return false;
  }

  $.ajax({
    type: "POST",
    url: "add_comment.php",
    data: {
      comment: commentInput
    },
    async: true,
    cache: false,
    success: function(data) {
      getComments();
      $('#comment-input').val('');
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      console.log(textStatus + ": " + errorThrown);
    }
  });
}

$(document).ready(function() {
  // Khởi tạo danh sách bình luận
  getComments();

  // Khi người dùng nhấn Gửi, gửi bình luận lên máy chủ và lưu trữ vào cơ sở dữ liệu
  $('#comment-submit').on('click', function(e) {
    e.preventDefault();
    addComment();
  });
});

//Lấy danh sách bình luận từ cơ sở dữ liệu
function getComments() {
  $.ajax({
    type: "POST",
    url: "get_comments.php",
    async: true,
    cache: false,
    success: function(data) {
      $('.comment-list').html(data);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      console.log(textStatus + ": " + errorThrown);
    }
  });
}
		
	
</script>
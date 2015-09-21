<?php
	$id = $_GET['id'];
	$mysqli = new mysqli('localhost', 'mysql_account', 'mysql_password', 'db_guestbook');
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$sql = $mysqli->prepare("SELECT * FROM `reply` WHERE id = ?");
	$sql->bind_param('s', $id);
	$sql->execute();
	$reply = $sql->get_result();
	$sql->close();
	$row = $reply->fetch_row();
	$sql2 = $mysqli->prepare("SELECT * FROM `message` WHERE id = ?");
	$sql2->bind_param('s', $row[1]);
	$sql2->execute();
	$message = $sql2->get_result();
	$sql2->close();
	$row2 = $message->fetch_row();
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Edit Reply</title>
	<link rel="stylesheet" type="text/css" href="css/reply_edit.css">
	<style>
		body {
			background-image: url("source/background.png");
		}
	</style>
</head>
<body>
	<div id="content">
		<div class="post">
			<div class="poster"><?php echo $row2[1]; ?></div>
			<div class="topic"><?php echo $row2[2]; ?></div>
			<div class="message"><?php echo $row2[3]; ?></div>
			<div class="time"><?php echo $row2[4]; ?></div>
			<div class="reply">
				<div class="reply_name"><?php echo $row[2]; ?></div>
				<div class="reply_content"><?php echo $row[3]; ?></div>
				<div class="reply_time"><?php echo $row[4]; ?></div>
			</div>
			<?php
				echo "<form action=\"reply_edit_finish.php?id=".$id."\"method=\"POST\" class=\"replyform\">";
				echo "<input type=\"text\" class=\"reply_input\" name=\"reply\" placeholder=\"Edit your reply here ...\">";
				echo "<input type=\"submit\" value=\"Submit\" class=\"replybtn\">";
				echo "</form>";
			?>
		</div>
	</div>
</body>
<html>

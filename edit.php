<?php
	$id = $_GET['id'];
	$mysqli = new mysqli('localhost', 'mysql_account', 'mysql_password', 'db_guestbook');	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$sql = $mysqli->prepare("SELECT `title`,`content` FROM `message` WHERE id = ?");
	$sql->bind_param('s', $id);
	$sql->execute();
	$result = $sql->get_result();
	$sql->close();
	$row=$result->fetch_row();
	$row[1]=str_replace("<br>","",$row[1]);
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/edit.css">
		<title>Edit Post</title>
		<style>
			body {
				background-image: url("source/background.png");
			}
		</style>
	</head>
	<body>
		<div id="content">
			<form action="edit_finish.php?id=<?php echo $id ?>" method="POST" id="postform">
				<h1>Edit Post</h1>
				<span class="text">Title:</span>
				<br>
				<input type="text" id="title" name="title" value="<?php echo $row[0] ?>" maxlength="20">
				<br>
				<span class="text">Content:</span>
				<br>
				<textarea id="message" name="content"><?php echo $row[1] ?></textarea>
				<br>
				<input type="submit" value="Submit" id="submit">
			</form>
		</div>
	</body>
</html>

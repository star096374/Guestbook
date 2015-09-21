<?php
	session_start();
	/*function rAddSlashes(&$data)
	{
		if(!get_magic_quotes_gpc())
		{
			return is_array($data)?array_map('rAddSlashes',$data):addslashes($data);
		}
		else
		{
			return $data;
		}
	}*/
	$id = $_GET['id'];
	//$id = rAddSlashes($id);
	$mysqli = new mysqli('localhost', 'mysql_account', 'mysql_password', 'db_guestbook');
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$sql=$mysqli->prepare("SELECT `poster` FROM `reply` WHERE id = ?");
	$sql->bind_param('s', $id);
	$sql->execute();
	$result = $sql->get_result();
	$sql->close();
	$row = $result->fetch_row();
	if (isset($_SESSION['account'])) {
		if ($row[0] == $_SESSION['account']) {
			$del=$mysqli->prepare("DELETE FROM `reply` WHERE id = ?");
			$del->bind_param('s', $id);
			if ($del->execute())
			{
				echo "<script>";
				echo "alert('Delete Success!')";
				echo "</script>";
				echo "<script>";
				echo "location.href='index.php'";
				echo "</script>";
			}
			else
			{
				echo "<script>";
				echo "alert('Something wrong happened.')";
				echo "</script>";
			}
		}
		else {
			echo "<script>";
			echo "alert('You are not the poster of this reply.')";
			echo "</script>";
			echo "<script>";
			echo "location.href='index.php'";
			echo "</script>";
		}
	}
	else {
		echo "<script>";
		echo "alert('You have to log in!')";
		echo "</script>";
		echo "<script>";
		echo "location.href='index.php'";
		echo "</script>";
	}
?>

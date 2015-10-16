<?php
    session_start();
    $mysqli = new mysqli('localhost', 'mysql_account', 'mysql_password', 'db_guestbook');
    if(mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $id = $_GET['id'];
    $reply = $_POST['reply'];
    if ($reply != NULL) {
        $stmt = $mysqli->prepare("INSERT INTO `reply`(postid, name, content, time, poster) VALUES (?, ?, ?, now(), ?)");
        $stmt->bind_param('isss', $id, $_SESSION['username'], $reply, $_SESSION['account']);
        $stmt->execute();
        $stmt->close();
    }
    else
    {
        echo "<script>";
        echo "alert(\"Please check and try again.\")";
        echo "</script>";
    }
?>

<script>
    location.href="index.php";
</script>

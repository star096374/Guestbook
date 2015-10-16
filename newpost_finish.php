<?php
    session_start();
    $mysqli = new mysqli('localhost', 'mysql_account', 'mysql_password', 'db_guestbook');
    if(mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    /*function DeleteHtml($str)
    {
        $str=trim($str);
        $str=strip_tags($str);
        return $str;
    }*/
    $name=$_SESSION['username'];
    $title=$_POST["title"];
    $content=$_POST["content"];
    $poster=$_SESSION['account'];
    /*$title=DeleteHtml($title);
    $content=DeleteHtml($content);
    $title=rAddSlashes($title);
    $content=rAddSlashes($content);*/
    $content=str_replace("\n",'<br>',$content);
    if($title != null && $content != null)
    {
        $stmt = $mysqli->prepare("INSERT INTO `message`(name, title, content, time, poster) VALUES (?, ?, ?, now(), ?)");
        $stmt->bind_param('ssss', $name, $title, $content, $poster);
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

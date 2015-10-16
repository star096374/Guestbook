<?php
    session_start();
    /*function DeleteHtml($str)
    {
        $str=trim($str);
        $str=strip_tags($str);
        return $str;
    }
    function rAddSlashes(&$data)
    {
    if(!get_magic_quotes_gpc())
    {
        return is_array($data)?array_map('rAddSlashes',$data):addslashes($data);
    }
    else
    {
        return $data;
    }*/
    $id = $_GET['id'];
    $topic = $_POST['title'];
    $message = $_POST['content'];
    /*$topic=DeleteHtml($topic);
    $message=DeleteHtml($message);
    $topic=rAddSlashes($topic);
    $message=rAddSlashes($message);*/
    $message = str_replace("\n", "<br>", $message);
    $mysqli = new mysqli('localhost', 'mysql_account', 'mysql_password', 'db_guestbook');
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $sql=$mysqli->prepare("SELECT `poster` FROM `message` WHERE id = ?");
    $sql->bind_param('s', $id);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    $row = $result->fetch_row();
    if (isset($_SESSION['account'])) {
        if ($row[0] == $_SESSION['account'] && $topic != NULL && $message != NULL) {
            $edit=$mysqli->prepare("UPDATE `message` set `title`= ?, `content`= ?, `time` = now() WHERE id= ? ");
            $edit->bind_param('sss', $topic, $message, $id);
            if ($edit->execute()) {
                echo "<script>";
                echo "alert('Edit Success!')";
                echo "</script>";
                echo "<script>";
                echo "location.href='index.php'";
                echo "</script>";
            }
            else {
                echo "<script>";
                echo "alert('Something wrong happened.')";
                echo "</script>";
            }
        }
        else {
            echo "<script>";
            echo "alert('You are not the poster of this post, or the title or content is empty.')";
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

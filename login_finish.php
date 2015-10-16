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
    $id=$_POST['account'];
    $pw=$_POST['password'];
    /*$id=DeleteHtml($id);
    $pw=DeleteHtml($pw);
    $id=rAddSlashes($id);
    $pw=rAddSlashes($pw);
    $salt="helloworld";
    $pw=md5($pw+$salt);*/
    $salt="guestbook";
    $pw=md5($salt.$pw);
    $sql = $mysqli->prepare("SELECT * FROM `users` WHERE account = ?");
    $sql->bind_param('s', $id);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    $row = $result->fetch_row();
    if($id != null && $pw != null && $row[1] == $id && $row[2] == $pw)
    {
        $_SESSION['account'] = $id;
        $_SESSION['username'] = $row[3];
        echo "<script>";
        echo "alert('Login Success!')";
        echo "</script>";
    }
    else
    {
        echo "<script>";
        echo "alert('Login Failed!')";
        echo "</script>";
    }
?>

<script>
    location.href="index.php";
</script>

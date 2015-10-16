<?php
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
        }
    }*/ 
    $id = $_POST['account'];
    $pw = $_POST['password'];
    $pw2 = $_POST['password2'];
    $name = $_POST['username'];
    $email= $_POST['email'];
    /*$id=DeleteHtml($id);
    $pw=DeleteHtml($pw);
    $pw2=DeleteHtml($pw2);
    $name=DeleteHtml($name);
    $id=rAddSlashes($id);
    $pw=rAddSlashes($pw);
    $pw2=rAddSlashes($pw2);
    $name=rAddSlashes($name);*/
    $sql = $mysqli->prepare("SELECT * FROM `users` WHERE account = ?");
    $sql->bind_param('s', $id);
    $sql->execute(); 
    $sql->store_result();
    $result = $sql->num_rows;
    $sql->close();
    if($id != null && $result == 0 && $pw != null && $pw2 != null && $pw == $pw2 && $name != null && $email != null)
    {
        $salt = "guestbook";
        $pw = md5($salt.$pw);
        $stmt = $mysqli->prepare("INSERT INTO `users`(account, password, username, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $id, $pw, $name, $email);
        if($stmt->execute())
        {
            $stmt->close();
            echo "<script>";
            echo "alert('Register Success!')";
            echo "</script>";
            echo "<script>";
            echo "location.href='index.php'";
            echo "</script>";
        }
        else
        {
            echo "<script>";
            echo "alert('Register Failed.')";
            echo "</script>";
            echo "<script>";
            echo "location.href='register.php'";
            echo "</script>";
        }
    }
    else
    {
        echo "<script>";
        echo "alert('Please check and try again.')";
        echo "</script>";
        echo "<script>";
        echo "location.href='register.php'";
        echo "</script>";
    }
?>

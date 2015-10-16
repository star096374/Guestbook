<?php
    session_start();
    $mysqli = new mysqli('localhost', 'mysql_account', 'mysql_password', 'db_guestbook');
    if(mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Guestbook</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <style>
        body {
            margin-left: 0px;
            margin-right: 0px;
            background-image: url("source/background.png");
        }
    </style>
</head>
<body>
    <div id="nav">
        <span class="sometext">AzureNight's Guestbook</span>
        <?php if(isset($_SESSION['account'])) {
            echo "<a href=\"logout.php\" class=\"submitbtn\">Logout</a>";
            echo "<a href=\"newpost.php\" class=\"submitbtn\">NewPost</a>";
            echo "<span class=\"text\">";
            echo $_SESSION ['username'];
            echo "</span>";
        }
        else
        {
            echo "<a href=\"login.php\" class=\"submitbtn\">Login</a>";
            echo "<a href=\"register.php\" class=\"submitbtn\">Register</a>";
        }?>
    </div>
    <div id="content">
        <?php
            $sql = "SELECT * FROM `message` ORDER BY id DESC";
            $result = $mysqli->query($sql);
            $number = $result->num_rows;
            for ($i = 0 ; $i < $number ; $i++) {
                $row = $result->fetch_row();
                echo "<div class=\"post\">";
                    echo "<div class=\"poster\">".$row[1]."</div>";
                    echo "<div class=\"topic\">".$row[2]."</div>";
                    echo "<div class=\"message\">".$row[3]."</div>";
                    echo "<div class=\"time\">".$row[4]."</div>";
                    if(isset($_SESSION['account']))
                    {
                        echo "<a href=\"delete.php?id=".$row[0]."\" class=\"btn\">Delete</a>";
                        echo "<a href=\"edit.php?id=".$row[0]."\" class=\"btn\">Edit</a>";
                        echo "<form action=\"reply.php?id=".$row[0]."\"method=\"POST\" class=\"replyform\">";
                        echo "<input type=\"text\" class=\"reply_input\" name=\"reply\" placeholder=\"Reply ...\">";
                        echo "<input type=\"submit\" value=\"Submit\" class=\"replybtn\">";
                        echo "</form>";
                    }
                    $id = $row[0];
                    $sql2 = $mysqli->prepare("SELECT * FROM `reply` WHERE `postid` = ? ORDER BY id");
                    $sql2->bind_param('i', $id);
                    $sql2->execute();
                    $reply = $sql2->get_result();
                    $sql2->close();
                    $number_reply = $reply->num_rows;
                    for ($j = 0 ; $j < $number_reply ; $j++) {
                        $row2 = $reply->fetch_row();
                        echo "<div class=\"reply\">";
                            echo "<div class=\"reply_name\">".$row2[2]."</div>";
                            echo "<div class=\"reply_content\">".$row2[3]."</div>";
                            echo "<div class=\"reply_time\">".$row2[4]."</div>";
                            if (isset($_SESSION['account']))
                            {
                                echo "<a href=\"reply_delete.php?id=".$row2[0]."\" class=\"btn\">Delete</a>";
                                echo "<a href=\"reply_edit.php?id=".$row2[0]."\" class=\"btn\">Edit</a>";
                            }
                        echo "</div>";
                    }
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>

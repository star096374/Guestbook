<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/newpost.css">
        <title>NewPost</title>
        <style>
            body {
                background-image: url("source/background.png");
            }
        </style>
    </head>
    <body>
        <div id="content">
            <form action="newpost_finish.php" method="POST" id="postform">
                <h1>New Post</h1>
                <span class="text">Title:</span>
                <br>
                <input type="text" id="title" name="title" maxlength="20">
                <br>
                <span class="text">Content:</span>
                <br>
                <textarea id="message" name="content"></textarea>
                <br>
                <input type="submit" value="Submit" id="submit">
            </form>
        </div>
    </body>
</html>

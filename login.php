<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<title>Login</title>
		<style>
			body {
				background-image: url("source/background.png");
			}
		</style>
	</head>
	<body>
		<div id="content">
			<form action="login_finish.php" method="POST">
				<h1>Already our members?</h1>
				<h1>Log in!</h1>
				<span class="text">Account:</span>
				<br>
				<input type="text" class="data" name="account">
				<br>
				<span class="text">Password:</span>
				<br>
				<input type="password" class="data" name="password">
				<br>
				<input type="submit" value="Submit" id="submit">
			</form>
		</div>
	<body>
</html>

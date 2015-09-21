<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/register.css">
		<title>Register</title>
		<style>
			body {
				background-image: url("source/background.png");
			}
		</style>
	</head>
	<body>
		<div id="content">
			<form action="register_finish.php" method="POST">
				<h1>Welcome to be our members!</h1>
				<span class="text">Account:</span>
				<br>
				<input type="text" class="data" name="account">
				<br>
				<span class="text">Password:</span>
				<br>	
				<input type="password" class="data" name="password">
				<br>
				<span class="text">Password again:</span>
				<br>
				<input type="password" class="data" name="password2">
				<br>
				<span class="text">Username:</span>
				<br>
				<input type="text" class="data" name="username">
				<br>
				<span class="text">Email:</span>
				<br>
				<input type="text" class="data" name="email">
				<br>
				<input type="submit" value="Submit" id="submit">
			</form>
		</div>
	</body>
</html>

<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>注册</title>
	<link rel="stylesheet" href="../Common/css/reset.css">
	<link rel="stylesheet" href="../Auth/css/register.css">
</head>
<body>
	<div class="register-cont">
		<h1 class="register-title1">Feather Tag</h1>
		<h2 class="register-title2">To follow me,just sign up</h2>
		<form>
			<div class="register-form" style="border:none">
				<input type="text" name="email" placeholder="Email" id="signup_email">
			</div>
			<div class="register-form">
				<input type="text" name="username" placeholder="Username" id="signup_username">
			</div>
			<div class="register-form">
				<input type="password" name="password" placeholder="Password" id="signup_password">
			</div>
			<div class="register-form">
				<input type="password" placeholder="Confirm the password" id="signup_confirm_password">
			</div>
		</form>
		<button id="signup_forms_submit">Sign up</button>
		<a class="signup_link" href="login">Log in</a>
	</div>
<script src="../Common/js/vue.min.js"></script>
</body>
</html>
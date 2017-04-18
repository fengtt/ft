<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>登陆</title>
	<link rel="stylesheet" href="../Common/css/font.css">
	<link rel="stylesheet" href="../Common/css/reset.css">
	<link rel="stylesheet" href="../Common/css/font-awesome.min.css">
	<link rel="stylesheet" href="../Auth/css/style.css"> <!-- Resource style -->
	<link rel="stylesheet" href="../Auth/css/login.css">
</head>
<body>
	<main class="cd-image-mask-effect">
		<section class="project-2 cd-project-mask">		
			<h1><img width="35px" class="logo" src="../Common/img/logog.png">Feather Tag</h1>	
			<div class="featured-image"></div>
			<div class="mask">
				    <div class="login">
				    	 <div class="login__check"></div>
				      <div class="login__form">
				        <div class="login__row">
				          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
				            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
				          </svg>
				          <input type="text" class="login__input name" placeholder="Username"/>
				        </div>
				        <div class="login__row">
				          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
				            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
				          </svg>
				          <input type="password" id="pwd" class="login__input pass" placeholder="Password"/>
				        </div>
				        <button type="button" class="login__submit">Sign in</button>
				        <p class="login__signup">Don't have an account? &nbsp;<a href="register">Sign up</a></p>
				      </div>
				    </div>   
				<span class="mask-border mask-border-top"></span>
				<span class="mask-border mask-border-bottom"></span>
				<span class="mask-border mask-border-left"></span>
				<span class="mask-border mask-border-right"></span>
			</div>

			<!--<a href="#0" class="project-trigger" style="color: #18a15f;">登  录</a>-->
			<div class="cd-project-info" data-url="project-2">
				<!-- content loaded using js -->
				
			</div>
			<div class="front-desk front-desk-left">
				<p>后台</p>
				<i class="fa fa-cog"></i>
			</div>
			<div class="front-desk front-desk-right">
				<p>前台</p>
				<i class="fa fa-leaf"  onclick="location.href='main.html'"></i>
			</div>
		</section> <!-- .cd-project-mask -->

	</main>
	
	<script src="../Common/js/jquery-1.11.0.min.js"></script>
	<script src="../Auth/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/login.css">
	</head>
	<body>
	<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://cdn.onlinewebfonts.com/svg/img_184513.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="<?php echo $baseURL . 'dashboard/login'?>" method="post">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="username">
      <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" name="submit" class="fadeIn fourth" value="Log In">
  	</form>
		<p><?php echo $message ?></p>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
	</body>
</html>

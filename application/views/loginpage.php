<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php
		echo $js;
		echo $css;
    ?>
	<nav class="navbar navbar-gradient navbar-expand-sm fixed-top" >
    <div class="container-fluid">
       
</head>
<body>
<div class="container">
    <img src="http://www.smartindo-technology.com/img/frontend/aboutus_icon_large.png" style=" display: block;
    margin-left: auto;
    margin-right: auto;
    width: 20%;">
	<h2 style="text-align: center; margin-top: 5%;">Welcome! Please Sign In</h2>
	<br>
	
    <?php
        if(!empty($success_msg)){
            echo '<p class="statusMsg">'.$success_msg.'</p>';
        }elseif(!empty($error_msg)){
            echo '<p class="statusMsg">'.$error_msg.'</p>';
        }
    ?>
    <?php echo form_open('UserAction/login'); ?>
    <form class="form-horizontal" action="" method="post">
        <div class="form-group has-feedback">
            <input type="username" class="form-control" name="username" placeholder="Username" required="" value="">
            <?php echo form_error('username','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required="">
          <?php echo form_error('password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="submit" name="signIn" class="btn-primary" value="Sign In"/>
        </div>
    </form>
    <?php echo form_close(); ?>
  
</div>
</body>
</html>
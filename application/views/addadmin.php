<!DOCTYPE html>
<html>
<head>
	<title>Add New Admin</title>
	<?php
		echo $js;
		echo $css;
	?>
	<nav class="navbar navbar-expand-sm fixed-top" >
		<div class="container-fluid">
			<h1 class="navbar-brand">Add New Admin</h1>
			<?php
				echo '<ul class="navbar-nav ml-auto">';
		            echo '<li class="nav-item" style="margin: 0px 10px 0px 10px">';
		            	echo '<a class="nav-link btn btn-primary" href="'.base_url().'index.php/UserAction/homepage','">';
		            	echo '<span class="fa fa-home"></span>';
		                    echo '  Home';
		                echo '</a>';
		                echo '<a class="nav-link btn btn-danger" href="'.base_url().'index.php/UserAction/logout','">';
		                echo '<span class="fa fa-power-off"></span>';
		                    echo '  Logout';
		                echo '</a>';
		            echo '</li>';
	            echo '</ul>';
     		?>
		</div>
	</nav>
</head>
<body>
<h3 style="text-align: center; margin-top: 5%;">Input new admin</h3>
	<?php
        if(!empty($success_msg)){
            echo '<p class="statusMsg">'.$success_msg.'</p>';
        }elseif(!empty($error_msg)){
            echo '<p class="statusMsg">'.$error_msg.'</p>';
        }
    ?>
<div class="container" style="margin-top: 2%;">
	<hr>
     <?php echo form_open('UserAction/addNewAdmin'); ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required="">
          <?php echo form_error('name','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required="">
          <?php echo form_error('name','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required="">
          <?php echo form_error('email','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required="">
            <?php echo form_error('password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <label for="conf_password">Confirm Password</label>
            <input type="password" class="form-control" name="conf_password" required="">
            <?php echo form_error('conf_password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
        	<p>Active status</p>
          <input type="radio"  name="active" required="" value=1> Active
          <input type="radio" name="active" required="" value=0> Inactive
          <?php echo form_error('active','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="submit" name="confirm" class="btn-primary" value="Submit"/>
        </div>
    </form>
    <?php echo form_close(); ?>
    <p class="footInfo"><a href="<?php echo base_url(); ?>index.php/UserAction/manageAdmin">Return to admin management</a></p>              
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php
		echo $js;
		echo $css;
	?>
	<nav class="navbar navbar-expand-sm fixed-top" >
		<div class="container-fluid">
			<h1 class="navbar-brand">Welcome!</h1>
			<?php
				echo '<ul class="navbar-nav ml-auto">';
		            echo '<li class="nav-item" style="margin: 0px 10px 0px 10px">';
		                echo '<a class="nav-link btn btn-danger" href="'.base_url().'index.php/UserAction/logout','">';
		                	echo '<span class="fa fa-power-off"></span>';
		                    	echo '  Logout';
		                	echo '</a>';
		                echo '</a>';
		            echo '</li>';
	            echo '</ul>';
     		?>
		</div>
	</nav>
</head>
<body>
<br>
<br>
	<div class="container">
	<?php
		if($this->session->userdata('isUserLoggedIn')){
			echo 'Welcome, '.$this->session->userdata['isUserLoggedIn']['username'];
			echo '<div>';

			//echo '<a href="'.base_url().'index.php/UserAction/logout','"> Logout </a>';
		}
	?>
		<hr>
		<div class="container-expand-md">
		<h3>Actions</h3>
			<ul>
			<?php
				echo '<li>';
				echo '<a href="'.base_url().'index.php/UserAction/manageAdmin','">';
				echo 'Manage Admins</a></li>';
				echo '<li>';
				echo '<a href="'.base_url().'index.php/UserAction/manageClient','">';
				echo 'Manage Clients</a></li>';
				echo '<li>';
				echo '<a href="'.base_url().'index.php/UserAction/managePaymentMtc','">';
				echo 'Input Payment Maintenance</a></li>';
			?>
			</ul>
		</div>

	</div>

</body>
</html>
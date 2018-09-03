<!DOCTYPE html>
<html>
<head>
	<title>Manage Payment Maintenance</title>
	<?php
		echo $js;
		echo $css;
	?>
	<nav class="navbar navbar-expand-sm fixed-top" >
		<div class="container-fluid">
			<h1 class="navbar-brand">Manage Payment Maintenance</h1>
			<?php
				echo '<ul class="navbar-nav ml-auto">';
		            echo '<li class="nav-item" style="margin: 0px 10px 0px 10px">';
		            	echo '<a class="nav-link btn btn-primary" href="'.base_url().'index.php/UserAction/homepage','">';
		            		echo '<span class="fa fa-home"></span>';
		                    echo '   Home';
		                echo '</a>';
		                echo '<a class="nav-link btn btn-danger" href="'.base_url().'index.php/UserAction/logout','">';
		                echo '<span class="fa fa-power-off"></span>';
		                    echo '   Logout';
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
			echo 'Your name is '.$this->session->userdata['isUserLoggedIn']['username'];
			echo '<br>';
			echo 'Your email is '.$this->session->userdata['isUserLoggedIn']['email'];
			echo '<div >';
			$id = $this->session->userdata['isUserLoggedIn']['id'];
			//echo '<a href="'.base_url().'index.php/UserAction/logout','"> Logout </a>';]	
			echo '<hr>';
		 
			echo '<a class="btn btn-primary" href="'.base_url().'index.php/UserAction/addPayment/'.$id.'">';
		}
	?>
			<span class="fa fa-plus"></span>
			Input new payment
		</a>
		<br>
		<div class="container-expand-md">
		<table id="list" class='table table-striped table-bordered' cellspacing='0'>
			<tr>
				<th>ID</th>
				<th>Client Name</th>
				<th>Payment Date</th>
				<th>Nominal</th>
				<th>Created By</th>
				<th>Created On</th>
				<th>Actions</th>
			</tr>
			<?php
				foreach ($payments as $key => $value) {
					$id = $value['id_payment'];
					$clientName = $value['client_name'];
					$paymentDate = $value['payment_date'];
					$nominal_tgh = $value['nominal_tgh'];
					$createdBy = $value['admin_name'];
					$createdOn = $value['payment_created_date'];
					echo "<tr>";
					echo "<td>".$id."</td>";
					echo "<td>".$clientName."</td>";
					echo "<td>".$paymentDate."</td>";
					echo "<td>".$nominal_tgh."</td>";
					echo "<td>".$createdBy."</td>";
					echo "<td>".$createdOn."</td>";
					echo "<td>";
	               
	                    echo '<a class="btn btn-danger" name="btnDelete" href="'.base_url().'index.php/UserAction/deletePayment/'.$value['id_payment'].'">';
	                    		echo '<span class="fa fa-times"></span>';
	                            echo '   Delete';
	                    echo '</a>';        
                    echo "</td>";
					echo "</tr>";
				}
			?>
			</table>
			<?php
				echo '<a class="btn btn-primary" href="'.base_url().'index.php/UserAction/checkEmail','"><span class="fa fa-envelope"></span>   Send Email</a>';
			?>
		</div>

	</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Clients</title>
	<?php
		echo $js;
		echo $css;
	?>
	<nav class="navbar navbar-expand-sm fixed-top" >
		<div class="container-fluid">
			<h1 class="navbar-brand">Manage Clients</h1>
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
			echo 'Welcome, '.$this->session->userdata['isUserLoggedIn']['username'];

			$id = $this->session->userdata['isUserLoggedIn']['id'];
			//echo '<a href="'.base_url().'index.php/UserAction/logout','"> Logout </a>';]	
			echo '<hr>';
		 
			echo '<a class="btn btn-primary" href="'.base_url().'index.php/UserAction/addClient/'.$id.'">';
		}
	?>
			<span class="fa fa-plus"></span>
			Add new client
		</a>
		<br>
		<div class="container-expand-md">
		<table id="list" class='table table-striped table-bordered' cellspacing='0'>
			<tr>
				<th>ID</th>
				<th>Client Name</th>
				<th>Client Email</th>
				<th>Nominal Tagihan</th>
				<th>Active</th>
				<th>Created By</th>
				<th>Created On</th>
				<th>Actions</th>
			</tr>
			<?php
				foreach ($clients as $key => $value) {
					$id = $value['id_client'];
					$clientName = $value['client_name'];
					$clientEmail = $value['client_email'];
					$nominalTgh = $value['nominal_tgh'];
					$active = $value['client_active'];
					$createdBy = $value['admin_name'];
					$createdOn = $value['client_created_date'];
					echo "<tr>";
					echo "<td>".$id."</td>";
					echo "<td>".$clientName."</td>";
					echo "<td>".$clientEmail."</td>";
					echo "<td>".$nominalTgh."</td>";
					if($active == 1){
						echo "<td>".'Active'."</td>";
					}
					else if($active == 0){
						echo "<td>".'Inactive'."</td>";
					}
					echo "<td>".$createdBy."</td>";
					echo "<td>".$createdOn."</td>";
					echo "<td>";
	                    echo '<a class="btn btn-primary" name="btnEdit" href="'.base_url().'index.php/UserAction/editClient/'.$value['id_client'].'">';
	                    		echo '<span class="fa fa-pencil"></span>';
	                            echo '   Edit';
	                    echo '</a>';
	                    echo "    ";
	                    echo '<a class="btn btn-danger" name="btnDelete" href="'.base_url().'index.php/UserAction/deleteClient/'.$value['id_client'].'">';
	                    		echo '<span class="fa fa-times"></span>';
	                            echo '   Delete';
	                    echo '</a>';        
                    echo "</td>";
					echo "</tr>";
				}
			?>
			</table>
			
		</div>

	</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Admin</title>
	<?php
		echo $js;
		echo $css;
	?>
	<script>
			$(document).ready(function(){
				$('#list').DataTable();
			});
	</script>
	<nav class="navbar navbar-expand-sm fixed-top" >
		<div class="container-fluid">
			<h1 class="navbar-brand">Manage Admin</h1>
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
<br>
<br>
	<div class="container">
	<?php
		if($this->session->userdata('isUserLoggedIn')){
			echo 'Welcome, '.$this->session->userdata['isUserLoggedIn']['username'];
		}
	?>
	<hr>
		<?php 
			echo '<a class="btn btn-primary" href="'.base_url().'index.php/UserAction/addAdmin','">';
		?>
			<span class="fa fa-plus"></span>
			Add new admin
		</a>
		<br>
		<div class="container-expand-md">
		<table id="list" class='table table-striped table-bordered' cellspacing='0'>
			<tr>
				<th>ID</th>
				<th>Admin Name</th>
				<th>Admin Username</th>
				<th>Admin Email</th>
				<th>Active</th>
				<th>Created On</th>
				<th>Actions</th>
			</tr>
			<?php
				foreach ($admins as $key => $value) {
					$id = $value['id_admin'];
					$adminName = $value['admin_name'];
					$adminUsername = $value['adm_user'];
					$adminEmail = $value['adm_email'];
					$active = $value['active'];
					$created = $value['created_date'];
					echo "<tr>";
					echo "<td>".$id."</td>";
					echo "<td>".$adminName."</td>";
					echo "<td>".$adminUsername."</td>";
					echo "<td>".$adminEmail."</td>";
					if($active == 1){
						echo "<td>".'Active'."</td>";
					}
					else{
						echo "<td>".'Inactive'."</td>";
					}
					echo "<td>".$created."</td>";
					echo "<td>";
	                    echo '<a class="btn btn-primary" name="btnEdit" href="'.base_url().'index.php/UserAction/editAdmin/'.$value['id_admin'].'">';
	                    		echo '<span class="fa fa-pencil"></span>';
	                            echo '   Edit';
	                    echo '</a>';
	                    echo "    ";
	                    echo '<a class="btn btn-danger" name="btnDelete" href="'.base_url().'index.php/UserAction/deleteAdmin/'.$value['id_admin'].'">';
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
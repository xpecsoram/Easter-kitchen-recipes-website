<?php
    include_once 'includes/header.php';
?>

<?php
    include_once '../includes/nav.php';
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12" style="min-height: 80vh">
			
			<!-- page heading -->
			<h1>Users</h1>

			<hr/>

			<?php
				include 'includes/notifications.php';
			?>

			<br>

			<div class="col-sm-3">
				<?php
					include 'includes/sidebar.php';
				?>
			</div>

		    <div class="col-sm-9">
		    	<?php
		    		// is page is view -> display all user
		    		if($_GET['page'] == 'view'){

		    			// write sql query to fetch user
		    			$sql_user = "SELECT id, name, username, email FROM user";
		    			
		    			// execute sql query
		    			$result_user = mysqli_query($connection, $sql_user);
		    			
		    			// create table
		    			echo '
		    				<p class="text-right">
		    					<a href="'.ADMIN_BASEURL.'/users.php?page=add" class="btn btn-info">Create new user</a>
		    				</p>
		    				<p>The following table displays all active user:</p>
		    				<table class="table table-bordered">
		    					<tr>
			    					<th>#</th>
			    					<th>Name</th>
			    					<th>Username</th>
			    					<th>Email</th>
			    					<th>Actions</th>
			    				</tr>';

			    			// create counter to display serial
			    			$counter = 1;
			    			// iterate all and fetch information
			    			while($row_user = mysqli_fetch_array($result_user)){

			    				$id = $row_user['id']; // get  id
			    				$name = $row_user['name']; // name
			    				$username = $row_user['username']; // username
			    				$email = $row_user['email']; // email
			    				
			    				// create and display table rows with actions (edit & delete)
			    				echo '<tr>
			    						<td>'.$counter.'</td>
			    						<td>'.$name.'</td>
			    						<td>'.$username.'</td>
			    						<td>'.$email.'</td>
			    						<td>
			    							<a href="'.ADMIN_BASEURL.'/users.php?page=edit&id='.$id.'" class="btn btn-success btn-xs">Edit</a> &nbsp;
			    							<a class="btn btn-danger btn-xs" 
			    								onClick="javascript:delete_data($(this));return false;"
			    								href="delete.php?type=user&id='.$id.'"
			    							>Delete</a>
			    						</td>
			    					 </tr>';

			    				$counter++;
			    			}
		    			echo '</table>';
		    		}



		    		// is page is add -> display form to add a new 
		    		else if($_GET['page'] == 'add'){

		    			// logic for create form submission
		    			if(isset($_POST['add'])){
		    				// get submitted data
		    				$name = mysqli_real_escape_string($connection, $_POST['name']);
					    	$username = mysqli_real_escape_string($connection, $_POST['username']);
					    	$email = mysqli_real_escape_string($connection, $_POST['email']);
					    	$date_of_birth = mysqli_real_escape_string($connection, $_POST['date_of_birth']);
					    	$password = mysqli_real_escape_string($connection, $_POST['password']);
					    	$gender = mysqli_real_escape_string($connection, $_POST['gender']);
					    	$phone = mysqli_real_escape_string($connection, $_POST['phone']);

					    	// check if the user exists or not
					    	if(mysqli_num_rows(mysqli_query($connection, "SELECT id FROM user WHERE username = '$username' OR username = '$email' "))){
					    		// display error as the username and email already ecists
					    		$_SESSION['alert'] = 'Error! Account already exists';
					    	}
					    	else {
					    		// create SQL for adding user
					    		$sql = "INSERT INTO user (name, username, email, password, date_of_birth, gender, phone) VALUES ('$name', '$username', '$email', '$password', '$date_of_birth', '$gender', '$phone') ";
					    		// execute SQL
					    		$result = mysqli_query($connection, $sql);

					    		if($result){
					    			$_SESSION['success'] = 'Success! Account is created successfully.';
					    		}else{
					    			$_SESSION['alert'] = 'Error! Account not created';
					    		}
					    	}
		    			}

		    			include 'includes/notifications.php';

		    			?>
		    			<p class="text-right">
	    					<a href="<?php echo ADMIN_BASEURL; ?>/users.php?page=view" class="btn btn-info">View all user</a>
	    				</p>
	    				<p>The following form will let you create a new user:</p>
			    		<!-- add form -->
			    		<form method="POST" action="" name="add" class="well" style="overflow: hidden;" enctype="multipart/form-data">
			    			<div class="col-sm-12">
			    				<!--  name -->
				    			<label>Full name</label>
					    		<input type="text" name="name" class="form-control" required />

								<br/>

								<!--  email -->
				    			<label>Email</label>
				        		<input type="email" name="email" class="form-control" required />

					    		<br/>

					    		<!-- username -->
					    		<label>Username</label>
					    		<input type="text" name="username" class="form-control" required />

					    		<br/>

					    		<!-- password -->
					    		<label>Password</label>
				        		<input type="password" name="password" class="form-control" required />

				        		<br/>

				        		<!-- date of birth -->
				        		<label>Date of birth</label>
				        		<input type="text" name="date_of_birth" class="form-control datepicker" placeholder="YYYY-MM-DD" required />

				        		<br/>

				        		<!-- gender -->
				        		<label>Gender</label>
    				        	<div class="radio">
    			        	        <label>
    				        	        <input type="radio" name="gender" value="Male" checked=""> Male
    				        	    </label>
    		        	        </div>
    		        	        <div class="radio">
    				        	    <label>
    				        	        <input type="radio" name="gender" value="Female"> Female
    				        	    </label>
    		        	        </div>

    		        	        <br/>

    		        	        <label>Phone</label>
    		        	        <input type="number" name="phone" class="form-control" required />

    		        	        <br/>

				    			<!-- create submit button -->
				    			<input type="submit" name="add" value="Create user" class="btn btn-primary">
				    		</div>
			    		</form>
			    		<?php
		    		}




		    		// is page is edit -> display form to edit an existing rrecord
		    		else if($_GET['page'] == 'edit'){

		    			// get  id from URL
						$id = mysqli_real_escape_string($connection, $_GET['id']);

		    			// logic for create  form submission
		    			if(isset($_POST['edit'])){
		    				// get submitted data
		    				$name = mysqli_real_escape_string($connection, $_POST['name']);
					    	$username = mysqli_real_escape_string($connection, $_POST['username']);
					    	$email = mysqli_real_escape_string($connection, $_POST['email']);
					    	$date_of_birth = mysqli_real_escape_string($connection, $_POST['date_of_birth']);
					    	$phone = mysqli_real_escape_string($connection, $_POST['phone']);
					    	$gender = mysqli_real_escape_string($connection, $_POST['gender']);
					    	$password = mysqli_real_escape_string($connection, $_POST['password']);

    						// create sql
    						$sql = "UPDATE user SET name = '$name', email = '$email', username = '$username', date_of_birth = '$date_of_birth', phone = '$phone', gender = '$gender', password = '$password' WHERE id = ".$id;
    						// execute sql
    						$result = mysqli_query($connection, $sql);
    						if($result == true){
    							$_SESSION['success'] = "Success! Record is updated successfully!";
    						}
    						else{
    							$_SESSION['alert'] = "Error! something went wrong";
    						}
		    			}

		    			include 'includes/notifications.php';

		    			// create sql
    						$sql = "SELECT * FROM user WHERE id = '$id' ";
    						// execute sql
    						$result = mysqli_query($connection, $sql);
    						$row = mysqli_fetch_array($result);

    						// fetch data
    						$name = $row['name'];
				    		$username = $row['username'];
				    		$email = $row['email'];
				    		$date_of_birth = $row['date_of_birth'];
				    		$phone = $row['phone'];
				    		$gender = $row['gender'];
				    		$password = $row['password'];
		    			?>
		    			<p class="text-right">
	    					<a href="<?php echo ADMIN_BASEURL; ?>/users.php?page=view" class="btn btn-info">View all user</a>
	    				</p>
	    				<p>The following form will let you update user:</p>
			    		<!-- change password form -->
			    		<form method="POST" action="" name="edit" class="well" style="overflow: hidden;" enctype="multipart/form-data">
			    			<input type="hidden" name="image_old" value="<?php echo $image;?>">
			    			<div class="col-sm-12">
				    			<!--  name -->
						      	<label>Full Name</label>
						        <input type="text" name="name" class="form-control" value="<?php echo $name;?>" required />
						      	<br/>

							    <!--  email -->
							    <label>Email</label>
							    <input type="email" name="email" class="form-control" value="<?php echo $email;?>"/>
							    <br/>

							    <!--  password -->
							    <label>Password</label>
							    <input type="text" name="password" class="form-control" value="<?php echo $password;?>"/>
							    <br/>

							    <!--  username -->
							    <label>Username</label>
							    <input type="text" name="username" class="form-control" value="<?php echo $username;?>" required />
							    <br/>

					    		<!--  date of birth -->
					    		<label>Date of birth</label>
					    		<input type="text" name="date_of_birth" class="form-control datepicker" placeholder="YYYY-MM-DD" value="<?php echo $date_of_birth;?>" required />
							    <br/>

					    		<!--  gender -->
					    		<label>Gender</label>
					        	<div class="radio">
				        	        <label>
					        	        <input type="radio" name="gender" value="Male" <?php echo (($gender == 'Male')?'checked':'');?> > Male
					        	    </label>
			        	        </div>
			        	        <div class="radio">
					        	    <label>
					        	        <input type="radio" name="gender" value="Female" <?php echo (($gender == 'Female')?'checked':'');?> > Female
					        	    </label>
			        	        </div>
							    <br/>

							    <!-- phone -->
							    <label>Phone</label>
							    <input type="number" name="phone" class="form-control" value="<?php echo $phone;?>" required />
							    <br/>
					    		
				    			<!-- create submit button -->
				    			<input type="submit" name="edit" value="Update user" class="btn btn-primary">
				    		</div>
			    		</form>
			    		<?php
		    		}
		    	?>
		    </div>

		</div>
	</div>
</div>

<?php
    include_once '../includes/footer.php';
?>

<script type="text/javascript">
	// create delete  function
	function delete_data(anchor) {
	   var conf = confirm('Are you sure want to delete this ?');
	   // if confirmed -> proceed for delete
	   if(conf){
	   		window.location=anchor.attr("href");
	   }
	}
</script>

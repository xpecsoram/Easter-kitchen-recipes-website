<?php
    // include header
    include_once 'includes/header.php';

    // include menu bar
    include_once '../includes/nav.php';

    // if not login -> redirect
    if(!isset($_SESSION['access']) == true || !isset($_SESSION['member']) == true){
    	$_SESSION['error'] = '<div class="alert alert-danger">Error! You must login to access this page.</div>';
    	header('Location:'.ACCOUNT_BASEURL.'/index.php');
    	exit();
    }else{
    	$user_id = $_SESSION['user_id'];
    }

    // check if change password form is submitted
    if(isset($_POST['save'])){
    	// get form values
    	$name = mysqli_real_escape_string($connection, $_POST['name']);
    	$username = mysqli_real_escape_string($connection, $_POST['username']);
    	$date_of_birth = mysqli_real_escape_string($connection, $_POST['date_of_birth']);
    	$phone = mysqli_real_escape_string($connection, $_POST['phone']);
    	$gender = mysqli_real_escape_string($connection, $_POST['gender']);

		// create sql
		$sql = "UPDATE user SET name = '$name', username = '$username', date_of_birth = '$date_of_birth', phone = '$phone', gender = '$gender' WHERE id = ".$_SESSION['user_id'];
		// execute sql
		$result = mysqli_query($connection, $sql);
		if($result == true){
			$_SESSION['success'] = "Your profile is updated successfully!";
		}
		else{
			$_SESSION['alert'] = "Error! something went wrong";
		}
    }

?>

<div class="container">
	<div class="row">
		<div class="col-sm-12" style="min-height: 80vh">
			
			<!-- page heading -->
			<h1>Profile settings</h1>

			<hr/>

			<?php
				include 'includes/notifications.php';
			?>

			<br><br>

		    <div class="col-sm-12 well">

		    	<?php
		    		// create sql to fetch user info
		    		$sql = "SELECT * FROM user WHERE id = ".$_SESSION['user_id'];

		    		// execute sql
		    		$result = mysqli_query($connection, $sql);
		    		$row = mysqli_fetch_array($result);

		    		// fetch data from database
		    		$name = $row['name'];
		    		$username = $row['username'];
		    		$email = $row['email'];
		    		$date_of_birth = $row['date_of_birth'];
		    		$phone = $row['phone'];
		    		$gender = $row['gender'];
		    	?>
		    	
	    		<!-- profile form -->
	    		<form method="POST" action="" name="save">
		    		<!-- create label and field for your name -->
		    		<div class="form-group">
				      	<label class="col-sm-3 control-label">Full Name</label>
				      	<div class="col-sm-9">
				        	<input type="text" name="name" class="form-control" value="<?php echo $name;?>" required />
				      	</div>
				    </div>

				    <!-- create label and field for your email -->
				    <div class="form-group">
				      	<label class="col-sm-3 control-label">Email</label>
				      	<div class="col-sm-9">
				        	<input type="email" name="email" class="form-control" value="<?php echo $email;?>" readonly />
				        	<small>Email cannot change</small>
				      	</div>
				    </div>

				    <!-- create label and field for your username -->
				    <div class="form-group">
				      	<label class="col-sm-3 control-label">Username</label>
				      	<div class="col-sm-9">
				        	<input type="text" name="username" class="form-control" value="<?php echo $username;?>" required />
				      	</div>
				    </div>

		    		<!-- create label and field for date of birth -->
		    		<div class="form-group">
				      	<label class="col-sm-3 control-label">Date of birth</label>
				      	<div class="col-sm-9">
				        	<input type="text" name="date_of_birth" class="form-control datepicker" placeholder="YYYY-MM-DD" value="<?php echo $date_of_birth;?>" required />
				      	</div>
				    </div>

		    		<!-- create label and field for gender -->
		    		<div class="form-group">
				      	<label class="col-sm-3 control-label">Gender</label>
				      	<div class="col-sm-9">
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
				      	</div>
				    </div>

				    <div class="form-group">
				      	<label class="col-sm-3 control-label">Phone</label>
				      	<div class="col-sm-9">
				        	<input type="number" name="phone" class="form-control" value="<?php echo $phone;?>" required />
				      	</div>
				    </div>

		    		<!-- create save button -->
		    		<div class="form-group">
				      	<div class="col-sm-9 col-sm-offset-3">
				        	<input type="submit" name="save" value="Update Profile" class="btn btn-primary">

				        	<br><br>

				        	<p><a href="<?php echo ACCOUNT_BASEURL;?>/change-password.php" class="orange">Click here</a> to change password</p>
				      	</div>
				    </div>

		    	</form>
		    </div>

		</div>
	</div>
</div>

<?php
    include_once '../includes/footer.php';
?>

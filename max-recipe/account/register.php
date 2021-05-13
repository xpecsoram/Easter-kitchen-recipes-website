<?php
	// include header
    include_once 'includes/header.php';

    // include menu
    include_once '../includes/nav.php';

    // check if signup form is submitted
    if(isset($_POST['signup'])){
    	// get form values
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
    		// create SQL for register
    		$sql = "INSERT INTO user (name, username, email, password, date_of_birth, gender, phone) VALUES ('$name', '$username', '$email', '$password', '$date_of_birth', '$gender', '$phone') ";
    		// execute SQL
    		$result = mysqli_query($connection, $sql);

    		// if ture -> push for register
    		if($result){
    			$_SESSION['success'] = 'Success! Your account is registered successfully. Please <a href="'.ACCOUNT_BASEURL.'">login</a> to your account';
    		}else{
    			// display error if account is not created
    			$_SESSION['alert'] = 'Error! Account not created';
    		}
    	}
    }
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12" style="min-height: 80vh">
			
			<!-- page heading -->
			<h1>Register</h1>

			<hr/>

			<?php
				include 'includes/notifications.php';
			?>

			<br><br>

		    <div class="col-sm-6 col-sm-offset-3 well">
		    	<!-- signup form -->
		    	<form method="POST" action="" name="signup">
		    		<!-- create label and field for your name -->
		    		<div class="form-group">
				      	<label class="col-sm-3 control-label">Full Name</label>
				      	<div class="col-sm-9">
				        	<input type="text" name="name" class="form-control" required />
				      	</div>
				    </div>

				    <!-- create label and field for your email -->
				    <div class="form-group">
				      	<label class="col-sm-3 control-label">Email</label>
				      	<div class="col-sm-9">
				        	<input type="email" name="email" class="form-control" required />
				      	</div>
				    </div>

				    <!-- create label and field for your username -->
				    <div class="form-group">
				      	<label class="col-sm-3 control-label">Username</label>
				      	<div class="col-sm-9">
				        	<input type="text" name="username" class="form-control" required />
				      	</div>
				    </div>

				    <!-- create label and field for your password -->
				    <div class="form-group">
				      	<label class="col-sm-3 control-label">Password</label>
				      	<div class="col-sm-9">
				        	<input type="password" name="password" class="form-control" required />
				      	</div>
				    </div>

		    		<!-- create label and field for date of birth -->
		    		<div class="form-group">
				      	<label class="col-sm-3 control-label">Date of birth</label>
				      	<div class="col-sm-9">
				        	<input type="text" name="date_of_birth" class="form-control datepicker" placeholder="YYYY-MM-DD" required />
				      	</div>
				    </div>

		    		<!-- create label and field for gender -->
		    		<div class="form-group">
				      	<label class="col-sm-3 control-label">Gender</label>
				      	<div class="col-sm-9">
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
				      	</div>
				    </div>

				    <div class="form-group">
				      	<label class="col-sm-3 control-label">Phone</label>
				      	<div class="col-sm-9">
				        	<input type="number" name="phone" class="form-control" required />
				      	</div>
				    </div>

		    		<!-- create signup button -->
		    		<div class="form-group">
				      	<div class="col-sm-9 col-sm-offset-3">
				        	<input type="submit" name="signup" value="Sign Up" class="btn btn-primary">

				        	<br><br>

				        	<p>Or <a href="<?php echo ACCOUNT_BASEURL;?>/" class="orange">click here</a> to login</p>
				      	</div>
				    </div>

		    	</form>
		    </div>

		</div>
	</div>
</div>

<?php
	// include footer
    include_once '../includes/footer.php';
?>
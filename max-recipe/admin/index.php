<?php
	// include header
    include_once 'includes/header.php';

    include_once '../includes/nav.php';

    // check if login form is submitted
    if(isset($_POST['login'])){
        // get form values
    	$email = mysqli_real_escape_string($connection, $_POST['email']);
    	$password = mysqli_real_escape_string($connection, $_POST['password']);

    	// check for username or email
    	$is_email = strpos($email, '@');
    	if ($is_email === false) {
    	    $cond = " username = '".$email."' "; // if username
    	    $type = 'username';
    	} else {
    	    $cond = " email = '".$email."' "; // if email
    	    $type = 'email';
    	}

    	// create conditional SQL
    	$sql = "SELECT * FROM admin WHERE ".$cond;
    	// execute SQL
    	$result = mysqli_query($connection, $sql);
    	// check if login exists
    	$count = mysqli_num_rows($result);

    	// if ture -> push for login
    	if($count == '1'){
    		$row = mysqli_fetch_array($result);

    		// check password
    		if($password == $row['password']){

    			$_SESSION['access'] = true; // save session to check if admin is login
                $_SESSION['admin'] = true; // save session to check admin type
    			$_SESSION['admin_id'] = $row['id']; // save logged id in session

    			// redirect to jobs page
    			header('Location:'.ADMIN_BASEURL.'/profile.php');
    			exit();
    		}else{
    			// display error if email/username or password
    			$_SESSION['alert'] = 'Error! Incorrect '.$type.' or password';
    		}
    	}else{
    		// display error if account is not found
    		$_SESSION['alert'] = 'Error! Account not found';
    	}
    }
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12" style="min-height: 80vh">
			
			<!-- page heading -->
			<h1>Login</h1>

			<hr/>

			<?php
				include 'includes/notifications.php';
			?>

			<br><br>

		    <div class="col-sm-8 col-sm-offset-2 well">
		    	<!-- login form -->
		    	<form method="POST" action="" name="login">
		    		<!-- create label and field for email -->
		    		<div class="form-group">
                        <label class="col-sm-4 control-label">Username or Email</label>
                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" required />
                        </div>
                    </div>

                    <!-- create label and field for password -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" required />
                        </div>
                    </div>

		    		<!-- create login button -->
                    <div class="form-group" style="margin-bottom: 0">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
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
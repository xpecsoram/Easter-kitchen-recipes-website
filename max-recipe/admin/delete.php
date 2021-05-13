<?php
	include '../includes/settings.php';

	// if not login -> redirect
    if(!isset($_SESSION['access']) == true || !isset($_SESSION['admin']) == true){
    	$_SESSION['error'] = '<div class="alert alert-danger">Error! You must login to access this page.</div>';
    	header('Location:'.ADMIN_BASEURL.'/index.php');
    	exit();
    }

    // get id and type from URL
	$id = mysqli_real_escape_string($connection, $_GET['id']);
	$type = mysqli_real_escape_string($connection, $_GET['type']);
	
	// delete for categories
	if($type == 'categories'){
		// prepare delete SQL
		$sql = "DELETE FROM categories WHERE id = ".$id;

		// execute sql query
		if(mysqli_query($connection, $sql)){
			$_SESSION['success'] = 'Success! Category has been removed successfully';
		}else{
			$_SESSION['alert'] = 'Error! Category is not deleted. Something went wrong';
		}

		header("location:".ADMIN_BASEURL.'/categories.php?page=view');
	}

	// delete for recipes
	else if($type == 'recipes'){
		// prepare delete SQL
		$sql = "DELETE FROM recipe WHERE id = ".$id;

		// execute sql query
		if(mysqli_query($connection, $sql)){
			$_SESSION['success'] = 'Success! Recipe has been removed successfully';
		}else{
			$_SESSION['alert'] = 'Error! Recipe is not deleted. Something went wrong';
		}

		header("location:".ADMIN_BASEURL.'/recipes.php?page=view');
	}

	// delete for users
	else if($type == 'user'){
		// prepare delete SQL
		$sql = "DELETE FROM favourite WHERE user_id = '$id'; 
				DELETE FROM reviews WHERE user_id = '$id'; 
				DELETE FROM user WHERE id = '$id'; ";

		// execute sql query
		if(mysqli_multi_query($connection, $sql)){
			$_SESSION['success'] = 'Success! User has been removed successfully';
		}else{
			$_SESSION['alert'] = 'Error! User is not deleted. Something went wrong';
		}

		header("location:".ADMIN_BASEURL.'/users.php?page=view');
	}

	exit();
?>
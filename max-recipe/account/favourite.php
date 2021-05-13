 <?php
	// include header
    include_once 'includes/header.php';
?>

	<title>Favourite</title>

<?php
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
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
			<!-- page heading -->
			<h1 class="orange">My Favourites</h1>

			<hr/>

		    <?php

				// method to remove from favourite
    				if(isset($_POST['remove-favourite'])){
    					$recipe_id = mysqli_real_escape_string($connection, $_POST['recipe_id']);

    					// echo "DELETE FROM favourite WHERE user_id = '$user_id' AND recipe_id = '$recipe_id' ";

    					if(mysqli_query($connection, "DELETE FROM favourite WHERE user_id = '$user_id' AND recipe_id = '$recipe_id' ")){
    						echo '<div class="alert alert-success alert-dismissible stick-top"><button type="button" class="close text-danger" data-dismiss="alert">&times;</button> Success! Recipe is removed from favourite successfully</div>';
    					}
    				}

		    	// display favourite
	    		$sql_favourite = "SELECT fav.user_id, fav.recipe_id, res.id, res.title, res.image
	    						FROM favourite fav 
	    							INNER JOIN recipe res
	    								ON fav.recipe_id = res.id
	    						WHERE fav.user_id = ".$_SESSION['user_id'];

	    		$result_favourite = mysqli_query($connection, $sql_favourite);

	    		if(mysqli_num_rows($result_favourite) > 0){

	    			$total_favourite = mysqli_num_rows($result_favourite);
	    			
	    			echo '<p>You have '.$total_favourite.' favourite recipes</p>';

	    			$count = 1;
					while($row_favourite = mysqli_fetch_array($result_favourite)){

						$recipe_id = $row_favourite['id'];
						$url = 'recipes.php?id='.$recipe_id; 
			    		$title = $row_favourite['title'];
			    		$image = BASEURL.'/recipe_photos/'.$row_favourite['image'];

						if($count % 3 == 0){
			    			echo '<div class="row">';
			    		}
				    		echo '
							<div class="col-sm-4 text-center">
								<a href="'.$url.'" class="category-thumb">
									<img src="'.$image.'" width="100%" alt="'.$title.'"/>
									<p class="orange">'.$title.'</p>

									<form name="remove-favourite" method="POST">
										<input type="hidden" name="recipe_id" value="'.$recipe_id.'">
										<button type="submit" name="remove-favourite" value="true" class="btn btn-primary btn-xs">
											<i class="fa fa-times"></i> Remove
										</button>
									</form>
								</a>
							</div>';

						if($count % 3 == 0){
			    			echo '</div>';
			    		}

			    		$count++;
					}
	    		}else{
	    			echo '<div class="alert alert-warning">You do not have any recipes in your favourites</div> <br><br><br><br><br><br><br>';
	    		}
		    ?>
		</div>
	</div>
</div>

<br><br>

<?php
	// include footer
    include_once '../includes/footer.php';
?>
<?php
	// include header
    include_once 'includes/header.php';
?>

	<title>Reviews</title>

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
			<h1 class="orange">My Reviews</h1>

			<hr/>

		    <?php

		    	// display reviews
	    		$sql_reviews = "SELECT rev.user_id, rev.recipe_id, rev.stars, rev.comment, res.id, res.title, res.image
	    						FROM reviews rev 
	    							INNER JOIN recipe res
	    								ON rev.recipe_id = res.id
	    						WHERE rev.user_id = ".$_SESSION['user_id'];

	    		$result_reviews = mysqli_query($connection, $sql_reviews);

	    		if(mysqli_num_rows($result_reviews) > 0){

	    			$total_reviews = mysqli_num_rows($result_reviews);
	    			
	    			echo '
	    			<div class="container">
	    				<div class="row">
	    					<div class="col-sm-12">
	    						<p>Total '.$total_reviews.' reviews published</p>';
	    						while($row_reviews = mysqli_fetch_array($result_reviews)){
	    							$stars = $row_reviews['stars'];

	    							$url = 'recipes.php?id='.$row_reviews['id']; 
						    		$title = $row_reviews['title'];
						    		$image = BASEURL.'/recipe_photos/'.$row_reviews['image'];

	    							if($stars == 1){ $star_type_1 = 'rating-golden'; }else{ $star_type_1 = 'rating-gray'; }
	    							if($stars == 2){ $star_type_1 = $star_type_2 = 'rating-golden'; }else{ $star_type_2 = 'rating-gray'; }
	    							if($stars == 3){ $star_type_1 = $star_type_2 = $star_type_3 = 'rating-golden'; }else{ $star_type_3 = 'rating-gray'; }
	    							if($stars == 4){ $star_type_1 = $star_type_2 = $star_type_3 = $star_type_4 = 'rating-golden'; }else{ $star_type_4 = 'rating-gray'; }
	    							if($stars == 5){ $star_type_1 = $star_type_2 = $star_type_3 = $star_type_4 = $star_type_5 = 'rating-golden'; }else{ $star_type_5 = 'rating-gray'; }

	    							echo '<div class="well" style="overflow: hidden">
	    									<div class="col-sm-7">
	    									  <table class="reviews">
	    									  	<tr>
	    									  		<td style="vertical-align: top">
	    									  			<img src="'.BASEURL.'/images/user.png" class="user-img">
	    									  		</td>
	    									  		<td>
	    									  			<i class="fa fa-star '.$star_type_1.'"></i>
	    									  			<i class="fa fa-star '.$star_type_2.'"></i>
	    									  			<i class="fa fa-star '.$star_type_3.'"></i>
	    									  			<i class="fa fa-star '.$star_type_4.'"></i>
	    									  			<i class="fa fa-star '.$star_type_5.'"></i>

	    									  			<p>"'.$row_reviews['comment'].'"</p>
	    									  			<small><cite>'.$row_reviews['name'].'</cite></small>
	    									  			<br>
	    									  			<a href="'.BASEURL.'/recipes.php?id='.$row_reviews['id'].'" class="btn btn-primary">Click here to view recipe</a>
	    									  		</td>
	    									  	</tr>
	    									  </table>
	    									</div>
	    									<div class="col-sm-4 col-sm-offset-1">
	    										<div class="col-sm-12 text-center">
	    											<a href="'.$url.'" class="category-thumb">
	    												<img src="'.$image.'" width="100%" alt="'.$title.'"/>
	    												'.$title.'
	    											</a>
	    										</div>
	    									</div>
	    								 </div>';
	    						}
	    			echo '					
	    					</div>
	    				</div>
	    			</div><br>';
	    		}else{
	    			echo '<div class="alert alert-warning">You do not have any reviews.</div> <br><br><br><br><br><br><br><br><br>';
	    		}
		    ?>

		</div>
	</div>
</div>

<?php
	// include footer
    include_once '../includes/footer.php';
?>
<?php
	// include header
    include_once 'includes/header.php';

    // get recipe ID from URL
    $recipe_id = $_GET['id'];

    // create and execute SQL based on recipe ID
    $sql = "SELECT count(id) AS counter, id, title, instructions, ingredients, image, category_id FROM recipe WHERE id = '$recipe_id' ";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($result);

	// get data from the query
	$counter = $row['counter'];
	$image = BASEURL.'/recipe_photos/'.$row['image'];
	$page_url = BASEURL.'/recipes.php?id='.$row['id'];
	$title = $row['title'];
	$ingredients = $row['ingredients'];
	$instructions = $row['instructions'];
	$category_id = $row['category_id'];
?>

	

</head>
<body>

<?php
	// include menu bar
    include_once 'includes/nav.php';


    // display single recipe => if recipe is found
	if($counter == 1){

		// fetch category based on fetched recipe by ID
		$sql_cat = "SELECT id, title, image FROM categories WHERE id = '$category_id' ";
		$result_cat = mysqli_query($connection, $sql_cat);
		$row_cat = mysqli_fetch_array($result_cat);

		// create data for category
		$category_url = BASEURL.'/category.php?id='.$row_cat['id'];
		$category_title = $row_cat['title'];
		$category_image = BASEURL.'/category_photos/'.$row_cat['image'];

		echo '<title>Recipe | '.$title.'</title>

		<div id="recipe-wrapper" style="background: url('.$image.') center center repeat; background-size: contain;" class="do-hide">
			<div class="recipe-overlay">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<!-- page heading -->
							<h1>'.$title.'</h1>';

							// if user is logged -> give option to add to favorite
			        			if(isset($_SESSION['access']) == true){
			        				$user_id = $_SESSION['user_id'];

			        				// method to add  favourite
				        				if(isset($_POST['add-favourite'])){
				        					if(mysqli_query($connection, "INSERT INTO favourite (user_id, recipe_id) VALUES ('$user_id', '$recipe_id') ")){
				        						echo '<div class="alert alert-success alert-dismissible stick-top"><button type="button" class="close text-danger" data-dismiss="alert">&times;</button> Success! Recipe added to favourite successfully</div>';
				        					}
				        				}

			        				// method to remove from favourite
				        				if(isset($_POST['remove-favourite'])){
				        					if(mysqli_query($connection, "DELETE FROM favourite WHERE user_id = '$user_id' AND recipe_id = '$recipe_id' ")){
				        						echo '<div class="alert alert-success alert-dismissible stick-top"><button type="button" class="close text-danger" data-dismiss="alert">&times;</button> Success! Recipe is removed from favourite successfully</div>';
				        					}
				        				}

				        			// check if recipe exists in favourite
			        				$sql_favourite = "SELECT count(id) AS found FROM favourite WHERE recipe_id = '$recipe_id' AND user_id = ".$user_id;
			        				$result_favourite = mysqli_query($connection, $sql_favourite);
			        				$row_favourite = mysqli_fetch_array($result_favourite);

			        				// if favourite not found => display button to add 
			        				if($row_favourite['found'] == 0){

				        				echo '<br>
		        						<form name="add-favourite" method="POST">
		        							<button type="submit" name="add-favourite" class="btn btn-primary btn-lg">
		        								<i class="fa fa-check"></i> Add this recipe to favourites <i class="fa fa-heart"></i>
		        							</button>
		        						</form>';
			        				}else{
			        					// display button to remove favourite
				        				echo '<br>
		        						<form name="remove-favourite" method="POST">
		        							<button type="submit" name="remove-favourite" class="btn btn-primary btn-lg">
		        								<i class="fa fa-times"></i> Remove this recipe from favourites <i class="fa fa-heart-broken"></i>
		        							</button>
		        						</form>';
			        				}
			        			}

							echo '
						</div>
					</div>
				</div>
			</div>
		</div>';

		// display recipe detail information
		echo '
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<h2 class="orange">Ingredients</h2>
						<p class="lead">'.$ingredients.'</p>
						<br/><br/>
						<h2 class="orange">Instructions</h2>
						<p class="lead">'.$instructions.'</p>
					</div>
					<div class="col-sm-4 text-center">
						<h2 class="orange text-left">Category</h2>
						<a href="'.$category_url.'" class="category-thumb">
							<img src="'.$category_image.'" width="100%" alt="'.$category_title.'"/>
							'.$category_title.'
						</a>
					</div>
				</div>
			</div>
		</div>';

		// add review form process
		if(isset($_POST['add-review'])){
			$user_id = $_SESSION['user_id'];
			$stars = mysqli_real_escape_string($connection, $_POST['stars']);
			$comment = mysqli_real_escape_string($connection, $_POST['comment']);

			// insert review in the database
			$sql = "INSERT INTO reviews (user_id, recipe_id, stars, comment) VALUES ('$user_id', '$recipe_id', '$stars', '$comment') ";
			if(mysqli_query($connection, $sql)){
				echo '<div class="alert alert-success alert-dismissible stick-top"><button type="button" class="close text-danger" data-dismiss="alert">&times;</button> Thank You! Your review is published successfully</div>';
			}
		}

		// display reviews section
			$sql_reviews = "SELECT rev.user_id, rev.recipe_id, rev.stars, rev.comment, u.name
							FROM reviews rev
								INNER JOIN user u
									ON rev.user_id = u.id
							WHERE rev.recipe_id = ".$recipe_id;
			$result_reviews = mysqli_query($connection, $sql_reviews);

			if(mysqli_num_rows($result_reviews) > 0){

				$total_reviews = mysqli_num_rows($result_reviews);
				
				echo '
				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<h2 class="orange">Reviews</h2>
							<p>'.$total_reviews.' reviews</p>';
							while($row_reviews = mysqli_fetch_array($result_reviews)){
								$stars = $row_reviews['stars'];

								// color the stars based on stars found in the reviews
								if($stars == 1){ $star_type_1 = 'rating-golden'; }else{ $star_type_1 = 'rating-gray'; }
								if($stars == 2){ $star_type_1 = $star_type_2 = 'rating-golden'; }else{ $star_type_2 = 'rating-gray'; }
								if($stars == 3){ $star_type_1 = $star_type_2 = $star_type_3 = 'rating-golden'; }else{ $star_type_3 = 'rating-gray'; }
								if($stars == 4){ $star_type_1 = $star_type_2 = $star_type_3 = $star_type_4 = 'rating-golden'; }else{ $star_type_4 = 'rating-gray'; }
								if($stars == 5){ $star_type_1 = $star_type_2 = $star_type_3 = $star_type_4 = $star_type_5 = 'rating-golden'; }else{ $star_type_5 = 'rating-gray'; }

								echo '<div class="well">
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
										  		</td>
										  	</tr>
										  </table>
									 </div>';
							}
				echo '					
						</div>
					</div>
				</div><br>';
			}

		// if user is logged -> give option to write review
	        if(isset($_SESSION['access']) == true){
	        	// display form only when user hasn't added review on particular recipe
	        	$sql_find_reviews = "SELECT count(id) AS found FROM reviews WHERE recipe_id = '$recipe_id' AND user_id = ".$_SESSION['user_id'];
				$result_find_reviews = mysqli_query($connection, $sql_find_reviews);
				$row_find_reviews = mysqli_fetch_array($result_find_reviews);
				
				if($row_find_reviews['found'] == 0){
					// create review form
					 echo '
					 <div class="container">
							<div class="row">
								<div class="col-sm-8">
									<div class="well">
										<p class="orange">Write your review <br><small>It will be published with your name</small></p>
										<form class="form-horizontal" method="POST" name="add-review">
										    <div class="form-group">
										      	<label class="col-sm-3 control-label">Ratings</label>
										      	<div class="col-sm-9">
										        	<select class="form-control" name="stars">
										        		<option value="1">1</option>
										        		<option value="2">2</option>
										        		<option value="3">3</option>
										        		<option value="4">4</option>
										        		<option value="5">5</option>
										        	</select>
										      	</div>
										    </div>

										    <div class="form-group">
										      	<label class="col-sm-3 control-label">Comment</label>
										      	<div class="col-sm-9">
										        	<textarea name="comment" class="form-control" required></textarea>
										        	<small><em>Once added, it can not be changed.</em></small>
										      	</div>
										    </div>

										    <div class="form-group" style="margin-bottom: 0">
										        <div class="col-sm-9 col-sm-offset-3">
										            <button type="reset" class="btn btn-default">Reset</button>
										            <button type="submit" name="add-review" class="btn btn-primary">Add Review</button>
										        </div>
										    </div>
										</form>
									</div>
								</div>
							</div>
						</div><br>';
				}
	        }

		// more recipes section
			echo '
			<div class="section" style="background: #DF6B36;">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							
							<h2 class="text-white">More delicious recipes!</h2>
							
							<br>

							<p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

							<br>';
								// select random 3 recipes
						    	$sql = "SELECT id, title, image FROM recipe ORDER BY rand() LIMIT 3";
						    	$result = mysqli_query($connection, $sql);
						    	while($row = mysqli_fetch_array($result)){
						    	
						    		$image = BASEURL.'/recipe_photos/'.$row['image'];
						    		$url = BASEURL.'/recipes.php?id='.$row['id'];
						    		$title = $row['title'];

						    		echo '
						    		<div class="col-sm-4 text-center">
						    			<a href="'.$url.'" class="category-thumb-orange">
							    			<img src="'.$image.'" width="100%" alt="'.$title.'"/>
							    			'.$title.'
							    		</a>
							    	</div>';
						    	
						    	}
			echo '
						</div>
					</div>
				</div>
			</div>';

	}else{

		echo '<title>Recipes</title>';

		$page_url = BASEURL.'/recipes.php';
?>

<!-- if the page don't have any recipe ID in the URL => display all recipes with pagination -->
<div id="cat-wrapper" style="background: url('<?php echo BASEURL;?>/category_photos/lunch.jpg') center center no-repeat; background-size: cover;" class="do-hide">
	<div class="cat-overlay">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<!-- page heading -->
					<h1>All Recipes</h1>
					<br><br>
				</div>
				<?php
					// create dynamic portion of SQL query for making search
					if(isset($_GET['s'])){
						$search = $_GET['s'];
						$search_sql = " WHERE title LIKE '%$search%' ";

						// create URL for pagination navigation buttons
						$page_url = BASEURL.'/recipes.php?s='.$search;
					}
				?>
				<!-- search form -->
				<form method="GET" name="search">
					<div class="col-sm-6 col-sm-offset-2">
						<!-- display the searched keyword in the search text box -->
						<input type="text" name="s" placeholder="Type in something..." class="form-control search-input" value="<?php echo $search;?>" required>
					</div>
					<div class="col-sm-2">
						<input type="submit" value="SEARCH" class="btn btn-primary btn-block search-btn">
					</div>
					<div class="col-sm-12 text-center">
						<?php
							// display link to reset search
							if(isset($_GET['s'])){
								echo '<br><a href="'.BASEURL.'/recipes.php" class="orange">Reset Search</a>';
							}
						?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			    <?php

			    	// SET Total Records Per Page Value
			    	$total_records_per_page = PAGINATE;

			    	// Get the Current Page Number
			    	if (isset($_GET['page_no']) && $_GET['page_no']!="") {
			    	    $page_no = $_GET['page_no'];
			    	} else {
			    	    $page_no = 1;
			    	}

			    	// Calculate OFFSET Value and SET other Variables
			    	$offset = ($page_no - 1) * $total_records_per_page;
			    	$previous_page = $page_no - 1;
			    	$next_page = $page_no + 1;
			    	$adjacents = 2;


			    	// get total recipies
			    	$result_count = mysqli_query($connection, "SELECT COUNT(*) As total_records FROM recipe ".$search_sql);
			    	$total_records = mysqli_fetch_array($result_count);
			    	$total_records = $total_records['total_records'];
			    	$total_no_of_pages = ceil($total_records / $total_records_per_page);
			    	$second_last = $total_no_of_pages - 1; // total pages minus 1

			    	echo '<p><strong>'.$total_records.'</strong> recepies found.</p>';

			    	// display recepies
			    	$sql = "SELECT * FROM recipe ".$search_sql." LIMIT $offset, $total_records_per_page ";
			    	$result = mysqli_query($connection, $sql);
			    	
			    	$count = 1;
			    	while($row = mysqli_fetch_array($result)){
			    	
			    		$url = 'recipes.php?id='.$row['id']; 
			    		$title = $row['title'];
			    		$image = BASEURL.'/recipe_photos/'.$row['image'];

			    		if($count % 3 == 0){
			    			echo '<div class="row">';
			    		}
				    		echo '
							<div class="col-sm-4 text-center">
								<a href="'.$url.'" class="category-thumb">
									<img src="'.$image.'" width="100%" alt="'.$title.'"/>
									'.$title.'
								</a>
							</div>';

						if($count % 3 == 0){
			    			echo '</div>';
			    		}
			    		
			    		$count++;
			    	}
			    ?>

			    <!-- create pagination -->
			   	<div class="row">
	   			   	<div class="col-sm-12">
		   			   	<div class="text-center">
		   		   		   	<ul class="pagination">
		   		   			    <?php 

		   		   			    	if(isset($_GET['s'])){
		   		   			    		$page_url = BASEURL.'/recipes.php?s='.$search.'&';
		   		   			    	}else{
		   		   			    		$page_url = BASEURL.'/recipes.php?';
		   		   			    	}


		   		   			    	if($page_no > 1){
		   		   			    		echo "<li><a href='".$page_url."page_no=1'>First Page</a></li>";
		   		   			    	} 
		   		   			    ?>
		   		   			        
		   		   			    <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
		   		   				    <a 
		   		   				    	<?php 
		   		   				    		if($page_no > 1){
		   		   				    			echo "href='".$page_url."page_no=$previous_page'";
		   		   				    		} 
		   		   				    	?>
		   		   				    >Previous</a>
		   		   			    </li>
		   		   			        
		   		   			    <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
		   		   			    	<a 
		   		   				    	<?php 
		   		   				    		if($page_no < $total_no_of_pages) {
		   		   				    			echo "href='".$page_url."page_no=$next_page'";
		   		   				    		} 
		   		   				    	?>
		   		   			    	>Next</a>
		   		   			    </li>
		   		   			     
		   		   			    <?php 
		   		   			    	if($page_no < $total_no_of_pages){
		   		   			    		echo "<li><a href='".$page_url."page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		   		   			    	} 
		   		   			    ?>
		   		   		    </ul>
		   			   	</div>
	   			   	</div>
			   	</div>
			   	<!-- pagination end -->

			</div>
		</div>
	</div>
</div>

<?php
	}
?>

<!-- display categories -->
<div class="section" style="background: #eee;">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				
				<h2 class="orange">Choose your meal!</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

				<br><br>

			    <?php
			    	// fetch categories
			    	$sql = "SELECT id, title, image FROM categories";
			    	$result = mysqli_query($connection, $sql);
			    	while($row = mysqli_fetch_array($result)){
			    	
			    		$image = BASEURL.'/category_photos/'.$row['image'];
			    		$url = BASEURL.'/category.php?id='.$row['id'];
			    		$title = $row['title'];

			    		echo '
			    		<div class="col-sm-4 text-center">
			    			<a href="'.$url.'" class="category-thumb">
				    			<img src="'.$image.'" class="img-responsive" alt="'.$title.'"/>
				    			'.$title.'
				    		</a>
				    	</div>';
			    	
			    	}
			    ?>

			</div>
		</div>
	</div>
</div>

<?php
	// include footer
    include_once 'includes/footer.php';
?>
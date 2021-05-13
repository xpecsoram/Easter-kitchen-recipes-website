<?php
	// include header
    include_once 'includes/header.php';
?>

	<title>About Us</title>

<?php
	// include menu bar
    include_once 'includes/nav.php';
?>

<div id="cat-wrapper" style="background: url('<?php echo BASEURL;?>/images/banner-1.jpg') center center no-repeat; background-size: cover;">
	<div class="cat-overlay">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<!-- page heading -->
					<h1>About Us</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
			<br><br>

			<h2 class="orange">Who We Are</h2>

			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			<br>

			<div class="text-center">
				<a href="<?php echo BASEURL;?>/categories.php" class="btn btn-outline btn-primary btn-lg min-200" style="margin: 5px;">CATEGORIES</a> 
				<a href="<?php echo BASEURL;?>/recipes.php" class="btn btn-outline btn-primary btn-lg min-200" style="margin: 5px;">RECIPES</a>
			</div>

			<br>

			<h2 class="orange">How we started?</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			<br><br>

			<h2 class="orange">More delicious recipes!</h2>
				
			<br>

			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			<br>
			
			<?php
				// fetch any 3 recipes (random records)
		    	$sql = "SELECT id, title, image FROM recipe ORDER BY rand() LIMIT 3";
		    	$result = mysqli_query($connection, $sql);
		    	while($row = mysqli_fetch_array($result)){
		    	
		    		$image = BASEURL.'/recipe_photos/'.$row['image'];
		    		$url = BASEURL.'/recipes.php?id='.$row['id'];
		    		$title = $row['title'];

		    		echo '
		    		<div class="col-sm-4 text-center">
		    			<a href="'.$url.'" class="category-thumb">
			    			<img src="'.$image.'" width="100%" alt="'.$title.'"/>
			    			'.$title.'
			    		</a>
			    	</div>';
		    	
		    	}
			?>
		</div>
		<div class="col-sm-12 text-center section">
			<a href="<?php echo BASEURL;?>/recipes.php" class="btn btn-outline btn-primary btn-lg min-200" style="margin: 5px;">ALL RECIPES</a>
		</div>
	</div>
</div>

<?php
	// include footer
    include_once 'includes/footer.php';
?>
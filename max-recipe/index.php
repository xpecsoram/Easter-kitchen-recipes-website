<?php
	// include header
    include_once 'includes/header.php';
?>

	<title>Home</title>

</head>
<body>
	
<?php
	// include menu bar
    include_once 'includes/nav.php';
?>

<div id="wrapper">
	<div class="overlay">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<!-- page heading -->
					<h1 class="text-white">WELCOME TO RECIPE BLOG</h1>
					<h1 class="text-white">THE #1 RECIPE SOURCE</h1>
					<br>
					<a href="<?php echo BASEURL;?>/category.php" class="btn btn-outline btn-primary btn-lg min-200" style="margin: 5px;">EXPLORE CATEGORIES</a> 
					<a href="<?php echo BASEURL;?>/recipes.php" class="btn btn-outline btn-primary btn-lg min-200" style="margin: 5px;">EXPLORE RECIPES</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				
				<h2 class="orange">Choose your meal!</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

				<br><br>

			    <?php
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
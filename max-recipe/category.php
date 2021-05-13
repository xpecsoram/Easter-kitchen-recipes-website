<?php
	// include header
    include_once 'includes/header.php';

    $category_id = $_GET['id'];

    $sql = "SELECT id, title, image FROM categories WHERE id = '$category_id' ";
	$result = mysqli_query($connection, $sql);

	// hide sections if category not found
	if(mysqli_num_rows($result) == 0){
		echo '<style>.do-hide{ display: none; }</style>';
	}
	
	$row = mysqli_fetch_array($result);
	
	$image = BASEURL.'/category_photos/'.$row['image'];
	$page_url = BASEURL.'/category.php?id='.$row['id'];
	$title = $row['title'];

?>

	<title>Category: <?php echo $title;?></title>

</head>
<body>

<?php
	// include menu bar
    include_once 'includes/nav.php';
?>

<div id="cat-wrapper" style="background: url('<?php echo $image;?>') center center no-repeat; background-size: cover;" class="do-hide">
	<div class="cat-overlay">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<!-- page heading -->
					<h1><?php echo $title;?></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section do-hide">
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
			    	$result_count = mysqli_query($connection, "SELECT COUNT(*) As total_records FROM recipe WHERE category_id = '$category_id'");
			    	$total_records = mysqli_fetch_array($result_count);
			    	$total_records = $total_records['total_records'];
			    	$total_no_of_pages = ceil($total_records / $total_records_per_page);
			    	$second_last = $total_no_of_pages - 1; // total pages minus 1

			    	echo '<p class="alert alert-success text-center"><strong>'.$total_records.'</strong> recepies found under <strong>'.$title.'</strong> category.</p>';

			    	// display recepies
			    	$sql = "SELECT * FROM recipe WHERE category_id = '$category_id' LIMIT $offset, $total_records_per_page ";
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
		   		   			    	if($page_no > 1){
		   		   			    		echo "<li><a href='".$page_url."&page_no=1'>First Page</a></li>";
		   		   			    	} 
		   		   			    ?>
		   		   			        
		   		   			    <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
		   		   				    <a 
		   		   				    	<?php 
		   		   				    		if($page_no > 1){
		   		   				    			echo "href='".$page_url."&page_no=$previous_page'";
		   		   				    		} 
		   		   				    	?>
		   		   				    >Previous</a>
		   		   			    </li>
		   		   			        
		   		   			    <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
		   		   			    	<a 
		   		   				    	<?php 
		   		   				    		if($page_no < $total_no_of_pages) {
		   		   				    			echo "href='".$page_url."&page_no=$next_page'";
		   		   				    		} 
		   		   				    	?>
		   		   			    	>Next</a>
		   		   			    </li>
		   		   			     
		   		   			    <?php 
		   		   			    	if($page_no < $total_no_of_pages){
		   		   			    		echo "<li><a href='".$page_url."&page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
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

<!-- display category -->
<div class="section" style="background: #eee;">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				
				<h2 class="orange">Choose your meal!</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

				<br><br>

			    <?php
			    	// get categories
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
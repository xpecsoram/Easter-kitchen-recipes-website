<?php
    include_once 'includes/header.php';
?>

<?php
    include_once '../includes/nav.php';
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12" style="min-height: 80vh">
			
			<!-- page heading -->
			<h1>Recipe</h1>

			<hr/>

			<?php
				include 'includes/notifications.php';
			?>

			<br>

			<div class="col-sm-3">
				<?php
					include 'includes/sidebar.php';
				?>
			</div>

		    <div class="col-sm-9">
		    	<?php
		    		// is page is view -> display all recipes
		    		if($_GET['page'] == 'view'){

		    			// write sql query to fetch recipes
		    			$sql_recipes = "SELECT id, title, image, category_id FROM recipe";
		    			
		    			// execute sql query
		    			$result_recipes = mysqli_query($connection, $sql_recipes);
		    			
		    			// create table
		    			echo '
		    				<p class="text-right">
		    					<a href="'.ADMIN_BASEURL.'/recipes.php?page=add" class="btn btn-info">Create new recipe</a>
		    				</p>
		    				<p>The following table displays all active recipes:</p>
		    				<table class="table table-bordered">
		    					<tr>
			    					<th>#</th>
			    					<th>Category</th>
			    					<th>Title</th>
			    					<th>Image</th>
			    					<th width="150">Actions</th>
			    				</tr>';

			    			// create counter to display serial
			    			$counter = 1;
			    			// iterate all and fetch information
			    			while($row_recipes = mysqli_fetch_array($result_recipes)){

			    				$id = $row_recipes['id']; // get  id
			    				$link = BASEURL.'/recipes.php?id='.$id; // id with link
			    				$title = $row_recipes['title']; // title
			    				$image = $row_recipes['image']; // image
			    				$category_id = $row_recipes['category_id'];

			    				// write sql query to fetch categories
			    				$sql_categories = "SELECT id, title FROM categories WHERE id = '$category_id'";
			    				// execute sql query
		    					$result_categories = mysqli_query($connection, $sql_categories);
		    					$row_categories = mysqli_fetch_array($result_categories);

			    				$category_title = $row_categories['title'];
			    				$category_link = BASEURL.'/category.php?id='.$id; // id with link
			    				
			    				// create and display table rows with actions (edit & delete)
			    				echo '<tr>
			    						<td>'.$counter.'</td>
			    						<td><a href="'.$category_link.'" target="_blank">'.$category_title.'</a></td>
			    						<td><a href="'.$link.'" target="_blank">'.$title.'</a></td>
			    						<td><img src="'.RECEIPE_IMG_URL.'/'.$image.'" height="50px"></td>
			    						<td>
			    							<a href="'.ADMIN_BASEURL.'/recipes.php?page=edit&id='.$id.'" class="btn btn-success btn-xs">Edit</a> &nbsp;
			    							<a class="btn btn-danger btn-xs" 
			    								onClick="javascript:delete_data($(this));return false;"
			    								href="delete.php?type=recipes&id='.$id.'"
			    							>Delete</a>
			    						</td>
			    					 </tr>';

			    				$counter++;
			    			}
		    			echo '</table>';
		    		}



		    		// is page is add -> display form to add a new 
		    		else if($_GET['page'] == 'add'){

		    			// logic for create form submission
		    			if(isset($_POST['add'])){
		    				// get submitted data
		    				$title = mysqli_real_escape_string($connection, $_POST['title']);
		    				$category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
		    				$ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);
		    				$instructions = mysqli_real_escape_string($connection, $_POST['instructions']);
    						$image_size = $_FILES['image']['size'];

    						// upload image
    						$fileType = mysqli_real_escape_string($connection,$_FILES['image']['type']);
						    $path = '../recipe_photos/';
						    $upFile = date('YmdHis').'-'.$_FILES['image']['name'];
						    if(is_uploaded_file($_FILES['image']['tmp_name'])){
						        if(!move_uploaded_file($_FILES['image']['tmp_name'], $path.$upFile)) {
							        $_SESSION['alert'] = "Permission Denied! File could not upload";
						        }

						        $image = $upFile;
						        // create sql
						        $sql = "INSERT INTO recipe (title, category_id, ingredients, instructions, image) VALUES ('$title', '$category_id', '$ingredients', '$instructions', '$image')";
						        // execute sql
						        $result = mysqli_query($connection, $sql);
						        if($result == true){
						        	$_SESSION['success'] = "Success! Record is created successfully!";
						        }
						        else{
						        	$_SESSION['alert'] = "Error! something went wrong";
						        }

						    } else {
						        $_SESSION['alert'] = "Possible file upload attack!";
						    }
		    			}

		    			include 'includes/notifications.php';

		    			?>
		    			<p class="text-right">
	    					<a href="<?php echo ADMIN_BASEURL; ?>/recipes.php?page=view" class="btn btn-info">View all recipes</a>
	    				</p>
	    				<p>The following form will let you create a new recipe:</p>
			    		<!-- add form -->
			    		<form method="POST" action="" name="add" class="well" style="overflow: hidden;" enctype="multipart/form-data">
			    			<div class="col-sm-12">
			    				<!--  title -->
				    			<label>Title</label>
					    		<input type="text" name="title" class="form-control" required />

								<br/>

								<!--  image -->
				    			<label>Categories</label>
				    			<select class="form-control" name="category_id">
									<?php
										// write sql query to fetch categories
					    				$sql_categories = "SELECT id, title FROM categories";
					    				// execute sql query
				    					$result_categories = mysqli_query($connection, $sql_categories);
				    					while($row_categories = mysqli_fetch_array($result_categories)){
				    						echo '<option value="'.$row_categories['id'].'">'.$row_categories['title'].'</option>';
				    					}
									?>
								</select>

								<br/>

								<!--  Ingredients -->
				    			<label>Ingredients</label>
					    		<textarea name="ingredients" class="form-control" rows="8" required></textarea>

								<br/>

								<!--  Instructions -->
				    			<label>Instructions</label>
					    		<textarea name="instructions" class="form-control" rows="8" required></textarea>

								<br/>

								<!--  image -->
				    			<label>Image</label>
					    		<input type="file" name="image" class="form-control" required />

					    		<br/>

				    			<!-- create submit button -->
				    			<input type="submit" name="add" value="Create Recipe" class="btn btn-primary">
				    		</div>
			    		</form>
			    		<?php
		    		}




		    		// is page is edit -> display form to edit an existing rrecord
		    		else if($_GET['page'] == 'edit'){

		    			// get  id from URL
						$id = mysqli_real_escape_string($connection, $_GET['id']);

		    			// logic for create  form submission
		    			if(isset($_POST['edit'])){
		    				// get submitted data
		    				$title = mysqli_real_escape_string($connection, $_POST['title']);
		    				$category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
		    				$ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);
		    				$instructions = mysqli_real_escape_string($connection, $_POST['instructions']);

    						$image_old = $_POST['image_old'];
    						$image_size = $_FILES['image']['size'];

    						// upload image
    						if(!empty($image_size)){
    						    $fileType = mysqli_real_escape_string($connection,$_FILES['image']['type']);
    						    $path = '../recipe_photos/';
    						    $upFile = date('YmdHis').'-'.$_FILES['image']['name'];
    						    if(is_uploaded_file($_FILES['image']['tmp_name'])){
    						        if(!move_uploaded_file($_FILES['image']['tmp_name'], $path.$upFile)) {
    							        $_SESSION['alert'] = "Permission Denied! File could not upload";
    						        }
    						    } else {
    						        $_SESSION['alert'] = "Possible file upload attack!";
    						    }
    						    $image = $upFile;
    						}else{
    						    $image = $image_old;
    						}

    						// create sql
    						$sql = "UPDATE recipe SET title = '$title', category_id = '$category_id', ingredients = '$ingredients', instructions = '$instructions', image = '$image' WHERE id = ".$id;
    						// execute sql
    						$result = mysqli_query($connection, $sql);
    						if($result == true){
    							$_SESSION['success'] = "Success! Record is updated successfully!";
    						}
    						else{
    							$_SESSION['alert'] = "Error! something went wrong";
    						}
		    			}

		    			include 'includes/notifications.php';

		    			// create sql
    						$sql = "SELECT * FROM recipe WHERE id = '$id' ";
    						// execute sql
    						$result = mysqli_query($connection, $sql);
    						$row = mysqli_fetch_array($result);

    						// fetch data
    						$title = $row['title'];
    						$image = $row['image'];
    						$ingredients = $row['ingredients'];
    						$instructions = $row['instructions'];
    						$category_id = $row['category_id'];
		    			?>
		    			<p class="text-right">
	    					<a href="<?php echo ADMIN_BASEURL; ?>/recipes.php?page=view" class="btn btn-info">View all recipes</a>
	    				</p>
	    				<p>The following form will let you update recipe:</p>
			    		<!-- change password form -->
			    		<form method="POST" action="" name="edit" class="well" style="overflow: hidden;" enctype="multipart/form-data">
			    			<input type="hidden" name="image_old" value="<?php echo $image;?>">
			    			<div class="col-sm-6">
			    				<!--  title -->
				    			<label>Title</label>
					    		<input type="text" name="title" value="<?php echo $title;?>" class="form-control" required />

					    		<br/>

					    		<!--  image -->
				    			<label>Categories</label>
				    			<select class="form-control" name="category_id">
									<?php
										// write sql query to fetch categories
					    				$sql_categories = "SELECT id, title FROM categories";
					    				// execute sql query
				    					$result_categories = mysqli_query($connection, $sql_categories);
				    					while($row_categories = mysqli_fetch_array($result_categories)){
				    						echo '<option value="'.$row_categories['id'].'" '.(($category_id == $row_categories['id'])?'selected':'').'>'.$row_categories['title'].'</option>';
				    					}
									?>
								</select>

								<br/>

								<!--  Ingredients -->
				    			<label>Ingredients</label>
					    		<textarea name="ingredients" class="form-control" rows="5" required><?php echo $ingredients;?></textarea>

								<br/>

								<!--  Instructions -->
				    			<label>Instructions</label>
					    		<textarea name="instructions" class="form-control" rows="5" required><?php echo $instructions;?></textarea>
					    		
					    		<br/>

				    			<!-- create submit button -->
				    			<input type="submit" name="edit" value="Update Recipe" class="btn btn-primary">
				    		</div>
				    		<div class="col-sm-6">
				    			<label>Image</label>
					    		<input type="file" name="image" class="form-control" />
					    		
					    		<br/>

				    			<img src="<?php echo RECEIPE_IMG_URL.'/'.$image;?>" class="img-responsive img-thumbnail">
				    		</div>
			    		</form>
			    		<?php
		    		}
		    	?>
		    </div>

		</div>
	</div>
</div>

<?php
    include_once '../includes/footer.php';
?>

<script type="text/javascript">
	// create delete  function
	function delete_data(anchor) {
	   var conf = confirm('Are you sure want to delete this ?');
	   // if confirmed -> proceed for delete
	   if(conf){
	   		window.location=anchor.attr("href");
	   }
	}
</script>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- logo -->
      <a class="navbar-brand" href="<?php echo BASEURL;?>">
        <img src="<?php echo BASEURL;?>/images/transparentlogo.png" class="logo">
      </a>
    </div>

    <!-- menu links -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo BASEURL;?>/about.php">About us</a></li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categories <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php
              $sql = "SELECT id, title FROM categories";
              $result = mysqli_query($connection, $sql);
              while($row = mysqli_fetch_array($result)){
                echo '<li><a href="'.BASEURL.'/category.php?id='.$row['id'].'">'.$row['title'].'</a></li>';
              }
            ?>
          </ul>
        </li>
        <li><a href="<?php echo BASEURL;?>/recipes.php">Recipes</a></li>
        <li><a href="<?php echo ACCOUNT_BASEURL;?>/reviews.php">Reviews</a></li>
        <li><a href="<?php echo ACCOUNT_BASEURL;?>/favourite.php" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Favourites">Favourite</a></li>
        
        <?php
          // if user is logged-in => show my account and logout
          if(isset($_SESSION['access']) == true && isset($_SESSION['member']) == true){
            echo '<li><a href="'.ACCOUNT_BASEURL.'/profile.php">My Account</a></li>';
            echo '<li><a href="'.ACCOUNT_BASEURL.'/logout.php" class="text-danger">Logout</a></li>';
          }
          // display logout for admin
          else if(isset($_SESSION['access']) == true && isset($_SESSION['admin']) == true){
            echo '<li><a href="'.ADMIN_BASEURL.'/logout.php" class="text-danger">Logout</a></li>';
          }
          else{
            echo '<li><a href="'.ACCOUNT_BASEURL.'/index.php">Login | Signup</a></li>';
          }
        ?>
      </ul>
    </div>
  </div>
</nav>
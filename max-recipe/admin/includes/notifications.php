<?php
    if(isset($_SESSION['alert']))
    {
        echo '<div class="alert alert-danger"><i class="fa fa-times"></i> '.$_SESSION['alert'].'</div>';
    }
    if(isset($_SESSION['success']))
    {
        echo '<div class="alert alert-success"><i class="fa fa-check"></i> '.$_SESSION['success'].'</div>';
    }
?>
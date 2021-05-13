<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				Copyright &copy; <?php echo date('Y');?>. All rights reserved
			</div>
		</div>
	</div>
</div>

<!-- include jquery and bootstrap javascript libraries -->
<script src="<?php echo BASEURL;?>/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo BASEURL;?>/js/bootstrap.min.js"></script>
<script src="<?php echo BASEURL;?>/js/bootstrap-datepicker.js"></script>



<script type="text/javascript">
	$(".datepicker").datepicker({
	  format: 'yyyy-mm-dd'
	});

	$('[data-toggle="tooltip"]').tooltip();
</script>

<?php
	unset($_SESSION['alert']);
	unset($_SESSION['success']);
?>

</body>
</html>
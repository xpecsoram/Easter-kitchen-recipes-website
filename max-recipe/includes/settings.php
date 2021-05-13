<?php
	error_reporting(1);

	session_start();

	// define default time zone
	date_default_timezone_set('America/Adak');

	// -- define site URL
	const BASEURL = 'http://localhost/max-recipe';

	// -- define URL for site members
	const ACCOUNT_BASEURL = BASEURL.'/account';

	// -- define URL for site admin
	const ADMIN_BASEURL = BASEURL.'/admin';


	// -- define recipe and category image path
	const RECEIPE_DIR = 'recipe_photos';
	const CATEGORY_DIR = 'category_photos';
	const RECEIPE_IMG_URL = BASEURL.'/'.RECEIPE_DIR;
	const CATEGORY_IMG_URL = BASEURL.'/'.CATEGORY_DIR;

	// -- set pagination limit for get all recipes
	const PAGINATE = 12;

	// -- DB credentials
	const DB_HOST = 'localhost';
	const DB_NAME = 'max_recipe';
	const DB_USER = 'root';
	const DB_PASSWORD = '';
	
	// create DB connection 
	$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
?>
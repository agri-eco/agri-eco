<?php
	$conn = mysqli_connect('localhost', 'root', '', 'agri_eco_db');
	
	if(!$conn){
		die('Error: Failed to connect to database');
	}
?>
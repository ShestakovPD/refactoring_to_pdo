<?php

	//Connect to  your rating database
	$rating_dbhost        = 'localhost';
	$rating_dbuser        = 'masters2_ridder1991';
	$rating_dbpass        = 'QcymG}Hp@N3.A5Y,';
	$rating_dbname        = 'masters2_zaimer_2019';
	$rating_tableName     = 'ratings';
	$rating_path_db       = ''; // the path to your db.php file (not used yet!)
	$rating_path_rpc      = ''; // the path to your rpc.php file (not used yet!)
	
	$rating_unitwidth     = 30; // the width (in pixels) of each rating unit (star, etc.)
	// if you changed your graphic to be 50 pixels wide, you should change the value above
	
$rating_conn = mysqli_connect($rating_dbhost, $rating_dbuser, $rating_dbpass) or die  ('Error connecting to mysql');
	//mysql_select_db($rating_dbname);

?>
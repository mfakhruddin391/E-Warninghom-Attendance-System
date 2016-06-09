<?php
//Start sessioning
session_start();
//Database Configuration
$dbhost = 'localhost';
$dbport = '3306';
$dbuser = 'root';
$dbpass = 'toor';
$dbname = 'ewarninghom';

//Session the connect variable to be used in other PHP files
$_SESSION['Connect'] = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) or die('Could not connect to database server');
?>
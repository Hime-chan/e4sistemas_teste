<link href='style.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="ajax.js"></script>
<?php 
session_start();
include("classes.php");
include('exceptions.php');
include("functions.php");
$databaseObj = new Database("mysql.purrfect.codes", "purrfect", "E4sistemas", "purrfect");
$databaseObj->connect();
$link_atual = "https://purrfect.codes/php_teste/";
?>

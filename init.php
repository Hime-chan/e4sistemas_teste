<link href='style.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="ajax.js"></script>
<?php 
session_start();
include("classes.php");
include('exceptions.php');
include("functions.php");
$databaseObj = new Database($server, $usuario, $senha, $database); // Preencher aqui!
$databaseObj->connect();
?>
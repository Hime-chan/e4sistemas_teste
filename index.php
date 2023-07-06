<html>
<head>
	<title>Teste de Conhecimento - E4sistemas - Claudia C. F.</title>
	<link rel="icon" href="favico_teste_ccf.png" type="image/png">
<? include('init.php'); ?>
</head>
<body>
<h1>Teste de Conhecimento - E4sistemas - Claudia C. F.</h1>
<div id='container'>
<div id='main'>
<? include($_SESSION['u_usuario']?($_GET['pg']?$_GET['pg'].'.php':'menu.php'):'login.php');?>
</div>
</div>
</body>
</html>
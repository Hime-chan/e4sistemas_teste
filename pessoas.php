<? 	include_once('init.php');
	if (!$_SESSION['u_status']) {echo "Você não está logado."; header('Location: '.$link_atual);} ?>
<h2>Pessoas</h2>
<div id='pessoas'>
<div id='listar_target'><? $_GET['tipo']='pessoa';include('listar.php'); ?></div>
<a class='button' id='nova_pessoa' onclick="ajax('pessoas_novo.php','nova_pessoa_target','pessoas')">Adicionar nova pessoa</a>
<div id='nova_pessoa_target'></div>
</div>
<div id='compact_menu'><? include('menu.php'); ?></div>
	

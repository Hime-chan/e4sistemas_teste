<? 	include_once('init.php');
	if (!$_SESSION['u_status']) {echo "Você não está logado."; header('Location: '.$link_atual);} ?>
<h2>Usuários</h2>
<div id='usuarios'>
<div id='listar_target'><? $_GET['tipo']='usuario';include('listar.php'); ?></div>
<a class='button' id='novo_usuario' onclick="ajax('usuarios_novo.php','novo_usuario_target','usuarios')">Adicionar novo usuário</a>
<div id='novo_usuario_target'></div>
</div>
<div id='compact_menu'><? include('menu.php'); ?></div>
	

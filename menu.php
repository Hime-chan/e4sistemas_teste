<? if (!$_GET['pg']) {?><span class='center'><? if ($_SESSION['u_usuario']) {echo "Seja bem-vindo(a), ".$_SESSION['u_nome']."!";} ?></span><? } ?>
<div id='menu'>
<a onclick="ajax('usuarios.php','main','usuarios')">Usuários</a>
<a onclick="ajax('pessoas.php','main','pessoas')">Pessoas</a>
<a onclick="ajax('logout.php','container','')">Logout</a>
</div>
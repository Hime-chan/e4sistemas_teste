<h2>Login</h2>
<? include_once('init.php');
   try {logar($_POST['usuario'],$_POST['senha'],$databaseObj->getConnection());
		header('Location: '.$link_atual.'menu.php');} 
   catch (Exception $excecao) {echo $excecao->getMessage();}
?>
<form method="post" id='form_login' class="label_block">
	<label>Usuário: <input required type="text" name="usuario" value=""/></label>
	<label class='password'>Senha: <input required type="password" name="senha"/><span onclick='toggleSenhaVisibility(this)'>👁</span></label>
	<input type="submit" value="Login">
</form>
<script>
  document.getElementById("form_login").addEventListener("submit", 
			function(event) {event.preventDefault();
							 //var formData = new FormData(this);
							 form_ajax("login.php", "main", "form_login",'');});
					 
</script>

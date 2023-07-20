<h2><? echo (($_GET['Id']||$_POST['Id'])?"Alteração de":"Novo")." usuário"; ?></h2>
<?  include_once('init.php'); 
	if (!$_SESSION['u_status']) {echo "Você não está logado."; header('Location: '.$link_atual);}
if ($_POST['submited'])
	{$usuario = new user($_POST);
	 try {if ($_POST['Id'])
			{$usuario->update($databaseObj->getConnection());}
		  else {$usuario->insert($databaseObj->getConnection());} 
		  echo "O usuário foi ".($_POST['Id']?"alterado":"cadastrado")." com sucesso.";} 
	 catch (Exception $excecao) {echo $excecao->getMessage();}
	}
else { if ($_GET['Id']) 
		{$usuario_alt=mysqli_fetch_array($databaseObj->query("select Id,nome,email,usuario,senha,status from usuario where excluido=0 and Id=".$_GET['Id']));} ?>
		<form method="post" id='form_cadastro' class="label_block">
			<label>Nome: <input required type="text" name="nome" value="<? echo $usuario_alt['nome']; ?>"/></label>
			<label>E-mail: <input required placeholder="exemplo@dominio.com" pattern="^.+@.+\..+$" type="text" name="email" value="<? echo $usuario_alt['email']; ?>"/></label>
			<label>Usuário: <input autocomplete="off" required type="text" name="usuario" value="<? echo $usuario_alt['usuario']; ?>"/></label>
			<input type='hidden' name='submited' value='true'/>
			<input type='hidden' name='Id' value='<? echo $usuario_alt['Id']; ?>'/>
			<label class='password'>Senha: <input autocomplete="off" required type="password" name="senha" value=""/>
			<span onclick='toggleSenhaVisibility(this)'>👁</span></label>
			<label class='check'>Ativo: <input type='checkbox' name='status' value='1' <? echo (($usuario_alt['status']==='0')?"":'checked'); ?>/></label>
			<input type="submit" value="<? echo ($_GET['Id']?"Alterar":"Cadastrar"); ?>"/>
		</form>
		<script>
		  document.getElementById("form_cadastro").addEventListener("submit", 
					function(event) {event.preventDefault();
									 setTimeout("ajax('listar.php?tipo=usuario','listar_target','usuarios');",500);
									 form_ajax("usuarios_novo.php", "novo_usuario_target", "form_cadastro",'usuarios');
									 });
		</script> 
<?		}?>


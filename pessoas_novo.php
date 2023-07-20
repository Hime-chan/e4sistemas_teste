<h2><? echo (($_GET['Id']||$_POST['Id'])?"Alteração de":"Nova")." pessoa"; ?></h2>
<?  include_once('init.php'); 
	if (!$_SESSION['u_status']) {echo "Você não está logado."; header('Location: '.$link_atual);}
if ($_POST['submited'])
	{$telefones = array_filter($_POST, function($key) {return preg_match('/^telefone/', $key);}, ARRAY_FILTER_USE_KEY);
	 $_POST['telefones'] = implode(',', $telefones);
	 $pessoa = new person($_POST);
	 try {if ($_POST['Id'])
			{$pessoa->update($databaseObj->getConnection(),($_POST['autoria']=='1'));}
		  else {$pessoa->insert($databaseObj->getConnection());} 
		  echo "O usuário foi ".($_POST['Id']?"alterado":"cadastrado")." com sucesso.";} 
	 catch (Exception $excecao) {echo $excecao->getMessage();}
	}
else { if ($_GET['Id']) 
		{$pessoa_alt=mysqli_fetch_array($databaseObj->query("select pessoa.*, GROUP_CONCAT(telefone.telefone SEPARATOR ',') AS telefones from pessoa
										left join telefone on telefone.pessoa_id = pessoa.Id where pessoa.Id='".$_GET['Id']."' group by pessoa.Id",false));} ?>
		<form method="post" id='form_cadastro' class="label_block">
			<label>Nome: <input required type="text" name="nome" value="<? echo $pessoa_alt['nome']; ?>"/></label>
			<label>E-mail: <input required type="text" placeholder="exemplo@dominio.com" pattern="^.+@.+\..+$" name="email" value="<? echo $pessoa_alt['email']; ?>"/></label>
			<label>Endereço: <input required type="text" name="endereco_linha1" value="<? echo $pessoa_alt['endereco_linha1']; ?>"/><br> 
							 <input required type="text" name="endereco_linha2" value="<? echo $pessoa_alt['endereco_linha2']; ?>"/></label>
			<label class='telefones'>Telefones: 
							  <? if ($pessoa_alt['telefones']) 
									{$ar_telefones=explode(',', $pessoa_alt['telefones']);
									 $i=0; 
									 array_map(function ($telefone) use (&$i) {echo "<input type='text' ".(($i==0)?"required":"onblur=\"if (this.value.trim() === '') {this.parentElement.removeChild(this);}\"")." name='telefone".(++$i)."' value='" . $telefone."'/>";}, $ar_telefones);}
								 else {?><input type='text' required name='telefone1'/><?}?>
							  <a onclick="add_lines(this);" alt='Adicionar mais telefones' title='Adicionar mais telefones'>+</a>
			</label>				 
			<? if ($_GET['Id'])  {?><label class='check'>Mudar autoria do cadastro: <input type='checkbox' name='autoria' value='1'/></label><? } ?>
			<input type='hidden' name='submited' value='true'/>
			<input type='hidden' name='Id' value='<? echo $pessoa_alt['Id']; ?>'/>			
			<input type="submit" value="<? echo ($_GET['Id']?"Alterar":"Cadastrar"); ?>"/>
		</form>
		<script>
		  document.getElementById("form_cadastro").addEventListener("submit", 
					function(event) {event.preventDefault();
									 setTimeout("ajax('listar.php?tipo=pessoa','listar_target','pessoas');",500);
									 form_ajax("pessoas_novo.php", "nova_pessoa_target", "form_cadastro",'pessoas');
									 });
		</script> 
<?		}?>


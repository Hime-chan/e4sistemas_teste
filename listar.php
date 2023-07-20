<? include_once('init.php');
   if (!$_SESSION['u_status']) {echo "Você não está logado."; header('Location: '.$link_atual);}  
   if ($_GET['tipo']=='usuario') 
			{$sql="select Id,nome,email,usuario,status from usuario where excluido=0 and Id!=2 order by Id";
			 $classe='user';
			 $cabecalho="<th>Nome</th><th>E-mail</th><th>Usuário</th><th></th>";} 
	   else {$sql="select pessoa.*,usuario.id as cadastrado_por_id,usuario.nome as cadastrado_por_nome, 
				   GROUP_CONCAT(telefone.telefone SEPARATOR ',') AS telefones from pessoa 
				   left join usuario on usuario.Id = pessoa.usuario_id left join telefone on telefone.pessoa_id = pessoa.Id
				   group by pessoa.Id";
			 $classe='person';
			 $cabecalho="<th>Nome</th><th>E-mail</th><th>Endereço</th><th>Responsável</th><th style='width:150px'>Telefones</th><th></th>";}
	?>
	<? $qry = $databaseObj->query($sql,false); ?>
		<table id='list'>
			<tr><? echo $cabecalho; ?></tr>
			<?  while ($array=mysqli_fetch_array($qry))
					{$objeto = new $classe($array);
					 $objeto->print_tr();} ?>
		</table>

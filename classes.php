<?php
class database
	{private $host;
     private $username;
     private $password;
     private $database;
     private $connection;
	 
	 public function __construct($host, $username, $password, $database) 
		{$this->host = $host;
         $this->username = $username;
         $this->password = $password;
         $this->database = $database; }
	 
	 public function connect() 
		{$this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
		 if ($this->connection->connect_error) 
			{die("Erro ao conectar ao banco de dados: " . $this->connection->connect_error);}
		 $this->connection->query("SET NAMES 'utf8'");}
	
	public function getConnection() 
		{return $this->connection;}
	
	public function query($SQL,$protection=true)
	 {if ($protection) {$SQL=($this->connection->real_escape_string($SQL));} 
	  return ($this->connection->query($SQL));}
	
	public function insert_id()
	 {return $this->connection->insert_id();}
		
	}	
	
class person
	{private $id;
	 private $nome;
	 private $email;
	 private $endereco_linha1;
	 private $endereco_linha2;
	 private $cadastrado_por_id;
	 private $cadastrado_por_nome;
	 private $telefones = array();
	 
	 public function __construct($array_result) 
		{$this->id=$array_result['Id'];
		 $this->nome=$array_result['nome'];
		 $this->email=$array_result['email'];
		 $this->endereco_linha1=$array_result['endereco_linha1'];
		 $this->endereco_linha2=$array_result['endereco_linha2'];
		 $this->cadastrado_por_id=($array_result['cadastrado_por_id']?$array_result['cadastrado_por_id']:$_SESSION['u_Id']);
		 $this->cadastrado_por_nome=$array_result['cadastrado_por_nome'];
		 $this->telefones=array_filter(array_map('trim', explode(",", $array_result['telefones'])), 'strlen');
		 }
	 public function print_tr()
		{echo "<tr>"
				."<td>".$this->nome."</td>"
				."<td>".$this->email."</td>"
				."<td>".$this->endereco_linha1."<br>".$this->endereco_linha2."</td>"
				."<td>".$this->cadastrado_por_nome."</td>"
				."<td>".implode("<br>", $this->telefones)."</td>"
				."<td class='buttons'>"
					."<a onclick=\"ajax('pessoas_novo.php?Id=".$this->id."','nova_pessoa_target','pessoas')\">Alterar</a><br><br>"
					."<a onclick=\"if(confirm('Deseja excluir a pessoa ".$this->nome."?')) {ajax('pessoas_apagar.php?Id=".$this->id."','listar_target','pessoas')}\">Excluir</a>"
				."</td></tr>";}
	
	 public function insert($database)
		{if ($database->query("insert into pessoa(nome, email, endereco_linha1, endereco_linha2, usuario_id) values('".$this->nome."','".$this->email."','".$this->endereco_linha1."','".$this->endereco_linha2."','".$this->cadastrado_por_id."')"))
			{$this->id=mysqli_insert_id($database);
			 $sql_telefones="insert into telefone(pessoa_id,telefone) values(".$this->id.",'".implode("'),(".$this->id.",'", $this->telefones)."')";
			 $database->query($sql_telefones);}
		 else {throw new Cadastro_ErroConexao($database);}
		}
	 
	 public function update($database,$change_user)
		{if ($change_user) {$this->cadastrado_por_id=$_SESSION['u_Id']; $this->cadastrado_por_nome=$_SESSION['u_nome'];}
		 if ($database->query("update pessoa set nome='".$this->nome."', email='".$this->email."', endereco_linha1='".$this->endereco_linha1."', endereco_linha2='".$this->endereco_linha2."' ".($change_user?", usuario_id='".$this->cadastrado_por_id."' ":"")." where Id=".$this->id))
			{$database->query('delete from telefone where pessoa_id='.$this->id);
			 $sql_telefones="insert into telefone(pessoa_id,telefone) values(".$this->id.",'".implode("'),(".$this->id.",'", $this->telefones)."')";
			 $database->query($sql_telefones);}
		 else {throw new Cadastro_ErroConexao($database);}	 
		}	
	 }
	
class user
	{private $nome;
	 private $id;
	 private $email;
	 private $usuario;
	 private $senha;
	 private $status;
	 
	 public function __construct($array_result) 
		{$this->nome=$array_result['nome'];
		 $this->id=$array_result['Id'];
		 $this->email=$array_result['email'];
		 $this->usuario=$array_result['usuario'];
		 $this->senha=$array_result['senha'];
		 $this->status=$array_result['status'];
		 }
	 
	 public function print_tr()
		{echo "<tr class='active".$this->status."'>"
				."<td>".$this->nome."</td>"
				."<td>".$this->email."</td>"
				."<td>".$this->usuario."</td>"
				."<td class='buttons'>"
					."<a onclick=\"ajax('usuarios_novo.php?Id=".$this->id."','novo_usuario_target','usuarios')\">Alterar</a>"
					."<a onclick=\"if(confirm('Deseja excluir o usuário ".$this->nome."?')) {ajax('usuarios_apagar.php?Id=".$this->id."','listar_target','usuarios')}\">Excluir</a>"
				."</td></tr>";}
	 
	 public function insert($database)
		{if ($database->query("insert into usuario(nome, email, usuario, senha, status) values('".$this->nome."','".$this->email."','".$this->usuario."',PASSWORD('".$this->senha."'),'".($this->status?$this->status:'0')."')"))
			{$this->id=mysqli_insert_id($database);}
		 else {throw new Cadastro_ErroConexao($database);}
		}

	 public function update($database)
		{if (!$database->query("update usuario set nome='".$this->nome."', email='".$this->email."', usuario='".$this->usuario."', senha=PASSWORD('".$this->senha."'), status='".($this->status?$this->status:'0')."' where Id=".$this->id))
			{throw new Cadastro_ErroConexao($database);}
		}
	 }	
?>
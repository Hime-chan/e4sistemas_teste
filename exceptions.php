<?php
class Login_UsuarioSenhaNaoConferem extends Exception 
	{public function __construct($message = "O usuário ou a senha não confere.", $code = 0, Exception  $previous = null) {parent::__construct($message, $code, $previous);}}

class Login_NaoPreenchido extends Exception 
	{public function __construct($message = "Preencha corretamente usuário e senha.", $code = 0, Exception $previous = null) {parent::__construct($message, $code, $previous);}}
	
class Cadastro_ErroConexao extends Exception 
	{public function __construct($database) 
		{$message = "Erro ao cadastrar no banco de dados: " . mysqli_error($database);
         $code = mysqli_errno($database);
         parent::__construct($message, $code);}}
?>
<?php 
function crypto($string)
	    {return password_hash($string, PASSWORD_BCRYPT);}

function settypestring($string)
   {$string = get_magic_quotes_gpc() ? stripslashes($string) : $string;
    $string = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($GLOBALS["conx"],$string) : mysqli_escape_string($GLOBALS["conx"],$string);
    return $string;}	

function logar($usuario,$senha,$database)
	{$preencheu=false;
	 if ($usuario&&$senha&&($preencheu=true)&&
		($array=mysqli_fetch_array($database->query("select * from usuario where usuario='".$usuario."' and senha=PASSWORD('".$senha."') and status='1' order by Id desc limit 1"))))
		{foreach($array as $key => $value)
			{if ($key!='senha')
				{$_SESSION["u_".$key]=$value;
				 setcookie("u_".$key,$value,time()+18144000,'/','purring.codes',false);}}
		 return true;
		}
	 else{throw ($preencheu ? new Login_UsuarioSenhaNaoConferem() : new Login_NaoPreenchido());}	
	 }
?>
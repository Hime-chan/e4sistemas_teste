<?  include_once('init.php'); 
	if (!$_SESSION['u_status']) {echo "Você não está logado."; header('Location: '.$link_atual);}
$_GET['tipo']='usuario'; 
$databaseObj->query("update ".$_GET['tipo']." set excluido=1 where Id=".$_GET['Id']);
include_once('listar.php');
	?>


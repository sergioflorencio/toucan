<html lang="pt-BR">
<?php
		session_start();

		include "../../php/login.php";
		
		$login=new login;
		$login->checklogin();

?>
</html>

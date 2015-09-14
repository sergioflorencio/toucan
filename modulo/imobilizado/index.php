<html lang="pt-BR">

<?php
		session_start();
		
		include "php/php.php";
		include "php/config.php";
		include "../dependencias.php";
		include "../php/nav_bar.php";
		include "../php/login.php";
	 
		
		$login=new login;
		$login->checklogin();

?>
</html>
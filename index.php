<html lang="pt-BR">
<?php
		session_start();
		include "php/config.php";
		include "php/sql.php";
		include "php/login.php";
		include "php/nav_bar.php";
		include "dependencias.php";

		$login=new login;
		$login->login_empresa();		
		$login->checklogin();


?>


	<div class="uk-width-small-1-1 uk-width-medium-4-5 uk-width-large-3-4 uk-container-center uk-text-center">
		<div class="uk-grid ">
			<?php

			
				if(((isset($_GET['act']) and $_GET['act']=="mudar_empresa")or (isset($_SESSION['cod_empresa'])==false )or (isset($_SESSION['cod_empresa']) and $_SESSION['cod_empresa']=="")) and (isset($_SESSION['loged']) and $_SESSION['loged']==true)){
					$navempresa=new navempresa;
					$navempresa->escolher_empresa();
				}else{
					if(isset($_SESSION['cod_empresa'])){

					$navbar=new navbar;
					$navbar->navbar_intranet();
					}
				}
				?>
		</div>
	</div>


	
	
	<style>
	.desabilitado {
		pointer-events: none;	
		color: #ccc;
	}
	#div_empresas ul li{
		margin-top: -15px;
		
	}

	
	
	</style>
	
</html>
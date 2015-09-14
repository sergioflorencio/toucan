<?php
	session_start();
	 include "php.php";
	//var_dump($_POST);
	
	 if(
		isset($_POST['tabela']) and
		isset($_POST['campo']) and
		isset($_POST['id']) and
		
		$_POST['tabela']!='' and
		$_POST['campo']!='' and
		$_POST['id']!='' 
	 ){
		
		//cad_pessoas
		if($_POST['tabela']=='cad_pessoas'){
			include "config.php";
			
			$result = mysql_query("SELECT * FROM ".$schema.".cad_colaboradores where cad_colaboradores.cod_empresa=".$_SESSION['cod_empresa']." and cod_pessoa=".$_POST['id'].";", $conexao);
			$ncolab = mysql_num_rows($result);
			//echo "ncolab:".$ncolab."<br/>";

			$result = mysql_query("SELECT * FROM ".$schema.".cad_cartas where cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and cod_contribuinte=".$_POST['id'].";", $conexao);
			$ncarta = mysql_num_rows($result);
			//echo "ncarta:".$ncarta."<br/>";

			
			//verificar se é colaborador
			
				if($ncolab>=1){
					echo "
						<div class='uk-alert uk-alert-success tm-main uk-container-center' data-uk-alert=''>
							<a href='' class='uk-alert-close uk-close'></a>
							<p>Esta pessoa está cadastrada como colaborador, o cadatro não poderá ser excluido!</p>
						</div>
					";	
				
				}else{
					//verificar se há uma carta lançada para ele
						if($ncarta>=1){
							echo "
								<div class='uk-alert uk-alert-success tm-main uk-container-center' data-uk-alert=''>
									<a href='' class='uk-alert-close uk-close'></a>
									<p>Há uma carta de doação lançada para esta pessoa, o cadatro não poderá ser excluido!</p>
								</div>
							";	
						
						}else{
								$table=$_POST['tabela'];
								$where="`".$_POST['campo']."`=".$_POST['id'];
								 
								$sql=new sql;
								$sql->delete($table,$where);
						}
				}	

		}
		

		
		 
	 }






?>
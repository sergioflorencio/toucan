<?php

	session_start();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
			
		include "php.php";
		include "sql.php";
		//var_dump($_POST);

		if(isset($_POST)){
				
			if($_POST['act']=="salvar_modulo"){
				$sql=new sql;
				$table="cad_menu";
				if($_POST['cod_menu']==""){
					$campos="`modulo`, `cod_menu_pai`, `label`, `icone`, `href`";
					$values="'".$_POST['modulo']."','".$_POST['cod_menu_pai']."','".$_POST['label']."','".$_POST['icone']."','".$_POST['href']."'";
					$msg="N";
					$sql->insert($table,$campos,$values,$msg);
				
				}else{
					$campos="`label`='".$_POST['label']."',`icone`='".$_POST['icone']."', `href`='".$_POST['href']."', `modulo`='".$_POST['modulo']."', `cod_menu_pai`='".$_POST['cod_menu_pai']."' ";
					$where="cod_menu=".$_POST['cod_menu']." ";
					$msg="N";
					$sql->update($table,$campos,$where,$msg);
					

				
				}

			}
			if($_POST['act']=="pesquisar_modulo"){
					include "config.php";
					$select="
							SELECT 
								*
							FROM 
								".$schema.".cad_menu 
							where 
								cod_menu='".$_POST['cod_menu']."';";
								
					$resultado=mysql_query($select,$conexao) or die (mysql_error());
						while($row = mysql_fetch_array($resultado)){
							echo '{"cad_menu":['.json_encode($row).']}';
					}
			
			}

		}

	}


?>
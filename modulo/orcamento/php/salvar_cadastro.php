<?php
	include "php.php";
	include "config.php";
	
	if(isset($_POST['tabela']) and isset($_POST['json'])){

		function verificar_coluna($tabela,$coluna){
				include "config.php";		
				$select="SELECT * FROM `".$schema_mysql."`.`".$tabela."` limit 0;";
				$result=mysql_query($select,$conexao);
				for($j=0;$j<mysql_num_fields($result);$j++){
					if($coluna==mysql_field_name($result,$j)){return true;}
				}
			}
	
		$tabela=$_POST['tabela'];
		$json=json_decode($_POST['json'], true);
		$keys=array_keys($json[0]);
		$campos="";
		$campos_update="";
		$valores="";
		$update="";
		$tb_select="";

		for($i=0;$i<count($keys);$i++){
			if(verificar_coluna($tabela,$keys[$i])){
				$campos.="`".$keys[$i]."`";
				$campos_update.="`".$keys[$i]."`=tb_valores.`".$keys[$i]."`";
			}
		}
		for($i=0;$i<count($json);$i++){
			$valores.="(";
			for($n=0;$n<count($json[$i]);$n++){
				if(verificar_coluna($tabela,$keys[$n])){
					$valores.="'".$json[$i][$keys[$n]]."',";
				}
			}
			$valores.=")";
			
			$tb_select.="select ";
			for($n=0;$n<count($json[$i]);$n++){
				if(verificar_coluna($tabela,$keys[$n])){
					$tb_select.="'".$json[$i][$keys[$n]]."' as `".$keys[$n]."`,";
				}
			}
			$tb_select.=" ";
		}
		
		$campos=str_replace("``","`,`",$campos);
		
		$valores=str_replace("')",")",$valores);
		$valores=str_replace(")(","),(",$valores);
		$valores=str_replace(",)",")",$valores);
		
		$tb_select="select * from (".$tb_select.")";
		$tb_select="".$tb_select." as tb_valores";
		$tb_select=str_replace(", )",")",$tb_select);
		$tb_select=str_replace(", select"," union all select",$tb_select);
		
		$campos_update=str_replace("``","`,`",$campos_update);
		
		$consulta="INSERT INTO `".$schema_mysql."`.`".$tabela."` (".$campos.") ".$tb_select." ON DUPLICATE KEY UPDATE  ".$campos_update.";"; 
		$insert=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main  uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	;	

	}


?>
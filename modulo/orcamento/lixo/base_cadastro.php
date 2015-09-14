<?php

//schema", schema;
//tabela", tabela;
//formato", json;

class json{
	function formatar($txt,$niveis){
			$resultado="";
			$txt=explode(".", $txt);
			for($i=0;$i<count($txt);$i++){
				if($i==$niveis-1){
						for($x=strlen($txt[$i]);$x<=3;$x++){
						$txt[$i]="0".$txt[$i];
					}	
				}else{
						for($x=strlen($txt[$i]);$x<=1;$x++){
						$txt[$i]="0".$txt[$i];
					}
				
				}
			}
			for($i=0;$i<count($txt);$i++){
				if($i>0){
					$resultado.= ".";
				}
					$resultado.= $txt[$i];

			}

			return $resultado;				

			//split($txt,".");
	}
	function pai($txt){
		$resultado= "";
		$txt=explode(".", $txt);
			for($i=0;$i<count($txt)-1;$i++){
				if($i>0){
					$resultado.= ".";
				}
					$resultado.= $txt[$i];

			}
		return "999999".str_replace(".","",$resultado);	

	}
	function id($txt){
		$resultado="999999".str_replace(".","",$txt);
		return $resultado;
	}
		
	function plano_de_contas($schema){
		include "php.php";
		$formatar=new json;
		
		$select= "
						SELECT
								plano_de_contas.*
						FROM 
							orcamento.plano_de_contas
						WHERE
							plano_de_contas.`schema`='".$schema."'
					

					
					";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$json='var db_grid=[{"id":0 ,"id_grid":999999 ,"id_grid_pai":-1 ,"numero":"0","nome":"RESULTADO"}';
		while($row = mysql_fetch_array($resultado))
		{
			$numero=$formatar->formatar($row['numero'],5);				
			$id_grid=$formatar->id($numero);
			$id_grid_pai=$formatar->pai($numero);
			$nome=$row['descricao'];
			$json.='{
					"id":'.$row['id'].',
					"id_grid":'.$id_grid.',
					"id_grid_pai":'.$id_grid_pai.',
					"numero":"'.$numero.'",
					"nome":"'.$numero." - ".$nome.'"
					}';
		}
		$json=str_replace("}{","},{",$json);
		$json.="];";
		echo $json;

	
	}
	function centro_de_custos($schema){
		include "php.php";
		$formatar=new json;

		$select= "
							SELECT 
								centro_de_custos.*
							FROM 
								orcamento.centro_de_custos
							WHERE
								centro_de_custos.`schema`='".$schema."'

					";

		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$json='var db_grid=[{"id":0 ,"id_grid":999999 ,"id_grid_pai":-1 ,"numero":"0","nome":"Consolidado"}';
		while($row = mysql_fetch_array($resultado))
		{
			$numero=$formatar->formatar($row['numero'],3);				
			$id_grid=$formatar->id($numero);
			$id_grid_pai=$formatar->pai($numero);
			$nome=$row['descricao'];
			$json.='{
					"id":'.$row['id'].',
					"id_grid":'.$id_grid.',
					"id_grid_pai":'.$id_grid_pai.',
					"numero":"'.$numero.'",
					"nome":"'.$numero." - ".$nome.'"
					}';
		}
		$json=str_replace("}{","},{",$json);
		$json.="];";
		echo $json;

	}
	function caixas($schema){
		include "php.php";
		$formatar=new json;

		$select= "
					SELECT 
						tb_tipo.id_tb_tipo_caixas as id,
						-1 as id_pai,
						tb_tipo.descricao as descricao
					FROM 
						(SELECT distinct caixas.tipo,tb_tipo_caixas.descricao, tb_tipo_caixas.id_tb_tipo_caixas FROM orcamento.caixas, orcamento.tb_tipo_caixas where caixas.tipo=tb_tipo_caixas.tipo) as tb_tipo 
				
					UNION ALL
					
					SELECT
						caixas.id_caixas,
						tb_tipo_caixas.id_tb_tipo_caixas as id_pai,
						caixas.descricao
					FROM 
						orcamento.caixas,
						orcamento.tb_tipo_caixas
					WHERE
						caixas.`schema`='".$schema."' and
						caixas.tipo=tb_tipo_caixas.tipo
					ORDER BY
						id_pai desc ; ";

		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$json='var db_grid=[';
		while($row = mysql_fetch_array($resultado))
		{
			$numero=$row['id'];			
			$id_grid=$row['id'];
			$id_grid_pai=$row['id_pai'];
			$nome=$row['descricao'];
			$json.='{
					"id":'.$row['id'].',
					"id_grid":'.$id_grid.',
					"id_grid_pai":'.$id_grid_pai.',
					"numero":"'.$numero.'",
					"nome":"'.$numero." - ".$nome.'"
					}';
		}
		$json=str_replace("}{","},{",$json);
		$json.="];";
		echo $json;

	}
	
}

if(isset($_GET['formato']) and isset($_GET['tabela'])){
	$base=new $_GET['formato'];
	$base->$_GET['tabela']($_GET['schema']);

}
	




?>
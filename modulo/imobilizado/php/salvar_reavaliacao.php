<?php
	include "php.php";

	$json=str_replace('"',"'", $_POST['json']);
	$json=str_replace('[',"", $json);
	$json=str_replace(']',"", $json);
	$json=explode('},{',$json);
	for($i=0;$i<count($json);$i++){
		$json[$i]=str_replace("{","",$json[$i]);
		$json[$i]=str_replace("}","",$json[$i]);
		$json[$i]=str_replace("'",'"',$json[$i]);
		$array[$i]="{".$json[$i]."}";
		if($i==0){
			$keys=$array[$i];
		}
		$array[$i]=json_decode($array[$i],true);
	}	
	//echo count($array);
	//print_r($array);
	$sql=new sql;
	
	for($i=0;$i<count($array);$i++){
		$array[$i]['valor_atual']=str_replace(",",".",$array[$i]['valor_atual']);
		if(strpos($array[$i]['data_inicio_depreciacao'],'/')==true){
			$array[$i]['data_inicio_depreciacao']=DateTime::createFromFormat('d/m/Y', $array[$i]['data_inicio_depreciacao'])->format('Y-m-d');
		}
		
		$table='cad_itens';
		$campos="data_inicio_depreciacao='".$array[$i]['data_inicio_depreciacao']."', ";
		$campos.="valor_atual='".$array[$i]['valor_atual']."', ";
		$campos.="vida_util='".$array[$i]['vida_util']."', ";
		$campos.="taxa_depreciacao_anual='".$array[$i]['taxa_depreciacao_anual']."' ";

		$where="cod_item='".$array[$i]['id']."'";
		$sql->update($table,$campos,$where,'N');
	}	
	echo "
		<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert='' style='margin: -15px 35px 30px;'>
			<a href='' class='uk-alert-close uk-close'></a>
			<p>Os registros foram atualizados com sucesso!</p>
		</div>";


	


?>
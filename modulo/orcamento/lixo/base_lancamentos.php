<?php


class base{
	function orcamento_lancamentos(){
		include "php.php";
		
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
			return "9999".str_replace(".","",$resultado);	

		}
		function id($txt){
			$resultado="9999".str_replace(".","",$txt);
			return $resultado;
		}
		
		$select= "
						SELECT
							tb_plano_de_contas.id,
							tb_plano_de_contas.`schema`,
							tb_plano_de_contas.numero,
							tb_plano_de_contas.descricao,

							sum(ifnull(mes_1.valor,0)) as mes_01,
							sum(ifnull(mes_2.valor,0)) as mes_02,
							sum(ifnull(mes_3.valor,0)) as mes_03,
							sum(ifnull(mes_4.valor,0)) as mes_04,
							sum(ifnull(mes_5.valor,0)) as mes_05,
							sum(ifnull(mes_6.valor,0)) as mes_06,
							sum(ifnull(mes_7.valor,0)) as mes_07,
							sum(ifnull(mes_8.valor,0)) as mes_08,
							sum(ifnull(mes_9.valor,0)) as mes_09,
							sum(ifnull(mes_10.valor,0)) as mes_10,
							sum(ifnull(mes_11.valor,0)) as mes_11,
							sum(ifnull(mes_12.valor,0)) as mes_12


						FROM 
							(SELECT
								plano_de_contas.id,
								plano_de_contas.`schema`,
								plano_de_contas.numero,
								plano_de_contas.descricao
							FROM
								orcamento.plano_de_contas
							WHERE
								plano_de_contas.`schema`='3c3d545454a1c8bf8b6aba7691cab4e1.sec3'
							
							) as tb_plano_de_contas 
							
							
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-01-01' and '2015-01-31' group by idconta ) as mes_1 on tb_plano_de_contas.id=mes_1.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-02-01' and '2015-02-28' group by idconta ) as mes_2 on tb_plano_de_contas.id=mes_2.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-03-01' and '2015-03-31' group by idconta ) as mes_3 on tb_plano_de_contas.id=mes_3.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-04-01' and '2015-04-30' group by idconta ) as mes_4 on tb_plano_de_contas.id=mes_4.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-05-01' and '2015-05-31' group by idconta ) as mes_5 on tb_plano_de_contas.id=mes_5.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-06-01' and '2015-06-30' group by idconta ) as mes_6 on tb_plano_de_contas.id=mes_6.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-07-01' and '2015-07-31' group by idconta ) as mes_7 on tb_plano_de_contas.id=mes_7.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-08-01' and '2015-08-31' group by idconta ) as mes_8 on tb_plano_de_contas.id=mes_8.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-09-01' and '2015-09-30' group by idconta ) as mes_9 on tb_plano_de_contas.id=mes_9.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-10-01' and '2015-10-31' group by idconta ) as mes_10 on tb_plano_de_contas.id=mes_10.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-11-01' and '2015-11-30' group by idconta ) as mes_11 on tb_plano_de_contas.id=mes_11.idconta
						left join (SELECT month(data) as mes,idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '2015-12-01' and '2015-12-31' group by idconta ) as mes_12 on tb_plano_de_contas.id=mes_12.idconta



						GROUP BY 
							tb_plano_de_contas.id;
							
							";
					
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$i=0;
		while($row = mysql_fetch_array($resultado))
		{
				$row_[$i]['numero']=formatar($row['numero'],5);
				$row_[$i]['id_grid']=id(formatar($row['numero'],5));
				$row_[$i]['id_grid_pai']=pai(formatar($row['numero'],5));
				$row_[$i]['descricao']=$row['descricao'];
				$row_[$i]['id']=$row['id'];
				$row_[$i]['mes_01']=$row['mes_01'];
				$row_[$i]['mes_02']=$row['mes_02'];
				$row_[$i]['mes_03']=$row['mes_03'];
				$row_[$i]['mes_04']=$row['mes_04'];
				$row_[$i]['mes_05']=$row['mes_05'];
				$row_[$i]['mes_06']=$row['mes_06'];
				$row_[$i]['mes_07']=$row['mes_07'];
				$row_[$i]['mes_08']=$row['mes_08'];
				$row_[$i]['mes_09']=$row['mes_09'];
				$row_[$i]['mes_10']=$row['mes_10'];
				$row_[$i]['mes_11']=$row['mes_11'];
				$row_[$i]['mes_12']=$row['mes_12'];
				$i=$i+1;
		}	
		//echo count($row_);
		for($i=0;$i<count($row_);$i++){
			$numero=$row_[$i]['numero'];

			for($x=0;$x<count($row_);$x++){
				if(
						$row_[$x]['numero']!=$numero and 
						substr($row_[$x]['numero'],0,strlen($numero))==$numero
					){
					$row_[$i]['mes_01']=$row_[$i]['mes_01']+$row_[$x]['mes_01'];
					$row_[$i]['mes_02']=$row_[$i]['mes_02']+$row_[$x]['mes_02'];
					$row_[$i]['mes_03']=$row_[$i]['mes_03']+$row_[$x]['mes_03'];
					$row_[$i]['mes_04']=$row_[$i]['mes_04']+$row_[$x]['mes_04'];
					$row_[$i]['mes_05']=$row_[$i]['mes_05']+$row_[$x]['mes_05'];
					$row_[$i]['mes_06']=$row_[$i]['mes_06']+$row_[$x]['mes_06'];
					$row_[$i]['mes_07']=$row_[$i]['mes_07']+$row_[$x]['mes_07'];
					$row_[$i]['mes_08']=$row_[$i]['mes_08']+$row_[$x]['mes_08'];
					$row_[$i]['mes_09']=$row_[$i]['mes_09']+$row_[$x]['mes_09'];
					$row_[$i]['mes_10']=$row_[$i]['mes_10']+$row_[$x]['mes_10'];
					$row_[$i]['mes_11']=$row_[$i]['mes_11']+$row_[$x]['mes_11'];
					$row_[$i]['mes_12']=$row_[$i]['mes_12']+$row_[$x]['mes_12'];
				}

			}
		
		
		}
		$json="";
		for($i=0;$i<count($row_);$i++){
			$json.='{
					"id":'.$row_[$i]['id'].',
					"id_grid":'.$row_[$i]['id_grid'].',
					"id_grid_pai":'.$row_[$i]['id_grid_pai'].',
					"numero":"'.$row_[$i]['numero'].'",
					"nome_conta":"'.$row_[$i]['numero'].' - '.$row_[$i]['descricao'].'" ,
					"mes_01":'.$row_[$i]['mes_01'].' ,
					"mes_02":'.$row_[$i]['mes_02'].' ,
					"mes_03":'.$row_[$i]['mes_03'].' ,
					"mes_04":'.$row_[$i]['mes_04'].' ,
					"mes_05":'.$row_[$i]['mes_05'].' ,
					"mes_06":'.$row_[$i]['mes_06'].' ,
					"mes_07":'.$row_[$i]['mes_07'].' ,
					"mes_08":'.$row_[$i]['mes_08'].' ,
					"mes_09":'.$row_[$i]['mes_09'].' ,
					"mes_10":'.$row_[$i]['mes_10'].' ,
					"mes_11":'.$row_[$i]['mes_11'].' ,
					"mes_12":'.$row_[$i]['mes_12'].' ,
					"total":'.
							 ($row_[$i]['mes_01']
							+$row_[$i]['mes_02']
							+$row_[$i]['mes_03']
							+$row_[$i]['mes_04']
							+$row_[$i]['mes_05']
							+$row_[$i]['mes_06']
							+$row_[$i]['mes_07']
							+$row_[$i]['mes_08']
							+$row_[$i]['mes_09']
							+$row_[$i]['mes_10']
							+$row_[$i]['mes_11']
							+$row_[$i]['mes_12'])
							.'
					}';

		}		
		$json=str_replace("}{","},{",$json);
		echo 'var base=[{ "id":0, "id_grid":9999, "id_grid_pai":-1, "numero":"00", "nome_conta":"00 - RESULTADO", "mes_01":0.00, "mes_02":0.00, "mes_03":0.00, "mes_04":0.00, "mes_05":0.00, "mes_06":0.00, "mes_07":0.00, "mes_08":0.00, "mes_09":0.00, "mes_10":0.00, "mes_11":0.00, "mes_12":0.00, "total":0.00 },'.$json.'];';
	
	}
	function orcamento_orcado_real_conta($schema_real,$id_orcamento){
		include "php.php";
		
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
			$id=$txt;
			$resultado= "";
			$txt=explode(".", $txt);
				for($i=0;$i<count($txt)-1;$i++){
					if($i>0){
						$resultado.= ".";
					}
						$resultado.= $txt[$i];

				}
				if($id=='00'){
					return '-1';
				}else{
					return "9999".str_replace(".","",$resultado);
				}			

		}
		function id($txt){
			$resultado="9999".str_replace(".","",$txt);
			return $resultado;
		}
		function href($idconta,$valor,$data_inicio,$data_fim,$R_O){
			return  "<a href='detalhe_real_orcado?id_conta=".$idconta."&data_inicio=".$data_inicio."&data_fim=".$data_fim."&R_O=".$R_O."' _blank>".$valor."</a>";
		}
		function sinalizador($real,$orcado){
			if($real<$orcado){
				return "'down'";
			}else{
				return "'up'";
			}
		
		}
				
		
		
		$select="SELECT year(data_inicio) as ano FROM orcamento.tb_orcamento where id_orcamento='".$id_orcamento."';";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		while($row = mysql_fetch_array($resultado))
		{
			$ano=$row['ano'];	
		}

			$mes_01_I = date("Y-m-d", mktime (0, 0, 0, 1  , 1, $ano));
			$mes_02_I = date("Y-m-d", mktime (0, 0, 0, 2  , 1, $ano));
			$mes_03_I = date("Y-m-d", mktime (0, 0, 0, 3  , 1, $ano));
			$mes_04_I = date("Y-m-d", mktime (0, 0, 0, 4  , 1, $ano));
			$mes_05_I = date("Y-m-d", mktime (0, 0, 0, 5  , 1, $ano));
			$mes_06_I = date("Y-m-d", mktime (0, 0, 0, 6  , 1, $ano));
			$mes_07_I = date("Y-m-d", mktime (0, 0, 0, 7  , 1, $ano));
			$mes_08_I = date("Y-m-d", mktime (0, 0, 0, 8  , 1, $ano));
			$mes_09_I = date("Y-m-d", mktime (0, 0, 0, 9  , 1, $ano));
			$mes_10_I = date("Y-m-d", mktime (0, 0, 0, 10 , 1, $ano));
			$mes_11_I = date("Y-m-d", mktime (0, 0, 0, 11 , 1, $ano));
			$mes_12_I = date("Y-m-d", mktime (0, 0, 0, 12 , 1, $ano));

			$mes_01_F = date("Y-m-d", mktime (0, 0, 0, 2  , 1, $ano)-1);
			$mes_02_F = date("Y-m-d", mktime (0, 0, 0, 3  , 1, $ano)-1);
			$mes_03_F = date("Y-m-d", mktime (0, 0, 0, 4  , 1, $ano)-1);
			$mes_04_F = date("Y-m-d", mktime (0, 0, 0, 5  , 1, $ano)-1);
			$mes_05_F = date("Y-m-d", mktime (0, 0, 0, 6  , 1, $ano)-1);
			$mes_06_F = date("Y-m-d", mktime (0, 0, 0, 7  , 1, $ano)-1);
			$mes_07_F = date("Y-m-d", mktime (0, 0, 0, 8  , 1, $ano)-1);
			$mes_08_F = date("Y-m-d", mktime (0, 0, 0, 9  , 1, $ano)-1);
			$mes_09_F = date("Y-m-d", mktime (0, 0, 0, 10  , 1, $ano)-1);
			$mes_10_F = date("Y-m-d", mktime (0, 0, 0, 11 , 1, $ano)-1);
			$mes_11_F = date("Y-m-d", mktime (0, 0, 0, 12 , 1, $ano)-1);
			$mes_12_F = date("Y-m-d", mktime (0, 0, 0, 1 , 1, $ano+1)-1);		
		
		
		
		
		
		$select= "
						select
							0 as id, 
							'00' as numero,
							'CONSOLIDADO' as descricao,
							
							0.00 as mes_01_O,
							0.00 as mes_02_O,
							0.00 as mes_03_O,
							0.00 as mes_04_O,
							0.00 as mes_05_O,
							0.00 as mes_06_O,
							0.00 as mes_07_O,
							0.00 as mes_08_O,
							0.00 as mes_09_O,
							0.00 as mes_10_O,
							0.00 as mes_11_O,
							0.00 as mes_12_O,

							0.00 as mes_01_R,
							0.00 as mes_02_R,
							0.00 as mes_03_R,
							0.00 as mes_04_R,
							0.00 as mes_05_R,
							0.00 as mes_06_R,
							0.00 as mes_07_R,
							0.00 as mes_08_R,
							0.00 as mes_09_R,
							0.00 as mes_10_R,
							0.00 as mes_11_R,
							0.00 as mes_12_R

						
						union all

						
						SELECT
							tb_plano_de_contas.id,
							concat('00.',tb_plano_de_contas.numero) as numero,							
							tb_plano_de_contas.descricao,

							-sum(ifnull(mes_1_O.valor,0)) as mes_01_O,
							-sum(ifnull(mes_2_O.valor,0)) as mes_02_O,
							-sum(ifnull(mes_3_O.valor,0)) as mes_03_O,
							-sum(ifnull(mes_4_O.valor,0)) as mes_04_O,
							-sum(ifnull(mes_5_O.valor,0)) as mes_05_O,
							-sum(ifnull(mes_6_O.valor,0)) as mes_06_O,
							-sum(ifnull(mes_7_O.valor,0)) as mes_07_O,
							-sum(ifnull(mes_8_O.valor,0)) as mes_08_O,
							-sum(ifnull(mes_9_O.valor,0)) as mes_09_O,
							-sum(ifnull(mes_10_O.valor,0)) as mes_10_O,
							-sum(ifnull(mes_11_O.valor,0)) as mes_11_O,
							-sum(ifnull(mes_12_O.valor,0)) as mes_12_O,

							sum(ifnull(mes_1_R.valor,0)) as mes_01_R,
							sum(ifnull(mes_2_R.valor,0)) as mes_02_R,
							sum(ifnull(mes_3_R.valor,0)) as mes_03_R,
							sum(ifnull(mes_4_R.valor,0)) as mes_04_R,
							sum(ifnull(mes_5_R.valor,0)) as mes_05_R,
							sum(ifnull(mes_6_R.valor,0)) as mes_06_R,
							sum(ifnull(mes_7_R.valor,0)) as mes_07_R,
							sum(ifnull(mes_8_R.valor,0)) as mes_08_R,
							sum(ifnull(mes_9_R.valor,0)) as mes_09_R,
							sum(ifnull(mes_10_R.valor,0)) as mes_10_R,
							sum(ifnull(mes_11_R.valor,0)) as mes_11_R,
							sum(ifnull(mes_12_R.valor,0)) as mes_12_R


						FROM 
							(
							SELECT
								plano_de_contas.id,
								plano_de_contas.`schema`,
								plano_de_contas.numero,
								plano_de_contas.descricao
							FROM
								orcamento.plano_de_contas,
								orcamento.tb_orcamento
							WHERE
								plano_de_contas.`schema`=tb_orcamento.schema_plano_de_contas and
								tb_orcamento.id_orcamento='".$id_orcamento."' 						
							) as tb_plano_de_contas 
							
							
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_01_I."' and '".$mes_01_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_1_O on tb_plano_de_contas.id=mes_1_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_02_I."' and '".$mes_02_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_2_O on tb_plano_de_contas.id=mes_2_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_03_I."' and '".$mes_03_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_3_O on tb_plano_de_contas.id=mes_3_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_04_I."' and '".$mes_04_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_4_O on tb_plano_de_contas.id=mes_4_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_05_I."' and '".$mes_05_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_5_O on tb_plano_de_contas.id=mes_5_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_06_I."' and '".$mes_06_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_6_O on tb_plano_de_contas.id=mes_6_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_07_I."' and '".$mes_07_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_7_O on tb_plano_de_contas.id=mes_7_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_08_I."' and '".$mes_08_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_8_O on tb_plano_de_contas.id=mes_8_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_09_I."' and '".$mes_09_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_9_O on tb_plano_de_contas.id=mes_9_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_10_I."' and '".$mes_10_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_10_O on tb_plano_de_contas.id=mes_10_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_11_I."' and '".$mes_11_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_11_O on tb_plano_de_contas.id=mes_11_O.idconta
						left join (SELECT month(data) as mes, idconta, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_12_I."' and '".$mes_12_F."' and id_orcamento='".$id_orcamento."' group by idconta ) as mes_12_O on tb_plano_de_contas.id=mes_12_O.idconta

						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_01_I."' and '".$mes_01_F."' and `schema`='".$schema_real."' group by idconta ) as mes_1_R on tb_plano_de_contas.id=mes_1_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_02_I."' and '".$mes_02_F."' and `schema`='".$schema_real."' group by idconta ) as mes_2_R on tb_plano_de_contas.id=mes_2_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_03_I."' and '".$mes_03_F."' and `schema`='".$schema_real."' group by idconta ) as mes_3_R on tb_plano_de_contas.id=mes_3_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_04_I."' and '".$mes_04_F."' and `schema`='".$schema_real."' group by idconta ) as mes_4_R on tb_plano_de_contas.id=mes_4_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_05_I."' and '".$mes_05_F."' and `schema`='".$schema_real."' group by idconta ) as mes_5_R on tb_plano_de_contas.id=mes_5_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_06_I."' and '".$mes_06_F."' and `schema`='".$schema_real."' group by idconta ) as mes_6_R on tb_plano_de_contas.id=mes_6_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_07_I."' and '".$mes_07_F."' and `schema`='".$schema_real."' group by idconta ) as mes_7_R on tb_plano_de_contas.id=mes_7_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_08_I."' and '".$mes_08_F."' and `schema`='".$schema_real."' group by idconta ) as mes_8_R on tb_plano_de_contas.id=mes_8_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_09_I."' and '".$mes_09_F."' and `schema`='".$schema_real."' group by idconta ) as mes_9_R on tb_plano_de_contas.id=mes_9_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_10_I."' and '".$mes_10_F."' and `schema`='".$schema_real."' group by idconta ) as mes_10_R on tb_plano_de_contas.id=mes_10_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_11_I."' and '".$mes_11_F."' and `schema`='".$schema_real."' group by idconta ) as mes_11_R on tb_plano_de_contas.id=mes_11_R.idconta
						left join (SELECT month(data) as mes,	idconta, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_12_I."' and '".$mes_12_F."' and `schema`='".$schema_real."' group by idconta ) as mes_12_R on tb_plano_de_contas.id=mes_12_R.idconta



						GROUP BY 
							tb_plano_de_contas.id;
							
							";
		
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$i=0;
		$row_="";
		while($row = mysql_fetch_array($resultado))
		{
				$row_[$i]['numero']=formatar($row['numero'],6);
				$row_[$i]['id_grid']=id(formatar($row['numero'],6));
				$row_[$i]['id_grid_pai']=pai(formatar($row['numero'],6));
				$row_[$i]['descricao']=$row['descricao'];
				$row_[$i]['id']=$row['id'];
				$row_[$i]['mes_01_O']=$row['mes_01_O'];
				$row_[$i]['mes_02_O']=$row['mes_02_O'];
				$row_[$i]['mes_03_O']=$row['mes_03_O'];
				$row_[$i]['mes_04_O']=$row['mes_04_O'];
				$row_[$i]['mes_05_O']=$row['mes_05_O'];
				$row_[$i]['mes_06_O']=$row['mes_06_O'];
				$row_[$i]['mes_07_O']=$row['mes_07_O'];
				$row_[$i]['mes_08_O']=$row['mes_08_O'];
				$row_[$i]['mes_09_O']=$row['mes_09_O'];
				$row_[$i]['mes_10_O']=$row['mes_10_O'];
				$row_[$i]['mes_11_O']=$row['mes_11_O'];
				$row_[$i]['mes_12_O']=$row['mes_12_O'];
				
				$row_[$i]['mes_01_R']=$row['mes_01_R'];
				$row_[$i]['mes_02_R']=$row['mes_02_R'];
				$row_[$i]['mes_03_R']=$row['mes_03_R'];
				$row_[$i]['mes_04_R']=$row['mes_04_R'];
				$row_[$i]['mes_05_R']=$row['mes_05_R'];
				$row_[$i]['mes_06_R']=$row['mes_06_R'];
				$row_[$i]['mes_07_R']=$row['mes_07_R'];
				$row_[$i]['mes_08_R']=$row['mes_08_R'];
				$row_[$i]['mes_09_R']=$row['mes_09_R'];
				$row_[$i]['mes_10_R']=$row['mes_10_R'];
				$row_[$i]['mes_11_R']=$row['mes_11_R'];
				$row_[$i]['mes_12_R']=$row['mes_12_R'];
				$i=$i+1;
		}	
		//echo count($row_);
		for($i=0;$i<count($row_);$i++){
			$numero=$row_[$i]['numero'];

			for($x=0;$x<count($row_);$x++){
				if(
						$row_[$x]['numero']!=$numero and 
						substr($row_[$x]['numero'],0,strlen($numero))==$numero
					){
					$row_[$i]['mes_01_O']=$row_[$i]['mes_01_O']+$row_[$x]['mes_01_O'];
					$row_[$i]['mes_02_O']=$row_[$i]['mes_02_O']+$row_[$x]['mes_02_O'];
					$row_[$i]['mes_03_O']=$row_[$i]['mes_03_O']+$row_[$x]['mes_03_O'];
					$row_[$i]['mes_04_O']=$row_[$i]['mes_04_O']+$row_[$x]['mes_04_O'];
					$row_[$i]['mes_05_O']=$row_[$i]['mes_05_O']+$row_[$x]['mes_05_O'];
					$row_[$i]['mes_06_O']=$row_[$i]['mes_06_O']+$row_[$x]['mes_06_O'];
					$row_[$i]['mes_07_O']=$row_[$i]['mes_07_O']+$row_[$x]['mes_07_O'];
					$row_[$i]['mes_08_O']=$row_[$i]['mes_08_O']+$row_[$x]['mes_08_O'];
					$row_[$i]['mes_09_O']=$row_[$i]['mes_09_O']+$row_[$x]['mes_09_O'];
					$row_[$i]['mes_10_O']=$row_[$i]['mes_10_O']+$row_[$x]['mes_10_O'];
					$row_[$i]['mes_11_O']=$row_[$i]['mes_11_O']+$row_[$x]['mes_11_O'];
					$row_[$i]['mes_12_O']=$row_[$i]['mes_12_O']+$row_[$x]['mes_12_O'];
					
					$row_[$i]['mes_01_R']=$row_[$i]['mes_01_R']+$row_[$x]['mes_01_R'];
					$row_[$i]['mes_02_R']=$row_[$i]['mes_02_R']+$row_[$x]['mes_02_R'];
					$row_[$i]['mes_03_R']=$row_[$i]['mes_03_R']+$row_[$x]['mes_03_R'];
					$row_[$i]['mes_04_R']=$row_[$i]['mes_04_R']+$row_[$x]['mes_04_R'];
					$row_[$i]['mes_05_R']=$row_[$i]['mes_05_R']+$row_[$x]['mes_05_R'];
					$row_[$i]['mes_06_R']=$row_[$i]['mes_06_R']+$row_[$x]['mes_06_R'];
					$row_[$i]['mes_07_R']=$row_[$i]['mes_07_R']+$row_[$x]['mes_07_R'];
					$row_[$i]['mes_08_R']=$row_[$i]['mes_08_R']+$row_[$x]['mes_08_R'];
					$row_[$i]['mes_09_R']=$row_[$i]['mes_09_R']+$row_[$x]['mes_09_R'];
					$row_[$i]['mes_10_R']=$row_[$i]['mes_10_R']+$row_[$x]['mes_10_R'];
					$row_[$i]['mes_11_R']=$row_[$i]['mes_11_R']+$row_[$x]['mes_11_R'];
					$row_[$i]['mes_12_R']=$row_[$i]['mes_12_R']+$row_[$x]['mes_12_R'];
				}

			}
		
		
		}
		$json="";
		for($i=0;$i<count($row_);$i++){
			
			
			$json.='{
					"id":'.$row_[$i]['id'].',
					"id_grid":'.$row_[$i]['id_grid'].',
					"id_grid_pai":'.$row_[$i]['id_grid_pai'].',
					"numero":"'.$row_[$i]['numero'].'",
					"nome_conta":"'.$row_[$i]['numero'].' - '.$row_[$i]['descricao'].'" ,
					"mes_01_O":'.$row_[$i]['mes_01_O'].' ,
					"mes_02_O":'.$row_[$i]['mes_02_O'].' ,
					"mes_03_O":'.$row_[$i]['mes_03_O'].' ,
					"mes_04_O":'.$row_[$i]['mes_04_O'].' ,
					"mes_05_O":'.$row_[$i]['mes_05_O'].' ,
					"mes_06_O":'.$row_[$i]['mes_06_O'].' ,
					"mes_07_O":'.$row_[$i]['mes_07_O'].' ,
					"mes_08_O":'.$row_[$i]['mes_08_O'].' ,
					"mes_09_O":'.$row_[$i]['mes_09_O'].' ,
					"mes_10_O":'.$row_[$i]['mes_10_O'].' ,
					"mes_11_O":'.$row_[$i]['mes_11_O'].' ,
					"mes_12_O":'.$row_[$i]['mes_12_O'].' ,

					"total_O":'.
							($row_[$i]['mes_01_O']
							+$row_[$i]['mes_02_O']
							+$row_[$i]['mes_03_O']
							+$row_[$i]['mes_04_O']
							+$row_[$i]['mes_05_O']
							+$row_[$i]['mes_06_O']
							+$row_[$i]['mes_07_O']
							+$row_[$i]['mes_08_O']
							+$row_[$i]['mes_09_O']
							+$row_[$i]['mes_10_O']
							+$row_[$i]['mes_11_O']
							+$row_[$i]['mes_12_O'])
							.' ,
					
					"mes_01_R":'.$row_[$i]['mes_01_R'].' ,
					"mes_02_R":'.$row_[$i]['mes_02_R'].' ,
					"mes_03_R":'.$row_[$i]['mes_03_R'].' ,
					"mes_04_R":'.$row_[$i]['mes_04_R'].' ,
					"mes_05_R":'.$row_[$i]['mes_05_R'].' ,
					"mes_06_R":'.$row_[$i]['mes_06_R'].' ,
					"mes_07_R":'.$row_[$i]['mes_07_R'].' ,
					"mes_08_R":'.$row_[$i]['mes_08_R'].' ,
					"mes_09_R":'.$row_[$i]['mes_09_R'].' ,
					"mes_10_R":'.$row_[$i]['mes_10_R'].' ,
					"mes_11_R":'.$row_[$i]['mes_11_R'].' ,
					"mes_12_R":'.$row_[$i]['mes_12_R'].' ,

					"total_R":'.
							($row_[$i]['mes_01_R']
							+$row_[$i]['mes_02_R']
							+$row_[$i]['mes_03_R']
							+$row_[$i]['mes_04_R']
							+$row_[$i]['mes_05_R']
							+$row_[$i]['mes_06_R']
							+$row_[$i]['mes_07_R']
							+$row_[$i]['mes_08_R']
							+$row_[$i]['mes_09_R']
							+$row_[$i]['mes_10_R']
							+$row_[$i]['mes_11_R']
							+$row_[$i]['mes_12_R'])
							.' ,
							
					"mes_01_V":'.($row_[$i]['mes_01_R']-$row_[$i]['mes_01_O']).' ,
					"mes_02_V":'.($row_[$i]['mes_02_R']-$row_[$i]['mes_02_O']).' ,
					"mes_03_V":'.($row_[$i]['mes_03_R']-$row_[$i]['mes_03_O']).' ,
					"mes_04_V":'.($row_[$i]['mes_04_R']-$row_[$i]['mes_04_O']).' ,
					"mes_05_V":'.($row_[$i]['mes_05_R']-$row_[$i]['mes_05_O']).' ,
					"mes_06_V":'.($row_[$i]['mes_06_R']-$row_[$i]['mes_06_O']).' ,
					"mes_07_V":'.($row_[$i]['mes_07_R']-$row_[$i]['mes_07_O']).' ,
					"mes_08_V":'.($row_[$i]['mes_08_R']-$row_[$i]['mes_08_O']).' ,
					"mes_09_V":'.($row_[$i]['mes_09_R']-$row_[$i]['mes_09_O']).' ,
					"mes_10_V":'.($row_[$i]['mes_10_R']-$row_[$i]['mes_10_O']).' ,
					"mes_11_V":'.($row_[$i]['mes_11_R']-$row_[$i]['mes_11_O']).' ,
					"mes_12_V":'.($row_[$i]['mes_12_R']-$row_[$i]['mes_12_O']).' ,

					"total_V":'.
							(($row_[$i]['mes_01_R']
							+$row_[$i]['mes_02_R']
							+$row_[$i]['mes_03_R']
							+$row_[$i]['mes_04_R']
							+$row_[$i]['mes_05_R']
							+$row_[$i]['mes_06_R']
							+$row_[$i]['mes_07_R']
							+$row_[$i]['mes_08_R']
							+$row_[$i]['mes_09_R']
							+$row_[$i]['mes_10_R']
							+$row_[$i]['mes_11_R']
							+$row_[$i]['mes_12_R'])
							
							-($row_[$i]['mes_01_O']
							+$row_[$i]['mes_02_O']
							+$row_[$i]['mes_03_O']
							+$row_[$i]['mes_04_O']
							+$row_[$i]['mes_05_O']
							+$row_[$i]['mes_06_O']
							+$row_[$i]['mes_07_O']
							+$row_[$i]['mes_08_O']
							+$row_[$i]['mes_09_O']
							+$row_[$i]['mes_10_O']
							+$row_[$i]['mes_11_O']
							+$row_[$i]['mes_12_O']))
							
							
							
							.' ,
							
					"mes_01_sinalizador":'.sinalizador($row_[$i]['mes_01_R'],$row_[$i]['mes_01_O']).' ,
					"mes_02_sinalizador":'.sinalizador($row_[$i]['mes_02_R'],$row_[$i]['mes_02_O']).' ,
					"mes_03_sinalizador":'.sinalizador($row_[$i]['mes_03_R'],$row_[$i]['mes_03_O']).' ,
					"mes_04_sinalizador":'.sinalizador($row_[$i]['mes_04_R'],$row_[$i]['mes_04_O']).' ,
					"mes_05_sinalizador":'.sinalizador($row_[$i]['mes_05_R'],$row_[$i]['mes_05_O']).' ,
					"mes_06_sinalizador":'.sinalizador($row_[$i]['mes_06_R'],$row_[$i]['mes_06_O']).' ,
					"mes_07_sinalizador":'.sinalizador($row_[$i]['mes_07_R'],$row_[$i]['mes_07_O']).' ,
					"mes_08_sinalizador":'.sinalizador($row_[$i]['mes_08_R'],$row_[$i]['mes_08_O']).' ,
					"mes_09_sinalizador":'.sinalizador($row_[$i]['mes_09_R'],$row_[$i]['mes_09_O']).' ,
					"mes_10_sinalizador":'.sinalizador($row_[$i]['mes_10_R'],$row_[$i]['mes_10_O']).' ,
					"mes_11_sinalizador":'.sinalizador($row_[$i]['mes_11_R'],$row_[$i]['mes_11_O']).' ,
					"mes_12_sinalizador":'.sinalizador($row_[$i]['mes_12_R'],$row_[$i]['mes_12_O']).' ,
					"ttal_sinalizador":'.sinalizador(
							($row_[$i]['mes_01_R']
							+$row_[$i]['mes_02_R']
							+$row_[$i]['mes_03_R']
							+$row_[$i]['mes_04_R']
							+$row_[$i]['mes_05_R']
							+$row_[$i]['mes_06_R']
							+$row_[$i]['mes_07_R']
							+$row_[$i]['mes_08_R']
							+$row_[$i]['mes_09_R']
							+$row_[$i]['mes_10_R']
							+$row_[$i]['mes_11_R']
							+$row_[$i]['mes_12_R'])
					
							,
							
							($row_[$i]['mes_01_O']
							+$row_[$i]['mes_02_O']
							+$row_[$i]['mes_03_O']
							+$row_[$i]['mes_04_O']
							+$row_[$i]['mes_05_O']
							+$row_[$i]['mes_06_O']
							+$row_[$i]['mes_07_O']
							+$row_[$i]['mes_08_O']
							+$row_[$i]['mes_09_O']
							+$row_[$i]['mes_10_O']
							+$row_[$i]['mes_11_O']
							+$row_[$i]['mes_12_O'])
					
					).'
					}';

		}		
		$json=str_replace("}{","},{",$json);
		echo 'var base=['.$json.'];';
	
	
	
	}	
	function orcamento_orcado_real_ctrcusto($schema_real,$id_orcamento){
		include "php.php";
		
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
			$id=$txt;
			$resultado= "";
			$txt=explode(".", $txt);
				for($i=0;$i<count($txt)-1;$i++){
					if($i>0){
						$resultado.= ".";
					}
						$resultado.= $txt[$i];

				}
				if($id=='00'){
					return '-1';
				}else{
					return "9999".str_replace(".","",$resultado);
				}
	

		}
		function id($txt){
			$resultado="9999".str_replace(".","",$txt);
			return $resultado;
		}
		function href($idconta,$valor,$data_inicio,$data_fim,$R_O){
			return  "<a href='detalhe_real_orcado?id_conta=".$idconta."&data_inicio=".$data_inicio."&data_fim=".$data_fim."&R_O=".$R_O."' _blank>".$valor."</a>";
		}
		function sinalizador($real,$orcado){
			if($real<$orcado){
				return "'down'";
			}else{
				return "'up'";
			}
		
		}
		
		
		$select="SELECT year(data_inicio) as ano FROM orcamento.tb_orcamento where id_orcamento='".$id_orcamento."';";
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		while($row = mysql_fetch_array($resultado))
		{
			$ano=$row['ano'];	
		}

			$mes_01_I = date("Y-m-d", mktime (0, 0, 0, 1  , 1, $ano));
			$mes_02_I = date("Y-m-d", mktime (0, 0, 0, 2  , 1, $ano));
			$mes_03_I = date("Y-m-d", mktime (0, 0, 0, 3  , 1, $ano));
			$mes_04_I = date("Y-m-d", mktime (0, 0, 0, 4  , 1, $ano));
			$mes_05_I = date("Y-m-d", mktime (0, 0, 0, 5  , 1, $ano));
			$mes_06_I = date("Y-m-d", mktime (0, 0, 0, 6  , 1, $ano));
			$mes_07_I = date("Y-m-d", mktime (0, 0, 0, 7  , 1, $ano));
			$mes_08_I = date("Y-m-d", mktime (0, 0, 0, 8  , 1, $ano));
			$mes_09_I = date("Y-m-d", mktime (0, 0, 0, 9  , 1, $ano));
			$mes_10_I = date("Y-m-d", mktime (0, 0, 0, 10 , 1, $ano));
			$mes_11_I = date("Y-m-d", mktime (0, 0, 0, 11 , 1, $ano));
			$mes_12_I = date("Y-m-d", mktime (0, 0, 0, 12 , 1, $ano));

			$mes_01_F = date("Y-m-d", mktime (0, 0, 0, 2  , 1, $ano)-1);
			$mes_02_F = date("Y-m-d", mktime (0, 0, 0, 3  , 1, $ano)-1);
			$mes_03_F = date("Y-m-d", mktime (0, 0, 0, 4  , 1, $ano)-1);
			$mes_04_F = date("Y-m-d", mktime (0, 0, 0, 5  , 1, $ano)-1);
			$mes_05_F = date("Y-m-d", mktime (0, 0, 0, 6  , 1, $ano)-1);
			$mes_06_F = date("Y-m-d", mktime (0, 0, 0, 7  , 1, $ano)-1);
			$mes_07_F = date("Y-m-d", mktime (0, 0, 0, 8  , 1, $ano)-1);
			$mes_08_F = date("Y-m-d", mktime (0, 0, 0, 9  , 1, $ano)-1);
			$mes_09_F = date("Y-m-d", mktime (0, 0, 0, 10  , 1, $ano)-1);
			$mes_10_F = date("Y-m-d", mktime (0, 0, 0, 11 , 1, $ano)-1);
			$mes_11_F = date("Y-m-d", mktime (0, 0, 0, 12 , 1, $ano)-1);
			$mes_12_F = date("Y-m-d", mktime (0, 0, 0, 1 , 1, $ano+1)-1);		
		
		
		
		
		
		$select= "
		
						select
							0 as id, 
							'00' as numero,
							'CONSOLIDADO' as descricao,
							
							0.00 as mes_01_O,
							0.00 as mes_02_O,
							0.00 as mes_03_O,
							0.00 as mes_04_O,
							0.00 as mes_05_O,
							0.00 as mes_06_O,
							0.00 as mes_07_O,
							0.00 as mes_08_O,
							0.00 as mes_09_O,
							0.00 as mes_10_O,
							0.00 as mes_11_O,
							0.00 as mes_12_O,

							0.00 as mes_01_R,
							0.00 as mes_02_R,
							0.00 as mes_03_R,
							0.00 as mes_04_R,
							0.00 as mes_05_R,
							0.00 as mes_06_R,
							0.00 as mes_07_R,
							0.00 as mes_08_R,
							0.00 as mes_09_R,
							0.00 as mes_10_R,
							0.00 as mes_11_R,
							0.00 as mes_12_R

						
						union all
						
						SELECT
							tb_centro_de_custos.id,
							concat('00.',tb_centro_de_custos.numero) as numero,
							tb_centro_de_custos.descricao,

							-sum(ifnull(mes_1_O.valor,0)) as mes_01_O,
							-sum(ifnull(mes_2_O.valor,0)) as mes_02_O,
							-sum(ifnull(mes_3_O.valor,0)) as mes_03_O,
							-sum(ifnull(mes_4_O.valor,0)) as mes_04_O,
							-sum(ifnull(mes_5_O.valor,0)) as mes_05_O,
							-sum(ifnull(mes_6_O.valor,0)) as mes_06_O,
							-sum(ifnull(mes_7_O.valor,0)) as mes_07_O,
							-sum(ifnull(mes_8_O.valor,0)) as mes_08_O,
							-sum(ifnull(mes_9_O.valor,0)) as mes_09_O,
							-sum(ifnull(mes_10_O.valor,0)) as mes_10_O,
							-sum(ifnull(mes_11_O.valor,0)) as mes_11_O,
							-sum(ifnull(mes_12_O.valor,0)) as mes_12_O,

							sum(ifnull(mes_1_R.valor,0)) as mes_01_R,
							sum(ifnull(mes_2_R.valor,0)) as mes_02_R,
							sum(ifnull(mes_3_R.valor,0)) as mes_03_R,
							sum(ifnull(mes_4_R.valor,0)) as mes_04_R,
							sum(ifnull(mes_5_R.valor,0)) as mes_05_R,
							sum(ifnull(mes_6_R.valor,0)) as mes_06_R,
							sum(ifnull(mes_7_R.valor,0)) as mes_07_R,
							sum(ifnull(mes_8_R.valor,0)) as mes_08_R,
							sum(ifnull(mes_9_R.valor,0)) as mes_09_R,
							sum(ifnull(mes_10_R.valor,0)) as mes_10_R,
							sum(ifnull(mes_11_R.valor,0)) as mes_11_R,
							sum(ifnull(mes_12_R.valor,0)) as mes_12_R


						FROM 
							(
							SELECT
								centro_de_custos.id,
								centro_de_custos.`schema`,
								centro_de_custos.numero,
								centro_de_custos.descricao
							FROM
								orcamento.centro_de_custos,
								orcamento.tb_orcamento
							WHERE
								centro_de_custos.`schema`=tb_orcamento.schema_plano_de_contas and
								tb_orcamento.id_orcamento='".$id_orcamento."' 						
							) as tb_centro_de_custos 
							
							
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_01_I."' and '".$mes_01_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_1_O on tb_centro_de_custos.id=mes_1_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_02_I."' and '".$mes_02_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_2_O on tb_centro_de_custos.id=mes_2_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_03_I."' and '".$mes_03_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_3_O on tb_centro_de_custos.id=mes_3_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_04_I."' and '".$mes_04_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_4_O on tb_centro_de_custos.id=mes_4_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_05_I."' and '".$mes_05_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_5_O on tb_centro_de_custos.id=mes_5_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_06_I."' and '".$mes_06_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_6_O on tb_centro_de_custos.id=mes_6_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_07_I."' and '".$mes_07_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_7_O on tb_centro_de_custos.id=mes_7_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_08_I."' and '".$mes_08_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_8_O on tb_centro_de_custos.id=mes_8_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_09_I."' and '".$mes_09_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_9_O on tb_centro_de_custos.id=mes_9_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_10_I."' and '".$mes_10_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_10_O on tb_centro_de_custos.id=mes_10_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_11_I."' and '".$mes_11_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_11_O on tb_centro_de_custos.id=mes_11_O.idctrcusto
						left join (SELECT month(data) as mes, idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.tb_orcamento_lancamentos where data between '".$mes_12_I."' and '".$mes_12_F."' and id_orcamento='".$id_orcamento."' group by idctrcusto ) as mes_12_O on tb_centro_de_custos.id=mes_12_O.idctrcusto

						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_01_I."' and '".$mes_01_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_1_R on tb_centro_de_custos.id=mes_1_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_02_I."' and '".$mes_02_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_2_R on tb_centro_de_custos.id=mes_2_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_03_I."' and '".$mes_03_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_3_R on tb_centro_de_custos.id=mes_3_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_04_I."' and '".$mes_04_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_4_R on tb_centro_de_custos.id=mes_4_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_05_I."' and '".$mes_05_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_5_R on tb_centro_de_custos.id=mes_5_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_06_I."' and '".$mes_06_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_6_R on tb_centro_de_custos.id=mes_6_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_07_I."' and '".$mes_07_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_7_R on tb_centro_de_custos.id=mes_7_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_08_I."' and '".$mes_08_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_8_R on tb_centro_de_custos.id=mes_8_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_09_I."' and '".$mes_09_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_9_R on tb_centro_de_custos.id=mes_9_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_10_I."' and '".$mes_10_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_10_R on tb_centro_de_custos.id=mes_10_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_11_I."' and '".$mes_11_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_11_R on tb_centro_de_custos.id=mes_11_R.idctrcusto
						left join (SELECT month(data) as mes,	idctrcusto, sum(ifnull(valor,0)) as valor FROM orcamento.lancamentos where data between '".$mes_12_I."' and '".$mes_12_F."' and `schema`='".$schema_real."' group by idctrcusto ) as mes_12_R on tb_centro_de_custos.id=mes_12_R.idctrcusto



						GROUP BY 
							tb_centro_de_custos.numero;
							
							";
		
		$resultado=mysql_query($select,$conexao) or die (mysql_error());
		$i=0;
		$row_="";
		while($row = mysql_fetch_array($resultado))
		{
				$row_[$i]['numero']=formatar($row['numero'],4);
				$row_[$i]['id_grid']=id(formatar($row['numero'],4));
				$row_[$i]['id_grid_pai']=pai(formatar($row['numero'],4));
				$row_[$i]['descricao']=$row['descricao'];
				$row_[$i]['id']=$row['id'];
				$row_[$i]['mes_01_O']=$row['mes_01_O'];
				$row_[$i]['mes_02_O']=$row['mes_02_O'];
				$row_[$i]['mes_03_O']=$row['mes_03_O'];
				$row_[$i]['mes_04_O']=$row['mes_04_O'];
				$row_[$i]['mes_05_O']=$row['mes_05_O'];
				$row_[$i]['mes_06_O']=$row['mes_06_O'];
				$row_[$i]['mes_07_O']=$row['mes_07_O'];
				$row_[$i]['mes_08_O']=$row['mes_08_O'];
				$row_[$i]['mes_09_O']=$row['mes_09_O'];
				$row_[$i]['mes_10_O']=$row['mes_10_O'];
				$row_[$i]['mes_11_O']=$row['mes_11_O'];
				$row_[$i]['mes_12_O']=$row['mes_12_O'];
				
				$row_[$i]['mes_01_R']=$row['mes_01_R'];
				$row_[$i]['mes_02_R']=$row['mes_02_R'];
				$row_[$i]['mes_03_R']=$row['mes_03_R'];
				$row_[$i]['mes_04_R']=$row['mes_04_R'];
				$row_[$i]['mes_05_R']=$row['mes_05_R'];
				$row_[$i]['mes_06_R']=$row['mes_06_R'];
				$row_[$i]['mes_07_R']=$row['mes_07_R'];
				$row_[$i]['mes_08_R']=$row['mes_08_R'];
				$row_[$i]['mes_09_R']=$row['mes_09_R'];
				$row_[$i]['mes_10_R']=$row['mes_10_R'];
				$row_[$i]['mes_11_R']=$row['mes_11_R'];
				$row_[$i]['mes_12_R']=$row['mes_12_R'];
				
				
				
				$i=$i+1;
		}	
		//echo count($row_);
		for($i=0;$i<count($row_);$i++){
			$numero=$row_[$i]['numero'];

			for($x=0;$x<count($row_);$x++){
				if(
						$row_[$x]['numero']!=$numero and 
						substr($row_[$x]['numero'],0,strlen($numero))==$numero
					){
					$row_[$i]['mes_01_O']=$row_[$i]['mes_01_O']+$row_[$x]['mes_01_O'];
					$row_[$i]['mes_02_O']=$row_[$i]['mes_02_O']+$row_[$x]['mes_02_O'];
					$row_[$i]['mes_03_O']=$row_[$i]['mes_03_O']+$row_[$x]['mes_03_O'];
					$row_[$i]['mes_04_O']=$row_[$i]['mes_04_O']+$row_[$x]['mes_04_O'];
					$row_[$i]['mes_05_O']=$row_[$i]['mes_05_O']+$row_[$x]['mes_05_O'];
					$row_[$i]['mes_06_O']=$row_[$i]['mes_06_O']+$row_[$x]['mes_06_O'];
					$row_[$i]['mes_07_O']=$row_[$i]['mes_07_O']+$row_[$x]['mes_07_O'];
					$row_[$i]['mes_08_O']=$row_[$i]['mes_08_O']+$row_[$x]['mes_08_O'];
					$row_[$i]['mes_09_O']=$row_[$i]['mes_09_O']+$row_[$x]['mes_09_O'];
					$row_[$i]['mes_10_O']=$row_[$i]['mes_10_O']+$row_[$x]['mes_10_O'];
					$row_[$i]['mes_11_O']=$row_[$i]['mes_11_O']+$row_[$x]['mes_11_O'];
					$row_[$i]['mes_12_O']=$row_[$i]['mes_12_O']+$row_[$x]['mes_12_O'];
					
					$row_[$i]['mes_01_R']=$row_[$i]['mes_01_R']+$row_[$x]['mes_01_R'];
					$row_[$i]['mes_02_R']=$row_[$i]['mes_02_R']+$row_[$x]['mes_02_R'];
					$row_[$i]['mes_03_R']=$row_[$i]['mes_03_R']+$row_[$x]['mes_03_R'];
					$row_[$i]['mes_04_R']=$row_[$i]['mes_04_R']+$row_[$x]['mes_04_R'];
					$row_[$i]['mes_05_R']=$row_[$i]['mes_05_R']+$row_[$x]['mes_05_R'];
					$row_[$i]['mes_06_R']=$row_[$i]['mes_06_R']+$row_[$x]['mes_06_R'];
					$row_[$i]['mes_07_R']=$row_[$i]['mes_07_R']+$row_[$x]['mes_07_R'];
					$row_[$i]['mes_08_R']=$row_[$i]['mes_08_R']+$row_[$x]['mes_08_R'];
					$row_[$i]['mes_09_R']=$row_[$i]['mes_09_R']+$row_[$x]['mes_09_R'];
					$row_[$i]['mes_10_R']=$row_[$i]['mes_10_R']+$row_[$x]['mes_10_R'];
					$row_[$i]['mes_11_R']=$row_[$i]['mes_11_R']+$row_[$x]['mes_11_R'];
					$row_[$i]['mes_12_R']=$row_[$i]['mes_12_R']+$row_[$x]['mes_12_R'];
				}

			}
		
		
		}
		$json="";
		for($i=0;$i<count($row_);$i++){
			
			
			$json.='{
					"id":'.$row_[$i]['id'].',
					"id_grid":'.$row_[$i]['id_grid'].',
					"id_grid_pai":'.$row_[$i]['id_grid_pai'].',
					"numero":"'.$row_[$i]['numero'].'",
					"nome_conta":"'.$row_[$i]['numero'].' - '.$row_[$i]['descricao'].'" ,
					"mes_01_O":'.$row_[$i]['mes_01_O'].' ,
					"mes_02_O":'.$row_[$i]['mes_02_O'].' ,
					"mes_03_O":'.$row_[$i]['mes_03_O'].' ,
					"mes_04_O":'.$row_[$i]['mes_04_O'].' ,
					"mes_05_O":'.$row_[$i]['mes_05_O'].' ,
					"mes_06_O":'.$row_[$i]['mes_06_O'].' ,
					"mes_07_O":'.$row_[$i]['mes_07_O'].' ,
					"mes_08_O":'.$row_[$i]['mes_08_O'].' ,
					"mes_09_O":'.$row_[$i]['mes_09_O'].' ,
					"mes_10_O":'.$row_[$i]['mes_10_O'].' ,
					"mes_11_O":'.$row_[$i]['mes_11_O'].' ,
					"mes_12_O":'.$row_[$i]['mes_12_O'].' ,

					"total_O":'.
							($row_[$i]['mes_01_O']
							+$row_[$i]['mes_02_O']
							+$row_[$i]['mes_03_O']
							+$row_[$i]['mes_04_O']
							+$row_[$i]['mes_05_O']
							+$row_[$i]['mes_06_O']
							+$row_[$i]['mes_07_O']
							+$row_[$i]['mes_08_O']
							+$row_[$i]['mes_09_O']
							+$row_[$i]['mes_10_O']
							+$row_[$i]['mes_11_O']
							+$row_[$i]['mes_12_O'])
							.' ,
					
					"mes_01_R":'.$row_[$i]['mes_01_R'].' ,
					"mes_02_R":'.$row_[$i]['mes_02_R'].' ,
					"mes_03_R":'.$row_[$i]['mes_03_R'].' ,
					"mes_04_R":'.$row_[$i]['mes_04_R'].' ,
					"mes_05_R":'.$row_[$i]['mes_05_R'].' ,
					"mes_06_R":'.$row_[$i]['mes_06_R'].' ,
					"mes_07_R":'.$row_[$i]['mes_07_R'].' ,
					"mes_08_R":'.$row_[$i]['mes_08_R'].' ,
					"mes_09_R":'.$row_[$i]['mes_09_R'].' ,
					"mes_10_R":'.$row_[$i]['mes_10_R'].' ,
					"mes_11_R":'.$row_[$i]['mes_11_R'].' ,
					"mes_12_R":'.$row_[$i]['mes_12_R'].' ,

					"total_R":'.
							($row_[$i]['mes_01_R']
							+$row_[$i]['mes_02_R']
							+$row_[$i]['mes_03_R']
							+$row_[$i]['mes_04_R']
							+$row_[$i]['mes_05_R']
							+$row_[$i]['mes_06_R']
							+$row_[$i]['mes_07_R']
							+$row_[$i]['mes_08_R']
							+$row_[$i]['mes_09_R']
							+$row_[$i]['mes_10_R']
							+$row_[$i]['mes_11_R']
							+$row_[$i]['mes_12_R'])
							.' ,
							
					"mes_01_V":'.($row_[$i]['mes_01_R']-$row_[$i]['mes_01_O']).' ,
					"mes_02_V":'.($row_[$i]['mes_02_R']-$row_[$i]['mes_02_O']).' ,
					"mes_03_V":'.($row_[$i]['mes_03_R']-$row_[$i]['mes_03_O']).' ,
					"mes_04_V":'.($row_[$i]['mes_04_R']-$row_[$i]['mes_04_O']).' ,
					"mes_05_V":'.($row_[$i]['mes_05_R']-$row_[$i]['mes_05_O']).' ,
					"mes_06_V":'.($row_[$i]['mes_06_R']-$row_[$i]['mes_06_O']).' ,
					"mes_07_V":'.($row_[$i]['mes_07_R']-$row_[$i]['mes_07_O']).' ,
					"mes_08_V":'.($row_[$i]['mes_08_R']-$row_[$i]['mes_08_O']).' ,
					"mes_09_V":'.($row_[$i]['mes_09_R']-$row_[$i]['mes_09_O']).' ,
					"mes_10_V":'.($row_[$i]['mes_10_R']-$row_[$i]['mes_10_O']).' ,
					"mes_11_V":'.($row_[$i]['mes_11_R']-$row_[$i]['mes_11_O']).' ,
					"mes_12_V":'.($row_[$i]['mes_12_R']-$row_[$i]['mes_12_O']).' ,

					"total_V":'.
							(($row_[$i]['mes_01_R']
							+$row_[$i]['mes_02_R']
							+$row_[$i]['mes_03_R']
							+$row_[$i]['mes_04_R']
							+$row_[$i]['mes_05_R']
							+$row_[$i]['mes_06_R']
							+$row_[$i]['mes_07_R']
							+$row_[$i]['mes_08_R']
							+$row_[$i]['mes_09_R']
							+$row_[$i]['mes_10_R']
							+$row_[$i]['mes_11_R']
							+$row_[$i]['mes_12_R'])
							
							-($row_[$i]['mes_01_O']
							+$row_[$i]['mes_02_O']
							+$row_[$i]['mes_03_O']
							+$row_[$i]['mes_04_O']
							+$row_[$i]['mes_05_O']
							+$row_[$i]['mes_06_O']
							+$row_[$i]['mes_07_O']
							+$row_[$i]['mes_08_O']
							+$row_[$i]['mes_09_O']
							+$row_[$i]['mes_10_O']
							+$row_[$i]['mes_11_O']
							+$row_[$i]['mes_12_O']))

							.' ,
							
					"mes_01_sinalizador":'.sinalizador($row_[$i]['mes_01_R'],$row_[$i]['mes_01_O']).' ,
					"mes_02_sinalizador":'.sinalizador($row_[$i]['mes_02_R'],$row_[$i]['mes_02_O']).' ,
					"mes_03_sinalizador":'.sinalizador($row_[$i]['mes_03_R'],$row_[$i]['mes_03_O']).' ,
					"mes_04_sinalizador":'.sinalizador($row_[$i]['mes_04_R'],$row_[$i]['mes_04_O']).' ,
					"mes_05_sinalizador":'.sinalizador($row_[$i]['mes_05_R'],$row_[$i]['mes_05_O']).' ,
					"mes_06_sinalizador":'.sinalizador($row_[$i]['mes_06_R'],$row_[$i]['mes_06_O']).' ,
					"mes_07_sinalizador":'.sinalizador($row_[$i]['mes_07_R'],$row_[$i]['mes_07_O']).' ,
					"mes_08_sinalizador":'.sinalizador($row_[$i]['mes_08_R'],$row_[$i]['mes_08_O']).' ,
					"mes_09_sinalizador":'.sinalizador($row_[$i]['mes_09_R'],$row_[$i]['mes_09_O']).' ,
					"mes_10_sinalizador":'.sinalizador($row_[$i]['mes_10_R'],$row_[$i]['mes_10_O']).' ,
					"mes_11_sinalizador":'.sinalizador($row_[$i]['mes_11_R'],$row_[$i]['mes_11_O']).' ,
					"mes_12_sinalizador":'.sinalizador($row_[$i]['mes_12_R'],$row_[$i]['mes_12_O']).' ,
					"ttal_sinalizador":'.sinalizador(
							($row_[$i]['mes_01_R']
							+$row_[$i]['mes_02_R']
							+$row_[$i]['mes_03_R']
							+$row_[$i]['mes_04_R']
							+$row_[$i]['mes_05_R']
							+$row_[$i]['mes_06_R']
							+$row_[$i]['mes_07_R']
							+$row_[$i]['mes_08_R']
							+$row_[$i]['mes_09_R']
							+$row_[$i]['mes_10_R']
							+$row_[$i]['mes_11_R']
							+$row_[$i]['mes_12_R'])
					
							,
							
							($row_[$i]['mes_01_O']
							+$row_[$i]['mes_02_O']
							+$row_[$i]['mes_03_O']
							+$row_[$i]['mes_04_O']
							+$row_[$i]['mes_05_O']
							+$row_[$i]['mes_06_O']
							+$row_[$i]['mes_07_O']
							+$row_[$i]['mes_08_O']
							+$row_[$i]['mes_09_O']
							+$row_[$i]['mes_10_O']
							+$row_[$i]['mes_11_O']
							+$row_[$i]['mes_12_O'])
					
					).'
					
					}';

		}		
		$json=str_replace("}{","},{",$json);
		echo 'var base=['.$json.'];';
	//	echo $select;
	
	
	}	
	function detalhe_real($cod_conta,$data_inicio,$data_fim){
	
	
	
	}
	
	
}


	if(isset($_GET['bs']) and isset($_GET['schema_real']) and isset($_GET['id_orcamento']) ){
		$base=new base;
		$base->$_GET['bs']($_GET['schema_real'],$_GET['id_orcamento']);
		
	}else{
		if(isset($_GET['bs'])){
			$base=new base;
			$base->$_GET['bs']();
		
		}
	
	}
	


?>
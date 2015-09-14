<?php
								
if(isset($_GET['cod_colaborador'])){
include "config.php";
					$select= 
						"SELECT 
							status_carta, 
							cad_status.status_resumido,
							sum(carta_valor_moeda) as total
						FROM 
							".$schema.".cad_cartas,
							".$schema.".cad_status
						where 
							cad_cartas.status_carta=cad_status.cod_status and
							cod_colaborador=".$_GET['cod_colaborador']." and
							cad_status.status_resumido!='carta_renovada'
						group by 
							status_carta;";
					$resultado=mysql_query($select,$conexao) or die ("<div class='uk-alert uk-alert-danger' data-uk-alert=''><p>".mysql_error()."</p></div>");
					$data_grafico='';
					$categories='';
						while($row = mysql_fetch_array($resultado))
						{
						$data_grafico.=$row['total'].",";
						$categories.="'".$row['status_resumido']."',";
						
						}
echo " var data_grafico=[".$data_grafico."];";
echo " var categories_grafico=[".$categories."];";

}
								
								
?>
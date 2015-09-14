<?php
	include "config.php";
	
	if(isset($_POST['cod_moeda'])){
	

///atualizar carta
$update_carta="update 
				".$schema.".cad_cartas,
				(SELECT 
					cod_carta,
					carta_moeda,
					carta_qtd_moeda,
					carta_valor_moeda,
					status_carta,
					tb_valor_moeda.valor_moeda,
					(carta_qtd_moeda*tb_valor_moeda.valor_moeda) as novo_valor

				FROM 
					".$schema.".cad_cartas,
					(SELECT cad_moedas_valores.valor as valor_moeda, ".$_POST['cod_moeda']." as cod_moeda from ".$schema.".cad_moedas_valores, (SELECT max(data_inicio) as data_inicio FROM ".$schema.".cad_moedas_valores WHERE cod_moeda=".$_POST['cod_moeda'].") as tb_valor where cad_moedas_valores.cod_moeda=".$_POST['cod_moeda']." and tb_valor.data_inicio=cad_moedas_valores.data_inicio) as tb_valor_moeda

				WHERE
					cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and 
					carta_moeda=".$_POST['cod_moeda']." and
					status_carta=1 and
					tb_valor_moeda.cod_moeda=cad_cartas.carta_moeda) as tb_novo_valor_carta 


			set cad_cartas.carta_valor_moeda=tb_novo_valor_carta.novo_valor

			where tb_novo_valor_carta.cod_carta=cad_cartas.cod_carta";



///atualizar captacoes
$update_captacao="update
				".$schema.".captacao_cartas,
				(
					select 
						cod_carta,
						carta_valor_moeda

					from 
						".$schema.".cad_cartas

					WHERE
							cad_cartas.cod_empresa=".$_SESSION['cod_empresa']." and 
							carta_moeda=".$_POST['cod_moeda']." and
							status_carta=1 

				) as tb_valor_carta
			set
				captacao_cartas.valor=tb_valor_carta.carta_valor_moeda

			where
				tb_valor_carta.cod_carta=captacao_cartas.cod_carta and
				captacao_cartas.status='-02' and
				captacao_cartas.data_vencimento>=now()
				";	

	
				$update=mysql_query($update_carta,$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."</div>");	
				$update=mysql_query($update_captacao,$conexao)  or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."</div>");	
				echo "<div class='uk-alert uk-alert-success  tm-main uk-width-medium-1-2 uk-container-center'>Registros atualizados com sucesso!</div>";

	}


?>


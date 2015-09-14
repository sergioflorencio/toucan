<?php 

	session_start();
	include "../../php/login.php";
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
	
	include "php/config.php";			

if((isset($_GET['id']) and $_GET['id']!='novo') or (isset($_POST['cod_captacao_carta']))){
//consultar cadastro

	if(isset($_GET['id']) and $_GET['id']!='novo'){$cod_captacao=$_GET['id'];}
	if(isset($_POST['cod_carta'])){$cod_captacao=$_POST['cod_carta'];}
	
	
	
					$select= "
						SELECT
								captacao_cartas.cod_captacao_cartas,
								captacao_cartas.cod_carta,
								captacao_cartas.numero_lote,
								DATE_FORMAT(captacao_cartas.data_vencimento,'%d/%m/%Y') as data_vencimento,
								captacao_cartas.status,
								cad_cartas.cod_contribuinte as cod_pessoa,
								cad_pessoas.nome_razao_social as nomecontribuinte,
								captacao_cartas.valor as valor,
								IFNULL(sum(captacao_cartas_baixas.valor_baixa),0) as somabaixas,
								(captacao_cartas.valor-IFNULL(sum(captacao_cartas_baixas.valor_baixa),0)) as saldocaptacao
								
							FROM 
								".$schema.".captacao_cartas

							LEFT JOIN ".$schema.".cad_cartas ON
								".$schema.".cad_cartas.cod_carta=".$schema.".captacao_cartas.cod_carta

							LEFT JOIN ".$schema.".captacao_cartas_baixas ON 
								".$schema.".captacao_cartas_baixas.cod_captacao_cartas=".$schema.".captacao_cartas.cod_captacao_cartas

							LEFT JOIN ".$schema.".cad_pessoas ON
								".$schema.".cad_pessoas.cod_pessoa=".$schema.".cad_cartas.cod_contribuinte

							WHERE 
								".$schema.".captacao_cartas.cod_captacao_cartas = '".$cod_captacao."'

							GROUP BY 	
								".$schema.".captacao_cartas.cod_captacao_cartas;";

					
					$resultado=mysql_query($select,$conexao) or die ("nao foi possivel conectar");
					while($row = mysql_fetch_array($resultado))
					  {
							$cod_captacao_cartas=$row['cod_captacao_cartas'];
							$cod_carta=$row['cod_carta'];
							$numero_lote=$row['numero_lote'];
							$data_vencimento=$row['data_vencimento'];
							$cod_pessoa=$row['cod_pessoa'];
							$status=$row['status'];
							$valor=$row['valor'];
							$somabaixas=$row['somabaixas'];
							$saldocaptacao=$row['saldocaptacao'];
							$cod_carta=$row['cod_carta'];
							$cod_carta=$row['cod_carta'];
							$cod_carta=$row['cod_carta'];

					  }
				
					  
					  
					  
					  
					  

	}else{
							$cod_carta='';

	
	}


?>






<body>

<!-- sub-menú -->
			
<div style="margin: 10px;">	
	<div class="uk-grid uk-grid-preserve"  id="submenu">
			<div class="uk-width-1-1">

					<div class=" uk-navbar-flip ">

						<div class="uk-button-group uk-hidden-small">
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('xls','tm-content','html');" data-uk-tooltip="{pos:'bottom-left'}" title="exportar arquivo .xls"><i class="uk-icon-file-excel-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('doc','tm-content','html');" data-uk-tooltip="{pos:'bottom-left'}" title="exportar arquivo .doc"><i class="uk-icon-file-word-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="imprimir('tm-content');" data-uk-tooltip="{pos:'bottom-left'}" title="imprimir"><i class="uk-icon-print"></i></span>						
						</div>	
					</div>	
				
			<?php 
				if(isset($_GET["id"])==false or $_GET["id"]==""){
			?>			
					<div class="uk-button-group ">
						<a href="#" onclick="marcar_checkbox('m');" style="padding-top: 7px; padding-bottom: 7px;" class="uk-button uk-button-small"  data-uk-tooltip="{pos:'bottom-left'}" title="Marcar todas"><i class="uk-icon-check-square-o"></i></a>
						<a href="#" onclick="marcar_checkbox('d');" style="padding-top: 7px; padding-bottom: 7px;" class="uk-button uk-button-small"  data-uk-tooltip="{pos:'bottom-left'}" title="Desmarcar todas"><i class="uk-icon-square-o"></i></a>
					</div>
					<span class="uk-button uk-button-small " style="padding-top: 7px; padding-bottom: 7px;" onclick="listar_itens_baixa_em_lote();" data-uk-modal="{target:'#div_baixa_em_lote'}" data-uk-tooltip="{pos:'bottom-left'}" title="Baixa em lote"><i class="uk-icon-magic"></i></span>					
					<div class="uk-button-group ">
						<?php
							$button=new button;
							$button->boletos();
							$button->recibos();
						
						?>

					</div>


					

					<div id="div_baixa_em_lote" class="uk-modal">
						<div class="uk-modal-dialog">
							<a class="uk-modal-close uk-close"></a>
							<div class="uk-grid uk-form">
								<div class="uk-width-2-3">
									<?php
										$selects=new selects;
										$selects->select_carteiras2('cod_carteira_baixa_lote');
									?>
								</div>
								<div class="uk-width-1-3" style="padding-top: 10px;">
									<?php
										$inputs=new inputs;
										$inputs->input_form_row('00/00/0000','data_baixa_lote','Data de baixa','',"placeholder='00/00/0000' onkeyup=javascript:formatar_data(this);");
									?>
									
								</div>
								<div class="uk-width-1-1" style="padding-top: 10px;">
									<hr class="uk-article-divider" style="margin-bottom: 0px;">								
									<div class="uk-grid" id="" style="height: 300px; overflow-y: scroll;">
									<div class="uk-width-1-1" id="itens_baixa_em_lote">
									</div>
									<table id="itens_baixa_em_lote" class="uk-table uk-table-hover">
									</table>
									</div>
									<input type="text" id="cod_captacao_carta_baixa_lote" hidden>
									<input type="text" id="valor_baixa_lote" hidden>
								</div>
								<div class="uk-width-1-1 uk-modal-footer" style="padding-top: 0px;">
									<hr class="uk-article-divider">								
									<div class="uk-navbar-flip">
										<button class="uk-button uk-button-small uk-button-primary " type="button" onclick="baixar_itens_em_lote();"><i class="uk-icon-magic"></i> Baixar</button>
										<button class="uk-button uk-button-small uk-button-danger uk-modal-close" type="button"><i class="uk-icon-close"></i> Fechar</button>
									</div>
								</div>
								


						

							
							</div>
						</div>
					</div>
				<?php		
					}else{
				?>						
						<?php
						if(isset($cod_captacao_cartas)){
							echo '<div class="uk-button-group" style="">
										<a href="#" style="padding-top: 7px; padding-bottom: 7px;"  onclick="mudar_status_captacao('.$cod_captacao_cartas.','."'php/mudar_status_captacao.php'".');" class="uk-button uk-button-small uk-button-danger" data-uk-tooltip title="Liberar captação do lote"><i class="uk-icon-unlock"></i></a>
										<a href="#" style="padding-top: 7px; padding-bottom: 7px;"  onclick=mudar_status_captacao('. $cod_captacao_cartas.','."'php/suspender_recebimento.php'".'); class="uk-button uk-button-small uk-button-danger" data-uk-tooltip title="Suspener recebimento" ><i class="uk-icon-flag"></i></a>
									</div>';
						}

						?>
				<?php		
					}
				?>	
			<span class="" id="arquivo_gerado"></span>	
			<hr class="uk-article-divider" style="margin: 10px -10px 0px -10px;">
			</div>

	</div>

	<div class="uk-grid" style="margin-top: 0px;">	
		<div class="uk-width-medium-1-1">	
			<div class="uk-grid">	
				<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4" style="min-height: 1px; border-right: 1px solid rgb(204, 204, 204); ">		
					<div class="tm-content">
					<div class=" uk-navbar-flip " style="margin-right: 20px;">
						<div class="uk-button-group uk-visible-small">
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('xls','tm-content','html');" data-uk-tooltip="{pos:'bottom-left'}" title="exportar arquivo .xls"><i class="uk-icon-file-excel-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('doc','tm-content','html');" data-uk-tooltip="{pos:'bottom-left'}" title="exportar arquivo .doc"><i class="uk-icon-file-word-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="imprimir('tm-content');" data-uk-tooltip="{pos:'bottom-left'}" title="imprimir"><i class="uk-icon-print"></i></span>						
						</div>	
					</div>					
				
				<?php if(isset($_GET['id'])==false){
					$filtro=new filtros; 
					$filtro->captacoes();	
				}?>
					
					</div>		
				</div>		
				<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-2-3 uk-width-large-3-4 " style="min-height: 100%; padding-left: 0px; border-left: 1px solid rgb(204, 204, 204);" id="tm-content">			
					<div class="tm-content">
						<div class="uk-overflow-container">
						<?php 
					
							if(
									isset($_POST['cod_carta']) and 
									isset($_POST['cod_captacao']) and 
									isset($_POST['lote_envio']) and 
									isset($_POST['data_inicio_de']) and 
									isset($_POST['data_inicio_ate']) and 
									isset($_POST['status_captacao_resumido']) and 
									isset($_POST['captacao_cartas_cod_retorno']) and 
									isset($_POST['valor_moeda_de']) and 
									isset($_POST['valor_moeda_ate']) and 
									isset($_POST['cod_pessoa']) and 
									isset($_POST['cod_colaborador']) and 
									isset($_POST['cod_ctrreceita']) and 
									isset($_POST['cod_centro']) and 
									isset($_POST['cod_grupo']) and 
									isset($_POST['cod_banco']) and 
									isset($_POST['cod_carteira']) and 
									isset($_POST['tipo_convenio']) and 
									isset($_POST['boleto_modo_envio'])and
									isset($_POST['carta_aberta'])
							){
								$captacoes=new tabelas; $captacoes->listar_captacoes(
									$_POST['cod_carta'],
									$_POST['cod_captacao'],
									$_POST['lote_envio'],
									$_POST['data_inicio_de'],
									$_POST['data_inicio_ate'],
									$_POST['status_captacao_resumido'],
									$_POST['captacao_cartas_cod_retorno'],
									$_POST['valor_moeda_de'],
									$_POST['valor_moeda_ate'],
									$_POST['cod_pessoa'],
									$_POST['cod_colaborador'],
									$_POST['cod_ctrreceita'],
									$_POST['cod_centro'],
									$_POST['cod_grupo'],
									$_POST['cod_banco'],
									$_POST['cod_carteira'],
									$_POST['tipo_convenio'],
									$_POST['boleto_modo_envio'],
									$_POST['carta_aberta']
								);
							}
							if(isset($_GET['id'])){
								include 'includes/cad_captacoes.php';
								
								}
							?>

						</div>
					</div>
				</div>	
			</div>
		</div>		
	</div>		
	</div>		
			
			
			
			
			
			
			
			

</body>
	<?php } ?>
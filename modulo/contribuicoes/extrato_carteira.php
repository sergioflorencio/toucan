<?php 
	session_start();
	include "../../php/login.php";

	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
	
	include "php/config.php";	
	include "../../igniteui.php";
	
?>



<body>

<!-- sub-menú -->
			
<div style="margin: 10px;">	
	<div class="uk-grid uk-grid-preserve"  id="submenu">
			<div class="uk-width-1-1">
				<div class="uk-button-group">
					<a href="#" class="uk-button uk-button-small" data-uk-modal="{target:'#filtro'}"><i class="uk-icon-filter"></i> Filtro</a>
				</div>
				<div class="uk-button-group uk-navbar-flip">
					<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('xls','grid','json');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .xls"><i class="uk-icon-file-excel-o"></i></span>
					<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('doc','grid','json');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .doc"><i class="uk-icon-file-word-o"></i></span>
					<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="imprimir('tm-content');" data-uk-tooltip="{pos:'left'}" title="imprimir"><i class="uk-icon-print"></i></span>	
				</div>					

					<span id="arquivo_gerado"></span>
			<hr class="uk-article-divider" style="margin: 10px -10px 0px -10px;">
			</div>
	</div>
	<div id="filtro" class="uk-modal" style="">
		<div class="uk-modal-dialog">
		<a href="" class="uk-modal-close uk-close"></a>
				<?php
					 $filtro=new filtros; 
					$filtro->carteiras();	
				?>
		</div>
	</div>
	<div class="uk-grid uk-overflow-container">	
		<div class="uk-width-medium-1-1">	
			<div class="uk-grid">	
				<div class="uk-width-medium-1-1" style="min-height: 450px;">		
					<div id="tm-content" class="tm-content">
						<div class="">
						<?php 
							if(
									isset($_POST['cod_carta']) and 
									isset($_POST['cod_captacao']) and 
									isset($_POST['lote_envio']) and 
									isset($_POST['data_inicio_de']) and 
									isset($_POST['data_inicio_ate']) and 
									isset($_POST['lote_retorno']) and 
									isset($_POST['valor_moeda_de']) and 
									isset($_POST['valor_moeda_ate']) and 
									isset($_POST['cod_pessoa']) and 
									isset($_POST['cod_carteira']) 
							){
								$captacoes=new tabelas; $captacoes->listar_extrato_carteira(
									$_POST['cod_carta'],
									$_POST['cod_captacao'],
									$_POST['lote_envio'],
									$_POST['data_inicio_de'],
									$_POST['data_inicio_ate'],
									$_POST['lote_retorno'],
									$_POST['valor_moeda_de'],
									$_POST['valor_moeda_ate'],
									$_POST['cod_pessoa'],
									$_POST['cod_carteira']

								);
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
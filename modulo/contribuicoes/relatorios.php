<?php

	session_start();
	include "../../php/login.php";
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
	include "php/config.php";	
	include "../../igniteui.php";

?>

<?php include "php/relatorios.php";?>

<body>

<!-- sub-menú -->
			
<div style="margin: -40px 10px 10px;">	


	<div class="uk-grid uk-grid-divider" style="margin-top: 0px;">	
		<div class="uk-width-medium-1-1">	
			<div class="uk-grid uk-grid-divider">	
				<div class="uk-width-medium-1-4" style="min-height: 450px;">		
					<div class="tm-content">
				<?php
					$filtro=new filtros; 
					$filtro->relatorios();	
				?>
					
					</div>		
				</div>		
				<div class="uk-width-medium-3-4 tm-main" style="min-height: 100%;padding: 10px;">	
					<div>

						<div class="uk-button-group uk-navbar-flip">
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('xls','tm-content','html');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .xls"><i class="uk-icon-file-excel-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('doc','tm-content','html');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .doc"><i class="uk-icon-file-word-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="imprimir('tm-content');" data-uk-tooltip="{pos:'left'}" title="imprimir"><i class="uk-icon-print"></i></span>	
						</div>					
						<span id="arquivo_gerado"></span>

					</div>
					<div class="tm-content" id="tm-content" style="font-family: arial,verdana,calibri ! important;">
					
				<?php 
					if(isset($_POST)?$_POST:''){
						$relatorios=new relatorios;
						//var_dump($_POST);
						
						//listagem_cartas_por_colaborador
						if (
								$_POST['relatorio']=='listagem_cartas_por_colaborador' and ( 
								isset($_POST['cod_centro']) or 
								isset($_POST['cod_grupo']) or 
								isset($_POST['cod_colaborador']) or 
								isset($_POST['status_carta']) or 
								isset($_POST['tipo_convenio']) or 
								isset($_POST['cod_campanha']) or 
								isset($_POST['carta_aberta']))
							){
								$relatorios->$_POST['relatorio']($_POST['cod_centro'],$_POST['cod_grupo'],$_POST['cod_colaborador'],$_POST['status_carta'],$_POST['tipo_convenio'],$_POST['cod_campanha'],$_POST['carta_aberta']); 
						}
						
						//demonstrativo_anual_doacoes
						
						if (
								$_POST['relatorio']=='resumo_carta_doacao' and 
								isset($_POST['cod_carta']) and
								$_POST['cod_carta']!=""
								
								
								){
								$relatorios->$_POST['relatorio']($_POST['cod_carta']); 
						}
						if (
								$_POST['relatorio']=='resumo_campanha' ){
								$relatorios->$_POST['relatorio']($_POST['data_inicio_de'],$_POST['data_inicio_ate'],$_POST['cod_campanha']); 
						}

						if (
								$_POST['relatorio']=='comprovante_doacoes' and
								isset($_POST['cod_pessoa']) and
								$_POST['cod_pessoa']!="" and
								isset($_POST['data_inicio_de']) and
								$_POST['data_inicio_de']!="" and
								isset($_POST['data_inicio_ate']) and
								$_POST['data_inicio_ate']!=""
								
								){
								$relatorios->$_POST['relatorio']($_POST['cod_pessoa'],$_POST['data_inicio_de'],$_POST['data_inicio_ate']); 
						}
						if (
								$_POST['relatorio']=='captacoes_cod_status' ){
								$relatorios->$_POST['relatorio']($_POST['data_inicio_de'],$_POST['data_inicio_ate']); 
						}
						if (
								$_POST['relatorio']=='captacoes_carteira' ){
								$relatorios->$_POST['relatorio']($_POST['data_inicio_de'],$_POST['data_inicio_ate']); 
						}

						
					}

				
				
				?>

					
					</div>
				</div>	
			</div>
		</div>		
	</div>		
	</div>		
			
	
			
			
			
			
			
			

</body>

	<?php } ?>
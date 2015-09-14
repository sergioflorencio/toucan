<?php 
	session_start();
	include "../../php/login.php";
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
	
	include "php/config.php";	
	
?>



<body>

<!-- sub-menú -->
			
<div style="margin: 10px;">		
	<div class="uk-grid uk-grid-preserve"  id="submenu">
			<div class="uk-width-1-1">
					<div class="uk-button-group">
						<a href="#" class="uk-button uk-button-small" data-uk-modal="{target:'#filtro'}"><i class="uk-icon-filter"></i> Filtro</a>
						<a href="#" class="uk-button uk-button-small" data-uk-modal="{target:'#upload'}"><i class="uk-icon-file-code-o"></i> Gerar arquivo</a>
						<a href="#" class="uk-button uk-button-small" target="_blank"><i class="uk-icon-print"></i>  Imprimir</a>						
					</div>
			<hr class="uk-article-divider" style="margin: 10px -10px 0px -10px;">	
			</div>

	</div>

	
	<div id="filtro" class="uk-modal" style="">
		<div class="uk-modal-dialog">
		<a href="" class="uk-modal-close uk-close"></a>
			<?php
				 $filtro=new filtros; 
				$filtro->arquivo_envio();	
			?>

		</div>
	</div>
	<div id="upload" class="uk-modal" style="">
		<div class="uk-modal-dialog">
		<a href="" class="uk-modal-close uk-close"></a>
			<div class="uk-grid">
				<div class="uk-width-1-1" id="tb_extrato">
					<?php
						$filtro->gerar_arquivo_envio();	
					?>
				</div>
			</div>

		
		</div>
	</div>
	<div class="uk-grid">	
		<div class="uk-width-medium-1-1">	
			<div class="uk-grid">	
	
				<div class="uk-width-medium-1-1" style="min-height: 450px;">		
					<div class="tm-content">
						<div class="tm-main ">
						<?php
//						print_r($_POST);
							if(
									isset($_POST['data_inicio_de']) and 
									isset($_POST['data_inicio_ate']) and 
									isset($_POST['cod_banco']) and 
									isset($_POST['cod_convenio']) and 
									isset($_POST['cod_status']) and
									isset($_POST['lote'])

							){
								$conciliacao=new tabelas; $conciliacao->listar_arquivos_envio(
									$_POST['data_inicio_de'],
									$_POST['data_inicio_ate'],
									$_POST['cod_banco'],
									$_POST['cod_convenio'],
									$_POST['cod_status'],
									$_POST['lote']

								);
							}
							if(
								isset($_GET['lote']) and 
								$_GET['lote'] and 
								isset($_GET['banco']) and 
								$_GET['banco']
							){
								$arquivo_envio=new arquivo_envio_debito;
								$arquivo_envio->excluir($_GET['lote'],$_GET['banco']);
							}
							if(
									isset($_POST['data_fim_de']) and 
									isset($_POST['data_fim_ate']) and 
									isset($_POST['cod_convenio'])
							){
								$arquivo_envio=new arquivo_envio_debito;
								$arquivo_envio->gerar(
									$_POST['data_fim_de'],
									$_POST['data_fim_ate'],
									$_POST['cod_convenio']
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
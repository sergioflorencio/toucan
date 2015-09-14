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
						<a href="#" class="uk-button uk-button-small" data-uk-modal="{target:'#upload'}"><i class="uk-icon-cloud-upload"></i> Upload</a>
						<a href="#" class="uk-button uk-button-small" target="_blank"><i class="uk-icon-print"></i>  Imprimir</a>						
<?php
		if(isset($_GET['status_arquivo']) and $_GET['status_arquivo']=='NP'){
			echo "
			
				<a href='?id_arquivo=".$_GET['id_arquivo']."&status_arquivo=baixar' class='uk-button uk-button-small uk-button-danger' data-uk-tooltip={pos:'right'} title='Baixar todas as captações do arquivo'><i class='uk-icon-magic'></i> Baixar captações</a>
			";
		}else{
		
		}
?>					
					</div>
			<hr class="uk-article-divider" style="margin: 10px -10px 0px -10px;">	
			</div>
	</div>

	
	<div id="filtro" class="uk-modal" style="">
		<div class="uk-modal-dialog">
		<a href="" class="uk-modal-close uk-close"></a>
			<?php
				 $filtro=new filtros; 
				$filtro->arquivo_retorno();	
			?>
		</div>
	</div>
	<div id="upload" class="uk-modal" style="">
		<div class="uk-modal-dialog uk-modal-dialog-large">
		<a href="" class="uk-modal-close uk-close"></a>
			<div class="uk-grid " >
				<div class="uk-width-1-1" >
					<label class="uk-form-label">Selecione o arquivo:</label>
					<input type="file" name="arquivo_retorno" id="arquivo_retorno" onchange="enviar_arquivo_retorno();"><br>
				</div>
				<div class="uk-width-1-1" id="tb_extrato">

				</div>
			</div>

		
		</div>
	</div>
	<div class="uk-grid">	
		<div class=" uk-width-medium-1-1">	
			<div class="uk-grid">	
	
				<div class="uk-width-medium-1-1" style="min-height: 450px;">		
					<div class="tm-content">
						<div class="tm-main">
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
								$conciliacao=new tabelas; $conciliacao->listar_arquivos_retorno(
									$_POST['data_inicio_de'],
									$_POST['data_inicio_ate'],
									$_POST['cod_banco'],
									$_POST['cod_convenio'],
									$_POST['cod_status'],
									$_POST['lote']

								);
							}
							
							if(isset($_GET['id_arquivo']) and $_GET['id_arquivo']!='' and isset($_GET['status_arquivo']) and $_GET['status_arquivo']!=''){
								$arquivo_retorno=new arquivo_retorno;
								$id_arquivo=$_GET['id_arquivo'];
								$status_arquivo=$_GET['status_arquivo'];
								if($_GET['status_arquivo']=='baixar'){$baixar='sim';}else{$baixar='nao';}
								$arquivo_retorno->processar("arquivos_bancarios/retorno/",$id_arquivo,$status_arquivo,$baixar);
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
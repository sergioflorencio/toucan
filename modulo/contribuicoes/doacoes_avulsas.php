<?php 

	session_start();
	include "../../php/login.php";
	$login=new login;
	$login->checklogin();
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){

	include "php/config.php";		
	
	$filtro=new filtros; 
	$campos_select=new selects; 
	$campos_inputs=new inputs;
	$tabelas=new tabelas;
	$cadastros=new cadastros;
	
	
	$salvar=new salvar;
	$salvar->doacoes_avulsas();

?>
<body>
	<div style="margin: 10px;">	
		<div class="uk-grid uk-grid-preserve"  id="submenu">
				<div class="uk-width-1-1">
						<div class="uk-button-group">
							<a href="?id=novo" class="uk-button uk-button-success uk-button-small"><i class="uk-icon-star"></i>  Novo</a>

						</div>
						<div class="uk-button-group">
							<button type="button" id="bt_importar_csv" style="padding-top: 7px; padding-bottom: 7px;" onclick="getFile_importar_csv();" class="uk-button uk-button-small uk-button-primary" data-uk-tooltip="{pos:'left'}" title="Importar arquivo .csv"><i class="uk-icon-cloud-upload"></i></button>						
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('xls','tm-content','html');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .xls"><i class="uk-icon-file-excel-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('doc','tm-content','html');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .doc"><i class="uk-icon-file-word-o"></i></span>
							<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="imprimir('tm-content');" data-uk-tooltip="{pos:'left'}" title="imprimir"><i class="uk-icon-print"></i></span>	
							<?php if(isset($_GET['id'])!=false and $_GET['id']=='novo'){?>
								<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="salvar_carta_avulsa();" data-uk-tooltip="{pos:'left'}" title="salvar"><i class="uk-icon-save"></i></span>						
							<?php }?>
						</div>
						<span  id="arquivo_gerado"></span>
						<div class='uk-button-group' style="right: 10px;position: absolute;">
				

						</div>
				<hr class="uk-article-divider" style="margin: 10px -10px 0px -10px;">	
				</div>

		</div>
		<div class="uk-grid" style="margin-top: 0px;" >	
			<div class="uk-width-medium-1-1">	
				<div class="uk-grid">	
					<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4" style="min-height: 1px; border-right: 1px solid rgb(204, 204, 204); ">		
						<?php 
							if(isset($_GET['id'])==false){
								$filtro->doacoes_avulsas();	
							}else{

							}
						?>
					</div>		
					<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-2-3 uk-width-large-3-4 " style="min-height: 100%; padding-left: 0px; border-left: 1px solid rgb(204, 204, 204);" id="tm-content">			
						<div>
							<input type="file" id="input_arquivo_csv" onchange="importar_csv();" hidden>
							 <script src="php/autocomplete.php?tb=colaboradores"></script>
							 <script src="php/autocomplete.php?tb=ctrreceitas"></script>

						</div>
						<div id="div_arquivo_csv" style="padding-top: 25px;">
						
						<?php
							if(isset($_GET['id'])==true){
								$cadastros->cad_cartas_avulsa($_GET['id']);								
							}
							if(
								isset($_POST['cod_campanha']) and 
								isset($_POST['cod_carta']) and 
								isset($_POST['cod_centro']) and 
								isset($_POST['cod_colaborador']) and 
								isset($_POST['cod_ctrreceita']) and 
								isset($_POST['cod_grupo']) and 
								isset($_POST['cod_pessoa']) and 
								isset($_POST['data_inicio_ate']) and 
								isset($_POST['data_inicio_de']) and 
								isset($_POST['status_carta']) and 
								isset($_POST['valor_moeda_ate']) and 
								isset($_POST['valor_moeda_de'])
							){

								$tabelas->listar_cartas_avulsa();
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



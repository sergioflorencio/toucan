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
						<a href="#" class="uk-button uk-button-small" data-uk-modal="{target:'#extrato'}"><i class="uk-icon-th-list"></i> Extrato</a>
					</div>
					<div class="uk-button-group">
						<a href="#" onclick="marcar_checkbox('m');calcular_conciliacao();" class="uk-button uk-button-small" data-uk-tooltip="{pos:'left'}" title="Marcar" style="padding-top: 7px; padding-bottom: 7px;"><i class="uk-icon-check-square-o"></i></a>
						<a href="#" onclick="marcar_checkbox('d');calcular_conciliacao();" class="uk-button uk-button-small" data-uk-tooltip="{pos:'left'}" title="Desmarcar" style="padding-top: 7px; padding-bottom: 7px;"><i class="uk-icon-square-o"></i></a>
					</div>	
					<div class="uk-button-group">	
						<a href="#" onclick="salvar_conciliacao();" class="uk-button uk-button-small"><i class="uk-icon-save"></i> Salvar</a>
					</div>
					<div class="uk-button-group uk-navbar-flip">
						<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('xls','tm-content','html');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .xls"><i class="uk-icon-file-excel-o"></i></span>
						<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('doc','tm-content','html');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .doc"><i class="uk-icon-file-word-o"></i></span>
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
				$filtro->conciliacao();	
			?>
		</div>
	</div>
	<div id="extrato" class="uk-modal" style="">
		<div class="uk-modal-dialog">
		<a href="" class="uk-modal-close uk-close"></a>
			<div class="uk-grid">
				<div class="uk-width-1-1">
					<label class="uk-form-label">Selecione o arquivio:</label>
					<input type="file" name="arquivo_conciliacao" id="arquivo_conciliacao" onchange="enviar_arquivo_conciliacao();"><br>
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
					<div id="tm-content">
						<div class="">
						<?php
//						print_r($_POST);
							if(
									isset($_POST['data_inicio_de']) and 
									isset($_POST['data_inicio_ate']) and 
									isset($_POST['valor_moeda_de']) and 
									isset($_POST['valor_moeda_ate']) and 
									isset($_POST['cod_carteira']) and
									isset($_POST['cod_conciliacao']) and 
									isset($_POST['conciliado']) 

							){
								$conciliacao=new tabelas; $conciliacao->listar_conciliacao(
									$_POST['data_inicio_de'],
									$_POST['data_inicio_ate'],
									$_POST['valor_moeda_de'],
									$_POST['valor_moeda_ate'],
									$_POST['cod_carteira'],
									$_POST['cod_conciliacao'],
									$_POST['conciliado']

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


<script>

$('#tb_sistema tr, #tb_arquivo tr').click(function(){
	
	
	if(this.className=="uk-alert-danger"){
		document.getElementById(this.id).className="";
		this.getElementsByTagName("input")[0].checked=false;
	}else{
		if(this.className=="uk-alert-warning"){
			document.getElementById(this.id).className="uk-alert-danger";
			this.getElementsByTagName("input")[0].checked=true;
		}else{
			if(this.className=="uk-alert-success"){
				document.getElementById(this.id).className="uk-alert-warning";
				this.getElementsByTagName("input")[0].checked=true;
			}else{
				if(this.className==""){
					document.getElementById(this.id).className="uk-alert-success";
					this.getElementsByTagName("input")[0].checked=true;
				}
			
			}
		}
	
	}
	calcular_conciliacao();







});
</script>


	<?php } ?>
<?php 

	session_start();
	include "../../php/login.php";
	$login=new login;
	$login->checklogin();
	
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		
		$salvar=new salvar;
		$salvar->cad_pessoas();




?>
<!-- sub-menú -->
<div class="uk-grid" style="padding-left: 10px;">
		<script src="php/autocomplete.php?tb=pessoas"></script>
		<div class="uk-width-1-1 uk-autocomplete uk-form" data-uk-autocomplete="{source:filtro_pessoas}">
			<form  action="#" method="get">
					<input style="width: 100%;max-width: 300px;min-width: 100px;" type="text" id="pesquisa" name="pesquisa" class="uk-form-small" placeholder="Pesquisar">

				<div class="uk-button-group">
					<button class="uk-button uk-button-small uk-button-primary">Pesquisar  <i class="uk-icon-search"></i></button>
					<a href="?id=novo" class="uk-button uk-button-small"><i class="uk-icon-star"></i>  Novo</a>
					<a href="#" class="uk-button uk-button-small" data-uk-modal="{target:'#correio'}"><i class="uk-icon-globe"></i> Correiros</a>
				</div>
				<div class="uk-button-group uk-navbar-flip">
					<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('xls','tm-content','html');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .xls"><i class="uk-icon-file-excel-o"></i></span>
					<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="exportar('doc','tm-content','html');" data-uk-tooltip="{pos:'left'}" title="exportar arquivo .doc"><i class="uk-icon-file-word-o"></i></span>
					<span class="uk-button uk-button-small" style="padding-top: 7px; padding-bottom: 7px;" onclick="imprimir('tm-content');" data-uk-tooltip="{pos:'left'}" title="imprimir"><i class="uk-icon-print"></i></span>	
				</div>
				<span id="arquivo_gerado"></span>
			</form>
		</div>
		<div class="uk-width-1-1 uk-overflow-container " id="tm-content">
		<?php 
			if(isset($_GET['pesquisa'])){
				$tabelas=new tabelas;$tabelas->listar_pessoas($_GET['pesquisa']);
			} 

			if(isset($_GET['id'])){
				
				if($_GET['id']=="novo"){$cod_pessoa="";}else{$cod_pessoa=$_GET['id'];}
				
				$cadastros=new cadastros;
				$cadastros->cad_pessoas($cod_pessoa);
			}
		?>
	</div>		
</div>

<div id="correio" class="uk-modal">
	<div class="uk-modal-dialog">
		<a class="uk-modal-close uk-close"></a>
		<div class='uk-width-3-4'>
			<label class='uk-form-label' for='Endereco'>Pesquisa</label>
			<input class="uk-form-small" type='text' name='txt_pesquisa_cep'  id='txt_pesquisa_cep' style='width: 100%;' value=''><br><br>
			<button class="uk-button uk-button-small uk-button-primary" onclick="pesquisacep();">Pesquisar  <i class="uk-icon-search"></i></button>
		
		</div>											
		<div id="pesquisa_cep"></div>
	</div>
</div>




	<?php } ?>
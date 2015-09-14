<?php 

	session_start();
	include "../../php/login.php";
	$login=new login;
	$login->checklogin();
	
	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		
		$salvar=new salvar;
		$salvar->cad_moedas();




?>
<body>
	<div class="uk-grid" style="padding-left: 10px;">
		<div class="uk-width-1-1">
			<form  action="#" method="get">
					<input style="width: 100%;max-width: 300px;min-width: 100px;" type="text" id="pesquisa" name="pesquisa" class="uk-form-small" placeholder="Pesquisar">

				<div class="uk-button-group">
					<button class="uk-button uk-button-small uk-button-primary">Pesquisar  <i class="uk-icon-search"></i></button>
					<a href="?id=novo" class="uk-button uk-button-small"><i class="uk-icon-star"></i>  Novo</a>
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
				$tabelas=new tabelas;$tabelas->listar_moedas($_GET['pesquisa']);
			} 

			if(isset($_GET['id'])){
				
				if($_GET['id']=="novo"){$cod_moeda="";}else{$cod_moeda=$_GET['id'];}
				
				$cadastros=new cadastros;
				$cadastros->cad_moedas($cod_moeda);
			}
		?>
		</div>		
	</div>
</body>

	<?php } ?>
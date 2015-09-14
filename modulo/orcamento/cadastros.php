<?php
	session_start();
	
	include "php/php.php";
	include "../dependencias.php";
	include "../php/nav_bar.php";

	$navbar=new navbar;
	$navbar->navbar_modulo('orcamento');
?>


<div class="uk-grid uk-grid-divider" data-uk-grid-match>
    <div class="uk-width-small-1-1 uk-width-medium-1-4 uk-width-large-1-5">
		<ul class="uk-list uk-list-line">
			<?php
				if(isset($_GET['tabela'])){
					$schema_cadastros= new schema_cadastros;
					$schema_cadastros->cadastro($_GET['tabela']);

				}
			?>
		</ul>
	
	</div>
    <div class="uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-4-5">
	<table id="grid"></table>
	<script>
		<?php
		if(isset($_GET['schema']) and isset($_GET['tabela']) ){
			$tabelas=new cadastro;
			$tabelas->$_GET['tabela']($_GET['schema']);
			
		}
	?>


	 $("#grid").igTreeGrid({
					width: "100%",
					dataSource: db_grid, //bound to flat data source,
					autoGenerateColumns: false,
					primaryKey: "numero",
					columns: [
						{ headerText: "Nome", key: "nome",  dataType: "string" },
						{ headerText: "Número", key: "numero",width: "100px",dataType: "string" },
						{ headerText: "id", key: "id", width: "100px", dataType: "number" }	,				
						{ headerText: "ID grid", key: "id_grid", width: "1px", dataType: "number" }					
				

					],
					// tree grid specific options
					key: "id_grid",
					foreignKey: "id_grid_pai",
					dataSourceLayoutKey: "id_grid_pai",
					hierarchicalDataSource: false,

					features: [
					{
						name: "Hiding"
					},
					{
						name: "Sorting"
					},
					{
						name: "Filtering"
					}]

					
					
				});	
	</script>
	
	
	</div>

</div>



<?php
	include "footer.php";


?>
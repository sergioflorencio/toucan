<?php
	session_start();
	
	include "php/php.php";
	include "../dependencias.php";
	include "../php/nav_bar.php";

	$navbar=new navbar;
	$navbar->navbar_modulo('orcamento');


	//Filtro
	if(isset($_POST['id_orcamento'])){
			$id_orcamento=$_POST['id_orcamento'];
		}else{
			$id_orcamento='';
		}
	if(isset($_POST['schema_real'])){
			$schema_real=$_POST['schema_real'];
		}else{
			$schema_real='';
		}
	$filtros= new filtros;
	$filtros->filtro_orcado_real_conta($id_orcamento,$schema_real);
	
	
	//relatório
	if(isset($_POST['id_orcamento']) and isset($_POST['schema_real'])){
		if(isset($_POST['ctrcusto']) and $_POST['ctrcusto']!=""){
			$ctrcusto=$_POST['ctrcusto'];
		}else{
			$ctrcusto="";
		}
		$tabelas=new tabelas;
		echo "<script>";
			$tabelas->orcamento_orcado_real_conta($_POST['schema_real'],$_POST['id_orcamento'],$ctrcusto);
		echo "</script>";

	}
	
	
?>

	<hr class="uk-article-divider">	
	
	<div style="position: absolute; background: none repeat scroll 0% 0% rgb(204, 204, 204); top: 170px;  left: 15px; right: 15px;">
		<table id="grid" > </table> 
	</div>
	
	<script type='text/autocomplete'>
		<ul class='uk-nav uk-nav-autocomplete uk-autocomplete-results'>
		{{~items}}
		<li data-value='{{{ $item.text }}}'>
		<a>
		<div>{{{ $item.value }}}</div>
		</a>
		</li>
		{{/items}}
		</ul>
	</script>
	
	
    <script>
	
	function igrid_(){
		$("#grid").igTreeGrid({
                dataSource: base, 
                autoGenerateColumns: false,
                primaryKey: "id_grid",
                columns: [
                    { headerText: "Nome Conta", key: "nome_conta",width: "350px",  dataType: "string" },
					{ headerText: "ID conta", key: "id_grid", width: "1px", dataType: "number" },
					{
						headerText: "Janeiro",
						group: [
						{ headerText: "Real", key: "mes_01_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_01_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
								{ headerText: "R$", key: "mes_01_V", width: "50px", dataType: "number",format: "###" },
								{ headerText: "", key: "mes_01_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Fevereiro",
						group: [
						{ headerText: "Real", key: "mes_02_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_02_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_02_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_02_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Março",
						group: [
						{ headerText: "Real", key: "mes_03_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_03_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_03_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_03_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Abril",
						group: [
						{ headerText: "Real", key: "mes_04_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_04_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_04_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_04_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Maio",
						group: [
						{ headerText: "Real", key: "mes_05_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_05_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_05_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_05_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Junho",
						group: [
						{ headerText: "Real", key: "mes_06_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_06_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_06_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_06_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Julho",
						group: [
						{ headerText: "Real", key: "mes_07_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_07_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_07_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_07_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Agosto",
						group: [
						{ headerText: "Real", key: "mes_08_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_08_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_08_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_08_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Setembro",
						group: [
						{ headerText: "Real", key: "mes_09_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_09_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_09_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_09_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Outubro",
						group: [
						{ headerText: "Real", key: "mes_10_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_10_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_10_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_10_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Novembro",
						group: [
						{ headerText: "Real", key: "mes_11_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_11_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_11_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_11_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Dezembro",
						group: [
						{ headerText: "Real", key: "mes_12_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "mes_12_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "mes_12_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "mes_12_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					},					
					{
						headerText: "Total",
						group: [
						{ headerText: "Real", key: "total_R", width: "50px", dataType: "number",format: "###" },						
						{ headerText: "Orçado", key: "total_O", width: "50px", dataType: "number",format: "###" },
						{
							headerText: "Variação",
							group: [
						{ headerText: "R$", key: "total_V", width: "50px", dataType: "number",format: "###" },
						{ headerText: "", key: "ttal_sinalizador", width: "30px", dataType: "string", formatter:makeFlagFormatter}
								]
						}
						]
					}

                ],
                // tree grid specific options
                key: "id_grid",
                foreignKey: "id_grid_pai",
                dataSourceLayoutKey: "id_grid_pai",
                hierarchicalDataSource: false,
                initialExpandDepth: 3,
                features: [
					{
						name: 'MultiColumnHeaders'
					},
					{
						name: 'Resizing'
					},			
					{
						name: 'Selection',
						mode: 'row',
						multipleSelection: true
					}				
				]

				
				
            });	
        
		function makeFlagFormatter(val) {
            if (val === "up")
                return "<i class='uk-icon-arrow-up uk-badge uk-badge-success'></i>";
            return "<i class='uk-icon-arrow-down uk-badge uk-badge-danger'></i>";
        }
	
	}
	
	if(window.attachEvent) {
		window.attachEvent('onload', igrid_);
	} else {
		if(window.onload) {
			var curronload = window.onload;
			var newonload = function() {
				curronload();
				igrid_();
			};
			window.onload = newonload;
		} else {
			window.onload = igrid_;
		}
	}
	
	
	

			

		
    </script>
		
		
		




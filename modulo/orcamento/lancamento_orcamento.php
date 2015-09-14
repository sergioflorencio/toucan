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

	$filtros= new filtros;
	$filtros->filtro_lancamento_orcamento($id_orcamento);

	//relatório
	if(
		isset($_POST['id_orcamento']) and
		isset($_POST['data_inicio']) and
		isset($_POST['data_fim']) and
		isset($_POST['idconta']) and
		isset($_POST['idcaixa']) and
		isset($_POST['ctrcusto'])
	){
		$tabelas= new tabelas;

		$data_inicio = DateTime::createFromFormat('d/m/Y', $_POST['data_inicio']);
		$data_inicio= $data_inicio->format('Y-m-d'); 
		
		$data_fim = DateTime::createFromFormat('d/m/Y', $_POST['data_fim']);
		$data_fim= $data_fim->format('Y-m-d'); 

		echo "<script>";
		$tabelas->listar_lancamentos($_POST['id_orcamento'],$data_inicio,$data_fim,$_POST['idconta'],$_POST['ctrcusto'],$_POST['idcaixa']);
		echo "</script>";
	}	
	
	?>

<hr class="uk-article-divider">	

	<div style="position: absolute; top: 170px; left: 5px; right: 5px;">
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
	

    <script type="text/javascript">
	$("#bt_salvar_lancamentos").click(function(){ 
		salvar_cadastro("tb_orcamento_lancamentos");
	});
        $( function ()
        {

		
            /*----------------- Instantiation -------------------------*/
            $( "#grid" ).igGrid( {
                virtualization: false,
                autoGenerateColumns: false,
                renderCheckboxes: true,
                primaryKey: "id_tb_orcamento_lancamentos",
                columns: [
					{
						headerText: "ID", key: "id_tb_orcamento_lancamentos", width: "50px", dataType: "string"
					},
					{
						headerText: "Centro de custos",
						group: [
								{
									headerText: "numero", key: "numero_centro_custo", width: "75px", dataType: "string"
								},
								{
									headerText: "descrição", key: "centro_custo", width: "175px", dataType: "string"
								}
							]
					},
					{
						headerText: "Conta",
						group: [
								{
									headerText: "numero", key: "numero_conta", width: "75px", dataType: "string"
								},
								{
									headerText: "descrição", key: "conta", width: "175px", dataType: "string"
								}
							]
					},
					{
						headerText: "Editar",
						group: [
									{
										headerText: "Data", key: "data", width: "75px", dataType: "date", format:"MMM/yyyy"
									},
									{
										headerText: "Valor", key: "valor", width: "100px", dataType: "number"
									},
									{
										headerText: "Caixa", key: "idcaixa", width: "100px", dataType: "number"
									},
									{
										headerText: "Descrição do gasto", width: "150px", key: "descricao", dataType: "string"
									}

							]
					},



                ],
                dataSource: base,
                dataSourceType: "json",
                responseDataKey: "results",
                width: "100%",
                tabIndex: 1,
                features: [
                    {
                        name: "Selection",
                        mode: "row"
                    },
					{
						name: 'MultiColumnHeaders'
					},
					{
						name: "Hiding"
					},
                    {
                        name: 'Paging',
                        type: "local",
                        pageSize: 15
                    },					
                    {
                        name: "Filtering",
                        type: "local"

                    },		
                    {
                        name: "Summaries",
						calculateRenderMode: "onselect",
						compactRenderingMode: true,
						defaultDecimalDisplay: 2,
						columnSettings: [
							{ columnKey: "id_tb_orcamento_lancamentos", allowSummaries: false  },
							{ columnKey: "numero_centro_custo", allowSummaries: false  },
							{ columnKey: "centro_custo", allowSummaries: false  },
							{ columnKey: "numero_conta", allowSummaries: false  },
							{ columnKey: "conta", allowSummaries: false  },
							{ columnKey: "data", allowSummaries: false  },
							{ columnKey: "descricao", allowSummaries: false  },
							{ columnKey: "valor", allowSummaries: true  }
						]						
						
                    },					
                    {
                        name: "Updating",
                        enableAddRow: false,
                        editMode: "row",
                        enableDeleteRow: false,
                        rowEditDialogContainment: "owner",
                        showReadonlyEditors: false,
                        enableDataDirtyException: false,
                        columnSettings: [
                        {
                            columnKey: "id_tb_orcamento_lancamentos",
                            readOnly: true
                        },
                        {
                            columnKey: "numero_centro_custo",
                            readOnly: true
                        },
                        {
                            columnKey: "centro_custo",
                            readOnly: true
                        },
                        {
                            columnKey: "numero_conta",
                            readOnly: true
                        },
                        {
                            columnKey: "conta",
                            readOnly: true
                        },

                        {
                            columnKey: "data",
                            editorType: "datepicker"
                        },
                       {
                            columnKey: "descricao",
                            editorType: "text"
                        },
                       {
                            columnKey: "valor",
                            editorType: "number"
                        }]
                    }


					
                    

                ]
            } );

        } );

    </script>	
<?php
	session_start();
	
	include "php/php.php";
	include "../dependencias.php";
	include "../php/nav_bar.php";

	$navbar=new navbar;
	$navbar->navbar_modulo('orcamento');
?>
	<?php $selects= new selects; ?>

<div class="uk-grid" style="padding: 10px">
	<div class="uk-width-1-1">
		<h3>Cadastro de Orçamentos</h3>
		<hr class="uk-article-divider">	
	</div>

	<div class="uk-width-1-1" id="principal">
		<div style="left: 10px;right: 10px;top: 200px;bottom: 10px;padding: 10px;margin: 10px;" >
			<table id="grid">
			</table>
		</div>
	</div>
	<div class="uk-width-1-1"style="">
		<hr class="uk-article-divider">	
		<button class="uk-button uk-button-success" type="button" style="margin: 0px 30px;" id="bt_salvar_cadastro_orcamento">Salvar</button>
	</div>	


</div>





    <script type="text/javascript">

<?php
	$tabelas= new tabelas;
	$tabelas->lista_orcamentos();
	$tabelas->listar_schemas_orcamento_json();

?>

	$("#bt_salvar_cadastro_orcamento").click(function(){ 
		salvar_cadastro("tb_orcamento");
	});
        $( function ()
        {

		
            /*----------------- Instantiation -------------------------*/
            $( "#grid" ).igGrid( {
                virtualization: false,
                autoGenerateColumns: false,
                renderCheckboxes: true,
                primaryKey: "id_orcamento",
                columns: [
					{
						headerText: "ID", key: "id_orcamento", width: "50px", dataType: "string"
					},
					{
						headerText: "Plano de contas", key: "schema_plano_de_contas", width: "250px", dataType: "string"
					},
					{
						headerText: "Inicio", key: "data_inicio", width: "100px", dataType: "date", format:"d/M/yyyy"
					},
					{
						headerText: "Fim", key: "data_fim", width: "100px", dataType: "date", format:"d/M/yyyy"
					},
					{
						headerText: "Descrição", key: "descricao", width: "350px", dataType: "string"
					}					


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
                        name: "Filtering",
                        type: "local"

                    },		
                    {
                        name: "Updating",
                        enableAddRow: true,
                        editMode: "row",
                        enableDeleteRow: false,
                        rowEditDialogContainment: "owner",
                        showReadonlyEditors: false,
                        enableDataDirtyException: false,
						horizontalMoveOnEnter: true,
						excelNavigationMode: true,
                        columnSettings: [
                        {
                            columnKey: "id_orcamento",
                            readOnly: true
                        },
                        {
                            columnKey: "descricao",
                            editorType: "text"
                        },
                        {
                            columnKey: "data_inicio",
                            editorType: "datepicker"
                        },
                        {
                            columnKey: "data_fim",
                            editorType: "datepicker"
                        },
                       {
                            columnKey: "schema_plano_de_contas",
							editorType: "text",
							editorOptions: {
									button: "dropdown",
									listItems: schemas,
									readOnly: true,
									dropDownOnReadOnly: true
								}
                        }
						]
                    }


					
                    

                ]
            } );

        } );

    </script>	


<!DOCTYPE html>
<html>
<head>
    <title></title>

    <!-- Ignite UI Required Combined CSS Files -->
    <link href="js/igniteui.14.1.20141.2031.custom/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
    <link href="js/igniteui.14.1.20141.2031.custom/css/structure/infragistics.css" rel="stylesheet" />

    <!-- Used to style the API Viewer and Explorer UI -->

    <script src="js/igniteui.14.1.20141.2031.custom/modernizr-latest.js"></script>
    <script src="js/igniteui.14.1.20141.2031.custom/jquery-1.9.1.min.js"></script>
    <script src="js/igniteui.14.1.20141.2031.custom/jquery-ui.min.js"></script>

    <!-- Ignite UI Required Combined JavaScript Files -->
    <script src="js/igniteui.14.1.20141.2031.custom/infragistics.core.js"></script>
    <script src="js/igniteui.14.1.20141.2031.custom/infragistics.lob.js"></script>

    <!-- Used to add markup and provide logging 
        functionality for the API Explorer and API Viewer UI -->
	<script src="http://127.0.0.1/orcamento/base.php?bs=orcamento_lancamentos&cta=7&ctrc=69&orc=0&dti='2014-01-01'&dtf='2014-11-30'"></script>
	
	
	
    <style>
        fieldset.explorer
        {
            float: left;
            width: 45%;
        }
        #sampleContainer fieldset input[type="checkbox"] + label
        {
            display: inline;
        }
        .addNewRow
        {
            width: 100%;
            list-style-type: none;
        }
        .addNewRow li
        {
            display: inline-block;
            float: left;
            margin-right: 1em;
            height: 60px;
        }
        .ui-igedit
        {
            margin: 2px 0px 2px 0px;
        }
    </style>
</head>
<body>

    <!--Sample JSON Data-->


    <!-- Target element for the igGrid -->
	<form action="#" method="post">
	<table id="grid">
    </table>
	<button type="submit"> enviar </button>
	<input type="button" onclick="json_table();" value="alerta">
	</form>
<?php print_r($_POST) ?>


    <script type="text/javascript">
        $(function () {

            // Used to show output in the API Viewer at runtime,
            // defined in external script "apiviewer.js"


            var titles = ["Sales Representative", "Sales Manager", "Inside Sales Coordinator", "Vice President, Sales"];
            var countries = ["UK", "USA"];

            /*----------------- Method & Option Examples -------------------------*/
			
			
			
			
			
			

  
            /*----------------- Instantiation -------------------------*/
            $("#grid").igGrid({
                virtualization: true,
                autoGenerateColumns: true,
                renderCheckboxes: true,
                primaryKey: "id_tb_orcamento_lancamentos",
                columns: [{
                    // note: if primaryKey is set and data in primary column contains numbers,
                    // then the dataType: "number" is required, otherwise, dataSource may misbehave
                    headerText: "id_tb_orcamento_lancamentos", key: "id_tb_orcamento_lancamentos", dataType: "number"
                },
				{
					headerText: "tipo_movimento", key: "tipo_movimento", dataType: "string"
                },
				{
                    headerText: "idconta", key: "idconta", dataType: "integer"
                }, 
				{
                    headerText: "idctrcusto", key: "idctrcusto", dataType: "integer"
                }, 
				{
                    headerText: "data", key: "data", dataType: "date", format:"MMM-yyyy"
                }, 
				{
                    headerText: "valor", key: "valor", dataType: "integer"
                }, 
				{
                    headerText: "descricao", key: "descricao", dataType: "text"
                }
                ],
                dataSource: bs_orcamento_lancamentos,
                dataSourceType: "json",
                responseDataKey: "results_",
                height: "350px",
                width:"100%",
                features: [
                    {
                        name: "Responsive",
                        enableVerticalRendering: true,
                        columnSettings: [
                            {
                                columnKey: "id_tb_orcamento_lancamentos",
                                classes: "ui-hidden-phone"
                            },
                            {
                                columnKey: "valor",
                                classes: "ui-hidden-phone"
                            }
                        ]
                    },
                    {
                        name: "Selection",
                        mode: "row"
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
							columnKey: "tipo_movimento", 
							readOnly: true
						},
						{
							columnKey: "idconta", 
							readOnly: true
						}, 
						{
							columnKey: "idctrcusto", 
							readOnly: true
						}, 						
                        {
                            columnKey: "valor",
                            editorType: "text"
                        },
						{
                            columnKey: "data",
                            editorType: "datepicker"
                        }
						]
                    }]
            });


        });
    
	function json_table(){
	
	// db_json="";
	
	//grid_headers
//	var headers=document.getElementsByClassName("ui-iggrid-headertext");
		//for(i=0;i<headers.length;i++){
		//	alert(headers[i].innerHTML);
		//}
		

		
	//.innerHTML
	
	//grid
//	var grid=document.getElementById("grid");
//		grid=grid.getElementsByClassName("ui-iggrid-virtualrow");
//		alert(grid.length);
		
		
//		for(i=0;i<=grid.length-1;i++){
//			line=grid[i].getElementsByTagName("td");
//				db_json="{";
//			for(i=0;i<=line.length-1;i++){
//				db_json+= "'"+headers[i].innerHTML+"':'"+line[i].innerHTML+"'";
				
//			}
//				db_json+="},";
//			console.log(db_json);
			
//		}
//			var count = $("#grid").igGrid("totalRecordsCount"); 
			$("#grid").igGrid("commit");
			console.log(JSON.stringify($("#grid").data("igGrid").dataSource.data()));	
		


	
	//grid_footers

	
	}
	
	
	</script>
</body>


</html>


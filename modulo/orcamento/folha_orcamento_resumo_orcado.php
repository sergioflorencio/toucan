

<!DOCTYPE html>
<html>
<head>
    <title></title>

    <!-- Ignite UI Required Combined CSS Files -->
    <link href="js/igniteui.14.1.20141.2031.custom/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
    <link href="js/igniteui.14.1.20141.2031.custom/css/structure/infragistics.css" rel="stylesheet" />
    <link href="js/igniteui.14.1.20141.2031.custom/css/structure/modules/infragistics.ui.treegrid.css" rel="stylesheet" />

    <!-- Used to style the API Viewer and Explorer UI -->

    <script src="js/igniteui.14.1.20141.2031.custom/modernizr-latest.js"></script>
    <script src="js/igniteui.14.1.20141.2031.custom/jquery-1.9.1.min.js"></script>
    <script src="js/igniteui.14.1.20141.2031.custom/jquery-ui.min.js"></script>

    <!-- Ignite UI Required Combined JavaScript Files -->
    <script src="js/igniteui.14.1.20141.2031.custom/infragistics.core.js"></script>
    <script src="js/igniteui.14.1.20141.2031.custom/infragistics.lob.js"></script>
    <script src="js/igniteui.14.1.20141.2031.custom/infragistics.ui.treegrid.js"></script>

    <!-- Used to add markup and provide logging
        functionality for the API Explorer and API Viewer UI -->
	<script src="http://127.0.0.1/orcamento/php/base_lancamentos.php?bs=orcamento_lancamentos"></script>
	
	
	
    <style>
   
    </style>
</head>
<body>

    <!--Sample JSON Data-->


    <!-- Target element for the igGrid -->
	<form action="#" method="post">
	<table id="grid">
    </table>
	<table id="treegrid1">
    </table>
	<button type="submit"> enviar </button>
	<input type="button" onclick="json_table();" value="alerta">
	</form>
<?php print_r($_POST) ?>


    <script>

			
			
	
			
        $(function () {



            $("#grid").igTreeGrid({
                width: "100%",
                dataSource: base, //bound to flat data source,
                autoGenerateColumns: false,
                primaryKey: "id",
                columns: [
                    { headerText: "ID conta", key: "id", width: "200px", dataType: "number" },
					{ headerText: "ID conta", key: "id_grid", width: "1px", dataType: "number" },
					{ headerText: "ID conta", key: "numero", width: "100px", dataType: "string" },
                    { headerText: "Nome Conta", key: "nome_conta",  dataType: "string" },
                     { headerText: "mes_1", key: "mes_01", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_2", key: "mes_02", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_3", key: "mes_03", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_4", key: "mes_04", width: "60px", dataType: "number",format: "###"  },
                     { headerText: "mes_5", key: "mes_05", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_6", key: "mes_06", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_7", key: "mes_07", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_8", key: "mes_08", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_9", key: "mes_09", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_10", key: "mes_10", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_11", key: "mes_11", width: "60px", dataType: "number",format: "###" },
                     { headerText: "mes_12", key: "mes_12", width: "60px", dataType: "number",format: "###" },
                     { headerText: "Total", key: "total", width: "60px", dataType: "number",format: "###" }
                ],
                // tree grid specific options
                key: "id_grid",
                foreignKey: "id_grid_pai",
                dataSourceLayoutKey: "id_pai",
                hierarchicalDataSource: false,
                initialExpandDepth: 4,
                features: [
                {
                    name: "Hiding"
                },
                {
                    name: "Sorting"
                },
                {
                    name: "Filtering"
                },
                {
                    name: "Paging",
                    pageSize: 4
                }]

				
				
            });



            });	
			
			
			
			
			
			
			
    </script>
	
</body>


</html>


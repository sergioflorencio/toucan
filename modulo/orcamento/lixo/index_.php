<!DOCTYPE html>
<html>
<head>
    <title></title>

    <!-- Ignite UI Required Combined CSS Files -->
    <link href="http://cdn-na.infragistics.com/igniteui/2014.2/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
    <link href="http://cdn-na.infragistics.com/igniteui/2014.2/latest/css/structure/infragistics.css" rel="stylesheet" />

    <script src="http://modernizr.com/downloads/modernizr-latest.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>

    <!-- Ignite UI Required Combined JavaScript Files -->
    <script src="http://cdn-na.infragistics.com/igniteui/2014.2/latest/js/infragistics.core.js"></script>
    <script src="http://cdn-na.infragistics.com/igniteui/2014.2/latest/js/infragistics.lob.js"></script>
    <script src="http://127.0.0.1/orcamento/base.php"></script>
</head>
<body>
    <table id="grid"></table>

    <script>

	
        $(function () {
            $("#grid").igGrid({
                autoGenerateColumns: false,
                width: "100%",
                height: "400px",
                columns: [
                    { headerText: "id", key: "id", dataType: "number", width: "10%" },
                    { headerText: "nome_conta", key: "nome_conta", dataType: "nome_conta", width: "30%" },
                    { headerText: "nivel1", key: "nivel1", dataType: "string", width: "15%" },
                    { headerText: "nivel2", key: "nivel2", dataType: "string", width: "15%" },
                    { headerText: "nivel3", key: "nivel3", dataType: "string", width: "15%" },
                    { headerText: "01_2014", key: "01_2014", dataType: "string", width: "15%" },
                   { headerText: "02_2014", key: "02_2014", dataType: "string", width: "15%" },

                ],
                dataSource: base,
                features: [
					{
                        name: 'GroupBy',
						 type: "local",
						groupedRowTextTemplate: "Total ${val}</td><td>",
						 summarySettings: {
								multiSummaryDelimiter: " | ",
								summaryFormat: "#0.00"
							},
						expandTooltip: "Custom expand tooltip",
						expansionIndicatorVisibility: true,
                        columnSettings: [
                           {
                                columnKey: "nivel1",
                                isGroupBy: true,
																
                            },
                           {
                                columnKey: "nivel2",
                                isGroupBy: true
                            },
                           {
                                columnKey: "nivel3",
                                isGroupBy: true
                            },
                           {
                                columnKey: "nivel4",
                                isGroupBy: true
                            },
                      {
                          columnKey: "01_2014",
                          allowGrouping: true,
                          summaries: [
                              {
                                  summaryFunction: "sum", text: " sum:"
                              },
                              {
                                  summaryFunction: "max", text: " max:"
                              },
                              {
                                  summaryFunction: "min", text: " min:"
                              },
                          ]
                      }
                        ]

                    },
					
					{
						name: "Summaries",
						columnSettings: [
							{ columnKey: "01_2014", allowSummaries: true },
							{ columnKey: "01_2014", allowSummaries: true }
						]
					},
					{
                        name: "Filtering",
                        type: "local",
                        mode: "advanced",
                        filterDialogContainment: "window"
                    }  ,                  
					{
                        name: "Hiding"
                    }
				
                ]
            });
		});

    </script>
</body>
</html>
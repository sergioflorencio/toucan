

<!DOCTYPE html>
<html>
<head>
    <nivel3></nivel3>

    <!-- Ignite UI Required Combined CSS Files -->
    <link href="http://cdn-na.infragistics.com/igniteui/2014.2/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
    <link href="http://cdn-na.infragistics.com/igniteui/2014.2/latest/css/structure/infragistics.css" rel="stylesheet" />

    <script src="http://modernizr.com/downloads/modernizr-latest.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>

    <!-- Ignite UI Required Combined JavaScript Files -->
    <script src="http://cdn-na.infragistics.com/igniteui/2014.2/latest/js/infragistics.core.js"></script>
    <script src="http://cdn-na.infragistics.com/igniteui/2014.2/latest/js/infragistics.lob.js"></script>

</head>
<body>

    <style type="text/css">
        .labelBackGround {
            text-align: right;
            margin-right: 10px;
        }
    </style>

    <!--Sample JSON Data
    <script src="http://www.igniteui.com/data-files/northwind.js"></script>-->
    <script src="http://127.0.0.1/orcamento/base.php?bs=plano_contas_"></script>
    <!-- Target element for the igGrid -->
    <table id="grid">
    </table>

    <script id="rowEditDialogRowTemplate1" type="text/x-jquery-tmpl">
        <tr>
            <td class="labelBackGround">${headerText}
                {{if ${dataKey} == '01_2014'}}<span style="color: red;">*</span>{{/if}}
            </td>
            <td data-key='${dataKey}'>
                <input />
            </td>
        </tr>
    </script>

    <script type="text/javascript">
        $( function ()
        {

            var nivel3s = ["Sales Representative", "Sales Manager", "Inside Sales Coordinator", "Vice President, Sales"];
            var countries = ["UK", "USA"];
			var contas=["x","z"];
			
            /*----------------- Instantiation -------------------------*/
            $( "#grid" ).igGrid( {
                virtualization: false,
                autoGenerateColumns: false,
                renderCheckboxes: true,
                primaryKey: "id",
                columns: [{
                    // note: if primaryKey is set and data in primary column contains numbers,
                    // then the dataType: "number" is required, otherwise, dataSource may misbehave
                    headerText: "Employee ID", key: "id", dataType: "number"
                },
				{
					headerText: "Conta", key: "nome_conta", dataType: "string"
                },
				{
                    headerText: "01_2014", key: "01_2014", dataType: "decimal"
                }, 
				{
                    headerText: "02_2014", key: "02_2014", dataType: "decimal"
                }, 
				{
                    headerText: "03_2014", key: "03_2014", dataType: "decimal"
                }, 
				{
                    headerText: "04_2014", key: "04_2014", dataType: "decimal"
                }, 
				{
                    headerText: "05_2014", key: "05_2014", dataType: "decimal"
                }, 
				{
                    headerText: "06_2014", key: "06_2014", dataType: "decimal"
                }

                ],
                dataSource: base,
                dataSourceType: "json",
                responseDataKey: "results",
                width: "100%",
                tabIndex: 1,
                features: [
                    {
                        name: 'Responsive',
                        enableVerticalRendering: false,
                        columnSettings: [
                            {
                                columnKey: 'id',
                                classes: 'ui-hidden-phone'
                            },
                            {
                                columnKey: 'nome_conta',
                                classes: 'ui-hidden-phone'
                            },
                            {
                                columnKey: '01_2014',
                                classes: 'ui-hidden-phone'
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
                        editMode: "rowedittemplate",
                        rowEditDialogWidth: 280,
                        rowEditDialogHeight: '280',
                        rowEditDialogContentHeight: 300,
                        rowEditDialogFieldWidth: 150,
                        rowEditDialogContainment: "window",
                        rowEditDialogRowTemplateID: "rowEditDialogRowTemplate1",
                        enableDeleteRow: false,
                        showReadonlyEditors: false,
                        showDoneCancelButtons: true,
                        enableDataDirtyException: false,
                        columnSettings: [
                            {
                                columnKey: "id",
                                readOnly: true
                            }, {
                                columnKey: "nivel3",
                                editorType: "text",
                                editorOptions: {
                                    button: "dropdown",
                                    listItems: nivel3s,
                                    readOnly: true,
                                    dropDownOnReadOnly: true
                                }
                            }, {
                                columnKey: "nome_conta",
                                editorType: "text",
                                editorOptions: {
                                    button: "dropdown",
                                    listItems: contas,
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
</body>
</html>


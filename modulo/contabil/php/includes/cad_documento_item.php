<?php

	echo "<div id='igrid_editavel_add'></div>";

	$pesquisa=new pesquisa;
	
	//$base="{'id':1,'cod_documento':1,'cod_empresa':1,'cod_tipo_documento':1,'referencia':'NF 00001','texto_cabecalho_documento':'txto teste','data_lancamento':'','data_base':'','data_estorno':'','data_alteracao':'','exercicio':'','periodo':'','historico':'','data_inclusao':'2015-05-22 18:15:45','data_ultima_alteracao':'0000-00-00 00:00:00','usuario_inclusao':0,'usuario_ultima_alteracao':0}";
	
	
	$column ="{headerText: 'Item', key: 'numero_item', width: '50px',  dataType: 'string'},";
	$column.="{headerText: 'CL', key: 'codigo_lancamento', width: '50px',  dataType: 'string'},";
	$column.="{headerText: 'Conta', key: 'cod_conta',   dataType: 'string'},";
	$column.="{headerText: 'Ctr.Custo', key: 'cod_ctr_custo',   dataType: 'string'},";
	$column.="{headerText: 'Montante', key: 'montante', width: '150px',  dataType: 'decimal', formatter: decimal_},";
	$column.="{headerText: 'Histórico', key: 'historico',  dataType: 'string'},";
	$column.="{headerText: 'Venc.Liquid.', key: 'data_vencimento_liquidacao', width: '150px',  dataType: 'date', format:'d/MM/yyyy'}";
	
	$select= "
			SELECT 
				cod_conta as ID,
				concat('#',numero_conta	) as numero_conta,
				concat('#',numero_conta,' - ', descricao	) as descricao
				

			FROM 
				".$schema.".cad_conta 
			WHERE
				cod_empresa='".$_SESSION['cod_empresa']."' ;";	
				
	$contas=$pesquisa->json($select);
	
	$select= "
			SELECT 
				cod_centro_custo as ID,
				concat('#',numero_centro_custo) as numero_centro_custo,
				concat('#',numero_centro_custo, ' - ', descricao ) as descricao
				

			FROM 
				".$schema.".cad_centro_custo 
			WHERE
				cod_empresa='".$_SESSION['cod_empresa']."' ;";	
				
	$centro_custo=$pesquisa->json($select);
	
					$column_editavel="
                        {
                            columnKey: 'numero_item',
                            readOnly: true,
							height:'20px',
                        },
                        {
                            columnKey: 'codigo_lancamento',
                            editorType: 'combo',
							required: true,
							height:'20px',
                            editorOptions: {
                                dataSource: [{value:'D'},{value:'C'}]	,
								dropDownWidth : 300,
								showDropDownButton : false,
								enableClearButton: false,
								enableActiveItem: false,								
                            }
                        },						
                        {
                            columnKey: 'cod_conta',
                            editorType: 'combo',
							required: true,
							height:'20px',
							autoComplete: true,
							filteringType: 'local',
							highlightMatchesMode: 'startsWith',
							filteringCondition: 'startsWith',		
							autoSelectFirstMatch: true,
							caseSensitive: true	,
                            editorOptions: {
                                dataSource: ".$contas.",
								textKey: 'descricao',
                                valueKey: 'numero_conta',
								dropDownWidth : 300,
								showDropDownButton : false,
								enableClearButton: false,
								enableActiveItem: false,								
                            }
                        },						
                        {
                            columnKey: 'cod_ctr_custo',
                            editorType: 'combo',
							required: true,
							height:'20px',
							autoComplete: true,
							filteringType: 'local',
							highlightMatchesMode: 'startsWith',
							filteringCondition: 'startsWith',		
							autoSelectFirstMatch: true,
							caseSensitive: true	,
                            editorOptions: {
                                dataSource: ".$centro_custo.",
								textKey: 'descricao',
                                valueKey: 'numero_centro_custo',
								dropDownWidth : 300,
								showDropDownButton : false,
								enableClearButton: false,
								enableActiveItem: false,								
                            }
                        },						
                        {
                            columnKey: 'nome_conta',
                            readOnly: true,
							height:'20px'
                        },
                        {
                            columnKey: 'montante',
                            readOnly: false,
							formatter: decimal_
						},
                        {
                            columnKey: 'historico',
                            readOnly: false,
							height:'20px'
                        },

                        {
                            columnKey: 'data_vencimento_liquidacao',
							readOnly: false,
							editorType: 'date',
							height:'20px'
                        }";

	$igniteui=new igniteui;
	$igniteui->igrid_editavel_add($base,$column,$column_editavel);


?>
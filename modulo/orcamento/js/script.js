

//--------------------------- Importar dados	 ----------------------------------------
	$("#bt_vincular_base").click(function(){ 
	//vincular_base
	 window.location.assign("vincular_base.php");
	
	
	});
	$("#bt_folha_orcamento_resumo_orcado_real_conta").click(function(){ 
	//vincular_base
	 window.location.assign("folha_orcamento_resumo_orcado_real_conta.php");
	
	
	});
	$("#bt_folha_orcamento_resumo_orcado_real_ctrcusto").click(function(){ 
	//vincular_base
	 window.location.assign("folha_orcamento_resumo_orcado_real_ctrcusto.php");
	
	
	});
	$("#bt_lancamento_orcamento").click(function(){ 
	//vincular_base
	 window.location.assign("lancamento_orcamento.php");
	
	
	});
	$("#bt_orcamentos").click(function(){ 
	//vincular_base
	 window.location.assign("orcamentos.php");
	
	
	});

	

function upload_base(){
	if (document.getElementById("uploaded_base").files[0]!=undefined){
		var formData = new FormData();
		file=document.getElementById("uploaded_base").files[0];
		formData.append("uploaded_base_", file);
		var xhr = new XMLHttpRequest();

		
		xhr.onreadystatechange = function()
		{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
			
				document.getElementById("msg").innerHTML=xhr.responseText;


			}
		}
		
		xhr.open("POST", 'php/upload_base.php',true);
		xhr.send(formData);

	}
	

}


	$("#bt_upload").click(function(){ 
		if (document.getElementById("uploaded_base").files[0]!=undefined){
			var formData = new FormData();
			file=document.getElementById("uploaded_base").files[0];
			formData.append("uploaded_base_", file);
			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById("msg").innerHTML=xhr.responseText;
				}
			}
			
			xhr.open("POST", 'php/upload_base.php',true);
			xhr.send(formData);

	}});
	

function gerar_grid_importar_dados(db_grid){
	document.getElementById("visualizador_dados").innerHTML="<div id='grid'></div>";
	$("#grid").igGrid({
		autoGenerateColumns: true,
		dataSource:JSON.parse(db_grid),  //JSON Array defined above      
		features: [
			{
				name: "Filtering",
				type: "local"
			},
			{
                        name: "Paging",
                        type: "local",
                        pageSize: 15
                    }
		]		
	});	


}

function importar_dados(tabela,action){

			var schema=document.getElementById("schema").value;
			
			var formData = new FormData();
				formData.append("schema", schema);
				formData.append("tabela", tabela);
				formData.append("action", action);
				
			var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function()
				{
					if(xhr.readyState == 4 && xhr.status == 200)
					{
					//	document.getElementById("visualizador_dados").innerHTML=xhr.responseText;					
						gerar_grid_importar_dados(xhr.responseText);
						document.getElementById("span_tabela").innerHTML=tabela;					
						document.getElementById("bt_confirmar_importacao").disabled=false;					
					}
				}
				xhr.open("POST", 'php/importar.php',true);
				xhr.send(formData);

}	
	
	$("#bt_importar_centro_custo").click(function(){ 
		if(document.getElementById("schema").value==""){
			alert("Selecione uma base de dados");
		}else{
			importar_dados('centro_de_custos','tabela');
		}

	});
	$("#bt_importar_contas_contabeis").click(function(){ 
		if(document.getElementById("schema").value==""){
			alert("Selecione uma base de dados");
		}else{
			importar_dados('plano_de_contas','tabela');
		}	

	});
	$("#bt_importar_contas_financeiras").click(function(){ 
		if(document.getElementById("schema").value==""){
			alert("Selecione uma base de dados");
		}else{
			importar_dados('caixas','tabela');
		}	

	});
	$("#bt_importar_lancamentos").click(function(){ 
		if(document.getElementById("schema").value==""){
			alert("Selecione uma base de dados");
		}else{
			importar_dados('lancamentos','tabela_lancamentos');
		}	

	});
	$(".radio_schema").click(function(){ 
		document.getElementById("schema").value=this.value;
		document.getElementById("span_base").innerHTML=this.value;
	});	
	$("#bt_confirmar_importacao").click(function(){ 
			document.getElementById("bt_confirmar_importacao").disabled=true;
			var schema=document.getElementById("schema").value;
			
			var formData = new FormData();
				formData.append("schema", schema);
				formData.append("db", JSON.stringify($("#grid").igGrid("option", "dataSource")));
				formData.append("tabela", document.getElementById("span_tabela").innerHTML);
				formData.append("action", "insert");
				
			var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function()
				{
					document.getElementById("visualizador_dados").innerHTML="<div class='uk-progress'><div class='uk-progress-bar' style='width: "+xhr.readyState/4+"%;'>"+xhr.readyState/4+"%</div></div>";
					if(xhr.readyState == 4 && xhr.status == 200)
					{
						document.getElementById("visualizador_dados").innerHTML=xhr.responseText;
					}
				}
				
				xhr.open("POST", 'php/importar.php',true);
				xhr.send(formData);		

		
		
	});	
	
	





//--------------------------- Cadastros	 ----------------------------------------
function grid_cadastro(db_grid){
			document.getElementById("visualizador_dados").innerHTML="<div id='grid'></div>"+db_grid;
////////////////////////////////////////////////////////////						
	$("#grid").igGrid({
		autoGenerateColumns: true,
		dataSource:JSON.parse(db_grid),  //JSON Array defined above      

		features: [
			{
				name: "Filtering",
				type: "local"
			},
			{
                        name: "Paging",
                        type: "local",
                        pageSize: 15
                    }
		]		
	});
////////////////////////////////////////////////////////////			
			

		
		}
	function carregar_cadastro(schema,tabela){

	

		//alert(schema+"-"+tabela);
		var formData = new FormData();
			formData.append("schema", schema);
			formData.append("tabela", tabela);
			formData.append("formato", "json");
			
		var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
				//	alert(xhr.responseText);
				//	var db_grid=xhr.responseText;
				// var db_grid=﻿[{ "id": 0,"id_pai": -1,"nome_conta": "RESULTADDO"},{ "id": 2,"id_pai": 0,"nome_conta": "1.1 - RECEITAS OPERACIONAIS"},{ "id": 3,"id_pai": 2,"nome_conta": "1.1.1 - RECEITAS PROPRIAS"},{ "id": 91,"id_pai": 2,"nome_conta": "1.1.2 - TERMOS DE PARCERIA / CONVENIOS / LEIS DE INCENTIVOS"},{ "id": 93,"id_pai": 2,"nome_conta": "1.1.9 - OUTRAS RECEITAS"},{ "id": 4,"id_pai": 3,"nome_conta": "1.1.1.01 - CUSTEIO"},{ "id": 19,"id_pai": 3,"nome_conta": "1.1.1.02 - ASSOCIATIVAS"},{ "id": 25,"id_pai": 3,"nome_conta": "1.1.1.05 - EDUCACIONAL"},{ "id": 30,"id_pai": 3,"nome_conta": "1.1.1.06 - MEIO AMBIENTE"},{ "id": 37,"id_pai": 3,"nome_conta": "1.1.1.07 - CULTURAL"},{ "id": 46,"id_pai": 3,"nome_conta": "1.1.1.08 - ESPORTE"},{ "id": 50,"id_pai": 3,"nome_conta": "1.1.1.09 - FESTAS E EVENTOS"},{ "id": 54,"id_pai": 3,"nome_conta": "1.1.1.10 - SUBVENCOES"},{ "id": 59,"id_pai": 3,"nome_conta": "1.1.1.11 - VENDAS DE BENS E SERVICOS"},{ "id": 73,"id_pai": 3,"nome_conta": "1.1.1.20 - RECEITAS FINANCEIRAS"},{ "id": 86,"id_pai": 3,"nome_conta": "1.1.1.25 - RECEITAS DIVERSAS"},{ "id": 5,"id_pai": 4,"nome_conta": "1.1.1.01.001 - DOACOES P.J"},{ "id": 6,"id_pai": 4,"nome_conta": "1.1.1.01.002 - DOACOES P.F"},{ "id": 7,"id_pai": 4,"nome_conta": "1.1.1.01.003 - CONTRIBUICOES"},{ "id": 8,"id_pai": 4,"nome_conta": "1.1.1.01.004 - PATROCIONIOS"},{ "id": 9,"id_pai": 4,"nome_conta": "1.1.1.01.005 - PARCEIROS MANTENEDORES"},{ "id": 10,"id_pai": 4,"nome_conta": "1.1.1.01.006 - ORGANIZACOES MADRINHAS"},{ "id": 11,"id_pai": 4,"nome_conta": "1.1.1.01.007 - PARCEIROS INSTITUCIONAIS"},{ "id": 12,"id_pai": 4,"nome_conta": "1.1.1.01.510 - OUTRAS RECEITAS PARA CUSTEIO"},{ "id": 13,"id_pai": 4,"nome_conta": "1.1.1.01.001 - RECURSOS DE TERMOS DE PARCERIA"},{ "id": 14,"id_pai": 4,"nome_conta": "1.1.1.01.002 - RECURSOS DE CONVENIOS"},{ "id": 15,"id_pai": 4,"nome_conta": "1.1.1.01.003 - DOACOES RECEBIDAS - LEIS INCENTIVOS"},{ "id": 16,"id_pai": 4,"nome_conta": "1.1.1.01.004 - PATROCINIOS - LEIS DE INCENTIVOS"},{ "id": 17,"id_pai": 4,"nome_conta": "1.1.1.01.005 - RENDIMENTO DE APLICACAO FINANCEIRA"},{ "id": 18,"id_pai": 4,"nome_conta": "1.1.1.01.510 - OUTROS RECURSOS"},{ "id": 20,"id_pai": 19,"nome_conta": "1.1.1.02.001 - MENSALIDADES P.J."},{ "id": 21,"id_pai": 19,"nome_conta": "1.1.1.02.002 - MENSALIDADES P.F."},{ "id": 22,"id_pai": 19,"nome_conta": "1.1.1.02.003 - ANUIDADES P.J."},{ "id": 23,"id_pai": 19,"nome_conta": "1.1.1.02.004 - ANUIDADES P.F."},{ "id": 24,"id_pai": 19,"nome_conta": "1.1.1.02.510 - OUTRAS RECEITAS ASSOCIATIVAS"},{ "id": 26,"id_pai": 25,"nome_conta": "1.1.1.05.001 - MENSALIDADE ESCOLAR"},{ "id": 27,"id_pai": 25,"nome_conta": "1.1.1.05.002 - MATRICULAS ESCOLARES"},{ "id": 28,"id_pai": 25,"nome_conta": "1.1.1.05.003 - EDUCACAO CONTINUADA"},{ "id": 29,"id_pai": 25,"nome_conta": "1.1.1.05.510 - OUTRAS RECEITAS EDUCIONAIS"},{ "id": 31,"id_pai": 30,"nome_conta": "1.1.1.06.001 - PRESERVACAO DE FLORESTAS"},{ "id": 32,"id_pai": 30,"nome_conta": "1.1.1.06.002 - PRESERVACAO DE RECURSOS HIDRICOS"},{ "id": 33,"id_pai": 30,"nome_conta": "1.1.1.06.003 - PRESERVACAO DA VIDA ANIMAL"},{ "id": 34,"id_pai": 30,"nome_conta": "1.1.1.06.004 - PRESERVACAO DO MEIO AMBIENTE"},{ "id": 35,"id_pai": 30,"nome_conta": "1.1.1.06.005 - RECICLAGEM"},{ "id": 36,"id_pai": 30,"nome_conta": "1.1.1.06.510 - OUTRAS RECEITAS PARA O MEIO AMBIENTE"},{ "id": 38,"id_pai": 37,"nome_conta": "1.1.1.07.001 - EXPOSICOES E MOSTRAS"},{ "id": 39,"id_pai": 37,"nome_conta": "1.1.1.07.002 - VENDA DE INGRESSOS"},{ "id": 40,"id_pai": 37,"nome_conta": "1.1.1.07.003 - DIREITOS AUTORAIS"},{ "id": 41,"id_pai": 37,"nome_conta": "1.1.1.07.004 - CONVITES"},{ "id": 42,"id_pai": 37,"nome_conta": "1.1.1.07.005 - PATROCINIOS CULTURAIS"},{ "id": 43,"id_pai": 37,"nome_conta": "1.1.1.07.006 - APOIOS CULTURAIS"},{ "id": 44,"id_pai": 37,"nome_conta": "1.1.1.07.007 - PREMIOS"},{ "id": 45,"id_pai": 37,"nome_conta": "1.1.1.07.510 - OUTRAS RECEITAS CULTURAIS"},{ "id": 47,"id_pai": 46,"nome_conta": "1.1.1.08.001 - PATROCINIOS ESPORTIVOS"},{ "id": 48,"id_pai": 46,"nome_conta": "1.1.1.08.002 - APOIOS ESPORTIVOS"},{ "id": 49,"id_pai": 46,"nome_conta": "1.1.1.08.510 - OUTRAS RECEITAS PARA O ESPORTE"},{ "id": 51,"id_pai": 50,"nome_conta": "1.1.1.09.001 - PASSEIOS E EXCURSOES"},{ "id": 52,"id_pai": 50,"nome_conta": "1.1.1.09.002 - VENDAS DE INGRESSOS"},{ "id": 53,"id_pai": 50,"nome_conta": "1.1.1.09.510 - OUTRAS RECEITAS PARA ATIVIDADES"},{ "id": 55,"id_pai": 54,"nome_conta": "1.1.1.10.001 - SUBVENCOES FEDERAIS"},{ "id": 56,"id_pai": 54,"nome_conta": "1.1.1.10.002 - SUBVENCOES ESTADUAIS"},{ "id": 57,"id_pai": 54,"nome_conta": "1.1.1.10.003 - SUBVENCOES MUNICIPAIS"},{ "id": 58,"id_pai": 54,"nome_conta": "1.1.1.10.510 - OUTRAS RECEITAS COM SUBVENCOES"},{ "id": 60,"id_pai": 59,"nome_conta": "1.1.1.11.001 - VENDAS DE PROD/MERC - INTERNO"},{ "id": 61,"id_pai": 59,"nome_conta": "1.1.1.11.002 - VENDAS DE PROD/MERC - EXTERNO"},{ "id": 62,"id_pai": 59,"nome_conta": "1.1.1.11.003 - PRESTACAO DE SERVICO - INTERNO"},{ "id": 63,"id_pai": 59,"nome_conta": "1.1.1.11.004 - PRESTACAO DE SERVICO - EXTERNO"},{ "id": 64,"id_pai": 59,"nome_conta": "1.1.1.11.005 - PRESTACAO DE SERVICO - PROD SOCIAL"},{ "id": 65,"id_pai": 59,"nome_conta": "1.1.1.11.006 - TAXA DE ADMINISTRACAO"},{ "id": 66,"id_pai": 59,"nome_conta": "1.1.1.11.007 - VENDA E ASSINATURA DE PUBLICACOES"},{ "id": 67,"id_pai": 59,"nome_conta": "1.1.1.11.008 - VENDAS DE MOVEIS E UTENSILIOS"},{ "id": 68,"id_pai": 59,"nome_conta": "1.1.1.11.009 - VENDAS DE EDIFICACOES"},{ "id": 69,"id_pai": 59,"nome_conta": "1.1.1.11.010 - VENDAS DE MAQUINAS E EQUIPAMENTOS"},{ "id": 70,"id_pai": 59,"nome_conta": "1.1.1.11.011 - VENDAS DDE VEICULOS"},{ "id": 71,"id_pai": 59,"nome_conta": "1.1.1.11.012 - VENDAS DE COMPUTADORES E PERIFERICOS"},{ "id": 72,"id_pai": 59,"nome_conta": "1.1.1.11.510 - OUTRAS VENDAS DE BENS E SERVICOS"},{ "id": 74,"id_pai": 73,"nome_conta": "1.1.1.20.001 - RENDIMENTO APLIC FINANCEIRAS"},{ "id": 75,"id_pai": 73,"nome_conta": "1.1.1.20.002 - JUROS E MULTAS ATIVAS"},{ "id": 76,"id_pai": 73,"nome_conta": "1.1.1.20.003 - VARIACAO MONETARIA E CAMBIAL ATIVA"},{ "id": 77,"id_pai": 73,"nome_conta": "1.1.1.20.004 - DESCONTOS OBTIDOS"},{ "id": 78,"id_pai": 73,"nome_conta": "1.1.1.20.005 - LUCROS RECEBIDOS"},{ "id": 79,"id_pai": 73,"nome_conta": "1.1.1.20.006 - DIVIDENDOS RECEBIDOS"},{ "id": 80,"id_pai": 73,"nome_conta": "1.1.1.20.007 - PARTICIP.EM DEBENTURES E PARTES BENEFICIADAS"},{ "id": 81,"id_pai": 73,"nome_conta": "1.1.1.20.008 - EMPRESTIMOS BANCARIOS"},{ "id": 82,"id_pai": 73,"nome_conta": "1.1.1.20.009 - CONTRATOS DE MUTUO"},{ "id": 83,"id_pai": 73,"nome_conta": "1.1.1.20.010 - FINANCIAMENTOS"},{ "id": 84,"id_pai": 73,"nome_conta": "1.1.1.20.011 - OUTROS EMPRESTIMOS E FINANCIAMENTOS"},{ "id": 85,"id_pai": 73,"nome_conta": "1.1.1.20.510 - OUTRAS RECEITAS FINANCEIRAS"},{ "id": 87,"id_pai": 86,"nome_conta": "1.1.1.25.001 - ALUGUEIS"},{ "id": 88,"id_pai": 86,"nome_conta": "1.1.1.25.002 - REEMBOLSO DE DESPESAS OPERACIONAIS"},{ "id": 89,"id_pai": 86,"nome_conta": "1.1.1.25.003 - REVERSAO DE PROV DEVEDORES DUVIDOSOS"},{ "id": 90,"id_pai": 86,"nome_conta": "1.1.1.25.510 - OUTRAS RECEITAS DIVERSAS"},{ "id": 92,"id_pai": 91,"nome_conta": "1.1.2.01 - RECEBIMENTO DE RECURSOS"},{ "id": 94,"id_pai": 93,"nome_conta": "1.1.9.01 - GANHOS NAO OPERACIONAIS"},{ "id": 95,"id_pai": 94,"nome_conta": "1.1.9.01.001 - GANHOS NA VENDA DE IMOBILIZADOS"},{ "id": 96,"id_pai": 94,"nome_conta": "1.1.9.01.510 - OUTROS GANHOS NAO OPERACIONAIS"},{ "id": 98,"id_pai": 0,"nome_conta": "2.5 - CUSTOS E DESPESAS OPERACIONAIS"},{ "id": 99,"id_pai": 98,"nome_conta": "2.5.2 - CUSTOS E DESPESAS - ATIVIDADES ASSISTENCIAIS"},{ "id": 270,"id_pai": 98,"nome_conta": "2.5.3 - CUSTOS E DESPESAS - ATIVIDADES EDUCACIONAIS"},{ "id": 443,"id_pai": 98,"nome_conta": "2.5.5 - CUSTOS E DESPESAS - OUTRAS ATIVIDADES"},{ "id": 614,"id_pai": 98,"nome_conta": "2.5.9 - OUTRAS DESPESAS"},{ "id": 100,"id_pai": 99,"nome_conta": "2.5.2.01 - DESPESAS COM PESSOAL"},{ "id": 108,"id_pai": 99,"nome_conta": "2.5.2.02 - BENEFICIOS PESSOAL COM VINCULO"},{ "id": 116,"id_pai": 99,"nome_conta": "2.5.2.03 - ENCARGOS SOCIAIS"},{ "id": 125,"id_pai": 99,"nome_conta": "2.5.2.04 - SERVICOS TOMADOS DE TERCEIROS"},{ "id": 140,"id_pai": 99,"nome_conta": "2.5.2.05 - VIAGENS"},{ "id": 147,"id_pai": 99,"nome_conta": "2.5.2.06 - OCUPACAO"},{ "id": 156,"id_pai": 99,"nome_conta": "2.5.2.07 - DESPESAS COM VEICULOS"},{ "id": 162,"id_pai": 99,"nome_conta": "2.5.2.08 - DESPESAS ADMINISTRATIVAS"},{ "id": 180,"id_pai": 99,"nome_conta": "2.5.2.09 - MARKETING / CAPTACAO REC / DESENV PARCERIAS"},{ "id": 192,"id_pai": 99,"nome_conta": "2.5.2.10 - DESPESAS TRIBUTARIAS"},{ "id": 209,"id_pai": 99,"nome_conta": "2.5.2.11 - DESPESAS FINANCEIRAS"},{ "id": 216,"id_pai": 99,"nome_conta": "2.5.2.15 - CUSTO DOS PRODUTOS/MERCADORIAS VENDIDAS"},{ "id": 219,"id_pai": 99,"nome_conta": "2.5.2.16 - CUSTOS GERAIS DE IMPORTACOES"},{ "id": 228,"id_pai": 99,"nome_conta": "2.5.2.17 - ASSISTENCIA SOCIAL / FILANTROPIA"},{ "id": 248,"id_pai": 99,"nome_conta": "2.5.2.20 - IMOBILIZAÇÕES"},{ "id": 101,"id_pai": 100,"nome_conta": "2.5.2.01.001 - SALARIOS A PAGAR"},{ "id": 102,"id_pai": 100,"nome_conta": "2.5.2.01.002 - ADIANTAMENTO SALARIAL"},{ "id": 103,"id_pai": 100,"nome_conta": "2.5.2.01.003 - ADIANTAMENTO DE FERIAS"},{ "id": 104,"id_pai": 100,"nome_conta": "2.5.2.01.004 - ADIANTAMENTO DE 13 SALARIOS"},{ "id": 105,"id_pai": 100,"nome_conta": "2.5.2.01.005 - ADIANTAMENTO DE RECISAO"},{ "id": 106,"id_pai": 100,"nome_conta": "2.5.2.01.006 - EMPRESTIMO A FUNCIONARIO"},{ "id": 107,"id_pai": 100,"nome_conta": "2.5.2.01.510 - OUTRAS DESPESAS COM PESSOAL"},{ "id": 643,"id_pai": 100,"nome_conta": "2.5.2.01.007 - ABONO ESPECIAL"},{ "id": 646,"id_pai": 100,"nome_conta": "2.5.2.01.008 - AUTONOMOS A PAGAR"},{ "id": 109,"id_pai": 108,"nome_conta": "2.5.2.02.001 - ASSIST MEDICA E MEDICINA DO TRABALHO"},{ "id": 110,"id_pai": 108,"nome_conta": "2.5.2.02.002 - VALE TRANSPORTE"},{ "id": 111,"id_pai": 108,"nome_conta": "2.5.2.02.003 - VALE REFEICAO/REFEITORIO"},{ "id": 112,"id_pai": 108,"nome_conta": "2.5.2.02.004 - SEGURO DE VIDA EM GRUPO"},{ "id": 113,"id_pai": 108,"nome_conta": "2.5.2.02.005 - CESTA BASICA"},{ "id": 114,"id_pai": 108,"nome_conta": "2.5.2.02.006 - APERFEICOMENTO PROFISSIONAL"},{ "id": 115,"id_pai": 108,"nome_conta": "2.5.2.02.510 - OUTROS BENEFICIOS"},{ "id": 117,"id_pai": 116,"nome_conta": "2.5.2.03.001 - INSS A RECOLHER"},{ "id": 118,"id_pai": 116,"nome_conta": "2.5.2.03.002 - FGTS A RECOLHER"},{ "id": 119,"id_pai": 116,"nome_conta": "2.5.2.03.003 - PIS FOLHA DE SALARIOS A RECOLHER"},{ "id": 120,"id_pai": 116,"nome_conta": "2.5.2.03.004 - CONTR. SINDICAIS A RECOLHER"},{ "id": 121,"id_pai": 116,"nome_conta": "2.5.2.03.005 - IRRF 0561 - (FUNCIONARIOS) A RECOLHER"},{ "id": 122,"id_pai": 116,"nome_conta": "2.5.2.03.006 - IRRF 0588 - (AUTONOMOS) A RECOLHER"},{ "id": 123,"id_pai": 116,"nome_conta": "2.5.2.03.007 - ISS RETIDO FONTE RPA A RECOLHER"},{ "id": 124,"id_pai": 116,"nome_conta": "2.5.2.03.510 - OUTROS ENCARGOS SOCIAIS A RECOLHER"},{ "id": 126,"id_pai": 125,"nome_conta": "2.5.2.04.001 - CONTABILIDADE"},{ "id": 127,"id_pai": 125,"nome_conta": "2.5.2.04.002 - JURIDICO"},{ "id": 128,"id_pai": 125,"nome_conta": "2.5.2.04.003 - AUDITORIA"},{ "id": 129,"id_pai": 125,"nome_conta": "2.5.2.04.004 - CONSULTORIA"},{ "id": 130,"id_pai": 125,"nome_conta": "2.5.2.04.005 - PESQUISA"},{ "id": 131,"id_pai": 125,"nome_conta": "2.5.2.04.006 - CAPTACAO DE RECURSO"},{ "id": 132,"id_pai": 125,"nome_conta": "2.5.2.04.007 - ASSESSORIA"},{ "id": 133,"id_pai": 125,"nome_conta": "2.5.2.04.008 - MANUTENCAO"},{ "id": 134,"id_pai": 125,"nome_conta": "2.5.2.04.009 - LIMPEZA"},{ "id": 135,"id_pai": 125,"nome_conta": "2.5.2.04.010 - SEGURANCA"},{ "id": 136,"id_pai": 125,"nome_conta": "2.5.2.04.011 - PROGRAMACAO"},{ "id": 137,"id_pai": 125,"nome_conta": "2.5.2.04.012 - ENTREGAS"},{ "id": 138,"id_pai": 125,"nome_conta": "2.5.2.04.013 - INFORMATICA"},{ "id": 139,"id_pai": 125,"nome_conta": "2.5.2.04.510 - OUTROS SERVICOS TOMADOS"},{ "id": 141,"id_pai": 140,"nome_conta": "2.5.2.05.001 - HOSPEDAGENS"},{ "id": 142,"id_pai": 140,"nome_conta": "2.5.2.05.001 - PASSAGENS"},{ "id": 143,"id_pai": 140,"nome_conta": "2.5.2.05.002 - GORJETAS"},{ "id": 144,"id_pai": 140,"nome_conta": "2.5.2.05.003 - ALIMENTACAO"},{ "id": 145,"id_pai": 140,"nome_conta": "2.5.2.05.004 - CONDUCAO"},{ "id": 146,"id_pai": 140,"nome_conta": "2.5.2.05.510 - OUTRAS DESPESAS COM VIAGENS"},{ "id": 148,"id_pai": 147,"nome_conta": "2.5.2.06.001 - ALUGUEL"},{ "id": 149,"id_pai": 147,"nome_conta": "2.5.2.06.002 - CONDOMINIO"},{ "id": 150,"id_pai": 147,"nome_conta": "2.5.2.06.003 - AGUA E ESGOTO"},{ "id": 151,"id_pai": 147,"nome_conta": "2.5.2.06.004 - ENERGIA ELETRICA"},{ "id": 152,"id_pai": 147,"nome_conta": "2.5.2.06.005 - SEGURO DE IMOVEIS"},{ "id": 153,"id_pai": 147,"nome_conta": "2.5.2.06.006 - MATERIAL DE LIMPEZA"},{ "id": 154,"id_pai": 147,"nome_conta": "2.5.2.06.007 - MATERIAL PARA MANUTENÇÃO"},{ "id": 155,"id_pai": 147,"nome_conta": "2.5.2.06.510 - OUTRAS DESPESAS DE OCUPACAO"},{ "id": 157,"id_pai": 156,"nome_conta": "2.5.2.07.001 - COMBUSTIVEIS E LUBRIFICANTES"},{ "id": 158,"id_pai": 156,"nome_conta": "2.5.2.07.002 - SEGURO DE VEICULOS"},{ "id": 159,"id_pai": 156,"nome_conta": "2.5.2.07.004 - PEDAGIO"},{ "id": 160,"id_pai": 156,"nome_conta": "2.5.2.07.005 - MANUTENCAO - PECAS"},{ "id": 161,"id_pai": 156,"nome_conta": "2.5.2.07.510 - OUTRAS DESPESAS COM VEICULOS"},{ "id": 163,"id_pai": 162,"nome_conta": "2.5.2.08.001 - MATERIAL DE ESCRITORIO"},{ "id": 164,"id_pai": 162,"nome_conta": "2.5.2.08.002 - PECAS P/ MAQS E EQUIPS ESCRITORIO"},{ "id": 165,"id_pai": 162,"nome_conta": "2.5.2.08.003 - CONDUCAO"},{ "id": 166,"id_pai": 162,"nome_conta": "2.5.2.08.004 - TELEFONE FAX INTERNET"},{ "id": 167,"id_pai": 162,"nome_conta": "2.5.2.08.005 - XEROX"},{ "id": 168,"id_pai": 162,"nome_conta": "2.5.2.08.006 - ASSINATURA DE JORNAIS/REVISTA/PERIODICOS"},{ "id": 169,"id_pai": 162,"nome_conta": "2.5.2.08.007 - LANCHES E REFEICOES"},{ "id": 170,"id_pai": 162,"nome_conta": "2.5.2.08.008 - LICENCA DE USO"},{ "id": 171,"id_pai": 162,"nome_conta": "2.5.2.08.009 - CARTORIO"},{ "id": 172,"id_pai": 162,"nome_conta": "2.5.2.08.010 - COPA E COZINHA"},{ "id": 173,"id_pai": 162,"nome_conta": "2.5.2.08.011 - CORREIOS E MALOTES"},{ "id": 174,"id_pai": 162,"nome_conta": "2.5.2.08.012 - DEVEDORES DUVIDOSOS"},{ "id": 175,"id_pai": 162,"nome_conta": "2.5.2.08.013 - BENS DURAVEIS DE PEQUENO VALOR"},{ "id": 176,"id_pai": 162,"nome_conta": "2.5.2.08.014 - LOCACAO DE MAQS E EQUIPAMENTOS"},{ "id": 177,"id_pai": 162,"nome_conta": "2.5.2.08.015 - UNIFORMES"},{ "id": 178,"id_pai": 162,"nome_conta": "2.5.2.08.016 - FRETES"},{ "id": 179,"id_pai": 162,"nome_conta": "2.5.2.08.510 - OUTRAS DESPESAS ADMINISTRATIVAS"},{ "id": 181,"id_pai": 180,"nome_conta": "2.5.2.09.001 - PUBLICIDADE"},{ "id": 182,"id_pai": 180,"nome_conta": "2.5.2.09.002 - MARKETING"},{ "id": 183,"id_pai": 180,"nome_conta": "2.5.2.09.003 - EVENTOS PROMOCIONAIS E ALUSIVOS"},{ "id": 184,"id_pai": 180,"nome_conta": "2.5.2.09.004 - GASTOS NO DESENVOVLIMENTO PARCERIAS"},{ "id": 185,"id_pai": 180,"nome_conta": "2.5.2.09.005 - GASTOS EM RELACOES PUBLICAS"},{ "id": 186,"id_pai": 180,"nome_conta": "2.5.2.09.006 - PARTICIPACOES EM EVENTOS BENEFICENTES"},{ "id": 187,"id_pai": 180,"nome_conta": "2.5.2.09.007 - PARTIC EM EVENTOS CULTURAIS E ARTISTICOS"},{ "id": 188,"id_pai": 180,"nome_conta": "2.5.2.09.008 - PARTICIPACOES EM FEIRAS"},{ "id": 189,"id_pai": 180,"nome_conta": "2.5.2.09.009 - PARTIC CONGRESSOS/REUNIOES/SEMINARIOS"},{ "id": 190,"id_pai": 180,"nome_conta": "2.5.2.09.010 - GASTOS COM BRINDES/PRESENTES/CORTESIAS"},{ "id": 191,"id_pai": 180,"nome_conta": "2.5.2.09.510 - OUTRAS GASTOS MARK/CAP REC/DESENV PARC"},{ "id": 193,"id_pai": 192,"nome_conta": "2.5.2.10.001 - IRPJ "},{ "id": 194,"id_pai": 192,"nome_conta": "2.5.2.10.002 - CSLL"},{ "id": 195,"id_pai": 192,"nome_conta": "2.5.2.10.003 - ADICIONAL IRPJ"},{ "id": 196,"id_pai": 192,"nome_conta": "2.5.2.10.004 - COFINS"},{ "id": 197,"id_pai": 192,"nome_conta": "2.5.2.10.005 - PIS"},{ "id": 198,"id_pai": 192,"nome_conta": "2.5.2.10.006 - ISS"},{ "id": 199,"id_pai": 192,"nome_conta": "2.5.2.10.007 - ICMS"},{ "id": 200,"id_pai": 192,"nome_conta": "2.5.2.10.008 - IPI"},{ "id": 201,"id_pai": 192,"nome_conta": "2.5.2.10.009 - IMP IMPORTACAO"},{ "id": 202,"id_pai": 192,"nome_conta": "2.5.2.10.010 - ITCMD"},{ "id": 203,"id_pai": 192,"nome_conta": "2.5.2.10.011 - ITBI"},{ "id": 204,"id_pai": 192,"nome_conta": "2.5.2.10.012 - CONTRIBUICAO SINDICAL PATRONAL"},{ "id": 205,"id_pai": 192,"nome_conta": "2.5.2.10.013 - TAXA DE LICENCA FISCALIZ E FUNCIONAMENTO"},{ "id": 206,"id_pai": 192,"nome_conta": "2.5.2.10.014 - IPTU"},{ "id": 207,"id_pai": 192,"nome_conta": "2.5.2.10.015 - IPVA"},{ "id": 208,"id_pai": 192,"nome_conta": "2.5.2.10.510 - OUTROS IMPOSTOS E TAXAS"},{ "id": 210,"id_pai": 209,"nome_conta": "2.5.2.11.001 - DESPESAS BANCARIAS"},{ "id": 211,"id_pai": 209,"nome_conta": "2.5.2.11.002 - JUROS E MULTAS PASSIVAS"},{ "id": 212,"id_pai": 209,"nome_conta": "2.5.2.11.003 - CPMF"},{ "id": 213,"id_pai": 209,"nome_conta": "2.5.2.11.004 - IOF"},{ "id": 214,"id_pai": 209,"nome_conta": "2.5.2.11.005 - IRRF APLICACOES FINANCEIRAS"},{ "id": 215,"id_pai": 209,"nome_conta": "2.5.2.11.510 - OUTRAS DESPESAS FINANCEIRAS"},{ "id": 217,"id_pai": 216,"nome_conta": "2.5.2.15.003 - COMPRAS MERC / PRODUTOS"},{ "id": 218,"id_pai": 216,"nome_conta": "2.5.2.15.005 - EMBALAGENS E ACONDICIONAMENTOS"},{ "id": 220,"id_pai": 219,"nome_conta": "2.5.2.16.001 - ARMAZENAGEM"},{ "id": 221,"id_pai": 219,"nome_conta": "2.5.2.16.002 - CAPATAZIAS"},{ "id": 222,"id_pai": 219,"nome_conta": "2.5.2.16.003 - MARINHA MERCANTE"},{ "id": 223,"id_pai": 219,"nome_conta": "2.5.2.16.004 - S D A"},{ "id": 224,"id_pai": 219,"nome_conta": "2.5.2.16.005 - COMISSARIA"},{ "id": 225,"id_pai": 219,"nome_conta": "2.5.2.16.006 - CONTAINERS"},{ "id": 226,"id_pai": 219,"nome_conta": "2.5.2.16.007 - DESPACHANTE ADUANEIRO"},{ "id": 227,"id_pai": 219,"nome_conta": "2.5.2.16.510 - OUTROS CUSTOS DE IMPORTACAO"},{ "id": 229,"id_pai": 228,"nome_conta": "2.5.2.17.001 - INTERNACAO HOSPITALAR"},{ "id": 230,"id_pai": 228,"nome_conta": "2.5.2.17.002 - MEDICAMENTOS"},{ "id": 231,"id_pai": 228,"nome_conta": "2.5.2.17.003 - CONSULTAS MEDICAS"},{ "id": 232,"id_pai": 228,"nome_conta": "2.5.2.17.004 - TRATAMENTO E TERAPIAS"},{ "id": 233,"id_pai": 228,"nome_conta": "2.5.2.17.005 - CIRURGIAS E PROC MEDICOS"},{ "id": 234,"id_pai": 228,"nome_conta": "2.5.2.17.006 - APARELHOS/EQUIPAMENTOS MEDICOS"},{ "id": 235,"id_pai": 228,"nome_conta": "2.5.2.17.007 - PROTESES E ORTESES"},{ "id": 236,"id_pai": 228,"nome_conta": "2.5.2.17.008 - ODONTOLOGIA"},{ "id": 237,"id_pai": 228,"nome_conta": "2.5.2.17.009 - APOIO INSTITUCIONAL A ORG SOCIAIS"},{ "id": 238,"id_pai": 228,"nome_conta": "2.5.2.17.010 - DOACOES"},{ "id": 239,"id_pai": 228,"nome_conta": "2.5.2.17.011 - AQUISICAO DE BONUS DE AUXILIO"},{ "id": 240,"id_pai": 228,"nome_conta": "2.5.2.17.012 - AUXILIO NATALIDADE"},{ "id": 241,"id_pai": 228,"nome_conta": "2.5.2.17.013 - AUXILIO FUNERAL"},{ "id": 242,"id_pai": 228,"nome_conta": "2.5.2.17.014 - AUXILIO A DESABRIGADOS / DESVALIDOS"},{ "id": 243,"id_pai": 228,"nome_conta": "2.5.2.17.015 - AUXILIO AO IMIGRANTE"},{ "id": 244,"id_pai": 228,"nome_conta": "2.5.2.17.016 - ATENDIMENTO A CALAMIDADE E EMERGENCIAS"},{ "id": 245,"id_pai": 228,"nome_conta": "2.5.2.17.017 - PARTICIPACOES EM CAMPANHAS SOCIAIS"},{ "id": 246,"id_pai": 228,"nome_conta": "2.5.2.17.018 - AUXILIO BOLSA DE ESTUDO"},{ "id": 247,"id_pai": 228,"nome_conta": "2.5.2.17.510 - OUTRAS DESPESAS COM ASSISTENCIA SOCIAL / FILANTROPIA"},{ "id": 249,"id_pai": 248,"nome_conta": "2.5.2.20.001 - PINTURAS"},{ "id": 250,"id_pai": 248,"nome_conta": "2.5.2.20.002 - ESCULTURAS"},{ "id": 251,"id_pai": 248,"nome_conta": "2.5.2.20.003 - FOTOGRAFIAS E VIDEOS"},{ "id": 252,"id_pai": 248,"nome_conta": "2.5.2.20.004 - GRAVURAS"},{ "id": 253,"id_pai": 248,"nome_conta": "2.5.2.20.005 - LIVROS"},{ "id": 254,"id_pai": 248,"nome_conta": "2.5.2.20.006 - TERRENOS"},{ "id": 255,"id_pai": 248,"nome_conta": "2.5.2.20.007 - EDIFICACOES"},{ "id": 256,"id_pai": 248,"nome_conta": "2.5.2.20.008 - INSTALACOES"},{ "id": 257,"id_pai": 248,"nome_conta": "2.5.2.20.009 - VEICULOS"},{ "id": 258,"id_pai": 248,"nome_conta": "2.5.2.20.010 - MAQUINAS E EQUIPAMENTOS"},{ "id": 259,"id_pai": 248,"nome_conta": "2.5.2.20.011 - MOVEIS E UTENSILIOS"},{ "id": 260,"id_pai": 248,"nome_conta": "2.5.2.20.012 - EQUIPAMENTOS PROC DADOS"},{ "id": 261,"id_pai": 248,"nome_conta": "2.5.2.20.013 - LINHAS TELEFONICAS"},{ "id": 262,"id_pai": 248,"nome_conta": "2.5.2.20.014 - SOFTWARES"},{ "id": 263,"id_pai": 248,"nome_conta": "2.5.2.20.015 - IMOBILIZADO EM ANDAMENTO"},{ "id": 264,"id_pai": 248,"nome_conta": "2.5.2.20.016 - OUTRAS IMOBILIZACOES"},{ "id": 265,"id_pai": 248,"nome_conta": "2.5.2.20.017 - MARCAS E PATENTES"},{ "id": 266,"id_pai": 248,"nome_conta": "2.5.2.20.018 - DIREITOS AUTORAIS ADQUIRIDOS E DESENVOLVIDOS"},{ "id": 267,"id_pai": 248,"nome_conta": "2.5.2.20.019 - INVESTIMENTOS EM PROJETOS CIENTIFICOS E TECNOLOGICOS"},{ "id": 268,"id_pai": 248,"nome_conta": "2.5.2.20.020 - INTANGIVEL EM ANDAMENTO"},{ "id": 269,"id_pai": 248,"nome_conta": "2.5.2.20.021 - OUTROS ATIVOS INTANGIVEIS"},{ "id": 271,"id_pai": 270,"nome_conta": "2.5.3.01 - DESPESAS COM PESSOAL"},{ "id": 281,"id_pai": 270,"nome_conta": "2.5.3.02 - BENEFICIOS PESSOAL COM VINCULO"},{ "id": 289,"id_pai": 270,"nome_conta": "2.5.3.03 - ENCARGOS SOCIAIS"},{ "id": 298,"id_pai": 270,"nome_conta": "2.5.3.04 - SERVICOS TOMADOS DE TERCEIROS"},{ "id": 313,"id_pai": 270,"nome_conta": "2.5.3.05 - VIAGENS"},{ "id": 320,"id_pai": 270,"nome_conta": "2.5.3.06 - OCUPACAO"},{ "id": 329,"id_pai": 270,"nome_conta": "2.5.3.07 - DESPESAS COM VEICULOS"},{ "id": 335,"id_pai": 270,"nome_conta": "2.5.3.08 - DESPESAS ADMINISTRATIVAS"},{ "id": 353,"id_pai": 270,"nome_conta": "2.5.3.09 - MARKETING / CAPTACAO REC / DESENV PARCERIAS"},{ "id": 365,"id_pai": 270,"nome_conta": "2.5.3.10 - DESPESAS TRIBUTARIAS"},{ "id": 382,"id_pai": 270,"nome_conta": "2.5.3.11 - DESPESAS FINANCEIRAS"},{ "id": 389,"id_pai": 270,"nome_conta": "2.5.3.15 - CUSTO DOS PRODUTOS/MERCADORIAS VENDIDAS"},{ "id": 392,"id_pai": 270,"nome_conta": "2.5.3.16 - CUSTOS GERAIS DE IMPORTACOES"},{ "id": 401,"id_pai": 270,"nome_conta": "2.5.3.17 - ASSISTENCIA SOCIAL / FILANTROPIA"},{ "id": 421,"id_pai": 270,"nome_conta": "2.5.3.20 - IMOBILIZAÇÕES"},{ "id": 272,"id_pai": 271,"nome_conta": "2.5.3.01.001 - SALARIOS A PAGAR"},{ "id": 273,"id_pai": 271,"nome_conta": "2.5.3.01.002 - ADIANTAMENTO SALARIAL"},{ "id": 274,"id_pai": 271,"nome_conta": "2.5.3.01.003 - ADIANTAMENTO DE FERIAS"},{ "id": 275,"id_pai": 271,"nome_conta": "2.5.3.01.004 - ADIANTAMENTO DE 13 SALARIOS"},{ "id": 276,"id_pai": 271,"nome_conta": "2.5.3.01.005 - ADIANTAMENTO DE RECISAO"},{ "id": 277,"id_pai": 271,"nome_conta": "2.5.3.01.006 - EMPRESTIMO A FUNCIONARIO"},{ "id": 278,"id_pai": 271,"nome_conta": "2.5.3.01.510 - OUTRAS DESPESAS COM PESSOAL"},{ "id": 279,"id_pai": 271,"nome_conta": "2.5.3.01.001 - PERDA NA VENDA DE ATIVOS PERMANENTES"},{ "id": 280,"id_pai": 271,"nome_conta": "2.5.3.01.510 - OUTRAS DESPESAS NAO OPERACIONAIS"},{ "id": 634,"id_pai": 271,"nome_conta": "2.5.3.01.007 - ESTAGIARIOS"},{ "id": 644,"id_pai": 271,"nome_conta": "2.5.3.01.008 - ABONO ESPECIAL"},{ "id": 647,"id_pai": 271,"nome_conta": "2.5.3.01.009 - AUTONOMOS A PAGAR"},{ "id": 282,"id_pai": 281,"nome_conta": "2.5.3.02.001 - ASSIST MEDICA E MEDICINA DO TRABALHO"},{ "id": 283,"id_pai": 281,"nome_conta": "2.5.3.02.002 - VALE TRANSPORTE"},{ "id": 284,"id_pai": 281,"nome_conta": "2.5.3.02.003 - VALE REFEICAO/REFEITORIO"},{ "id": 285,"id_pai": 281,"nome_conta": "2.5.3.02.004 - SEGURO DE VIDA EM GRUPO"},{ "id": 286,"id_pai": 281,"nome_conta": "2.5.3.02.005 - CESTA BASICA"},{ "id": 287,"id_pai": 281,"nome_conta": "2.5.3.02.006 - APERFEICOMENTO PROFISSIONAL"},{ "id": 288,"id_pai": 281,"nome_conta": "2.5.3.02.510 - OUTROS BENEFICIOS"},{ "id": 290,"id_pai": 289,"nome_conta": "2.5.3.03.001 - INSS A RECOLHER"},{ "id": 291,"id_pai": 289,"nome_conta": "2.5.3.03.002 - FGTS A RECOLHER"},{ "id": 292,"id_pai": 289,"nome_conta": "2.5.3.03.003 - PIS FOLHA DE SALARIOS A RECOLHER"},{ "id": 293,"id_pai": 289,"nome_conta": "2.5.3.03.004 - CONTR. SINDICAIS A RECOLHER"},{ "id": 294,"id_pai": 289,"nome_conta": "2.5.3.03.005 - IRRF 0561 - (FUNCIONARIOS) A RECOLHER"},{ "id": 295,"id_pai": 289,"nome_conta": "2.5.3.03.006 - IRRF 0588 - (AUTONOMOS) A RECOLHER"},{ "id": 296,"id_pai": 289,"nome_conta": "2.5.3.03.007 - ISS RETIDO FONTE RPA A RECOLHER"},{ "id": 297,"id_pai": 289,"nome_conta": "2.5.3.03.510 - OUTROS ENCARGOS SOCIAIS A RECOLHER"},{ "id": 299,"id_pai": 298,"nome_conta": "2.5.3.04.001 - CONTABILIDADE"},{ "id": 300,"id_pai": 298,"nome_conta": "2.5.3.04.002 - JURIDICO"},{ "id": 301,"id_pai": 298,"nome_conta": "2.5.3.04.003 - AUDITORIA"},{ "id": 302,"id_pai": 298,"nome_conta": "2.5.3.04.004 - CONSULTORIA"},{ "id": 303,"id_pai": 298,"nome_conta": "2.5.3.04.005 - PESQUISA"},{ "id": 304,"id_pai": 298,"nome_conta": "2.5.3.04.006 - CAPTACAO DE RECURSO"},{ "id": 305,"id_pai": 298,"nome_conta": "2.5.3.04.007 - ASSESSORIA"},{ "id": 306,"id_pai": 298,"nome_conta": "2.5.3.04.008 - MANUTENCAO"},{ "id": 307,"id_pai": 298,"nome_conta": "2.5.3.04.009 - LIMPEZA"},{ "id": 308,"id_pai": 298,"nome_conta": "2.5.3.04.010 - SEGURANCA"},{ "id": 309,"id_pai": 298,"nome_conta": "2.5.3.04.011 - PROGRAMACAO"},{ "id": 310,"id_pai": 298,"nome_conta": "2.5.3.04.012 - ENTREGAS"},{ "id": 311,"id_pai": 298,"nome_conta": "2.5.3.04.013 - INFORMATICA"},{ "id": 312,"id_pai": 298,"nome_conta": "2.5.3.04.510 - OUTROS SERVICOS TOMADOS"},{ "id": 618,"id_pai": 298,"nome_conta": "2.5.3.04.015 - SERV TECNICOS"},{ "id": 619,"id_pai": 298,"nome_conta": "2.5.3.04.014 - CORRETORA"},{ "id": 620,"id_pai": 298,"nome_conta": "2.5.3.04.016 - TREINAMENTO"},{ "id": 628,"id_pai": 298,"nome_conta": "2.5.3.04.017 - FOTOGRAFICOS"},{ "id": 629,"id_pai": 298,"nome_conta": "2.5.3.04.018 - SERVIÇOS GRAFICOS"},{ "id": 314,"id_pai": 313,"nome_conta": "2.5.3.05.001 - HOSPEDAGENS"},{ "id": 315,"id_pai": 313,"nome_conta": "2.5.3.05.001 - PASSAGENS"},{ "id": 316,"id_pai": 313,"nome_conta": "2.5.3.05.002 - GORJETAS"},{ "id": 317,"id_pai": 313,"nome_conta": "2.5.3.05.003 - ALIMENTACAO"},{ "id": 318,"id_pai": 313,"nome_conta": "2.5.3.05.004 - CONDUCAO"},{ "id": 319,"id_pai": 313,"nome_conta": "2.5.3.05.510 - OUTRAS DESPESAS COM VIAGENS"},{ "id": 321,"id_pai": 320,"nome_conta": "2.5.3.06.001 - ALUGUEL"},{ "id": 322,"id_pai": 320,"nome_conta": "2.5.3.06.002 - CONDOMINIO"},{ "id": 323,"id_pai": 320,"nome_conta": "2.5.3.06.003 - AGUA E ESGOTO"},{ "id": 324,"id_pai": 320,"nome_conta": "2.5.3.06.004 - ENERGIA ELETRICA"},{ "id": 325,"id_pai": 320,"nome_conta": "2.5.3.06.005 - SEGURO DE IMOVEIS"},{ "id": 326,"id_pai": 320,"nome_conta": "2.5.3.06.006 - MATERIAL DE LIMPEZA"},{ "id": 327,"id_pai": 320,"nome_conta": "2.5.3.06.007 - MATERIAL PARA MANUTENÇÃO"},{ "id": 328,"id_pai": 320,"nome_conta": "2.5.3.06.510 - OUTRAS DESPESAS DE OCUPACAO"},{ "id": 639,"id_pai": 320,"nome_conta": "2.5.3.06.010 - GAS"},{ "id": 330,"id_pai": 329,"nome_conta": "2.5.3.07.001 - COMBUSTIVEIS E LUBRIFICANTES"},{ "id": 331,"id_pai": 329,"nome_conta": "2.5.3.07.002 - SEGURO DE VEICULOS"},{ "id": 332,"id_pai": 329,"nome_conta": "2.5.3.07.004 - PEDAGIO"},{ "id": 333,"id_pai": 329,"nome_conta": "2.5.3.07.005 - MANUTENCAO - PECAS"},{ "id": 334,"id_pai": 329,"nome_conta": "2.5.3.07.510 - OUTRAS DESPESAS COM VEICULOS"},{ "id": 623,"id_pai": 329,"nome_conta": "2.5.3.07.006 - ESTACIONAMENTO"},{ "id": 336,"id_pai": 335,"nome_conta": "2.5.3.08.001 - MATERIAL DE ESCRITORIO"},{ "id": 337,"id_pai": 335,"nome_conta": "2.5.3.08.002 - PECAS P/ MAQS E EQUIPS ESCRITORIO"},{ "id": 338,"id_pai": 335,"nome_conta": "2.5.3.08.003 - CONDUCAO"},{ "id": 339,"id_pai": 335,"nome_conta": "2.5.3.08.004 - TELEFONE FAX INTERNET"},{ "id": 340,"id_pai": 335,"nome_conta": "2.5.3.08.005 - XEROX"},{ "id": 341,"id_pai": 335,"nome_conta": "2.5.3.08.006 - ASSINATURA DE JORNAIS/REVISTA/PERIODICOS"},{ "id": 342,"id_pai": 335,"nome_conta": "2.5.3.08.007 - LANCHES E REFEICOES"},{ "id": 343,"id_pai": 335,"nome_conta": "2.5.3.08.008 - LICENCA DE USO"},{ "id": 344,"id_pai": 335,"nome_conta": "2.5.3.08.009 - CARTORIO"},{ "id": 345,"id_pai": 335,"nome_conta": "2.5.3.08.010 - COPA E COZINHA"},{ "id": 346,"id_pai": 335,"nome_conta": "2.5.3.08.011 - CORREIOS E MALOTES"},{ "id": 347,"id_pai": 335,"nome_conta": "2.5.3.08.012 - DEVEDORES DUVIDOSOS"},{ "id": 348,"id_pai": 335,"nome_conta": "2.5.3.08.013 - BENS DURAVEIS DE PEQUENO VALOR"},{ "id": 349,"id_pai": 335,"nome_conta": "2.5.3.08.014 - LOCACAO DE MAQS E EQUIPAMENTOS"},{ "id": 350,"id_pai": 335,"nome_conta": "2.5.3.08.015 - UNIFORMES"},{ "id": 351,"id_pai": 335,"nome_conta": "2.5.3.08.016 - FRETES"},{ "id": 352,"id_pai": 335,"nome_conta": "2.5.3.08.510 - OUTRAS DESPESAS ADMINISTRATIVAS"},{ "id": 621,"id_pai": 335,"nome_conta": "2.5.3.08.017 - MERENDA ESCOLAR"},{ "id": 622,"id_pai": 335,"nome_conta": "2.5.3.08.018 - MATERIAL ESCOLAR"},{ "id": 624,"id_pai": 335,"nome_conta": "2.5.3.08.019 - CONFRATERNIZAÇÃO"},{ "id": 625,"id_pai": 335,"nome_conta": "2.5.3.08.020 - CHAVEIRO"},{ "id": 627,"id_pai": 335,"nome_conta": "2.5.3.08.021 - CANIL "},{ "id": 633,"id_pai": 335,"nome_conta": "2.5.3.08.022 - MATERIAL ESPORTIVO"},{ "id": 638,"id_pai": 335,"nome_conta": "2.5.3.08.023 - DEVOLUÇÃO CREDITOS INDEVIDOS "},{ "id": 354,"id_pai": 353,"nome_conta": "2.5.3.09.001 - PUBLICIDADE"},{ "id": 355,"id_pai": 353,"nome_conta": "2.5.3.09.002 - MARKETING"},{ "id": 356,"id_pai": 353,"nome_conta": "2.5.3.09.003 - EVENTOS PROMOCIONAIS E ALUSIVOS"},{ "id": 357,"id_pai": 353,"nome_conta": "2.5.3.09.004 - GASTOS NO DESENVOVLIMENTO PARCERIAS"},{ "id": 358,"id_pai": 353,"nome_conta": "2.5.3.09.005 - GASTOS EM RELACOES PUBLICAS"},{ "id": 359,"id_pai": 353,"nome_conta": "2.5.3.09.006 - PARTICIPACOES EM EVENTOS BENEFICENTES"},{ "id": 360,"id_pai": 353,"nome_conta": "2.5.3.09.007 - PARTIC EM EVENTOS CULTURAIS E ARTISTICOS"},{ "id": 361,"id_pai": 353,"nome_conta": "2.5.3.09.008 - PARTICIPACOES EM FEIRAS"},{ "id": 362,"id_pai": 353,"nome_conta": "2.5.3.09.009 - PARTIC CONGRESSOS/REUNIOES/SEMINARIOS"},{ "id": 363,"id_pai": 353,"nome_conta": "2.5.3.09.010 - GASTOS COM BRINDES/PRESENTES/CORTESIAS"},{ "id": 364,"id_pai": 353,"nome_conta": "2.5.3.09.510 - OUTRAS GASTOS MARK/CAP REC/DESENV PARC"},{ "id": 366,"id_pai": 365,"nome_conta": "2.5.3.10.001 - IRPJ "},{ "id": 367,"id_pai": 365,"nome_conta": "2.5.3.10.002 - CSLL"},{ "id": 368,"id_pai": 365,"nome_conta": "2.5.3.10.003 - ADICIONAL IRPJ"},{ "id": 369,"id_pai": 365,"nome_conta": "2.5.3.10.004 - COFINS"},{ "id": 370,"id_pai": 365,"nome_conta": "2.5.3.10.005 - PIS"},{ "id": 371,"id_pai": 365,"nome_conta": "2.5.3.10.006 - ISS"},{ "id": 372,"id_pai": 365,"nome_conta": "2.5.3.10.007 - ICMS"},{ "id": 373,"id_pai": 365,"nome_conta": "2.5.3.10.008 - IPI"},{ "id": 374,"id_pai": 365,"nome_conta": "2.5.3.10.009 - IMP IMPORTACAO"},{ "id": 375,"id_pai": 365,"nome_conta": "2.5.3.10.010 - ITCMD"},{ "id": 376,"id_pai": 365,"nome_conta": "2.5.3.10.011 - ITBI"},{ "id": 377,"id_pai": 365,"nome_conta": "2.5.3.10.012 - CONTRIBUICAO SINDICAL PATRONAL"},{ "id": 378,"id_pai": 365,"nome_conta": "2.5.3.10.013 - TAXA DE LICENCA FISCALIZ E FUNCIONAMENTO"},{ "id": 379,"id_pai": 365,"nome_conta": "2.5.3.10.014 - IPTU"},{ "id": 380,"id_pai": 365,"nome_conta": "2.5.3.10.015 - IPVA"},{ "id": 381,"id_pai": 365,"nome_conta": "2.5.3.10.510 - OUTROS IMPOSTOS E TAXAS"},{ "id": 383,"id_pai": 382,"nome_conta": "2.5.3.11.001 - DESPESAS BANCARIAS"},{ "id": 384,"id_pai": 382,"nome_conta": "2.5.3.11.002 - JUROS E MULTAS PASSIVAS"},{ "id": 385,"id_pai": 382,"nome_conta": "2.5.3.11.003 - CPMF"},{ "id": 386,"id_pai": 382,"nome_conta": "2.5.3.11.004 - IOF"},{ "id": 387,"id_pai": 382,"nome_conta": "2.5.3.11.005 - IRRF APLICACOES FINANCEIRAS"},{ "id": 388,"id_pai": 382,"nome_conta": "2.5.3.11.510 - OUTRAS DESPESAS FINANCEIRAS"},{ "id": 390,"id_pai": 389,"nome_conta": "2.5.3.15.003 - COMPRAS MERC / PRODUTOS"},{ "id": 391,"id_pai": 389,"nome_conta": "2.5.3.15.005 - EMBALAGENS E ACONDICIONAMENTOS"},{ "id": 393,"id_pai": 392,"nome_conta": "2.5.3.16.001 - ARMAZENAGEM"},{ "id": 394,"id_pai": 392,"nome_conta": "2.5.3.16.002 - CAPATAZIAS"},{ "id": 395,"id_pai": 392,"nome_conta": "2.5.3.16.003 - MARINHA MERCANTE"},{ "id": 396,"id_pai": 392,"nome_conta": "2.5.3.16.004 - S D A"},{ "id": 397,"id_pai": 392,"nome_conta": "2.5.3.16.005 - COMISSARIA"},{ "id": 398,"id_pai": 392,"nome_conta": "2.5.3.16.006 - CONTAINERS"},{ "id": 399,"id_pai": 392,"nome_conta": "2.5.3.16.007 - DESPACHANTE ADUANEIRO"},{ "id": 400,"id_pai": 392,"nome_conta": "2.5.3.16.510 - OUTROS CUSTOS DE IMPORTACAO"},{ "id": 402,"id_pai": 401,"nome_conta": "2.5.3.17.001 - INTERNACAO HOSPITALAR"},{ "id": 403,"id_pai": 401,"nome_conta": "2.5.3.17.002 - MEDICAMENTOS"},{ "id": 404,"id_pai": 401,"nome_conta": "2.5.3.17.003 - CONSULTAS MEDICAS"},{ "id": 405,"id_pai": 401,"nome_conta": "2.5.3.17.004 - TRATAMENTO E TERAPIAS"},{ "id": 406,"id_pai": 401,"nome_conta": "2.5.3.17.005 - CIRURGIAS E PROC MEDICOS"},{ "id": 407,"id_pai": 401,"nome_conta": "2.5.3.17.006 - APARELHOS/EQUIPAMENTOS MEDICOS"},{ "id": 408,"id_pai": 401,"nome_conta": "2.5.3.17.007 - PROTESES E ORTESES"},{ "id": 409,"id_pai": 401,"nome_conta": "2.5.3.17.008 - ODONTOLOGIA"},{ "id": 410,"id_pai": 401,"nome_conta": "2.5.3.17.009 - APOIO INSTITUCIONAL A ORG SOCIAIS"},{ "id": 411,"id_pai": 401,"nome_conta": "2.5.3.17.010 - DOACOES"},{ "id": 412,"id_pai": 401,"nome_conta": "2.5.3.17.011 - AQUISICAO DE BONUS DE AUXILIO"},{ "id": 413,"id_pai": 401,"nome_conta": "2.5.3.17.012 - AUXILIO NATALIDADE"},{ "id": 414,"id_pai": 401,"nome_conta": "2.5.3.17.013 - AUXILIO FUNERAL"},{ "id": 415,"id_pai": 401,"nome_conta": "2.5.3.17.014 - AUXILIO A DESABRIGADOS / DESVALIDOS"},{ "id": 416,"id_pai": 401,"nome_conta": "2.5.3.17.015 - AUXILIO AO IMIGRANTE"},{ "id": 417,"id_pai": 401,"nome_conta": "2.5.3.17.016 - ATENDIMENTO A CALAMIDADE E EMERGENCIAS"},{ "id": 418,"id_pai": 401,"nome_conta": "2.5.3.17.017 - PARTICIPACOES EM CAMPANHAS SOCIAIS"},{ "id": 419,"id_pai": 401,"nome_conta": "2.5.3.17.018 - AUXILIO BOLSA DE ESTUDO"},{ "id": 420,"id_pai": 401,"nome_conta": "2.5.3.17.510 - OUTRAS DESPESAS COM ASSISTENCIA SOCIAL / FILANTROPIA"},{ "id": 422,"id_pai": 421,"nome_conta": "2.5.3.20.001 - PINTURAS"},{ "id": 423,"id_pai": 421,"nome_conta": "2.5.3.20.002 - ESCULTURAS"},{ "id": 424,"id_pai": 421,"nome_conta": "2.5.3.20.003 - FOTOGRAFIAS E VIDEOS"},{ "id": 425,"id_pai": 421,"nome_conta": "2.5.3.20.004 - GRAVURAS"},{ "id": 426,"id_pai": 421,"nome_conta": "2.5.3.20.005 - LIVROS"},{ "id": 427,"id_pai": 421,"nome_conta": "2.5.3.20.006 - TERRENOS"},{ "id": 428,"id_pai": 421,"nome_conta": "2.5.3.20.007 - EDIFICACOES"},{ "id": 429,"id_pai": 421,"nome_conta": "2.5.3.20.008 - INSTALACOES"},{ "id": 430,"id_pai": 421,"nome_conta": "2.5.3.20.009 - VEICULOS"},{ "id": 431,"id_pai": 421,"nome_conta": "2.5.3.20.010 - MAQUINAS E EQUIPAMENTOS"},{ "id": 432,"id_pai": 421,"nome_conta": "2.5.3.20.011 - MOVEIS E UTENSILIOS"},{ "id": 433,"id_pai": 421,"nome_conta": "2.5.3.20.012 - EQUIPAMENTOS PROC DADOS"},{ "id": 434,"id_pai": 421,"nome_conta": "2.5.3.20.013 - LINHAS TELEFONICAS"},{ "id": 435,"id_pai": 421,"nome_conta": "2.5.3.20.014 - SOFTWARES"},{ "id": 436,"id_pai": 421,"nome_conta": "2.5.3.20.015 - IMOBILIZADO EM ANDAMENTO"},{ "id": 437,"id_pai": 421,"nome_conta": "2.5.3.20.016 - OUTRAS IMOBILIZACOES"},{ "id": 438,"id_pai": 421,"nome_conta": "2.5.3.20.017 - MARCAS E PATENTES"},{ "id": 439,"id_pai": 421,"nome_conta": "2.5.3.20.018 - DIREITOS AUTORAIS ADQUIRIDOS E DESENVOLVIDOS"},{ "id": 440,"id_pai": 421,"nome_conta": "2.5.3.20.019 - INVESTIMENTOS EM PROJETOS CIENTIFICOS E TECNOLOGICOS"},{ "id": 441,"id_pai": 421,"nome_conta": "2.5.3.20.020 - INTANGIVEL EM ANDAMENTO"},{ "id": 442,"id_pai": 421,"nome_conta": "2.5.3.20.021 - OUTROS ATIVOS INTANGIVEIS"},{ "id": 444,"id_pai": 443,"nome_conta": "2.5.5.01 - DESPESAS COM PESSOAL"},{ "id": 452,"id_pai": 443,"nome_conta": "2.5.5.02 - BENEFICIOS PESSOAL COM VINCULO"},{ "id": 460,"id_pai": 443,"nome_conta": "2.5.5.03 - ENCARGOS SOCIAIS"},{ "id": 469,"id_pai": 443,"nome_conta": "2.5.5.04 - SERVICOS TOMADOS DE TERCEIROS"},{ "id": 484,"id_pai": 443,"nome_conta": "2.5.5.05 - VIAGENS"},{ "id": 491,"id_pai": 443,"nome_conta": "2.5.5.06 - OCUPACAO"},{ "id": 500,"id_pai": 443,"nome_conta": "2.5.5.07 - DESPESAS COM VEICULOS"},{ "id": 506,"id_pai": 443,"nome_conta": "2.5.5.08 - DESPESAS ADMINISTRATIVAS"},{ "id": 524,"id_pai": 443,"nome_conta": "2.5.5.09 - MARKETING / CAPTACAO REC / DESENV PARCERIAS"},{ "id": 536,"id_pai": 443,"nome_conta": "2.5.5.10 - DESPESAS TRIBUTARIAS"},{ "id": 553,"id_pai": 443,"nome_conta": "2.5.5.11 - DESPESAS FINANCEIRAS"},{ "id": 560,"id_pai": 443,"nome_conta": "2.5.5.15 - CUSTO DOS PRODUTOS/MERCADORIAS VENDIDAS"},{ "id": 563,"id_pai": 443,"nome_conta": "2.5.5.16 - CUSTOS GERAIS DE IMPORTACOES"},{ "id": 572,"id_pai": 443,"nome_conta": "2.5.5.17 - ASSISTENCIA SOCIAL / FILANTROPIA"},{ "id": 592,"id_pai": 443,"nome_conta": "2.5.5.20 - IMOBILIZAÇÕES"},{ "id": 445,"id_pai": 444,"nome_conta": "2.5.5.01.001 - SALARIOS A PAGAR"},{ "id": 446,"id_pai": 444,"nome_conta": "2.5.5.01.002 - ADIANTAMENTO SALARIAL"},{ "id": 447,"id_pai": 444,"nome_conta": "2.5.5.01.003 - ADIANTAMENTO DE FERIAS"},{ "id": 448,"id_pai": 444,"nome_conta": "2.5.5.01.004 - ADIANTAMENTO DE 13 SALARIOS"},{ "id": 449,"id_pai": 444,"nome_conta": "2.5.5.01.005 - ADIANTAMENTO DE RECISAO"},{ "id": 450,"id_pai": 444,"nome_conta": "2.5.5.01.006 - EMPRESTIMO A FUNCIONARIO"},{ "id": 451,"id_pai": 444,"nome_conta": "2.5.5.01.510 - OUTRAS DESPESAS COM PESSOAL"},{ "id": 630,"id_pai": 444,"nome_conta": "2.5.5.01.007 - ESTAGIARIO"},{ "id": 635,"id_pai": 444,"nome_conta": "2.5.5.01.008 - DESPESAS JUDICIAIS"},{ "id": 645,"id_pai": 444,"nome_conta": "2.5.5.01.009 - ABONO ESPECIAL"},{ "id": 648,"id_pai": 444,"nome_conta": "2.5.5.01.010 - AUTONOMOS A PAGAR"},{ "id": 453,"id_pai": 452,"nome_conta": "2.5.5.02.001 - ASSIST MEDICA E MEDICINA DO TRABALHO"},{ "id": 454,"id_pai": 452,"nome_conta": "2.5.5.02.002 - VALE TRANSPORTE"},{ "id": 455,"id_pai": 452,"nome_conta": "2.5.5.02.003 - VALE REFEICAO/REFEITORIO"},{ "id": 456,"id_pai": 452,"nome_conta": "2.5.5.02.004 - SEGURO DE VIDA EM GRUPO"},{ "id": 457,"id_pai": 452,"nome_conta": "2.5.5.02.005 - CESTA BASICA"},{ "id": 458,"id_pai": 452,"nome_conta": "2.5.5.02.006 - APERFEICOMENTO PROFISSIONAL"},{ "id": 459,"id_pai": 452,"nome_conta": "2.5.5.02.510 - OUTROS BENEFICIOS"},{ "id": 461,"id_pai": 460,"nome_conta": "2.5.5.03.001 - INSS A RECOLHER"},{ "id": 462,"id_pai": 460,"nome_conta": "2.5.5.03.002 - FGTS A RECOLHER"},{ "id": 463,"id_pai": 460,"nome_conta": "2.5.5.03.003 - PIS FOLHA DE SALARIOS A RECOLHER"},{ "id": 464,"id_pai": 460,"nome_conta": "2.5.5.03.004 - CONTR. SINDICAIS A RECOLHER"},{ "id": 465,"id_pai": 460,"nome_conta": "2.5.5.03.005 - IRRF 0561 - (FUNCIONARIOS) A RECOLHER"},{ "id": 466,"id_pai": 460,"nome_conta": "2.5.5.03.006 - IRRF 0588 - (AUTONOMOS) A RECOLHER"},{ "id": 467,"id_pai": 460,"nome_conta": "2.5.5.03.007 - ISS RETIDO FONTE RPA A RECOLHER"},{ "id": 468,"id_pai": 460,"nome_conta": "2.5.5.03.510 - OUTROS ENCARGOS SOCIAIS A RECOLHER"},{ "id": 470,"id_pai": 469,"nome_conta": "2.5.5.04.001 - CONTABILIDADE"},{ "id": 471,"id_pai": 469,"nome_conta": "2.5.5.04.002 - JURIDICO"},{ "id": 472,"id_pai": 469,"nome_conta": "2.5.5.04.003 - AUDITORIA"},{ "id": 473,"id_pai": 469,"nome_conta": "2.5.5.04.004 - CONSULTORIA"},{ "id": 474,"id_pai": 469,"nome_conta": "2.5.5.04.005 - PESQUISA"},{ "id": 475,"id_pai": 469,"nome_conta": "2.5.5.04.006 - CAPTACAO DE RECURSO"},{ "id": 476,"id_pai": 469,"nome_conta": "2.5.5.04.007 - ASSESSORIA"},{ "id": 477,"id_pai": 469,"nome_conta": "2.5.5.04.008 - MANUTENCAO"},{ "id": 478,"id_pai": 469,"nome_conta": "2.5.5.04.009 - LIMPEZA"},{ "id": 479,"id_pai": 469,"nome_conta": "2.5.5.04.010 - SEGURANCA"},{ "id": 480,"id_pai": 469,"nome_conta": "2.5.5.04.011 - PROGRAMACAO"},{ "id": 481,"id_pai": 469,"nome_conta": "2.5.5.04.012 - ENTREGAS"},{ "id": 482,"id_pai": 469,"nome_conta": "2.5.5.04.013 - INFORMATICA"},{ "id": 483,"id_pai": 469,"nome_conta": "2.5.5.04.510 - OUTROS SERVICOS TOMADOS"},{ "id": 616,"id_pai": 469,"nome_conta": "2.5.5.04.014 - CORRETORA"},{ "id": 617,"id_pai": 469,"nome_conta": "2.5.5.04.015 - SERVICOS TECNICOS"},{ "id": 631,"id_pai": 469,"nome_conta": "2.5.5.04.016 - SERVICOS GRAFICOS"},{ "id": 632,"id_pai": 469,"nome_conta": "2.5.5.04.017 - TRANSPORTE"},{ "id": 642,"id_pai": 469,"nome_conta": "2.5.5.04.018 - PUBLICAÇÃO "},{ "id": 485,"id_pai": 484,"nome_conta": "2.5.5.05.001 - HOSPEDAGENS"},{ "id": 486,"id_pai": 484,"nome_conta": "2.5.5.05.001 - PASSAGENS"},{ "id": 487,"id_pai": 484,"nome_conta": "2.5.5.05.002 - GORJETAS"},{ "id": 488,"id_pai": 484,"nome_conta": "2.5.5.05.003 - ALIMENTACAO"},{ "id": 489,"id_pai": 484,"nome_conta": "2.5.5.05.004 - CONDUCAO"},{ "id": 490,"id_pai": 484,"nome_conta": "2.5.5.05.510 - OUTRAS DESPESAS COM VIAGENS"},{ "id": 492,"id_pai": 491,"nome_conta": "2.5.5.06.001 - ALUGUEL"},{ "id": 493,"id_pai": 491,"nome_conta": "2.5.5.06.002 - CONDOMINIO"},{ "id": 494,"id_pai": 491,"nome_conta": "2.5.5.06.003 - AGUA E ESGOTO"},{ "id": 495,"id_pai": 491,"nome_conta": "2.5.5.06.004 - ENERGIA ELETRICA"},{ "id": 496,"id_pai": 491,"nome_conta": "2.5.5.06.005 - SEGURO DE IMOVEIS"},{ "id": 497,"id_pai": 491,"nome_conta": "2.5.5.06.006 - MATERIAL DE LIMPEZA"},{ "id": 498,"id_pai": 491,"nome_conta": "2.5.5.06.007 - MATERIAL PARA MANUTENÇÃO"},{ "id": 499,"id_pai": 491,"nome_conta": "2.5.5.06.510 - OUTRAS DESPESAS DE OCUPACAO"},{ "id": 640,"id_pai": 491,"nome_conta": "2.5.5.06.010 - GAS"},{ "id": 501,"id_pai": 500,"nome_conta": "2.5.5.07.001 - COMBUSTIVEIS E LUBRIFICANTES"},{ "id": 502,"id_pai": 500,"nome_conta": "2.5.5.07.002 - SEGURO DE VEICULOS"},{ "id": 503,"id_pai": 500,"nome_conta": "2.5.5.07.004 - PEDAGIO"},{ "id": 504,"id_pai": 500,"nome_conta": "2.5.5.07.005 - MANUTENCAO - PECAS"},{ "id": 505,"id_pai": 500,"nome_conta": "2.5.5.07.510 - OUTRAS DESPESAS COM VEICULOS"},{ "id": 636,"id_pai": 500,"nome_conta": "2.5.5.07.006 - ESTACIONAMENTO"},{ "id": 507,"id_pai": 506,"nome_conta": "2.5.5.08.001 - MATERIAL DE ESCRITORIO"},{ "id": 508,"id_pai": 506,"nome_conta": "2.5.5.08.002 - PECAS P/ MAQS E EQUIPS ESCRITORIO"},{ "id": 509,"id_pai": 506,"nome_conta": "2.5.5.08.003 - CONDUCAO"},{ "id": 510,"id_pai": 506,"nome_conta": "2.5.5.08.004 - TELEFONE FAX INTERNET"},{ "id": 511,"id_pai": 506,"nome_conta": "2.5.5.08.005 - XEROX"},{ "id": 512,"id_pai": 506,"nome_conta": "2.5.5.08.006 - ASSINATURA DE JORNAIS/REVISTA/PERIODICOS"},{ "id": 513,"id_pai": 506,"nome_conta": "2.5.5.08.007 - LANCHES E REFEICOES"},{ "id": 514,"id_pai": 506,"nome_conta": "2.5.5.08.008 - LICENCA DE USO"},{ "id": 515,"id_pai": 506,"nome_conta": "2.5.5.08.009 - CARTORIO"},{ "id": 516,"id_pai": 506,"nome_conta": "2.5.5.08.010 - COPA E COZINHA"},{ "id": 517,"id_pai": 506,"nome_conta": "2.5.5.08.011 - CORREIOS E MALOTES"},{ "id": 518,"id_pai": 506,"nome_conta": "2.5.5.08.012 - DEVEDORES DUVIDOSOS"},{ "id": 519,"id_pai": 506,"nome_conta": "2.5.5.08.013 - BENS DURAVEIS DE PEQUENO VALOR"},{ "id": 520,"id_pai": 506,"nome_conta": "2.5.5.08.014 - LOCACAO DE MAQS E EQUIPAMENTOS"},{ "id": 521,"id_pai": 506,"nome_conta": "2.5.5.08.015 - UNIFORMES"},{ "id": 522,"id_pai": 506,"nome_conta": "2.5.5.08.016 - FRETES"},{ "id": 523,"id_pai": 506,"nome_conta": "2.5.5.08.510 - OUTRAS DESPESAS ADMINISTRATIVAS"},{ "id": 637,"id_pai": 506,"nome_conta": "2.5.5.08.020 - DEVOLUÇÃO CREDITOS INDEVIDOS"},{ "id": 525,"id_pai": 524,"nome_conta": "2.5.5.09.001 - PUBLICIDADE"},{ "id": 526,"id_pai": 524,"nome_conta": "2.5.5.09.002 - MARKETING"},{ "id": 527,"id_pai": 524,"nome_conta": "2.5.5.09.003 - EVENTOS PROMOCIONAIS E ALUSIVOS"},{ "id": 528,"id_pai": 524,"nome_conta": "2.5.5.09.004 - GASTOS NO DESENVOVLIMENTO PARCERIAS"},{ "id": 529,"id_pai": 524,"nome_conta": "2.5.5.09.005 - GASTOS EM RELACOES PUBLICAS"},{ "id": 530,"id_pai": 524,"nome_conta": "2.5.5.09.006 - PARTICIPACOES EM EVENTOS BENEFICENTES"},{ "id": 531,"id_pai": 524,"nome_conta": "2.5.5.09.007 - PARTIC EM EVENTOS CULTURAIS E ARTISTICOS"},{ "id": 532,"id_pai": 524,"nome_conta": "2.5.5.09.008 - PARTICIPACOES EM FEIRAS"},{ "id": 533,"id_pai": 524,"nome_conta": "2.5.5.09.009 - PARTIC CONGRESSOS/REUNIOES/SEMINARIOS"},{ "id": 534,"id_pai": 524,"nome_conta": "2.5.5.09.010 - GASTOS COM BRINDES/PRESENTES/CORTESIAS"},{ "id": 535,"id_pai": 524,"nome_conta": "2.5.5.09.510 - OUTRAS GASTOS MARK/CAP REC/DESENV PARC"},{ "id": 537,"id_pai": 536,"nome_conta": "2.5.5.10.001 - IRPJ "},{ "id": 538,"id_pai": 536,"nome_conta": "2.5.5.10.002 - CSLL"},{ "id": 539,"id_pai": 536,"nome_conta": "2.5.5.10.003 - ADICIONAL IRPJ"},{ "id": 540,"id_pai": 536,"nome_conta": "2.5.5.10.004 - COFINS"},{ "id": 541,"id_pai": 536,"nome_conta": "2.5.5.10.005 - PIS"},{ "id": 542,"id_pai": 536,"nome_conta": "2.5.5.10.006 - ISS"},{ "id": 543,"id_pai": 536,"nome_conta": "2.5.5.10.007 - ICMS"},{ "id": 544,"id_pai": 536,"nome_conta": "2.5.5.10.008 - IPI"},{ "id": 545,"id_pai": 536,"nome_conta": "2.5.5.10.009 - IMP IMPORTACAO"},{ "id": 546,"id_pai": 536,"nome_conta": "2.5.5.10.010 - ITCMD"},{ "id": 547,"id_pai": 536,"nome_conta": "2.5.5.10.011 - ITBI"},{ "id": 548,"id_pai": 536,"nome_conta": "2.5.5.10.012 - CONTRIBUICAO SINDICAL PATRONAL"},{ "id": 549,"id_pai": 536,"nome_conta": "2.5.5.10.013 - TAXA DE LICENCA FISCALIZ E FUNCIONAMENTO"},{ "id": 550,"id_pai": 536,"nome_conta": "2.5.5.10.014 - IPTU"},{ "id": 551,"id_pai": 536,"nome_conta": "2.5.5.10.015 - IPVA"},{ "id": 552,"id_pai": 536,"nome_conta": "2.5.5.10.510 - OUTROS IMPOSTOS E TAXAS"},{ "id": 641,"id_pai": 536,"nome_conta": "2.5.5.10.016 - IRRF 1708"},{ "id": 554,"id_pai": 553,"nome_conta": "2.5.5.11.001 - DESPESAS BANCARIAS"},{ "id": 555,"id_pai": 553,"nome_conta": "2.5.5.11.002 - JUROS E MULTAS PASSIVAS"},{ "id": 556,"id_pai": 553,"nome_conta": "2.5.5.11.003 - CPMF"},{ "id": 557,"id_pai": 553,"nome_conta": "2.5.5.11.004 - IOF"},{ "id": 558,"id_pai": 553,"nome_conta": "2.5.5.11.005 - IRRF APLICACOES FINANCEIRAS"},{ "id": 559,"id_pai": 553,"nome_conta": "2.5.5.11.510 - OUTRAS DESPESAS FINANCEIRAS"},{ "id": 626,"id_pai": 553,"nome_conta": "2.5.5.11.006 - EMPRESTIMOS"},{ "id": 561,"id_pai": 560,"nome_conta": "2.5.5.15.003 - COMPRAS MERC / PRODUTOS"},{ "id": 562,"id_pai": 560,"nome_conta": "2.5.5.15.005 - EMBALAGENS E ACONDICIONAMENTOS"},{ "id": 564,"id_pai": 563,"nome_conta": "2.5.5.16.001 - ARMAZENAGEM"},{ "id": 565,"id_pai": 563,"nome_conta": "2.5.5.16.002 - CAPATAZIAS"},{ "id": 566,"id_pai": 563,"nome_conta": "2.5.5.16.003 - MARINHA MERCANTE"},{ "id": 567,"id_pai": 563,"nome_conta": "2.5.5.16.004 - S D A"},{ "id": 568,"id_pai": 563,"nome_conta": "2.5.5.16.005 - COMISSARIA"},{ "id": 569,"id_pai": 563,"nome_conta": "2.5.5.16.006 - CONTAINERS"},{ "id": 570,"id_pai": 563,"nome_conta": "2.5.5.16.007 - DESPACHANTE ADUANEIRO"},{ "id": 571,"id_pai": 563,"nome_conta": "2.5.5.16.510 - OUTROS CUSTOS DE IMPORTACAO"},{ "id": 573,"id_pai": 572,"nome_conta": "2.5.5.17.001 - INTERNACAO HOSPITALAR"},{ "id": 574,"id_pai": 572,"nome_conta": "2.5.5.17.002 - MEDICAMENTOS"},{ "id": 575,"id_pai": 572,"nome_conta": "2.5.5.17.003 - CONSULTAS MEDICAS"},{ "id": 576,"id_pai": 572,"nome_conta": "2.5.5.17.004 - TRATAMENTO E TERAPIAS"},{ "id": 577,"id_pai": 572,"nome_conta": "2.5.5.17.005 - CIRURGIAS E PROC MEDICOS"},{ "id": 578,"id_pai": 572,"nome_conta": "2.5.5.17.006 - APARELHOS/EQUIPAMENTOS MEDICOS"},{ "id": 579,"id_pai": 572,"nome_conta": "2.5.5.17.007 - PROTESES E ORTESES"},{ "id": 580,"id_pai": 572,"nome_conta": "2.5.5.17.008 - ODONTOLOGIA"},{ "id": 581,"id_pai": 572,"nome_conta": "2.5.5.17.009 - APOIO INSTITUCIONAL A ORG SOCIAIS"},{ "id": 582,"id_pai": 572,"nome_conta": "2.5.5.17.010 - DOACOES"},{ "id": 583,"id_pai": 572,"nome_conta": "2.5.5.17.011 - AQUISICAO DE BONUS DE AUXILIO"},{ "id": 584,"id_pai": 572,"nome_conta": "2.5.5.17.012 - AUXILIO NATALIDADE"},{ "id": 585,"id_pai": 572,"nome_conta": "2.5.5.17.013 - AUXILIO FUNERAL"},{ "id": 586,"id_pai": 572,"nome_conta": "2.5.5.17.014 - AUXILIO A DESABRIGADOS / DESVALIDOS"},{ "id": 587,"id_pai": 572,"nome_conta": "2.5.5.17.015 - AUXILIO AO IMIGRANTE"},{ "id": 588,"id_pai": 572,"nome_conta": "2.5.5.17.016 - ATENDIMENTO A CALAMIDADE E EMERGENCIAS"},{ "id": 589,"id_pai": 572,"nome_conta": "2.5.5.17.017 - PARTICIPACOES EM CAMPANHAS SOCIAIS"},{ "id": 590,"id_pai": 572,"nome_conta": "2.5.5.17.018 - AUXILIO BOLSA DE ESTUDO"},{ "id": 591,"id_pai": 572,"nome_conta": "2.5.5.17.510 - OUTRAS DESPESAS COM ASSISTENCIA SOCIAL / FILANTROPIA"},{ "id": 593,"id_pai": 592,"nome_conta": "2.5.5.20.001 - PINTURAS"},{ "id": 594,"id_pai": 592,"nome_conta": "2.5.5.20.002 - ESCULTURAS"},{ "id": 595,"id_pai": 592,"nome_conta": "2.5.5.20.003 - FOTOGRAFIAS E VIDEOS"},{ "id": 596,"id_pai": 592,"nome_conta": "2.5.5.20.004 - GRAVURAS"},{ "id": 597,"id_pai": 592,"nome_conta": "2.5.5.20.005 - LIVROS"},{ "id": 598,"id_pai": 592,"nome_conta": "2.5.5.20.006 - TERRENOS"},{ "id": 599,"id_pai": 592,"nome_conta": "2.5.5.20.007 - EDIFICACOES"},{ "id": 600,"id_pai": 592,"nome_conta": "2.5.5.20.008 - INSTALACOES"},{ "id": 601,"id_pai": 592,"nome_conta": "2.5.5.20.009 - VEICULOS"},{ "id": 602,"id_pai": 592,"nome_conta": "2.5.5.20.010 - MAQUINAS E EQUIPAMENTOS"},{ "id": 603,"id_pai": 592,"nome_conta": "2.5.5.20.011 - MOVEIS E UTENSILIOS"},{ "id": 604,"id_pai": 592,"nome_conta": "2.5.5.20.012 - EQUIPAMENTOS PROC DADOS"},{ "id": 605,"id_pai": 592,"nome_conta": "2.5.5.20.013 - LINHAS TELEFONICAS"},{ "id": 606,"id_pai": 592,"nome_conta": "2.5.5.20.014 - SOFTWARES"},{ "id": 607,"id_pai": 592,"nome_conta": "2.5.5.20.015 - IMOBILIZADO EM ANDAMENTO"},{ "id": 608,"id_pai": 592,"nome_conta": "2.5.5.20.016 - OUTRAS IMOBILIZACOES"},{ "id": 609,"id_pai": 592,"nome_conta": "2.5.5.20.017 - MARCAS E PATENTES"},{ "id": 610,"id_pai": 592,"nome_conta": "2.5.5.20.018 - DIREITOS AUTORAIS ADQUIRIDOS E DESENVOLVIDOS"},{ "id": 611,"id_pai": 592,"nome_conta": "2.5.5.20.019 - INVESTIMENTOS EM PROJETOS CIENTIFICOS E TECNOLOGICOS"},{ "id": 612,"id_pai": 592,"nome_conta": "2.5.5.20.020 - INTANGIVEL EM ANDAMENTO"},{ "id": 613,"id_pai": 592,"nome_conta": "2.5.5.20.021 - OUTROS ATIVOS INTANGIVEIS"},{ "id": 615,"id_pai": 614,"nome_conta": "2.5.9.01 - PERDAS NAO OPERACIONAIS"},];
				// JSON.parse
				// JSON.stringify
			//	var db_grid = JSON.stringify(xhr.responseText);
				//var db_grid = xhr.responseText;
				// db_grid = JSON.parse(db_grid);
				//	var		db_grid=﻿[{ "id": "0","id_pai":"-1","nome_conta":"RESULTADDO"},{ "id": "2","id_pai":"0","nome_conta":"1.1 - RECEITAS OPERACIONAIS"},{ "id": "3","id_pai":"2","nome_conta":"1.1.1 - RECEITAS PROPRIAS"},{ "id": "91","id_pai":"2","nome_conta":"1.1.2 - TERMOS DE PARCERIA / CONVENIOS / LEIS DE INCENTIVOS"},{ "id": "93","id_pai":"2","nome_conta":"1.1.9 - OUTRAS RECEITAS"},{ "id": "4","id_pai":"3","nome_conta":"1.1.1.01 - CUSTEIO"},{ "id": "19","id_pai":"3","nome_conta":"1.1.1.02 - ASSOCIATIVAS"},{ "id": "25","id_pai":"3","nome_conta":"1.1.1.05 - EDUCACIONAL"},{ "id": "30","id_pai":"3","nome_conta":"1.1.1.06 - MEIO AMBIENTE"},{ "id": "37","id_pai":"3","nome_conta":"1.1.1.07 - CULTURAL"}];

				//grid_cadastro(﻿[{"id": "0","id_pai":"-1","nome_conta":"RESULTADDO"},{"id": "2","id_pai":"0","nome_conta":"1.1 - RECEITAS OPERACIONAIS"},{"id": "3","id_pai":"2","nome_conta":"1.1.1 - RECEITAS PROPRIAS"},{"id": "91","id_pai":"2","nome_conta":"1.1.2 - TERMOS DE PARCERIA / CONVENIOS / LEIS DE INCENTIVOS"},{"id": "93","id_pai":"2","nome_conta":"1.1.9 - OUTRAS RECEITAS"},{"id": "4","id_pai":"3","nome_conta":"1.1.1.01 - CUSTEIO"},{"id": "19","id_pai":"3","nome_conta":"1.1.1.02 - ASSOCIATIVAS"},{"id": "25","id_pai":"3","nome_conta":"1.1.1.05 - EDUCACIONAL"},{"id": "30","id_pai":"3","nome_conta":"1.1.1.06 - MEIO AMBIENTE"},{"id": "37","id_pai":"3","nome_conta":"1.1.1.07 - CULTURAL"}]);
				document.getElementById("visualizador_dados").innerHTML=JSON.stringify(xhr.responseText);
			//	grid_cadastro(xhr.responseText);
				//	grid_cadastro(xhr.responseText);
				//	grid_cadastro(db_grid);


				}
			}
			
			xhr.open("POST", 'php/base_cadastro.php',true);
			xhr.send(formData);		

	
	}
	
	
	$("#tb_cadastro_plano_de_contas").click(function(){ 
		window.location.assign("cadastros.php?tabela=plano_de_contas");
	});

	
	$("#tb_cadastro_caixas").click(function(){ 
		window.location.assign("cadastros.php?tabela=caixas");
	});

	
	$("#tb_cadastro_centro_de_custos").click(function(){ 
		window.location.assign("cadastros.php?tabela=centro_de_custos");
	});	
	
	$(".td_schema").click(function(){ 
	//	document.getElementById("span_schema").innerHTML=this.innerHTML;
		var schema=this.innerHTML;
		var tabela=document.getElementById("span_tabela").innerHTML;
	//	carregar_cadastro(schema,tabela);
		
		window.location.assign("cadastros.php?schema="+schema+"&tabela="+tabela+"&formato=json");
			//schema", schema);
			//tabela", tabela);
			//formato", "json");
		
	});	
	
function pesquisar_select_ctrcusto(){

			var id_orcamento=document.getElementById("id_orcamento").value;
			var formData = new FormData();
				formData.append("id_orcamento", id_orcamento);
				
			var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function()
				{
					if(xhr.readyState == 4 && xhr.status == 200)
					{
						document.getElementById("div_cod_ctrcusto").innerHTML=xhr.responseText;
					}
				}
				
				xhr.open("POST", 'php/pesquisar_select_ctrcusto.php',true);
				xhr.send(formData);	



}
function pesquisar_select_conta(){

			var id_orcamento=document.getElementById("id_orcamento").value;
			var formData = new FormData();
				formData.append("id_orcamento", id_orcamento);
				
			var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function()
				{
					if(xhr.readyState == 4 && xhr.status == 200)
					{
						document.getElementById("div_cod_conta").innerHTML=xhr.responseText;
					}
				}
				
				xhr.open("POST", 'php/pesquisar_select_conta.php',true);
				xhr.send(formData);	



}


function salvar_cadastro(tabela){
			$("#grid").igGrid("commit");
			var formData = new FormData();
				formData.append("json", JSON.stringify($("#grid").data("igGrid").dataSource.data()));
				formData.append("tabela", tabela);
			var xhr = new XMLHttpRequest();
				xhr.open("POST", 'php/salvar_cadastro.php',true);
				xhr.send(formData);				
}


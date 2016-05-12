
function ajax(id_responseText, metodo, url,formData,reload){
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById(id_responseText).innerHTML=xhr.responseText;
					if(reload=='reload'){
						location.reload();
						
					}
				}
			}			
			xhr.open(metodo, url);

			xhr.overrideMimeType('text/xml; charset=utf-8');			
			xhr.send(formData);
}
function exportar(formato,id_grid,base){
		//document.getElementById("arquivo_gerado").innerHTML="";
		
		var formData = new FormData();
		formData.append('formato', formato);
		formData.append('base', base);


		if(base=='html'){
		_table_headers=id_grid+"_table_headers";
		_table=id_grid+"_table";
		_table_footers=id_grid+"_table_footers";
			var tabela="<meta http-equiv='Content-type' content='text/html; charset=utf-8' />"+document.getElementById(id_grid).innerHTML;
			formData.append('json', tabela);
		}	
		if(base=='json'){
			formData.append('json', JSON.stringify($( "#"+id_grid ).igGrid("option", "dataSource")));
		}		
			
		var xhr = new XMLHttpRequest();

		
		xhr.onreadystatechange = function()
		{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
				document.getElementById("arquivo_gerado").innerHTML=xhr.responseText;

			}
		}
		
		xhr.open("POST", 'php/temp/exportar.php');
		xhr.overrideMimeType('text/xml; charset=utf-8');
		xhr.send(formData);	
}
function upload_fotos(){
		var cod_item=document.getElementById("cod_item").value; 
				if (document.getElementById("imagem").files[0]!=undefined){
			var formData = new FormData();
			formData.append('my_uploaded_file', document.getElementById("imagem").files[0]);
			formData.append('cod_item',cod_item);
			var xhr = new XMLHttpRequest();

			
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById("imagens_").innerHTML=xhr.responseText;
				}
			}
			
			xhr.open("POST", 'php/upload_imagem.php');
			xhr.overrideMimeType('text/xml; charset=utf-8');
			xhr.send(formData);

		}
}
function excluir_fotos(cod_imagem){
			var cod_item=document.getElementById("cod_item").value; 
			var formData = new FormData();
			formData.append('cod_imagem',cod_imagem);
			formData.append('cod_item',cod_item);
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById("imagens_").innerHTML=xhr.responseText;
				}
			}			
			xhr.open("POST", 'php/excluir_imagem.php');
			xhr.overrideMimeType('text/xml; charset=utf-8');
			xhr.send(formData);

}
function formatar_data(a){
	valor=a.value;
	a.value='';
	valor = valor.replace( "-", "" );
	valor = valor.replace( ",", "" );
	valor = valor.replace( ".", "" );
	valor = valor.replace( "/", "" );
	valor = valor.replace( "/", "" );
	valor = valor.replace( "/", "" );
	valor = valor.replace( "/", "" );
	valor = valor.replace( "/", "" );
	valor = valor.replace( "/", "" );
	valor = valor.replace( "(", "" );
	valor = valor.replace( ")", "" );
	valor = valor.replace( " ", "" );


	dia=valor.substring(0, 2);
	mes=valor.substring(2, 4);
	ano=valor.substring(4, 8);

	//alert(dia);
	a.value= dia+"/"+mes+"/"+ano;
	//a.value= valor;


}
function formatar_numero(a){
	valor = a.value;
	valor = valor.replace( "-", "" );
	valor = valor.replace( ",", "" );
	valor = valor.replace( ".", "" );
	valor = valor.replace( "/", "" );
	valor = valor.replace( "(", "" );
	valor = valor.replace( ")", "" );
	valor = valor.replace( " ", "" );
	valor = valor/100
	valor = valor.toFixed(2);
	a.value = valor;
}
    $(function(){$( "input[id*='data']" ).keyup(function(){formatar_data(this);});});
    $(function(){$( "input[id*='valor']" ).keyup(function(){formatar_numero(this);});});
    $(function(){$( "input[id*='taxa']" ).keyup(function(){formatar_numero(this);});});
    $(function(){$( "input[id*='unidade']" ).keyup(function(){formatar_numero(this);});});
    $(function(){$( "input[id*='quantidade']" ).keyup(function(){formatar_numero(this);});});
    $(function(){$( "input[id*='vida_']" ).keyup(function(){formatar_numero(this);});});



var cleanName = function(str) {
    if ($.trim(str) == '') return str; // jQuery

   var special = ['&', 'O', 'Z', '-', 'o', 'z', 'Y', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ',',','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','x','y','z','w'],
        normal = ['ET', 'O', 'Z', '-', 'O', 'Z', 'Y', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'Y',' ','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','W'];
    for (var i = 0; i < str.length; i++) {
        for (var j = 0; j < special.length; j++) {
            if (str[i] == special[j]) {
                str = str.replace(new RegExp(str[i], 'gi'), normal[j]);
            }
        }
    }

    str = str.replace(/[\-]{2,}/gi, '_');
    str = str.replace(/[\_]{2,}/gi, '_');
    return str;
};
function maiusculas(){
	this.value=cleanName(this.value);
	
}

$('input').keyup(function(){ 
	this.value=cleanName(this.value);

});
$('textarea').keyup(function(){ 
	this.value=cleanName(this.value);

});

function salvar_cadastro(tabela){
			
			id_responseText="msg";
			metodo="POST";
			url="php/salvar_cadastro.php";
			var formData = new FormData();
				formData.append("tabela", tabela);
				switch(tabela) {
					case "cad_conta":
							formData.append("cod_conta", document.getElementById("cod_conta").value);
							formData.append("numero_conta_mae", document.getElementById('numero_conta_mae').value);
							formData.append("numero_conta", document.getElementById('numero_conta').value);
							formData.append("cod_tipo_conta", document.getElementById('cod_tipo_conta').value);							
						break;
					case "cad_centro_custo":
							formData.append("cod_centro_custo", document.getElementById("cod_centro_custo").value);
							formData.append("numero_centro_custo_mae", document.getElementById('numero_centro_custo_mae').value);
							formData.append("numero_centro_custo", document.getElementById('numero_centro_custo').value);
						break;
					default:

						break;
				}

				formData.append("descricao", document.getElementById('descricao').value);
				formData.append("saldo_inicial", document.getElementById('saldo_inicial').value);
				formData.append("saldo_atual", document.getElementById('saldo_atual').value);
				formData.append("status", document.getElementById('status').value);
				formData.append("act", "editar");
				formData.append("mod", tabela);
			
				
			ajax(id_responseText, metodo, url,formData,'');

}

	function cloneRow(table_id) {
	   
		//limpar classes
		limpar_classe();

		var table = document.getElementById(table_id); // find table to append to
		var row = table.rows[1]; // find row to copy
		var clone = row.cloneNode(true); // copy children too
		clone.id = "newID"; // change id or other attributes/contents
		var inputs=clone.getElementsByTagName("input");	
		for(var n=0;n<6;n++){inputs[n].value="";inputs[n].id=Math.floor((Math.random() * 100000) + 1)+"_"+Math.floor((Math.random() * 100000) + 1);inputs[n].addEventListener("keyup", maiusculas);}		
		var tbody=table.getElementsByTagName("tbody");
		table.getElementsByTagName("tbody")[0].appendChild(clone); // add new row to end of table


	}
	function delAllRow(table_id){
		var table = document.getElementById(table_id); // find table to append to
		var y=table.rows.length;
		
		for(var i=1;i<y-1;i++){
			//alert(i);
			document.getElementById(table_id).deleteRow(1);
		}
		
		var table = document.getElementById(table_id); // find table to append to
		var y=table.rows.length;

		if(y==2){
			var row = table.rows[1]; // find row to copy
			var clone = row.cloneNode(true); // copy children too
			clone.id = "newID"; // change id or other attributes/contents
			var inputs=clone.getElementsByTagName("input");	
			for(var n=0;n<6;n++){inputs[n].value="";inputs[n].id=Math.floor((Math.random() * 100000) + 1)+"_"+Math.floor((Math.random() * 100000) + 1);inputs[n].addEventListener("keyup", maiusculas);}	
			table=document.getElementById(table_id);
			table.deleteRow(1);
			table.getElementsByTagName("tbody")[0].appendChild(clone); // add new row to end of table
		}
	}	
	function delRow(r,table_id) {
		var table = document.getElementById(table_id); // find table to append to
		if(table.rows.length>2){
			var i = r.parentNode.parentNode.rowIndex;
			document.getElementById(table_id).deleteRow(i);
		}else{

			
		var row = table.rows[1]; // find row to copy
		var clone = row.cloneNode(true); // copy children too
		clone.id = "newID"; // change id or other attributes/contents
		var inputs=clone.getElementsByTagName("input");	
		for(var n=0;n<6;n++){inputs[n].value="";inputs[n].id=Math.floor((Math.random() * 100000) + 1)+"_"+Math.floor((Math.random() * 100000) + 1);inputs[n].addEventListener("keyup", maiusculas);}	
			var i = r.parentNode.parentNode.rowIndex;
			document.getElementById(table_id).deleteRow(i);
		table.getElementsByTagName("tbody")[0].appendChild(clone); // add new row to end of table
			
		}
	}	
	function importar_lancamentos(){
		
			var base=document.getElementById("text_area_importar_lancamento").value;
			var table_id="tableToModify";
			var linhas=base.split("\n");
			base=[];
			
			for(var i=0;i<linhas.length;i++){
				
					//verificar o tamanho da matriz
					var linha_=linhas[i].split("	");
					var linha__=linhas[i].split(";");
					if(linha_.length==6){
						base[i]=linha_;
					}else{
						if(linha__.length==6){
							base[i]=linha__;	
						}
					}
					
					//se a matriz tiver a dimensão de 6 colunas deverá fazer a inclusão da linha
					if(linha_.length==6 || linha__.length==6){
						var table = document.getElementById(table_id); 
						var row = table.rows[1];
						var clone = row.cloneNode(true); 
						clone.id = "newID";
						var inputs=clone.getElementsByTagName("input");	
						for(var n=0;n<6;n++){
							inputs[n].value=base[i][n];
							inputs[n].id=Math.floor((Math.random() * 100000) + 1)+"_"+Math.floor((Math.random() * 100000) + 1);
							inputs[n].addEventListener("keyup", maiusculas);
						}
						
						//se for a primeira linha, deve limpar a tabela de lançamentos
						if(i==0){ for(var a=1;a<table.rows.length;a++){ document.getElementById(table_id).deleteRow(a); } }					
						
						//incluir a nova linha
						table.appendChild(clone);
					}
					
					//limpar a variavel
					linha_="";
					linha__="";				

			}
		
	}	
	function limpar_classe(){
		var elements=document.getElementsByTagName("input");
		for (var i = 0; i < elements.length; i++) {
			elements[i].className=" uk-form-small";	
			elements[i].setAttribute("conferido", "");;	
		
		}
	}
	function salvar_documento(){
		
				//limpar classes
				limpar_classe();
						
				//var itens=document.getElementById(table_id);
				var codigo_lancamento = document.querySelectorAll("[coluna='codigo_lancamento']");
				var montante = document.querySelectorAll("[coluna='montante']");

				var itens="";
				var total=0;
				var sinal=0;
				var erro="";	
				var erros=0;
				var elements="";
				var debito=0;
				var credito=0;
				
				
				
				for(var a=0;a<codigo_lancamento.length;a++){
					if(codigo_lancamento[a].value=="D"){sinal=1; debito=debito+Number(Number(montante[a].value).toFixed(2))}
					if(codigo_lancamento[a].value=="C"){sinal=-1; credito=credito+Number(Number(montante[a].value).toFixed(2))}
					
					total=montante[a].value*sinal+total;

				}
		
	
				document.getElementById("debito").value=Number(Number(debito).toFixed(2));
				document.getElementById("credito").value=Number(Number(credito).toFixed(2));
				
	

				// 1 - Conferir o preenchimento dos campos
				if(document.getElementById("cod_tipo_documento").value==""){
					document.getElementById("cod_tipo_documento").className="uk-form-small uk-form-danger";
					document.getElementById("cod_tipo_documento").setAttribute("conferido", "erro");
					}
				else{document.getElementById("cod_tipo_documento").className="uk-form-small uk-form-success";}
				
				if(document.getElementById("referencia").value==""){
					document.getElementById("referencia").className="uk-form-small uk-form-danger";
					document.getElementById("referencia").setAttribute("conferido", "erro");
					}
				else{document.getElementById("referencia").className="uk-form-small uk-form-success";}
			
				if(document.getElementById("historico").value==""){
					document.getElementById("historico").className="uk-form-small uk-form-danger";
					document.getElementById("historico").setAttribute("conferido", "erro");
					}
				else{document.getElementById("historico").className="uk-form-small uk-form-success";}
				
				if(document.getElementById("texto_cabecalho_documento").value==""){
					document.getElementById("texto_cabecalho_documento").className="uk-form-small uk-form-danger";
					document.getElementById("texto_cabecalho_documento").setAttribute("conferido", "erro");
					}
				else{document.getElementById("texto_cabecalho_documento").className="uk-form-small uk-form-success";}
				
				if(document.getElementById("data_lancamento").value=="01/01/9999" || document.getElementById("data_lancamento").value==""){
					document.getElementById("data_lancamento").className="uk-form-small uk-form-danger";
					document.getElementById("data_lancamento").setAttribute("conferido", "erro");
					}
				else{document.getElementById("data_lancamento").className="uk-form-small uk-form-success";}
				
				if(document.getElementById("data_base").value=="01/01/9999" || document.getElementById("data_base").value==""){
					document.getElementById("data_base").className="uk-form-small uk-form-danger";
					document.getElementById("data_base").setAttribute("conferido", "erro");
					}
				else{document.getElementById("data_base").className="uk-form-small uk-form-success";}
				
				// 2 - preencher o valor do campo exercicio e período
				if(document.getElementById("data_base").value!="01/01/9999"){
					data=document.getElementById("data_base").value;
					data = data.replace( "-", "" );
					data = data.replace( ",", "" );
					data = data.replace( ".", "" );
					data = data.replace( "/", "" );
					data = data.replace( "/", "" );
					data = data.replace( "/", "" );
					data = data.replace( "/", "" );
					data = data.replace( "/", "" );
					data = data.replace( "/", "" );
					data = data.replace( "(", "" );
					data = data.replace( ")", "" );
					data = data.replace( " ", "" );
					
					exercicio=data.substring(4, 8);	
					periodo=data.substring(2, 4);
					
					document.getElementById("exercicio").value=exercicio;
					document.getElementById("periodo").value=periodo;
					
					
				}
				
				//validar centro de custo
					///0///função ajax para verificar cadatro
						function verificar_ajax(cadastro,cod_centro_custo,id){
							var xhr = new XMLHttpRequest();
							var formData = new FormData();				
							var metodo = "POST";
							var url = "php/verificar_cadastro.php";
							formData.append('cadastro', cadastro);
							formData.append('valor', cod_centro_custo);
							xhr.onreadystatechange = function()
							{
								if(xhr.readyState == 4 && xhr.status == 200)
								{
									var classe_=xhr.responseText;
									document.getElementById(id).className=classe_;
									
									if(classe_.indexOf("danger") != -1){document.getElementById(id).setAttribute("conferido", "erro");}
								}
							}		
							xhr.open(metodo, url);
							xhr.overrideMimeType('text/xml; charset=utf-8');			
							xhr.send(formData);					
						}			
				
				
					//1// pegar valor do campo centro_custo
						var cod_ctr_custo=document.querySelectorAll("[coluna='cod_ctr_custo']");
					
					//2// verificar se existe
						for(var n=0;n<cod_ctr_custo.length;n++){
							if(cod_ctr_custo[n].value!=""){
								verificar_ajax('cod_centro_custo',cod_ctr_custo[n].value,cod_ctr_custo[n].id);
							}else{
								document.getElementById(cod_ctr_custo[n].id).className=" uk-form-small uk-form-danger";
								document.getElementById(cod_ctr_custo[n].id).setAttribute("conferido", "erro");
							}
						}
				
				
				//validar contas
					//1// pegar valor do campo centro_custo
						var cod_conta=document.querySelectorAll("[coluna='cod_conta']");
					
					//2// verificar se existe
						for(var n=0;n<cod_conta.length;n++){
							if(cod_conta[n].value!=""){
								verificar_ajax('cod_conta',cod_conta[n].value,cod_conta[n].id);
							}else{
								document.getElementById(cod_conta[n].id).className=" uk-form-small uk-form-danger";
								document.getElementById(cod_conta[n].id).setAttribute("conferido", "erro");
							}
						}
					
				//validar projeto
					//1// pegar valor do campo projeto
						var cod_projeto=document.querySelectorAll("[coluna='cod_projeto']");
					
					//2// verificar se existe
						for(var n=0;n<cod_projeto.length;n++){
							if(cod_projeto[n].value!=""){
								verificar_ajax('cod_projeto',cod_projeto[n].value,cod_projeto[n].id);
							}else{
								document.getElementById(cod_projeto[n].id).className=" uk-form-small uk-form-danger";
								document.getElementById(cod_projeto[n].id).setAttribute("conferido", "erro");
							}
						}
					
				
				
				
				//validar se a chave de lançamento está correta "C/D"
					//1// pegar valor do campo codigo_lancamento
						var codigo_lancamento=document.querySelectorAll("[coluna='codigo_lancamento']");
					
					//2// verificar se existe
						for(var n=0;n<codigo_lancamento.length;n++){
							if(codigo_lancamento[n].value=="D" || codigo_lancamento[n].value=="C"){
								document.getElementById(codigo_lancamento[n].id).className=" uk-form-small uk-form-success";
							}else{
								document.getElementById(codigo_lancamento[n].id).className=" uk-form-small uk-form-danger";
								document.getElementById(codigo_lancamento[n].id).setAttribute("conferido", "erro");

							}
						}

				
				
				
				
				//validar o campo valor
					//1// pegar valor do campo montante
						var montante=document.querySelectorAll("[coluna='montante']");
					
					//2// verificar se existe
						for(var n=0;n<montante.length;n++){
							if(montante[n].value=="NaN" || montante[n].value=="NAN" || montante[n].value=="0.00" || montante[n].value==""){
								document.getElementById(montante[n].id).className=" uk-form-small uk-form-danger";
								document.getElementById(montante[n].id).setAttribute("conferido", "erro");
							}else{
								document.getElementById(montante[n].id).className=" uk-form-small uk-form-success";
							}
						}
					///verificar se os debitos batem com os creditos
					montante = document.querySelectorAll("[coluna='montante']");				
					if(document.getElementById("debito").value!=document.getElementById("credito").value ){
						for(var a=0;a<codigo_lancamento.length;a++){
							document.getElementById(montante[a].id).className=" uk-form-small uk-form-danger";
							document.getElementById(montante[a].id).setAttribute("conferido", "erro");
						}
						
					}
				
				
				
				
				//validar o campo descricao
					//1// pegar valor do campo historico
						var historico=document.querySelectorAll("[coluna='historico_']");
					
					//2// verificar se existe
						for(var n=0;n<historico.length;n++){
							if(historico[n].value=="NaN" || historico[n].value=="NAN" || historico[n].value==""){
								document.getElementById(historico[n].id).className=" uk-form-small uk-form-danger";
								document.getElementById(historico[n].id).setAttribute("conferido", "erro");
							}else{
								document.getElementById(historico[n].id).className=" uk-form-small uk-form-success";
							}
						}

				
				
				// montar matriz de itens
				var codigo_lancamento=document.querySelectorAll("[coluna='codigo_lancamento']");
				var cod_ctr_custo=document.querySelectorAll("[coluna='cod_ctr_custo']");
				var cod_conta=document.querySelectorAll("[coluna='cod_conta']");
				var cod_projeto=document.querySelectorAll("[coluna='cod_projeto']");
				var historico=document.querySelectorAll("[coluna='historico_']");
				var montante=document.querySelectorAll("[coluna='montante']");
				var data_vencimento_liquidacao=document.querySelectorAll("[coluna='data_vencimento_liquidacao']");
				
				for(var i=0; i<codigo_lancamento.length;i++){
					itens+="{'codigo_lancamento':'"+codigo_lancamento[i].value+"','cod_ctr_custo':'"+cod_ctr_custo[i].value+"','cod_conta':'"+cod_conta[i].value+"','cod_projeto':'"+cod_projeto[i].value+"','historico':'"+historico[i].value+"','montante':'"+montante[i].value+"','data_vencimento_liquidacao':'"+data_vencimento_liquidacao[i].value+"'}";
				}
				itens = "["+itens+"]";
				
				//Ultima verificação

					elements=document.getElementsByTagName("input");
					for (var i = 0; i < elements.length; i++) {
						if(elements[i].getAttribute("conferido")=="erro"){
							erros=erros+1;
						}
					
					}
					
				// 3 - Salvar documento
				if(erros==0){
					id_responseText="msg";
					metodo="POST";
					url="php/salvar_cad_documento.php";
					var formData = new FormData();
						formData.append("cod_documento",document.getElementById("cod_documento").value );
						formData.append("cod_tipo_documento",document.getElementById("cod_tipo_documento").value );
						formData.append("referencia",document.getElementById("referencia").value );
						formData.append("texto_cabecalho_documento",document.getElementById("texto_cabecalho_documento").value );
						formData.append("data_lancamento",document.getElementById("data_lancamento").value );
						formData.append("data_base",document.getElementById("data_base").value );
						formData.append("exercicio",document.getElementById("exercicio").value );
						formData.append("periodo",document.getElementById("periodo").value );
						formData.append("itens", itens);

					ajax(id_responseText, metodo, url,formData,'');				
					
				}

		

	}
	function calcular_total_debito_credito(){
		var codigo_lancamento = document.querySelectorAll("[coluna='codigo_lancamento']");
		var montante = document.querySelectorAll("[coluna='montante']");

		var debito=0;
		var credito=0;
		
		for(var a=0;a<codigo_lancamento.length;a++){
			if(codigo_lancamento[a].value=="D"){sinal=1; debito=debito+Number(Number(montante[a].value).toFixed(2))}
			if(codigo_lancamento[a].value=="C"){sinal=-1; credito=credito+Number(Number(montante[a].value).toFixed(2))}
		}
		
	
		document.getElementById("debito").value=Number(Number(debito).toFixed(2));
		document.getElementById("credito").value=Number(Number(credito).toFixed(2));
		
		
	}

function pesquisar_conta_mae(a){
		var valor=a.value.split(".");
			valor=a.value.split(".",valor.length-1);
			if(valor.length==0){valor[0]=-1}
			console.log(valor);
			document.getElementById("numero_conta_mae").value=valor.join(".");
			
			function ajax_pesquisa_conta(id_responseText, metodo, url,formData,reload){
					var xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && xhr.status == 200)
						{
							document.getElementById(id_responseText).value=xhr.responseText;
							//alert(xhr.responseText);
						}
					}			
					xhr.open(metodo, url);
					xhr.overrideMimeType('text/xml; charset=utf-8');			
					xhr.send(formData);
			}

			id_responseText="descricao_conta_mae";
			metodo="POST";
			url="php/pesquisa_conta_mae.php";
			
			var formData = new FormData();
				formData.append("valor", valor.join("."));
				formData.append("cadastro", "cod_conta");
			ajax_pesquisa_conta(id_responseText, metodo, url,formData,'');


		
}
function pesquisar_centro_custo_mae(a){
		var valor=a.value.split(".");
			valor=a.value.split(".",valor.length-1);
			if(valor.length==0){valor[0]=-1}
			console.log(valor);
			document.getElementById("numero_centro_custo_mae").value=valor.join(".");
			
			function ajax_pesquisa_centro_custo(id_responseText, metodo, url,formData,reload){
					var xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && xhr.status == 200)
						{
							document.getElementById(id_responseText).value=xhr.responseText;
							//alert(xhr.responseText);
						}
					}			
					xhr.open(metodo, url);
					xhr.overrideMimeType('text/xml; charset=utf-8');			
					xhr.send(formData);
			}

			id_responseText="descricao_centro_custo_mae";
			metodo="POST";
			url="php/pesquisa_conta_mae.php";
			
			var formData = new FormData();
				formData.append("valor", valor.join("."));
				formData.append("cadastro", "cod_centro_custo");
			ajax_pesquisa_centro_custo(id_responseText, metodo, url,formData,'');


		
}




///////ofx///////
	function readSingleFile(e) {
	  var file = e.target.files[0];
	  //console.log(e);
	  //console.log(file);
	  if (!file) {
		return;
	  }
	  var reader = new FileReader();
	  reader.onload = function(e) {
		var contents = e.target.result;
		displayContents(contents);
		document.getElementById('input_selecionar_ofx').value=file.name;
	  };
	  reader.readAsText(file);
	}
	function displayContents(contents) {
		
		function format_data_(a){
			valor=a;
			valor = valor.replace( "-", "" );
			valor = valor.replace( ",", "" );
			valor = valor.replace( ".", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "(", "" );
			valor = valor.replace( ")", "" );
			valor = valor.replace( " ", "" );


			var dia=valor.substring(6, 8);
			var mes=valor.substring(4, 6);
			var ano=valor.substring(0, 4);
			
			valor=dia+"/"+mes+"/"+ano;
			
			return valor;

			
			
		}
		function format_numero_(a){
			valor=a;

			valor = valor.replace( ",", "" );
			valor = valor.replace( ".", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "/", "" );
			valor = valor.replace( "(", "" );
			valor = valor.replace( ")", "" );
			valor = valor.replace( " ", "" );


			valor = valor/100
			valor = valor.toFixed(2);
			
			return valor;

			
			
		}
		
		if (window.DOMParser)
		  {
		  parser=new DOMParser();
		  xmlDoc=parser.parseFromString(contents,"text/xml");
		  }
		else // Internet Explorer
		  {
		  xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
		  xmlDoc.async=false;
		  xmlDoc.loadXML(contents);
		  }	
		 // alert(xmlDoc.getElementsByTagName("ofx").length);
		  
		document.getElementById('div_preview_').innerHTML = contents;
		
		json=document.getElementsByTagName('STMTTRN');
		//alert(json.length);
		var tb={};
		for(var n=0;n<json.length;n++){
			campos=json[n].innerHTML;
			campos = campos.replace(/	/g, '');	
			campos = campos.replace(/:/g, ' ');	
			campos = campos.replace(/\s\s+/g, ' ');			
			campos = campos.replace(/<[/].*>/g, '');
			campos = campos.replace(/]/g, ')');
			campos = campos.replace(/[[]/g, '(');
			campos = campos.replace(/\s</g, '<');	
			
			campos = campos.split("<");
			for(var a=0;a<campos.length;a++){
				campos[a]=campos[a].replace(/>/g, ':');
				campos[a]=campos[a].replace(/\r/g, '');
				campos[a]=campos[a].replace(/\n/g, '');
				js = '{"'+campos[a].replace(/:/g, '":"')+'"}';
				if(js!='{""}'){
					campos[a]=JSON.parse(js);
				}
			}

			tb[n]=campos;
			
		}


			
		var table="<table id='table_ofx' class='uk-table uk-table-condensed uk-table-hover' style='font-size:12px;border: 0px;'>";
				table+="<thead><tr style='height: 34px;'>";
				table+="<th style='min-width: 80px;padding: 0px;'><div style='padding: 0px 3px;'>Data</div></th>";
				table+="<th style='min-width: 80px;padding: 0px;'><div style='padding: 0px 3px;'>Valor</div></th>";
				table+="<th style='min-width: 80px;padding: 0px;'><div style='padding: 0px 3px;'>Doc.</div></th>";				
				table+="<th style='min-width: 150px;padding: 0px;'><div style='padding: 0px 3px;'>Histórico</div></th>";
				table+="<th style='min-width: 150px;padding: 0px;'><div style='padding: 0px 3px;'>Conta Contábil</div></th>";
				table+="<th style='min-width: 150px;padding: 0px;'><div style='padding: 0px 3px;'>Centro de Custo</div></th>";
				table+="<th style='min-width: 30px;padding: 0px;'></th>";
				table+="</tr></thead>";	
		 table+="<tbody style='max-height: inherit ! important;'>";				
			for(var n=0;n<Object.keys(tb).length;n++){
				table+="<tr style='height: 34px;'>";
				//keys=Object.keys(tb[n]);
				for( b in tb[n]){
					key_=Object.keys(tb[n][b]);
					//console.log(key_);
					for(c in tb[n][b]){
						if(c=='memo'|| c=='dtposted'|| c=='trnamt'|| c=='checknum' ){
							switch(c) {
								case 'dtposted':
									table+="<td style='min-width: 80px ! important;padding: 0px;vertical-align: middle;'><div style='width: 65px;padding: 0px 3px;' class='uk-text-truncate'>"+format_data_(tb[n][b][c])+"</div></td>";
									break;
								case 'trnamt':
									table+="<td style='min-width: 80px ! important;padding: 0px;vertical-align: middle;text-align:right;'><div style='width: 65px;padding: 0px 3px;'  class='uk-text-truncate'>"+format_numero_(tb[n][b][c])+"</div></td>";
									break;
								case 'checknum':	
									table+="<td style='min-width: 80px ! important;padding: 0px;vertical-align: middle;'><div style='width: 65px;padding: 0px 3px;'  class='uk-text-truncate'>"+tb[n][b][c]+"</div></td>";
									break;
								case 'memo':	
									table+="<td style='min-width: 150px ! important;padding: 0px;vertical-align: middle;'><div style='width: 135px;padding: 0px 3px;'  class='uk-text-truncate'>"+tb[n][b][c]+"</div></td>";
									break;

							} 						
							
						}
					}
				}
				var input_conta="";
					input_conta+= "<div class=' uk-autocomplete' data-uk-autocomplete='{source:bs_conta}' style=''>";
					input_conta+= "<input  coluna='conta_ofx' id='n_cta_ofx_"+n+"' placeholder='' class='uk-form-small' type='text' style='width: 140px; margin-left: 10px; ' value=''/>";
					input_conta+= "</div>";	
					
				var input_ctr_custo="";
					input_ctr_custo+= "<div class=' uk-autocomplete' data-uk-autocomplete='{source:bs_ctrcusto}' style=''>";
					input_ctr_custo+= "<input  coluna='ctr_custo_ofx' id='n_ctr_c_ofx_"+n+"' placeholder='' class='uk-form-small' type='text' style='width: 140px; margin-left: 10px; ' value=''/>";
					input_ctr_custo+= "</div>";		
					
				table+="<td style='min-width: 150px ! important; padding: 0px;vertical-align: middle;' class='ofx_conta' >"+input_conta+"</td>";
				table+="<td style='min-width: 150px ! important; padding: 0px;vertical-align: middle;' class='ofx_ctr_custo'>"+input_ctr_custo+"</td>";			
				table+="<td style='min-width: 20px;padding: 0px;vertical-align: middle;'><button data-cached-title='Excluir linha' class='uk-button uk-button-mini uk-button-danger' type='button' onclick=delRow(this,'table_ofx') data-uk-tooltip='' title='' style='margin-left: 10px;'><i class='uk-icon-trash-o'></i></button></td>";
				table+="</tr>";
				
				
			}
		 
		 
		 
		 table+="</tbody>";
		 table+="</table>";
		//console.log(table);
		document.getElementById('div_preview').innerHTML = table;
		for(var n=0;n<Object.keys(tb).length;n++){
			document.getElementById("n_cta_ofx_"+n).addEventListener("click", verificar_ajax_ofx_input);
			document.getElementById("n_cta_ofx_"+n).addEventListener("change", verificar_ajax_ofx_input);
			document.getElementById("n_cta_ofx_"+n).addEventListener("onblur", verificar_ajax_ofx_input);
			document.getElementById("n_cta_ofx_"+n).addEventListener("keyup", verificar_ajax_ofx_input);
			document.getElementById("n_cta_ofx_"+n).addEventListener("keydown", verificar_ajax_ofx_input);
			
			document.getElementById("n_ctr_c_ofx_"+n).addEventListener("click", verificar_ajax_ofx_input);
			document.getElementById("n_ctr_c_ofx_"+n).addEventListener("change", verificar_ajax_ofx_input);
			document.getElementById("n_ctr_c_ofx_"+n).addEventListener("onblur", verificar_ajax_ofx_input);
			document.getElementById("n_ctr_c_ofx_"+n).addEventListener("keyup", verificar_ajax_ofx_input);
			document.getElementById("n_ctr_c_ofx_"+n).addEventListener("keydown", verificar_ajax_ofx_input);
		}

		
	}



	function verificar_ajax_ofx_input(){
		var coluna=this.getAttribute("coluna");
		if(coluna=="conta_ofx"){ var cadatro="cod_conta"}
		if(coluna=="ctr_custo_ofx"){ var cadatro="cod_centro_custo"}
		if(cadatro!=null){verificar_ajax_ofx(cadatro,this.value,this.id);}
		
	}
	function verificar_ajax_ofx(cadastro,cod_,id){
		var xhr = new XMLHttpRequest();
		var formData = new FormData();				
		var metodo = "POST";
		var url = "php/verificar_cadastro.php";
		formData.append('cadastro', cadastro);
		formData.append('valor', cod_);
		xhr.onreadystatechange = function()
		{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
				var classe_=xhr.responseText;
				if(document.getElementById(id)!=null){
					var elemento = document.getElementById(id);
						elemento.className=classe_;
					var classes=elemento.className;
				}

				//if(classes.indexOf("uk-form-success")>-1){ elemento.parentNode.innerHTML=elemento.value;}
			}
		}		
		xhr.open(metodo, url);
		xhr.overrideMimeType('text/xml; charset=utf-8');			
		xhr.send(formData);					
	}	
	function salvar_ajax_ofx(id_responseText,metodo, url,formData){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function()
				{
					if(xhr.readyState == 4 && xhr.status == 200)
					{
						document.getElementById(id_responseText).innerHTML+=xhr.responseText;

					}
				}			
				xhr.open(metodo, url);
				xhr.overrideMimeType('text/xml; charset=utf-8');			
				xhr.send(formData);
	}
	function importar_transacoes_ofx(){
	//////função ajax para verificar cadatro

		var arquivo=document.getElementById('input_selecionar_ofx');
		var conta=document.getElementById('cod_conta');
		var tabela=document.getElementById('table_ofx');
		
		//verificar se algum arquivo está selecionado
			if (arquivo.value==''){
				arquivo.className=" uk-form-small uk-form-danger "
			}else{
				arquivo.className=" uk-form-small uk-form-success "
			}
		
		//verificar se a conta contabil foi indicada
				//cod_centro_custo
			if(conta!= null){
				if(conta.value!=""){
					verificar_ajax_ofx('cod_conta',conta.value,conta.id);
				}else{
					document.getElementById(conta.id).className=" uk-form-small uk-form-danger";
					document.getElementById(conta.id).setAttribute("conferido", "erro");
				}
			}
		//verificar se a tabela foi montada
		if(tabela!=null){
			//verificar se as contas contabeis foram preenchidas
				var conta_ofx=document.querySelectorAll("[coluna='conta_ofx']");
				for(var n=0;n<conta_ofx.length;n++){
					if(conta_ofx[n].value==""){conta_ofx[n].className="﻿﻿﻿﻿﻿﻿ uk-form-small uk-form-danger";}
				}
		
			//verificar se os centros de custo foram preenchidos
				var ctr_custo_ofx=document.querySelectorAll("[coluna='ctr_custo_ofx']");
				for(var n=0;n<ctr_custo_ofx.length;n++){
					if(ctr_custo_ofx[n].value==""){ctr_custo_ofx[n].className="﻿﻿﻿﻿﻿﻿ uk-form-small uk-form-danger";}
				}
				
			//transformar tudo em table
			var conta=document.querySelectorAll("[coluna='conta_ofx']")
			for(n=0;n<conta.length;n++){
				var elemento = document.getElementById(conta[n].id);
				var classes=elemento.className;				
				if(classes.indexOf("uk-form-success")>-1){ elemento.parentNode.innerHTML=elemento.value;}
			}			
			var ctr_custo=document.querySelectorAll("[coluna='ctr_custo_ofx']")
			for(n=0;n<ctr_custo.length;n++){
				var elemento = document.getElementById(ctr_custo[n].id);
				var classes=elemento.className;				
				if(classes.indexOf("uk-form-success")>-1){ elemento.parentNode.innerHTML=elemento.value;}
			}			
			
			
			
			//verificar dangers
			var danger=document.getElementsByClassName("uk-form-danger");
			var success=document.getElementsByClassName("uk-form-success");
			if(danger.length==0 && success.length==1){
			////////////////////////////////////////////////////////////////////////////////////////////////
				// montar matriz de itens
				
			var tabela=document.getElementsByTagName("table");
			var tr=tabela[0].getElementsByTagName("tr");
			console.log(tr.length);

			var data_vencimento_liquidacao="";
			var codigo_lancamento="";
			var montante="";
			var cod_ctr_custo="";
			var cod_conta="";
			var historico="";
			var itens="";
			var td="";
			var msg="";
			
			var id_responseText="msg";
			var metodo="POST";
			var url="php/salvar_cad_documento.php";
			var cod_conta_banco=document.getElementById("cod_conta_banco").innerHTML;
			var cod_documento=document.getElementById("input_selecionar_ofx").value;
			
			document.getElementById(id_responseText).innerHTML="";
			
			for (var n=1;n<tr.length;n++){
					td=tr[n].getElementsByTagName("td");

					data=td[0].childNodes[0].innerHTML;
					data = data.split('/');	
					exercicio=data[2];	
					periodo=data[1];
					
					if(Number(td[1].childNodes[0].innerHTML)>=0){codigo_lancamento= "D"}else{codigo_lancamento= "C"};	
					if(Number(td[1].childNodes[0].innerHTML)>=0){codigo_lancamento_= "C"}else{codigo_lancamento_= "D"};	
					
					itens="[{";
					itens+="'codigo_lancamento':'"+codigo_lancamento+"',";
					itens+="'cod_ctr_custo':'"+td[5].childNodes[0].innerHTML+"',";
					itens+="'cod_conta':'"+cod_conta_banco+"',";
					itens+="'historico':'"+td[3].childNodes[0].innerHTML+"',";
					itens+="'montante':'"+Math.abs(Number(td[1].childNodes[0].innerHTML))+"',";
					itens+="'data_vencimento_liquidacao':'"+td[0].childNodes[0].innerHTML+"'";
					itens+="},{";
					itens+="'codigo_lancamento':'"+codigo_lancamento_+"',";
					itens+="'cod_ctr_custo':'"+td[5].childNodes[0].innerHTML+"',";
					itens+="'cod_conta':'"+td[4].childNodes[0].innerHTML+"',";
					itens+="'historico':'"+td[3].childNodes[0].innerHTML+"',";
					itens+="'montante':'"+Math.abs(Number(td[1].childNodes[0].innerHTML))+"',";
					itens+="'data_vencimento_liquidacao':'"+td[0].childNodes[0].innerHTML+"'";
					itens+="}]";
					
				var formData = new FormData();
					formData.append("cod_documento",cod_documento);
					formData.append("cod_tipo_documento","4" );
					formData.append("referencia",td[2].childNodes[0].innerHTML);
					formData.append("texto_cabecalho_documento",td[2].childNodes[0].innerHTML);
					formData.append("data_lancamento",td[0].childNodes[0].innerHTML);
					formData.append("data_base",td[0].childNodes[0].innerHTML);
					formData.append("exercicio",exercicio);
					formData.append("periodo",periodo);
					formData.append("itens", itens);
				salvar_ajax_ofx(id_responseText,metodo, url,formData);
			}


	
		
		
		
		
			////////////////////////////////////////////////////////////////////////////////////////////////					
				
				
				
				
				
				
				
				
			}
			
			
			
			

			//criar o json
			
			
			

		}

	}
	
////compesação //////
	function compensacao_calcular(){
		var input = document.querySelectorAll('input[type=checkbox]');
		var total=0;
		for(var n=0;n<input.length;n++){
			if(input[n].checked==true){total=total+Number(input[n].value);}
		}
		document.getElementById('diferenca').value=total.toFixed(2);	
		
	}
	function compensacao_selecionar_todos(status){
		var input = document.querySelectorAll('input[type=checkbox]');
		for(var n=0;n<input.length;n++){
			input[n].checked=status;
		}
		compensacao_calcular();

	}
	function compensacao_compensar(){
		var input = document.querySelectorAll('input[type=checkbox]');
		var x=0;
		var total=0;
		var itens="";	
		
		for(var n=0;n<input.length;n++){
			if(input[n].checked==true){total=total+Number(input[n].value);x++;}
		}
				
		if((document.getElementById('diferenca').value=='0' || document.getElementById('diferenca').value=='0.00') && total==0 && x>=2){

			for(var n=0;n<input.length;n++){
				if(input[n].checked==true){itens+=","+input[n].id;}
			}
				id_responseText="msg";
				metodo="POST";
				url="php/conciliacao.php";
				var formData = new FormData();
					formData.append("act","conciliar" );
					formData.append("itens", itens);

				ajax(id_responseText, metodo, url,formData,'reload');				
			
		}else{
			alert("Para efetuar a compensação a diferença deve ser igual a zero!");
		}
		
		
	}
	
	


$(function(){$( "#bt_selecionar_ofx" ).click(function(){document.getElementById('file-input').click();});});




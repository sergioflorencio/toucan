
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
	function pesquisar_orcamento(){
		

		
			id_responseText="msg";
			metodo="POST";
			url="php/orcamento.php";
			var formData = new FormData();

			formData.append("cod_orcamento", document.getElementById('cod_orcamento').value);
			formData.append("cod_centro_custo", document.getElementById('cod_centro_custo').value);
			formData.append("act", "pesquisar");
			
			var xhr_ = new XMLHttpRequest();
			xhr_.onreadystatechange = function()
			{
				if(xhr_.readyState == 4 && xhr_.status == 200)
				{
					//document.getElementById(id_responseText).innerHTML=xhr_.responseText;
					
					var js_data = xhr_.responseText;
						js_data=js_data.replace("}]","");
						js_data=js_data.replace("[{","");
						js_data=js_data.split("},{");

					var inputs=document.querySelectorAll("input[class='x_y']");
						
					for(var w=0;w<inputs.length;w++){
						inputs[w].value="0.00";

					}
					var inputs=document.querySelectorAll("input[class='historico']");
						
					for(var w=0;w<inputs.length;w++){
						inputs[w].value="";

					}
					for(var a=0;a<js_data.length;a++){
						js_data[a]=js_data[a].split(",");
						for(var b=0;b<js_data[a].length;b++){
							js_data[a][b]=js_data[a][b].split(":");
							js_data[a][js_data[a][b][0]]=js_data[a][b][1];
						}						
					}

					for(var r=0;r<js_data.length;r++){
						
						var id=js_data[r][3][1]+"_"+js_data[r][4][1].replace("'","");
							id=id.replace("'","");
							document.getElementById(id).value=js_data[r][5][1];

					}
					
					console.log(js_data);
					for(var r=0;r<js_data.length;r++){
						
						var id=js_data[r][3][1]+"_historico";
							js_data[r][6][1]=js_data[r][6][1].replace("'","");
							js_data[r][6][1]=js_data[r][6][1].replace("'","");
							document.getElementById(id).value=js_data[r][6][1];

					}
				}
			}			
			xhr_.open(metodo, url);
			xhr_.overrideMimeType('text/xml; charset=utf-8');			
			xhr_.send(formData);
			


		
		
	}
	function salvar_orcamento(){
				
				id_responseText="msg";
				metodo="POST";
				url="php/orcamento.php";
				var inputs=document.querySelectorAll("input[class='x_y']");
				var formData = new FormData();
				var bs=[];
				document.getElementById(id_responseText).innerHTML="";
				
				for(var q=0;q<inputs.length;q++){
					var data="01-"+inputs[q].getAttribute("data_");
						data=data.split("-");
						data=data[2]+"-"+data[1]+"-"+data[0];
					//console.log(data);
					
					var id_historico=inputs[q].id.split("_");
						id_historico=id_historico[0]+"_historico";
					
					bs[q]=[document.getElementById('cod_orcamento').value,document.getElementById('cod_centro_custo').value,inputs[q].getAttribute("cod_conta"),data,inputs[q].value,document.getElementById(id_historico).value];
				
					//console.log(new Date(inputs[q].getAttribute("data_")));
					//console.log("01-"+inputs[q].getAttribute("data_"));
				}
				
				//console.log(bs);
				
					formData.append("bs", JSON.stringify(bs));
					formData.append("campos", "`cod_orcamento`,`cod_centro_custo`,`cod_conta`,`data`,`valor`,`historico`");
					formData.append("cod_orcamento", document.getElementById('cod_orcamento').value);
					formData.append("cod_centro_custo", document.getElementById('cod_centro_custo').value);
					
					
				//	
					formData.append("act", "salvar");
				//	formData.append("status", document.getElementById('status').value);
				//	formData.append("act", "editar");
				//	formData.append("mod", tabela);
				
					
				ajax(id_responseText, metodo, url,formData,'');

	}
	function pesquisar_cod_orcamento_centro_custo(){
				id_responseText="cod_orcamento_centro_custo";
				metodo="POST";
				url="php/pesquisa_real_orcado.php";
				var formData = new FormData();
				//document.getElementById(id_responseText).innerHTML="";
				formData.append("cod_orcamento", document.getElementById('cod_orcamento').value);
				formData.append("act", "pesquisar");
				formData.append("mod", "cod_orcamento_centro_custo");

					
				ajax(id_responseText, metodo, url,formData,'');
	}

	
	
	
	
	
	
	
	
	
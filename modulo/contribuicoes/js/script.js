function ajax(id_responseText, metodo, url,formData){
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById(id_responseText).innerHTML=xhr.responseText;
				}
			}			
			xhr.open(metodo, url);

			xhr.overrideMimeType('text/xml; charset=utf-8');			
			xhr.send(formData);
}
function ajax_return(id_responseText, metodo, url,formData){
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById(id_responseText).innerHTML=document.getElementById(id_responseText).innerHTML+xhr.responseText;
				}
			}			
			xhr.open(metodo, url);

			xhr.overrideMimeType('text/xml; charset=utf-8');			
			xhr.send(formData);
}


function formatar_numero(valor){
	valor = valor.replace( "-", "" );
	valor = valor.replace( ",", "" );
	valor = valor.replace( ".", "" );
	valor = valor.replace( "/", "" );
	valor = valor.replace( "(", "" );
	valor = valor.replace( ")", "" );
	valor = valor.replace( " ", "" );
	valor=valor/100
	return valor.toFixed(2);


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

function calculartotalcarta(){


	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
		xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var quantidade=formatar_numero(document.getElementById("carta_qtd_moeda").value);
				var valor_moeda=xmlhttp.responseText;
				var total_carta=quantidade*valor_moeda;
				document.getElementById("carta_qtd_moeda").value=quantidade;
				document.getElementById("carta_valor_moeda").value=total_carta.toFixed(2);
		
			}
	}
	var data_base = "valor_moeda="+document.getElementById("cod_moeda").value;
	xmlhttp.open("POST","php/consulta.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.overrideMimeType('text/xml; charset=utf-8');
	xmlhttp.send(data_base);


 }
 
function formatar_decimal(id){
	id.value=formatar_numero(id.value);
 }
 
function listar_boletos_recibos(tipo,convenio,layout){

	var txt='';

	//Nova Janela
	myWindow=window.open('','','width=auto,height=auto,scrollbars=1');
	
	//Consultar recibos/boletos
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	i = 0;

	function pesquisar(convenio,layout,id,i,checked){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{


//							myWindow.document.write("<div style='page-break-after: always'>"+xmlhttp.responseText+"</div>");
							myWindow.document.write(xmlhttp.responseText);
						i++;//alert(txt);
						if (i <= x.length-1){
							pesquisar(convenio,layout,x[i].id,i,x[i].checked);
						}else {
						}
					}
			}

			if(tipo=='boleto'){
				xmlhttp.open("GET","boleto/boleto_itau.php/?id="+id+"&convenio="+convenio, true);
			}
			if(tipo=='recibo'){
				xmlhttp.open("GET","comprovantes/comprovante.php/?id="+id+"&layout="+layout, true);
			}
		//	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		//	xmlhttp.overrideMimeType('text/xml; charset=utf');
			if(checked==1){
				xmlhttp.overrideMimeType('text/xml; charset=utf-8');
				xmlhttp.send();	
			}else{i++; pesquisar(convenio,layout,x[i].id,i,x[i].checked);}
	}
	

	
	
	
	//Percorrer Checkbox
	var x = document.getElementsByClassName("checkbox_selecionar");
	if(x.length==0){
		var _id=document.getElementById("cod_captacao_cartas").value;
		pesquisar(convenio,layout,_id,i,1);
	}
	var text = "";
	if (i < x.length){
		var _id=x[i].id;
		pesquisar(convenio,layout,_id,i,x[i].checked);
	}
	

	


}
function listar_itens_baixa_em_lote(){
	document.getElementById("itens_baixa_em_lote").innerHTML="";
	document.getElementById("cod_captacao_carta_baixa_lote").value="";
	document.getElementById("valor_baixa_lote").value="";
	//Percorrer Checkbox
	var x = document.getElementsByClassName("checkbox_selecionar");
	for(i=0;i < x.length;i++){
		
		if(x[i].checked==true){
				id_responseText="itens_baixa_em_lote";
				metodo="POST";
				url="php/listar_itens_baixa_em_lote.php";
				var formData = new FormData();
					formData.append("cod_captacao_carta", x[i].id);
				ajax_return(id_responseText, metodo, url,formData);
				document.getElementById("cod_captacao_carta_baixa_lote").value+="{"+x[i].id+"}"
				document.getElementById("valor_baixa_lote").value+="{"+x[i].getAttribute("valor_captacao")+"}"
		}
	}
	

}

function marcar_checkbox(check){
	var x = document.getElementsByClassName("checkbox_selecionar");
	for (i=0;i < x.length;i++){
		if(check=='m' && document.getElementById(x[i].id).disabled == false){
				document.getElementById(x[i].id).checked = true;
		}else{
				document.getElementById(x[i].id).checked = false;
		}

	}

		var tabela = document.getElementsByTagName("table"); 
//Sistema
		for (var i=1;i<=tabela[0].getElementsByTagName("tr").length-1;i++){
			if(check=='m'){
				tabela[0].getElementsByTagName("tr")[i].className="uk-alert-success";
			}else{
				tabela[0].getElementsByTagName("tr")[i].className="";
			}

		}		
//Arquivo
		for (var i=1;i<=tabela[1].getElementsByTagName("tr").length-1;i++){
			if(check=='m'){
				tabela[1].getElementsByTagName("tr")[i].className="uk-alert-success";
			}else{
				tabela[1].getElementsByTagName("tr")[i].className="";
			}
		}	
	
	
	
	
}

function calcular_conciliacao(){
	
		var tabela = document.getElementsByTagName("table"); 
		var total_arquivo=0;
		var total_sistema=0;
//Sistema
		for (var i=1;i<=tabela[0].getElementsByTagName("tr").length-1;i++){
				id=tabela[0].getElementsByTagName("tr")[i].getElementsByTagName('td')[2].textContent;
			if(document.getElementById("tr_sitema_"+id).checked == true){

				total_sistema=total_sistema+Number(document.getElementById("tr_sitema_"+id).getAttribute("valor_baixa"));
			}
		}		
//Arquivo
		for (var i=1;i<=tabela[1].getElementsByTagName("tr").length-1;i++){
				id=tabela[1].getElementsByTagName("tr")[i].getElementsByTagName('td')[2].textContent;
			if(document.getElementById("tr_arquivo_"+id).checked == true){

				total_arquivo=total_arquivo+Number(document.getElementById("tr_arquivo_"+id).getAttribute("valor_baixa"));
			}
		}		

//Total
		document.getElementById("total_arquivo").value=total_arquivo.toFixed(2);
		document.getElementById("total_sistema").value=total_sistema.toFixed(2);
		var diferenca=total_arquivo.toFixed(2)-total_sistema.toFixed(2);
		document.getElementById("diferenca").value=diferenca.toFixed(2);

}

function marcar_conciliar_historico(){
		var tabela = document.getElementsByTagName("table"); 
		var historico_conciliar="";
		var historico_sistema="";
		var historico_arquivo="";
//Sistema
		for (var i=1;i<=tabela[0].getElementsByTagName("tr").length-1;i++){
				historico_sistema=document.getElementById("historico_sistema").value; 
				historico_conciliar=tabela[0].getElementsByTagName("tr")[i].getElementsByTagName('td')[3].textContent; 
				id=tabela[0].getElementsByTagName("tr")[i].getElementsByTagName('td')[2].textContent;

			if(historico_conciliar.indexOf(historico_sistema)!= -1){
				document.getElementById("tr_sitema_"+id).checked = true;
//				alert(document.getElementById("tr_sitema_"+id).getAttribute("valor_baixa"));
			}
			else{
				document.getElementById("tr_sitema_"+id).checked = false;
			}
	
		}
//Arquivo
		for (var i=1;i<=tabela[1].getElementsByTagName("tr").length-1;i++){
				historico_sistema=document.getElementById("historico_arquivo").value; 
				historico_conciliar=tabela[1].getElementsByTagName("tr")[i].getElementsByTagName('td')[3].textContent; 
				id=tabela[1].getElementsByTagName("tr")[i].getElementsByTagName('td')[2].textContent;

			if(historico_conciliar.indexOf(historico_sistema)!= -1){
				document.getElementById("tr_arquivo_"+id).checked = true;
//				alert(document.getElementById("tr_sitema_"+id).getAttribute("valor_baixa"));
			}
			else{
				document.getElementById("tr_arquivo_"+id).checked = false;
			}
	
		}

//Calcular
	calcular_conciliacao();


}

function salvar_conciliacao(){

	if(document.getElementById("diferenca").value==0.00){
	
	
		var tabela = document.getElementsByTagName("table"); 
		var arquivo="";
		var sistema="";


//Sistema
		for (var i=1;i<=tabela[0].getElementsByTagName("tr").length-1;i++){
				id=tabela[0].getElementsByTagName("tr")[i].getElementsByTagName('td')[2].textContent;
			if(document.getElementById("tr_sitema_"+id).checked == true){
				sistema=sistema+" cod_captacao_cartas_baixas='"+id+"' or ";
				document.getElementById("tr_sitema_"+id).disabled = true;
				document.getElementById("tr_sitema_"+id).checked = false;
			}
		}		
//Arquivo
		for (var i=1;i<=tabela[1].getElementsByTagName("tr").length-1;i++){
				id=tabela[1].getElementsByTagName("tr")[i].getElementsByTagName('td')[2].textContent;
			if(document.getElementById("tr_arquivo_"+id).checked == true){
				arquivo=arquivo+" cod_arquivo_ofx_lancamentos='"+id+"' or ";
				document.getElementById("tr_arquivo_"+id).disabled = true;
				document.getElementById("tr_arquivo_"+id).checked = false;
			}
		}	

		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
		xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				alert(xmlhttp.responseText);
				}
			  }
		var data_base = "arquivo="+arquivo+"&sistema="+sistema;
		xmlhttp.open("POST","php/conciliacao.php", true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.overrideMimeType('text/xml; charset=utf-8');
		xmlhttp.send(data_base);
	
	
	}
	else{
		alert("Há diferenças a serem conciliadas.");
		}



}


function enviar_arquivo_conciliacao(){
	if (document.getElementById("arquivo_conciliacao").files[0]!=undefined){
		var formData = new FormData();
		formData.append('my_uploaded_file', document.getElementById("arquivo_conciliacao").files[0]);
		formData.append('conciliacao','upload');
		var xhr = new XMLHttpRequest();

		
		xhr.onreadystatechange = function()
		{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
				document.getElementById("tb_extrato").innerHTML=xhr.responseText;
			//	pesquisar_conciliacao();
			}
		}
		
		xhr.open("POST", 'php/conciliacao.php');
		xhr.send(formData);

	}
  
}
function gravar_arquivo_conciliacao(){
	
	var carteira=document.getElementById("carteira").value;


	if (carteira!=""){

		var tabela = document.getElementsByTagName("table"); // alert(5.1);
		var linhas=tabela[0].getElementsByTagName('tr');
		var j=linhas.length-1
		var data_inicio=tabela[0].getElementsByTagName('tr')[2].getElementsByTagName('td')[1].textContent;
		var data_fim=tabela[0].getElementsByTagName('tr')[j].getElementsByTagName('td')[1].textContent;
		
		
		
		var tb=
		"'"+carteira+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[2].getElementsByTagName('td')[0].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[2].getElementsByTagName('td')[1].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[2].getElementsByTagName('td')[2].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[2].getElementsByTagName('td')[3].textContent.replace(" ","")+"',"+
		""+tabela[0].getElementsByTagName('tr')[2].getElementsByTagName('td')[4].textContent.replace(" ","")+","+
		"'"+tabela[0].getElementsByTagName('tr')[2].getElementsByTagName('td')[5].textContent+"'),";

		
		for (var i=3;i<=linhas.length-2;i++){

		tb=tb+
		"('"+carteira+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[0].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[1].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[2].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[3].textContent.replace(" ","")+"',"+
		""+tabela[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[4].textContent.replace(" ","")+","+
		"'"+tabela[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[5].textContent+"'),";

		}//alert(10);

		tb=tb+
		"('"+carteira+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[j].getElementsByTagName('td')[0].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[j].getElementsByTagName('td')[1].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[j].getElementsByTagName('td')[2].textContent.replace(" ","")+"',"+
		"'"+tabela[0].getElementsByTagName('tr')[j].getElementsByTagName('td')[3].textContent.replace(" ","")+"',"+
		""+tabela[0].getElementsByTagName('tr')[j].getElementsByTagName('td')[4].textContent.replace(" ","")+","+
		"'"+tabela[0].getElementsByTagName('tr')[j].getElementsByTagName('td')[5].textContent+"'";
		
		var xmlhttp;
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
		else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("tb_extrato").innerHTML=xmlhttp.responseText;
				}
			}
				  
		var data_base = "conciliacao=inserir_arquivo_ofx_lancamentos&tb="+tb+"&data_inicio="+data_inicio+"&data_fim="+data_fim+"&carteira="+carteira;
		xmlhttp.open("POST","php/conciliacao.php", true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.overrideMimeType('text/xml; charset=utf-8');
		xmlhttp.send(data_base);
		
		}
		else{
		alert("Escolha uma Carteira.");
		}

}

function enviar_arquivo_retorno(){
	if (document.getElementById("arquivo_retorno").files[0]!=undefined){
		var formData = new FormData();
		formData.append('my_uploaded_file', document.getElementById("arquivo_retorno").files[0]);
		var xhr = new XMLHttpRequest();

		
		xhr.onreadystatechange = function()
		{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
				document.getElementById("tb_extrato").innerHTML=xhr.responseText;

			}
		}
		
		xhr.open("POST", 'php/upload_file_retorno.php', true);
		xhr.overrideMimeType('text/xml; charset=utf-8');
		xhr.send(formData);

	}
  
}


function mudar_status_captacao(cod_captacao_carta,consulta){
	function mudar_status(cod_captacao_carta,consulta){
		var xmlhttp;
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
		else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("msg").innerHTML=xmlhttp.responseText;
				}
			}
				  
		var data_base = "cod_captacao_carta="+cod_captacao_carta;
		xmlhttp.open("POST",consulta, true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.overrideMimeType('text/xml; charset=utf-8');
		xmlhttp.send(data_base);
	
	}

var txt;
var r = confirm("Deseja confirmar continuar?");
if (r == true) {
		mudar_status(cod_captacao_carta,consulta);
	} else {

	}


}



function data_fim_carta_aberta(){
	if(document.getElementById('carta_aberta').value=="aberta"){
	document.getElementById('carta_data_fim').value="31/12/2050";
	}else{
	if(document.getElementById('carta_aberta').value=="avulso"){
	document.getElementById('carta_data_fim').value=document.getElementById('carta_data_inicio').value;
	var dia =document.getElementById('carta_data_inicio').value;
	var dia =dia.substr(0, 2);
	}}
}

function pesquisacep(){
	
		document.getElementById("pesquisa_cep").innerHTML="<div style='text-align: center;'><i class='uk-icon-refresh uk-icon-spin'></i> Pesquisando... </div>";

		filtro=document.getElementById("txt_pesquisa_cep").value;
	
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
			xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("pesquisa_cep").innerHTML=xmlhttp.responseText;
				}
		}

		var data_base = "metodo=cep&filtro="+filtro;
		xmlhttp.open("POST","php/correios.php", true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//		xmlhttp.overrideMimeType('text/xml; charset=utf-8');
		xmlhttp.send(data_base);
}
function selecionarcep(linha){
	var linha=document.getElementById(linha).getElementsByTagName("td");
	document.getElementById('endereco').value=linha[0].innerHTML;
	document.getElementById('bairro').value=linha[2].innerHTML;
	document.getElementById('cidade').value=linha[4].innerHTML;
	document.getElementById('uf').value=linha[6].innerHTML;
	document.getElementById('cep').value=linha[8].innerHTML;

}


function salvar_carta(){
	check=0;
		function validar(id){
			if(
				document.getElementById(id).value=='' || 
				document.getElementById(id).value==null|| 
				document.getElementById(id).value=='0,00'|| 
				document.getElementById(id).value=='0.00'
				
				){
				document.getElementById(id).className = "uk-form-small uk-form-danger";
				check+=1;
			}
		
		}
		validar('cod_pessoa');
		validar('cod_colaborador');
		validar('cod_ctrreceita');
		validar('carta_aberta');
		validar('periodicidade');
		validar('dia_debito');
		validar('cod_moeda');
		validar('carta_data_inicio');
		validar('carta_data_fim');
		validar('carta_qtd_moeda');
		validar('carta_valor_moeda');
		validar('tipo_convenio');
		
		if(check==0){
			document.getElementById("form_carta").submit();
		
		}

}
function salvar_carta_avulsa(){
	check=0;
		function validar(id){
			if(
				document.getElementById(id).value=='' || 
				document.getElementById(id).value==null|| 
				document.getElementById(id).value=='0,00'|| 
				document.getElementById(id).value=='0.00'
				
				){
				document.getElementById(id).className = "uk-form-small uk-form-danger";
				check+=1;
			}
		
		}
		validar('cod_pessoa');		
		validar('cod_colaborador');	
		validar('cod_ctrreceita');		
		validar('cod_moeda');		
		validar('carta_data_inicio');		
		validar('carta_qtd_moeda');		
		validar('carta_valor_moeda');		

		
		if(check==0){
			document.getElementById("form_carta").submit();
		
		}

}
function gerar_senha(){

		data_base="cod_usuario="+document.getElementById("cod_usuario").value;

		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
			xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("div_msg").innerHTML=xmlhttp.responseText;
				}
		}


		xmlhttp.open("POST","login/gerar_senha.php", true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//		xmlhttp.overrideMimeType('text/xml; charset=utf-8');
		xmlhttp.send(data_base);
}

function enviar_dados_acesso_colaborador(cod_colaborador){
	
		id_responseText="div_msg";
		metodo="POST";
		url="areadocolaborador/email_dados_acesso.php";
		var formData = new FormData();
			formData.append("cod_colaborador", cod_colaborador);
		ajax(id_responseText, metodo, url,formData);

}


function atualizar_valor_cartas(){

	var cod_moeda=document.getElementById("cod_moeda_carta").value;

	if (cod_moeda==''){
		alert('Selecione uma moeda para utilizar.');
	}else{
	

			data_base="cod_moeda="+cod_moeda;

			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
				xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					document.getElementById("div_msg").innerHTML=xmlhttp.responseText;
					}
			}


			xmlhttp.open("POST","php/atualizar_valor_carta.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(data_base);
	
	}

}






  
  
  
  
  
  
  function selecionarpessoa(id,valor,_id_id,_id_valor){
	document.getElementById(_id_id).value=id;
 	document.getElementById(_id_valor).value=valor;

  
  }
  
  
function alertas(){
		id_responseText="div_alertas";
		metodo="POST";
		url="php/alertas.php";
		var formData = new FormData();
			formData.append("status", "ANV");
		ajax(id_responseText, metodo, url,formData);
}


function acao_alerta(a){
		id_responseText="div_alertas";
		metodo="POST";
		url="php/alertas.php";
		var formData = new FormData();
			formData.append("funcao", 'cad_alertas');
			formData.append("cod_alerta", a.getAttribute('cod_alerta'));
			formData.append("status_alerta", a.getAttribute('status_alerta'));
		ajax(id_responseText, metodo, url,formData);	
		
		id_responseText="cad_alertas_numero";
			formData.append("funcao", 'cad_alertas_numero');
			formData.append("status_alerta", 'ANV');
		ajax(id_responseText, metodo, url,formData);	
}


function contar_download(cod_arquivo){
		id_responseText="";
		metodo="POST";
		url="php/contar_download.php";
		var formData = new FormData();
			formData.append("cod_arquivo_bancario", cod_arquivo);
		ajax(id_responseText, metodo, url,formData);	
}



function excluir(tb,campo,id){
		id_responseText="msg";
		metodo="POST";
		url="php/excluir_cadastro.php";
		var formData = new FormData();
			formData.append("tabela", tb);
			formData.append("campo", campo);
			formData.append("id", id);
		ajax(id_responseText, metodo, url,formData);	
	
	
}


function exportar(formato,id_grid,base){
		document.getElementById("arquivo_gerado").innerHTML="";
		var formData = new FormData();
		formData.append('formato', formato);
		formData.append('base', base);


		if(base=='html'){
			var tabela=document.getElementById(id_grid).innerHTML;
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


function imprimir(id_div){

	metodo="POST";
	url="dependencias.php";
	formData="";
	
	//Nova Janela
	myWindow=window.open('','','width=auto,height=auto,scrollbars=1');
	
	var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function()
		{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
				html=document.getElementById(id_div).innerHTML;
				html+=xhr.responseText;
				myWindow.document.write(html);
			}
		}		
		xhr.open(metodo, url);
		xhr.overrideMimeType('text/xml; charset=utf-8');			
		xhr.send(formData);	
		


}








var cleanName = function(str) {
    if ($.trim(str) == '') return str; // jQuery
    str = $.trim(str).toLowerCase();
   var special = ['&', 'O', 'Z', '-', 'o', 'z', 'Y', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '+', '\'','\(','\)'],
        normal = ['ET', 'O', 'Z', '-', 'O', 'Z', 'Y', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'Y', '-', '','',''];
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


function baixar_itens_em_lote(){
	
	if(document.getElementById("cod_carteira_baixa_lote").value==""){
			alert("Selecione uma carteira para efetivar a baixa.");
	}else{
		if(document.getElementById("data_baixa_lote").value=="00/00/0000"){
			alert("Digite uma data válida");	
		}else{
				id_responseText="itens_baixa_em_lote";
				metodo="POST";
				url="php/baixa_em_lote.php";
				var formData = new FormData();
					formData.append("data_baixa_lote", document.getElementById("data_baixa_lote").value);
					formData.append("cod_carteira_baixa_lote", document.getElementById("cod_carteira_baixa_lote").value);
					formData.append("cod_captacao_carta_baixa_lote", document.getElementById("cod_captacao_carta_baixa_lote").value);
					formData.append("valor_baixa_lote", document.getElementById("valor_baixa_lote").value);
				ajax(id_responseText, metodo, url,formData);
			
				document.getElementById("cod_captacao_carta_baixa_lote").value="";
				document.getElementById("valor_baixa_lote").value="";
		}
		
		
	}
	
	
	
	
	
	
	
}


function importar_csv_ler_arquivo(content,separador){
	var body=content.split(/\r\n|\n/);
	var table="";
	 table+="";
	 table+="<button class='uk-button uk-button-small uk-button-primary uk-navbar-flip' style='margin-bottom: 10px;' type='button' onclick='validar_dados_importacao();'><i class='uk-icon-refresh uk-icon-refresh'></i> Validar dados da importação</button>";
	 table+="<button class='uk-button uk-button-small uk-button-primary uk-navbar-flip' style='margin-bottom: 10px;' type='button' onclick='salvar_importar_csv();'><i class='uk-icon-refresh uk-icon-save'></i> Salvar</button>";
	 table+="<table class='uk-table uk-table-condensed uk-table-hover uk-form'>";
	var campos="";
	//conferir campos obrigatorios
	
			campo=body[0].split(separador);
			for(i=0;i<campo.length;i++){
				campos+=i+":"+campo[i]+"|";
			}
			
			document.getElementById("div_arquivo_csv").innerHTML=campos;
			
			if(
				campo[0]=="cod_contribuinte" && 
				campo[1]=="nome_contribuinte" && 
				
				campo[2]=="cod_colaborador" && 
				campo[3]=="nome_colaborador" && 
				
				campo[4]=="cod_ctrreceita" && 
				campo[5]=="centro_receita" && 
				
				campo[6]=="valor" && 
				campo[7]=="data" 
			
			){
				for(l=0;l<body.length;l++){
					linha=body[l].split(separador);
						if(linha.length==8){
						table+="<tr>";
						
						for(c=0;c<linha.length;c++){
							if(l==0){
										table+= "<td>"+linha[c]+"</td>";
							}else{
								switch(c) {
									case 0:
										table+= "<td style='width: 70px;'><input type='text' id='"+l+"-"+c+"' name='"+l+"-"+c+"' class='uk-form-small' style='width: 100%;' value='"+linha[c]+"' disabled></td>";
										break;
									case 1:
										table+= "<td style='width: 150px;' class='uk-autocomplete uk-form' data-uk-autocomplete={source:filtro_pessoas}><input type='text' id='"+l+"-"+c+"' name='"+l+"-"+c+"' class='uk-form-small' style='width: 100%;' value='"+linha[c]+"'></td>";
										break;
										
									case 2:
										table+= "<td style='width: 70px;'><input type='text' id='"+l+"-"+c+"' name='"+l+"-"+c+"' class='uk-form-small' style='width: 100%;' value='"+linha[c]+"' disabled></td>";
										break;
									case 3:
										table+= "<td style='width: 150px;' class='uk-autocomplete uk-form' data-uk-autocomplete={source:filtro_colaboradores}><input type='text' id='"+l+"-"+c+"' name='"+l+"-"+c+"' class='uk-form-small' style='width: 100%;' value='"+linha[c]+"'></td>";
										break;
										
									case 4:
										table+= "<td style='width: 70px;'><input type='text' id='"+l+"-"+c+"' name='"+l+"-"+c+"' class='uk-form-small' style='width: 100%;' value='"+linha[c]+"' disabled></td>";
										break;
									case 5:
										table+= "<td style='width: 150px;' class='uk-autocomplete uk-form' data-uk-autocomplete={source:filtro_ctrreceita}><input type='text' id='"+l+"-"+c+"' name='"+l+"-"+c+"' class='uk-form-small' style='width: 100%;' value='"+linha[c]+"'></td>";
										break;
										
									default:
										table+= "<td style='width: 70px;'><input type='text' id='"+l+"-"+c+"' name='"+l+"-"+c+"' class='uk-form-small' style='width: 100%;' value='"+linha[c]+"' disabled ></td>";

								}
							
							}
 							

						}
						
						
						table+="</tr>";
						}
				}
				
				table+="</table>";
				table+="<label>linhas: </label><input type='text' style='width: 70px;' id='linhas' name='linhas' class='uk-form-small' style='width: 100%;' value='"+body.length+"' disabled >";
				table+="<input type='text' style='width: 70px;visibility: hidden;' id='colunas' name='colunas' class='uk-form-small' style='width: 100%;' value='"+body[0].split(separador).length+"' disabled >";
				document.getElementById("div_arquivo_csv").innerHTML=table;
				
			}else{
				document.getElementById("div_arquivo_csv").innerHTML="<div class='uk-alert uk-alert-danger' data-uk-alert=''><a href='' class='uk-alert-close uk-close'></a><p>As colunas da planilha estão fora de ordem ou nomeadas incorretamente, reordene e renomeie as colunas e tente novamente. (cod_contribuinte, nome_contribuinte, cod_colaborador, nome_colaborador, cod_ctrreceita, centro_receita, valor, data)</p></div>";
			}




}
function importar_csv(){
	var file = document.getElementById("input_arquivo_csv").files[0];
	var reader = new FileReader();
	reader.readAsText(file, "UTF-8");
	reader.onload = function(evt)
	{
		importar_csv_ler_arquivo(evt.target.result,";");
	}
}
function getFile_importar_csv(){
	document.getElementById('input_arquivo_csv').click();
}
var pesquisa_cod_cadastro_importar_csv = {
	 contribuinte: function(){
	var a=1; 
	var linhas=document.getElementById("linhas").value;
	var nome_razao_social=document.getElementById(a+"-1").value; 
	function pesquisa_cadastro(nome_razao_social){
		
			var formData = new FormData();
				formData.append("nome_razao_social", nome_razao_social);
			var metodo="POST";
			var url="php/consulta.php";
			var xhr = new XMLHttpRequest();		
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById(a+"-0").value=xhr.responseText;					
					if(document.getElementById(a+"-0").value==""){
						document.getElementById(a+"-0").className="uk-form-danger uk-form-small";
					}else{
						document.getElementById(a+"-0").className="uk-form-success uk-form-small";
					}

					if(a<=linhas){
						a++;
						nome_razao_social=document.getElementById(a+"-1").value;
						pesquisa_cadastro(nome_razao_social);

						
					}
				}
			}			
			xhr.open(metodo, url);
			xhr.overrideMimeType('text/xml; charset=utf-8');			
			xhr.send(formData);
		
	}


		pesquisa_cadastro(nome_razao_social);

	
	
},
	 colaborador: function(){
	var a=1; 
	var linhas=document.getElementById("linhas").value;
	var colaborador=document.getElementById(a+"-3").value; 
	function pesquisa_cadastro(colaborador){
			var formData = new FormData();
				formData.append("colaborador", colaborador);
			var metodo="POST";
			var url="php/consulta.php";
			var xhr = new XMLHttpRequest();		
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					
					document.getElementById(a+"-2").value=xhr.responseText;					
					if(document.getElementById(a+"-2").value==""){
						document.getElementById(a+"-2").className="uk-form-danger uk-form-small";
					}else{
						document.getElementById(a+"-2").className="uk-form-success uk-form-small";
					}

					if(a<=linhas){
						a++;
						colaborador=document.getElementById(a+"-3").value;
						pesquisa_cadastro(colaborador);

						
					}
				}
			}			
			xhr.open(metodo, url);
			xhr.overrideMimeType('text/xml; charset=utf-8');			
			xhr.send(formData);
		
	}

		pesquisa_cadastro(colaborador);

	
	
},
	 ctrreceita: function(){
	var a=1; 
	var linhas=document.getElementById("linhas").value;
	var ctrreceita=document.getElementById(a+"-5").value; 
	function pesquisa_cadastro(ctrreceita){
		
			var formData = new FormData();
				formData.append("ctrreceita", ctrreceita);
			var metodo="POST";
			var url="php/consulta.php";
			var xhr = new XMLHttpRequest();		
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById(a+"-4").value=xhr.responseText;					
					if(document.getElementById(a+"-4").value==""){
						document.getElementById(a+"-4").className="uk-form-danger uk-form-small";
					}else{
						document.getElementById(a+"-4").className="uk-form-success uk-form-small";
					}
					if(a<=linhas){
						a++;
						ctrreceita=document.getElementById(a+"-5").value;
						pesquisa_cadastro(ctrreceita);

						
					}
				}
			}			
			xhr.open(metodo, url);
			xhr.overrideMimeType('text/xml; charset=utf-8');			
			xhr.send(formData);
		
	}
	

		pesquisa_cadastro(ctrreceita);


	
	
	
}

}
function validar_dados_importacao(){
	pesquisa_cod_cadastro_importar_csv.contribuinte();
	pesquisa_cod_cadastro_importar_csv.colaborador();
	pesquisa_cod_cadastro_importar_csv.ctrreceita();
}
function salvar_importar_csv(){
	//Verificar campos
	
		var erros= document.getElementsByClassName("uk-form-danger");
		if(erros.length==0){
			//criar json
			var linhas=document.getElementById("linhas").value;
			var json="";
			for(a=1;a<=linhas-2;a++){

					json+="(";
					json+="'"+document.getElementById(a+"-0").value+"'@";
					json+="'"+document.getElementById(a+"-2").value+"'@";
					json+="'"+document.getElementById(a+"-4").value+"'@";
					json+="'"+document.getElementById(a+"-6").value+"'@";
					json+="'"+document.getElementById(a+"-7").value+"'";
					json+=")";		

			}

			id_responseText="div_arquivo_csv"; 
			metodo="POST";
			url="php/importar_cartas_avulsas.php"; 
			var formData = new FormData(); 
				formData.append("json", json); 
			ajax(id_responseText, metodo, url,formData); 
			
		}else{
			alert("Existem campos com dados inconsistentes, corrija os dados e tente salvar novamente.");
		}
}














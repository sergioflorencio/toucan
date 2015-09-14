
		function detalhe_carta(cod_carta){
			if (window.XMLHttpRequest)
			{
			xmlhttp=new XMLHttpRequest();
			}
			else
			{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
				xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{

						document.getElementById("conteudo_detalhe_carta").innerHTML=xmlhttp.responseText;

					}
			}

			var data_base = "cod_carta="+cod_carta;
			xmlhttp.open("POST","../comprovante_carta.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.overrideMimeType('text/xml; charset=utf-8');
			xmlhttp.send(data_base);
		
		}
		
		function pesquisar_contribuinte(cod_contribuinte){
			if (window.XMLHttpRequest)
			{
			xmlhttp=new XMLHttpRequest();
			}
			else
			{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
				xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{

						document.getElementById("conteudo_dados_contribuinte").innerHTML=xmlhttp.responseText;

					}
			}

			var data_base = "cod_pessoa="+cod_contribuinte+"&atualizar=0";
			xmlhttp.open("POST","../atualizar_contribuinte.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.overrideMimeType('text/xml; charset=utf-8');
			xmlhttp.send(data_base);
		
		}

		function salvar_contribuinte(cod_contribuinte){
			var txt;
			var r = confirm("Deseja salvar a alterações?");
			if (r == true) {
				if (window.XMLHttpRequest)
				{
				xmlhttp=new XMLHttpRequest();
				}
				else
				{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
					xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{

							document.getElementById("conteudo_dados_contribuinte").innerHTML=xmlhttp.responseText;

						}
				}

				var data_base ="&atualizar=1";
				data_base +="&cod_colaborador="+document.getElementById('cod_colaborador').value;
				data_base +="&cod_pessoa="+document.getElementById('contr_cod_pessoa').value;
				data_base +="&nome_razao_social="+document.getElementById('contr_nome_razao_social').value;
				data_base +="&endereco="+document.getElementById('contr_endereco').value;
				data_base +="&numero="+document.getElementById('contr_numero').value;
				data_base +="&complemento="+document.getElementById('contr_complemento').value;
				data_base +="&cep="+document.getElementById('contr_cep').value;
				data_base +="&bairro="+document.getElementById('contr_bairro').value;
				data_base +="&cidade="+document.getElementById('contr_cidade').value;
				data_base +="&uf="+document.getElementById('contr_uf').value;
				data_base +="&email_1="+document.getElementById('contr_email_1').value;
				data_base +="&email_2="+document.getElementById('contr_email_2').value;
				data_base +="&telefone_1="+document.getElementById('contr_telefone_1').value;
				data_base +="&telefone_2="+document.getElementById('contr_telefone_2').value;
				data_base +="&celular_1="+document.getElementById('contr_celular_1').value;
				data_base +="&celular_2="+document.getElementById('contr_celular_2').value;


				xmlhttp.open("POST","../atualizar_contribuinte.php", true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.overrideMimeType('text/xml; charset=utf-8');
				xmlhttp.send(data_base);
		}
	}

		function salvar_colaborador(cod_colaborador){
			var txt;
			var r = confirm("Deseja salvar a alterações?");
			if (r == true) {
			
					if (window.XMLHttpRequest)
					{
					xmlhttp=new XMLHttpRequest();
					}
					else
					{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
						xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{

								document.getElementById("conteudo_dados_contribuinte").innerHTML=xmlhttp.responseText;
								//xmlhttp.responseText;

							}
					}

					var data_base ="&atualizar=1";
					data_base +="&cod_colaborador="+document.getElementById('cod_colaborador').value;
					data_base +="&cod_pessoa="+document.getElementById('cod_pessoa').value;
					data_base +="&nome_razao_social="+document.getElementById('nome_razao_social').value;
					data_base +="&endereco="+document.getElementById('endereco').value;
					data_base +="&numero="+document.getElementById('numero').value;
					data_base +="&complemento="+document.getElementById('complemento').value;
					data_base +="&cep="+document.getElementById('cep').value;
					data_base +="&bairro="+document.getElementById('bairro').value;
					data_base +="&cidade="+document.getElementById('cidade').value;
					data_base +="&uf="+document.getElementById('uf').value;
					data_base +="&email_1="+document.getElementById('email_1').value;
					data_base +="&email_2="+document.getElementById('email_2').value;
					data_base +="&telefone_1="+document.getElementById('telefone_1').value;
					data_base +="&telefone_2="+document.getElementById('telefone_2').value;
					data_base +="&celular_1="+document.getElementById('celular_1').value;
					data_base +="&celular_2="+document.getElementById('celular_2').value;


					xmlhttp.open("POST","../atualizar_contribuinte.php", true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.overrideMimeType('text/xml; charset=utf-8');
					xmlhttp.send(data_base);
					
					
					
					
					
					
			
			}
		}


		
		
		
function pesquisacep(){

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
function enviar_email(){
	function enviar(){
					if (window.XMLHttpRequest)
					{
					xmlhttp=new XMLHttpRequest();
					}
					else
					{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
						xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{

								document.getElementById("corpo_email").innerHTML=xmlhttp.responseText;
								//xmlhttp.responseText;

							}
					}

					var data_base ="&email_nome="+document.getElementById('email_nome').value;
					data_base +="&email_email="+document.getElementById('email_email').value;
					data_base +="&email_mensagem="+document.getElementById('email_mensagem').value;

					xmlhttp.open("POST","../email.php", true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.overrideMimeType('text/xml; charset=utf-8');
					xmlhttp.send(data_base);
					
	
	}
		
	if(document.getElementById('email_nome').value==''){
			alert("Preencha o campo 'Nome'");
		}else{
		if(document.getElementById('email_email').value==''){
			alert("Preencha o campo 'e-mail'");
		
		}else{
			if(document.getElementById('email_mensagem').value==''){
			alert("Preencha o corpo da mensagem");
			
			
			}else{
				var txt;
				var r = confirm("Deseja confirmar o envio?");
				if (r == true) {
				
					enviar();

				
				}

			}
		
		}
	
	}
		
}




  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-31881561-3', 'auto');
  ga('send', 'pageview');
  
  
  
  

function pesquisar_carta(){
	if (window.XMLHttpRequest)
	{
	xmlhttp=new XMLHttpRequest();
	}
	else
	{
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
		xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{

				document.getElementById("resultado_pesquisa").innerHTML=xmlhttp.responseText;

			}
	}

	var data_base = "pesquisa="+document.getElementById("pesquisa").value;
	xmlhttp.open("POST","../pesquisa_cartas.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.overrideMimeType('text/xml; charset=utf-8');
	xmlhttp.send(data_base);

}
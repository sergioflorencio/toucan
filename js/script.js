

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



function cad_menu_acessos(a){
	id_responseText="div_msg";
	metodo="POST"
	url="php/cad_usuarios.php";
	var formData = new FormData();
		formData.append('act','acesso_modulos');
		formData.append('cod_usuario',document.getElementById("cod_usuario").value);
		formData.append('checked',a.checked);
		formData.append('cod_menu',a.getAttribute("cod_menu"));
		formData.append('cod_menu_pai',a.getAttribute("cod_menu_pai"));
	ajax(id_responseText, metodo, url,formData);
}
function cad_empresa_acessos(a){
	id_responseText="div_msg";
	metodo="POST"
	url="php/cad_empresas.php";
	var formData = new FormData();
		formData.append('act','acesso_empresas');
		formData.append('checked',a.checked);
		formData.append('cod_usuario',a.getAttribute("cod_usuario"));
		formData.append('cod_empresa',a.getAttribute("cod_empresa"));
	ajax(id_responseText, metodo, url,formData);
}
function cad_usuarios_acoes_banco_dados(a){
	id_responseText="div_msg";
	metodo="POST"
	url="php/cad_usuarios.php";
	var formData = new FormData();
		formData.append('act','acoes_banco_dados');
		formData.append('cod_usuario',document.getElementById("cod_usuario").value);		
		formData.append('checked',a.checked);
		formData.append('acesso',a.id);
	ajax(id_responseText, metodo, url,formData);
}
function salvar_usuario(a){
	id_responseText="div_msg";
	metodo="POST"
	url="php/cad_usuarios.php";
	var formData = new FormData();
		formData.append('act','salvar_usuario');
		formData.append('cod_usuario',document.getElementById("cod_usuario").value);		
		formData.append('nome',document.getElementById("nome").value);		
		formData.append('usuario',document.getElementById("usuario").value);		
		formData.append('email',document.getElementById("email").value);		
		formData.append('status',document.getElementById("status").value);		
	ajax(id_responseText, metodo, url,formData);
}
function salvar_empresa(){
	id_responseText="div_msg";
	metodo="POST"
	url="php/cad_empresas.php";
	var formData = new FormData();
		formData.append('act','salvar_empresa');
		formData.append('cod_empresa',document.getElementById("cod_empresa").value);		
		formData.append('razao_social',document.getElementById("razao_social").value);		
		formData.append('endereco',document.getElementById("endereco").value);		
		formData.append('numero',document.getElementById("numero").value);		
		formData.append('complemento',document.getElementById("complemento").value);		
		formData.append('cep',document.getElementById("cep").value);		
		formData.append('cidade',document.getElementById("cidade").value);		
		formData.append('uf',document.getElementById("uf").value);		
		formData.append('cnpj',document.getElementById("cnpj").value);	
		formData.append('cod_empresa_matriz',document.getElementById("cod_empresa_matriz").value);		
		formData.append('matriz_filial',document.getElementById("matriz_filial").value);		
		formData.append('email',document.getElementById("email").value);		
		formData.append('telefone',document.getElementById("telefone").value);		
	ajax(id_responseText, metodo, url,formData);
}
function enviar_senha(a){
	id_responseText="div_msg";
	metodo="POST"
	url="php/cad_usuarios.php";
	var formData = new FormData();
		formData.append('act','enviar_senha');
		formData.append('cod_usuario',document.getElementById("cod_usuario").value);		
	ajax(id_responseText, metodo, url,formData);
}
function pesquisar_cad_modulo(a){
	id_responseText="div_editar_cad_modulo";
	metodo="POST";
	url="php/cad_modulos.php";
	var formData = new FormData();
		formData.append('act','pesquisar_modulo');
		formData.append('cod_menu',a.getAttribute("cod_menu"));		

		
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function()
		{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
			obj=JSON.parse(xhr.responseText); 
			document.getElementById("label").value=obj.cad_menu[0].label;		
			document.getElementById("label").setAttribute("cod_menu", obj.cad_menu[0].cod_menu);		
			document.getElementById("label").setAttribute("modulo", obj.cad_menu[0].modulo);		
			document.getElementById("href").value=obj.cad_menu[0].href;		
			document.getElementById("icone").className=obj.cad_menu[0].icone;		
			document.getElementById("icone_label").innerHTML=obj.cad_menu[0].icone;		
			document.getElementById("menu_pai_"+obj.cad_menu[0].cod_menu_pai).selected = "true";
			}
		}			
		xhr.open(metodo, url);

		xhr.overrideMimeType('text/xml; charset=utf-8');			
		xhr.send(formData);
}




function selecionar_icone(a){
	document.getElementById("icone_label").innerHTML=a.childNodes[0].className;
	document.getElementById("icone").className=a.childNodes[0].className;
}

function salvar_cad_modulo(){
	id_responseText="div_msg";
	metodo="POST";
	url="php/cad_modulos.php";
	var formData = new FormData();
		formData.append('act','salvar_modulo');
		formData.append('label',document.getElementById("label").value);	
		formData.append('modulo',document.getElementById("label").getAttribute("modulo"));	
		formData.append('cod_menu',document.getElementById("label").getAttribute("cod_menu"));	
		formData.append('cod_menu_pai',document.getElementById("cod_menu_pai").value);		
		formData.append('href',document.getElementById("href").value);		
		formData.append('icone',document.getElementById("icone").className);

	ajax(id_responseText, metodo, url,formData);


}

function upload_logo(){
	id_responseText="logo_";
	metodo="POST"
	url="php/cad_empresas.php";
	var formData = new FormData();
		formData.append('act','upload_logo');
		formData.append('cod_empresa',document.getElementById("cod_empresa").value);		
		if (document.getElementById("upload_logo").files[0]!=undefined){
		formData.append('upload_logo', document.getElementById("upload_logo").files[0]);
		}
	ajax(id_responseText, metodo, url,formData);	
}


function login_empresa(cod_empresa){
	document.getElementById("cod_empresa").value=cod_empresa;
	document.getElementById("form_login_empresa").submit();
	
	
}
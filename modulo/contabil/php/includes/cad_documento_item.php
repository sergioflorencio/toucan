<?php
	if(intval($_GET['id'])>0){
		$disabled=" disabled ";
	}else{
		$disabled="  ";
	}

?>




<?php
	$lancamento=new lancamento;
	$lancamento->listar_cad_documento_item($id);

?>
<hr class="uk-article-divider" style="margin-bottom: 10px;">

<button class="uk-button uk-button-mini uk-button-primary" type="button" onclick="cloneRow()" <?php echo $disabled ; ?> ><i class="uk-icon-plus-circle"></i> Nova linha</button>
<button class="uk-button uk-button-mini uk-button-danger" type="button" onclick="delAllRow()" <?php echo $disabled ; ?>><i class="uk-icon-times"></i> Excluir linhas</button>
<button class="uk-button uk-button-mini uk-button-primary" data-uk-modal="{target:'#div_importar_lancamentos'}" <?php echo $disabled ; ?>><i class="uk-icon-sign-in"></i>  Importar lançamentos</button>

  <script type="text/javascript">
   function cloneRow() {
		var table = document.getElementById("tableToModify"); // find table to append to
		var row = table.rows[1]; // find row to copy
		var clone = row.cloneNode(true); // copy children too
		clone.id = "newID"; // change id or other attributes/contents
		var inputs=clone.getElementsByTagName("input");	
		for(var n=0;n<6;n++){inputs[n].value="";}		
		table.appendChild(clone); // add new row to end of table


    }
	function delAllRow(){
		var table = document.getElementById("tableToModify"); // find table to append to
		var y=table.rows.length;
		
		for(var i=1;i<y-1;i++){
			//alert(i);
			document.getElementById("tableToModify").deleteRow(1);
		}
		
		var table = document.getElementById("tableToModify"); // find table to append to
		var y=table.rows.length;

		if(y==2){
			var row = table.rows[1]; // find row to copy
			var clone = row.cloneNode(true); // copy children too
			clone.id = "newID"; // change id or other attributes/contents
			var inputs=clone.getElementsByTagName("input");	
			for(var n=0;n<6;n++){inputs[n].value="";}	
			table=document.getElementById("tableToModify");
			table.deleteRow(1);
			table.appendChild(clone); // add new row to end of table
		}
	}	
	
	function delRow(r) {
		var table = document.getElementById("tableToModify"); // find table to append to
		if(table.rows.length>2){
			var i = r.parentNode.parentNode.rowIndex;
			document.getElementById("tableToModify").deleteRow(i);
		}else{

			
		var row = table.rows[1]; // find row to copy
		var clone = row.cloneNode(true); // copy children too
		clone.id = "newID"; // change id or other attributes/contents
		var inputs=clone.getElementsByTagName("input");	
		for(var n=0;n<6;n++){inputs[n].value="";}	
			var i = r.parentNode.parentNode.rowIndex;
			document.getElementById("tableToModify").deleteRow(i);
		table.appendChild(clone); // add new row to end of table
			
		}
	}	

	
	
	

function importar_lancamentos(){
	
		var base=document.getElementById("text_area_importar_lancamento").value;
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
					var table = document.getElementById("tableToModify"); 
					var row = table.rows[1];
					var clone = row.cloneNode(true); 
					clone.id = "newID";
					var inputs=clone.getElementsByTagName("input");	
					for(var n=0;n<6;n++){
						inputs[n].value=base[i][n];
					}
					
					//se for a primeira linha, deve limpar a tabela de lançamentos
					if(i==0){ for(var a=1;a<table.rows.length;a++){ document.getElementById("tableToModify").deleteRow(a); } }					
					
					//incluir a nova linha
					table.appendChild(clone);
				}
				
				//limpar a variavel
				linha_="";
				linha__="";				

		}
	
}	





function salvar_documento(){


	//var itens=document.getElementById("tableToModify");
	var codigo_lancamento=document.getElementsByClassName("codigo_lancamento");
	var montante=document.getElementsByClassName("montante");
	var itens="";
	
	//alert(codigo_lancamento.length);
	var total=0;
	var sinal=0;
	var erro="ok";	
	
	for(var a=0;a<codigo_lancamento.length;a++){
		if(codigo_lancamento[a].value=="D"){sinal=1;}
		if(codigo_lancamento[a].value=="C"){sinal=-1;}
		
		total=montante[a].value*sinal+total;

		
	}
	//	alert(total);
	//total==0 && codigo_lancamento.length>=1
	if(total==0 && codigo_lancamento.length>=2 ){
		//salvar

			
			// 1 - Conferir o preenchimento dos campos
			if(document.getElementById("cod_tipo_documento").value==""){erro="erro";document.getElementById("cod_tipo_documento").className+=" uk-form-danger";}else{}
			if(document.getElementById("referencia").value==""){erro="erro";document.getElementById("referencia").className+=" uk-form-danger";}else{}
			if(document.getElementById("texto_cabecalho_documento").value==""){erro="erro";document.getElementById("texto_cabecalho_documento").className+=" uk-form-danger";}else{}
			if(document.getElementById("data_lancamento").value=="01/01/9999"){erro="erro";document.getElementById("data_lancamento").className+=" uk-form-danger";}else{}
			if(document.getElementById("data_base").value=="01/01/9999"){erro="erro";document.getElementById("data_base").className+=" uk-form-danger";}else{}
			
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
			
			
			// montar matriz de itens
			var codigo_lancamento=document.getElementsByClassName("codigo_lancamento");
			var cod_ctr_custo=document.getElementsByClassName("cod_ctr_custo");
			var cod_conta=document.getElementsByClassName("cod_conta");
			var historico=document.getElementsByClassName("historico");
			var montante=document.getElementsByClassName("montante");
			var data_vencimento_liquidacao=document.getElementsByClassName("data_vencimento_liquidacao");
			
			for(var i=0; i<codigo_lancamento.length;i++){
				itens+="{'codigo_lancamento':'"+codigo_lancamento[i].value+"','cod_ctr_custo':'"+cod_ctr_custo[i].value+"','cod_conta':'"+cod_conta[i].value+"','historico':'"+historico[i].value+"','montante':'"+montante[i].value+"','data_vencimento_liquidacao':'"+data_vencimento_liquidacao[i].value+"'}";
			}
			itens = "["+itens+"]";
		
					
			// 3 - Salvar documento
			if(erro=="ok"){
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
			
		
		
	}else{
				//alert
				alert("As somas dos débitos e créditos estão diferentes!");
		
			}
	

}




  </script>


	<hr class="uk-article-divider" >	
<div id="msg">
</div>
<div class="uk-modal" id="div_importar_lancamentos">
	<div class="uk-form uk-modal-dialog" id="">
		<a class="uk-modal-close uk-close"></a>
		<div class="uk-form-row">
			<h3>Importar lançamentos</h3>
			<p class="uk-article-meta">Copie e cole sua planilha na área de texto abaixo. Certifique-se de que as colunas estejam separadas por ; ou por TAB (tabulação manual), geralmente apenas copiando e colando a os dados de uma planilha Excel as informações já estarão separadas por TAB. As colinas devem estar na mesma ordem que na tabela de lançamento acima (“CL” , “Ctr. Custo”, “Conta”, “Descrição”, “Valor”, “Vencimento”).</p>
			<textarea cols="" rows="10" style="width: 100%; margin-bottom: 20px;" placeholder title="copie e cole os dados" id="text_area_importar_lancamento"></textarea>
		</div>
		<button class="uk-button uk-button-mini uk-button-primary" type="button" onclick="importar_lancamentos();"><i class="uk-icon-refresh"></i> Importar</button>

	</div>
</div>






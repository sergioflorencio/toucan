	<?php





	function cep($filtro){
	$file = "http://www.buscacep.correios.com.br/servicos/dnec/consultaEnderecoAction.do?relaxation=".$filtro."&Metodo=listaLogradouro&TipoConsulta=relaxation&StartRow=1&EndRow=10" ;
	$doc = new DOMDocument();
	@$doc->loadHTMLFile($file);
	$elements = $doc->getElementsByTagName('table');
	echo "<br>
	<h4>Resultado:</h4>
	<table class='uk-table uk-table-hover uk-table-condensed uk-table-striped uk-text-nowrap uk-panel-box' style='font-size: 10px;padding: 2px;'>";

	if (!is_null($elements)) {
	$n=0;
	  foreach ($elements as $element) {
		$nodes = $element->childNodes;
		foreach ($nodes as $node) {
			$colunas = $node->childNodes;
			$endereco="";

			foreach ($colunas as $coluna) {$endereco=$endereco . $coluna->nodeValue;} 
			
			if($n>0){
				echo "<tr onclick='selecionarcep(".$n.")' id='".$n."' class='uk-modal-close'>";
				foreach ($colunas as $coluna) {echo  "<td style='max-width: 100px !important;width:auto;' class='uk-text-truncate'>". mb_convert_encoding($coluna->nodeValue,'ISO-8859-1','UTF-8') . "</td>";}
				echo "</tr>";
				
			}
			$n=$n+1;
			}
	  }
	}
	echo "</table>";
	}
	function logradouro($a){



	}

	if (isset($_POST['metodo']) and isset($_POST['filtro'])){
	cep($_POST['filtro']);

	}



	?>
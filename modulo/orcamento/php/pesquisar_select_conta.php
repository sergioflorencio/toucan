<?php
include "php.php";

	if(isset($_POST['id_orcamento'])){
		$selects= new selects;
		$selects-> conta($_POST['id_orcamento']);
	}


?>
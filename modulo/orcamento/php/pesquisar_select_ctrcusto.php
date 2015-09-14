<?php
include "php.php";

	if(isset($_POST['id_orcamento'])){
		$selects= new selects;
		$selects-> ctrcusto($_POST['id_orcamento']);
	}


?>
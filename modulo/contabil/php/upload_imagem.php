﻿<?php

	include "php.php";
	$imagens=new imagens;
	$imagens->upload($_POST['cod_item']);
	$imagens->listar($_POST['cod_item']);
//	var_dump($_GET);
//	var_dump($_POST);
//	var_dump($_FILES);

?>
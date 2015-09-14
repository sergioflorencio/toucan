<?php
	include ('../php/config.php');
	include ('../php/php.php');
	$senha=substr(md5(mt_rand(1,10000).date("Y-m-d H:i:s")),0,6);
	$sql=new sql;
	$table="cad_usuarios";
	$campos="password='".$senha."'";
	$where="cod_usuario='".$_POST['cod_usuario']."'";
	$sql->update($table,$campos,$where);
	$select= "
			select 
				*
				
			from 
				nico.cad_usuarios 
				
			where  
				`cad_usuarios`.`cod_usuario` = ".$_POST['cod_usuario'].";";

	
	$resultado=mysql_query($select,$conexao) or die ("nao foi possivel conectar");
	while($row = mysql_fetch_array($resultado))
	  {
			$username=$row['username'];
			$_email=$row['email'];
	  }
	$email=new email;
	$email->enviar_senha($_email,$username,$senha);
	echo 
		"<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert=''>
			<a href='' class='uk-alert-close uk-close'></a>
			<p>Uma nova senha foi encaminhada para o seu email.</p>
		</div>";

	
?>
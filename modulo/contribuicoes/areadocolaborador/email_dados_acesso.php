<?php
if(isset($_POST['cod_colaborador'])){

	include "config.php";
	include "email.php";
	$subject = 'Dados de acesso';
	$where=" and cad_colaboradores.cod_colaborador='".$_POST['cod_colaborador']."'";


	$select_token="select 
						cad_colaboradores.cod_colaborador,
						cad_colaboradores.cod_pessoa,
						cad_colaboradores.cod_grupo,
						cad_colaboradores.data_inclusao,
						cad_pessoas.email_1 as email
					from 
						".$schema.".cad_colaboradores,
						".$schema.".cad_pessoas
					where
						cad_colaboradores.cod_pessoa=cad_pessoas.cod_pessoa and
						cad_pessoas.email_1!=''
						
					".$where.";";
				
						$resultado_token=mysql_query($select_token,$conexao) or die ("<div class='uk-alert uk-alert-danger' data-uk-alert=''><p>".mysql_error()."</p></div>");
						$n=1;
							while($row_token = mysql_fetch_array($resultado_token))
							{
								$token=md5($row_token['cod_colaborador'].$row_token['cod_pessoa'].$row_token['cod_grupo'].$row_token['data_inclusao']);
								$cod_colaborador=$row_token['cod_colaborador'];
								$email=$row_token['email'];
								include "includes/email_area_colaborador_mod1.php";
								email($email,$email_mensagem,$subject);
							}
							echo "<div class='uk-alert uk-alert-success' data-uk-alert=''>
									<a href='' class='uk-alert-close uk-close'></a>
									<p>email enviado com sucesso!</p>
								</div>";

}
echo $token;


?>
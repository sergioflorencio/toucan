<?php


			
		class sql{
			public function update($table,$campos,$where,$msg){
				include "config.php";
				if(isset($_SESSION)){$uid=$_SESSION['session'];$user=$_SESSION['user'];}else{$uid=0;$user='';}
				$consulta="UPDATE `".$schema."`.`".$table."` SET ".$campos." WHERE ".$where.";";
				$update=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main uk-width-medium-1-2 uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	
				if($msg=='S'){
				echo "
					<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert='' style=''>
						<a href='' class='uk-alert-close uk-close'></a>
						<p>O registro foi salvo com sucesso!</p>
					</div>";

				}
			}
			public function insert($table,$campos,$values,$msg){
				include "config.php";
				if(isset($_SESSION)){$uid=$_SESSION['session'];$user=$_SESSION['user'];}else{$uid=0;$user='';}
				$consulta="INSERT INTO `".$schema."`.".$table." (".$campos.")  VALUES (".$values.");"; 
				//echo $consulta;
				$insert=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main  uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	;	
				if($msg=='S'){
				echo "
					<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert='' style=''>
						<a href='' class='uk-alert-close uk-close'></a>
						<p>O registro foi salvo com sucesso!</p>
					</div>";
				}
			}
			public function delete($table,$where,$msg){
				include "config.php";
				$consulta="DELETE FROM `".$schema."`.".$table." WHERE ".$where.";";
				//echo $consulta;
				$delete=mysql_query($consulta,$conexao) or die ("<div class='uk-alert uk-alert-danger  tm-main  uk-container-center'>".mysql_error()."<br><br>Consulta<br>".$consulta."</div>");	;	
				if($msg=='S'){
				echo "
					<div class='uk-alert uk-alert-success tm-main uk-width-medium-1-1 uk-container-center' data-uk-alert='' style='margin: -15px 35px 30px;'>
						<a href='' class='uk-alert-close uk-close'></a>
						<p>O registro foi excluido com sucesso!</p>
					</div>";
				}

			}

		}

	

?>
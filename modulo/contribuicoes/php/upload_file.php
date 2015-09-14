<?php 
 session_start();
include "php.php";



					$origem_tabela=$_POST['origem_tabela'];
					$origem_campo_id=$_POST['origem_campo_id'];
					$origem_cod_id=$_POST['origem_cod_id'];

					
					
					//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
					//echo "Type: " . $_FILES["file"]["type"] . "<br>";
					//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
					//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

					if (file_exists("arquivos_anexos/" . $_FILES["file"]["name"]))
					  {
					  echo $_FILES["file"]["name"] . " already exists. ";
					  }
					else
					  {
					  move_uploaded_file($_FILES["file"]["tmp_name"],
					  "../arquivos_anexos/" . $_FILES["file"]["name"]);
					  echo "Stored in: " . "../arquivos_anexos/" . $_FILES["file"]["name"];
					  }
					



					$caminho_arquivo="arquivos_anexos/" . $_FILES["file"]["name"];
					$nome_arquivo=$_FILES["file"]["name"];
					$tamanho_arquivo=$_FILES["file"]["size"] / 1024;
					$extensao=explode(".", $_FILES["file"]["name"]);
					
					$table='cad_anexos';
					
					$campos="origem_tabela,";
					$campos.="origem_campo_id,";
					$campos.="origem_cod_id,";
					$campos.="nome_arquivo,";
					$campos.="caminho_arquivo,";
					$campos.="tamanho_arquivo,";
					$campos.="extensao";
					
					$values="'".$origem_tabela."', ";
					$values.="'".$origem_campo_id."', ";
					$values.="'".$origem_cod_id."', ";
					$values.="'".$nome_arquivo."', ";
					$values.="'".$caminho_arquivo."', ";
					$values.="'".$tamanho_arquivo."', ";
					$values.="'".$extensao[count($extensao)-1]."' ";	


					$sql=new sql;
					$sql->insert($table,$campos,$values);			  
				  
					header("Location:../cadastro_cartas.php?id=".$origem_cod_id."");
				  
				  
				  
				  

?>
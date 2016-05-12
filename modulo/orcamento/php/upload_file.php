<?php 
session_start();
include "php.php";

	if(isset($_SESSION['loged']) and $_SESSION['loged']==true){
		

					$cod_projeto=$_POST['cod_projeto'];
					
					
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
					
					$table='cad_anexo_projeto';
					
					$campos="cod_projeto,";
					$campos.="nome_arquivo,";
					$campos.="caminho_arquivo,";
					$campos.="tamanho_arquivo,";
					$campos.="extensao";
					
					$values="'".$cod_projeto."', ";
					$values.="'".$nome_arquivo."', ";
					$values.="'".$caminho_arquivo."', ";
					$values.="'".$tamanho_arquivo."', ";
					$values.="'".$extensao[count($extensao)-1]."' ";	


					$sql=new sql;
					$sql->insert($table,$campos,$values);			  
				  
					header("Location:../index.php?act=cadastros&mod=cad_projeto&id=".$cod_projeto."");
			
		
	}
			  
				  
				  
				  

?>
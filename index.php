<!DOCTYPE HTML>
<html lang="pt_BR">
<head>
	<meta charset="UTF-8">
	<title>Discografia- Tião Carreiro e Pardinho</title>
</head>

<body>
<FORM method='get' action=''>
Pesquisar: <input type ='text' name='search'>

<input type ='submit' value='Ok'>
</FORM>

	<?php
	
		require 'config.php';
		require 'connection.php';
		require 'database.php';
		
		if(isset($_GET['search'])){
		
			$search = $_GET['search'];

			$musica = DBRead('Faixas', " JOIN Album WHERE Faixas.album_id = Album.id AND Faixas.nome LIKE '%"
			.$search."%' ORDER BY Album.ano, Faixas.numero", 
			'Faixas.id,Faixas.numero,Faixas.nome,Faixas.duracao,Faixas.album_id,Album.id AS idAlbum,Album.nome AS nomeAlbum,Album.ano AS anoAlbum'
			);
			
			if($musica == ''){
				
				if($search == ''){
					echo "Digite uma musica!";
				
				}else{
					echo 'Musica "'.$search.'" não encontrada!';
				}
			} 
			else{
				$linhas = count($musica);
				for($i = 0 ; $i < $linhas; $i++){
					
					echo '<br>'.$musica[$i]['nomeAlbum'].' ';
					echo $musica[$i]['anoAlbum'].'<br>';
					echo '<br> N° Faixa Duração <br>';

					$albumAtual = $musica[$i]['idAlbum'];

				
					$j = 0;
					
					for($j = $i ; $j < $linhas; $j++){
						
						
						if($albumAtual == $musica[$j]['album_id']){
							
							echo $musica[$j]['numero'].' ';
							echo $musica[$j]['nome'].' ';
							echo $musica[$j]['duracao'].'<br>';
						}else{
							
							$j = $j-1; 
							break;
						}
					} 
				
					$i += $j;
					
				}
			
			}
		}		
		
	?>
	
</body>
</html>

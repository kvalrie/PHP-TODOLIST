<?php
$file = file_get_contents('./todo2.json', true);
$json = json_decode($file,true);

if (isset($_POST['submit'])) {

	array_push($json['todo'],$_POST['tache']);

			    $json_encoded = json_encode($json);
				//echo $json_encoded;
				$file = file_put_contents('./todo2.json',$json_encoded);

}

if (isset($_POST['done'])){


			
	foreach ($_POST as $key => $value) {
		if (is_int($key)) {

			array_push($json['archive'],$json['todo'][$key]);

		}
	}


	foreach ($_POST as $key => $value) {
		if (is_int($key)) {
//3eme argument pour savoir combien
			array_splice($json['todo'], $key ,1);
				
		}
	}
	

		
				$json_encoded = json_encode($json);
				echo $json_encoded;
				$file = file_put_contents('./todo2.json',$json_encoded);		
				print_r($_POST);
}
		
		
		
		
echo"<pre>";
 print_r($json);
echo"</pre>";

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ma todo</title>
</head>
<body>
		<h1>Envoyer</h1>
		
		<form method="post">
			<input type="text" name="tache">
			<button type="submit" name="submit" value="send">Envoyer</button>
		</form>
		

		<h2>A faire</h2>
		
		<form method="post">
			<ul>
			<?php foreach ($json['todo'] as $key => $value) {
			;
			echo "<li><label><input type='checkbox' name=$key value=$value>
			$value</label></li>";
			}
			?>
			</ul>

			<button type="submit" name="done" value="checked">Done</button>
			
		</form>
		
		<h2>Done</h2>
		<ul>
			<?php foreach ($json['archive'] as $key => $value) {
			;
			echo "<label><li>
			$value</li></label>";
			}
			?>

		</ul>
	
</body>
</html> 

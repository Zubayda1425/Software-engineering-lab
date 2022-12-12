	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Insertion</title>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">
	</head>
	<body>
		

		<div class="ui padded text segment container" style="margin-top: 20vh;">
			<?php

				$Video_ID = $_GET["Video_ID"];
				$Video_Name = $_GET["Video_Name"];
				$Video_link = $_GET["Video_link"];
				$Course_ID = $_GET["Course_ID"];


				require_once('dataBase.php');

				$connect = mysqli_connect( HOST, USER, PASS, DB )

					or die("Can not connect");



				mysqli_query( $connect, "INSERT INTO lecture (Video_ID , Video_Name , Video_link , Course_ID) VALUES ($Video_ID, '$Video_Name' , '$Video_link' , '$Course_ID')" )

					or die("Can not execute query");


				echo "<h2>Record inserted for Video = ''$Video_Name'' </h2> <br> <br>";



				echo "<p><a href=video.php><button class='ui right floated blue button'>OK</button></a></p>";

			?>
			
		</div>
	</body>
	</html>


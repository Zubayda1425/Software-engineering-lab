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

				$S_Q_ID = $_GET["S_Q_ID"];
				$Question_Name = $_GET["Question_Name"];
				$Course_ID = $_GET["Course_ID"];
				$PDF = $_GET["PDF"];
				


				require_once('dataBase.php');

				$connect = mysqli_connect( HOST, USER, PASS, DB )

					or die("Can not connect");



				mysqli_query( $connect, "INSERT INTO sample_question (S_Q_ID , Question_Name ,  Course_ID , PDF) VALUES ($S_Q_ID, '$Question_Name' ,  '$Course_ID' , '$PDF')" )

					or die("Can not execute query");


				echo "<h2>Record inserted for Book = ''$Question_Name'' </h2> <br> <br>";



				echo "<p><a href=sample_question.php><button class='ui right floated blue button'>OK</button></a></p>";

			?>
			
		</div>
	</body>
	</html>


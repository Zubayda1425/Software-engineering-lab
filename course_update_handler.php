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


						$Course_ID = $_GET["Course_ID"];
						$Course_Name = $_GET["Course_Name"];
						$Course_Image = $_GET["Course_Image"];
						$Department = $_GET["Department"];

						require_once('dataBase.php');

						$connect = mysqli_connect( HOST, USER, PASS, DB )

							or die("Can not connect");



						mysqli_query( $connect, "UPDATE course SET Course_Name = '$Course_Name', Department = '$Department', Course_Image = '$Course_Image' WHERE Course_ID = '$Course_ID'	" )

							or die("Can not execute query");

				echo "<h2>Record updated for ''$Course_Name'' </h2> <br> <br>";



				echo "<p><a href=course.php><button class='ui right floated orange button'>OK</button></a></p>";

			?>
			
		</div>
	</body>
	</html>


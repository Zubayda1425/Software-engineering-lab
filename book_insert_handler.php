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

				$Book_ID = $_GET["Book_ID"];
				$Book_Name = $_GET["Book_Name"];
				$Price = $_GET["Price"];
				$Image = $_GET["Image"];
				$Department = $_GET["Department"];
				$PDF = $_GET["PDF"];


				require_once('dataBase.php');

				$connect = mysqli_connect( HOST, USER, PASS, DB )

					or die("Can not connect");



				mysqli_query( $connect, "INSERT INTO books (Book_ID , Book_Name , Price , Image , Department, PDF) VALUES ($Book_ID, '$Book_Name' , '$Price' , '$Image' , '$Department' , '$PDF')" )

					or die("Can not execute query");


				echo "<h2>Record inserted for Book = ''$Book_Name'' </h2> <br> <br>";



				echo "<p><a href=book.php><button class='ui right floated blue button'>OK</button></a></p>";

			?>
			
		</div>
	</body>
	</html>


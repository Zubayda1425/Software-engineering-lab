<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Deletion</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">
</head>
<body>

	<div class="ui text segment container" style="margin-top: 20vh;">
		<?php

			$S_Q_ID = $_GET["id"];



			require_once('dataBase.php');

			$connect = mysqli_connect( HOST, USER, PASS, DB )

				or die("Can not connect");



			mysqli_query( $connect, "DELETE FROM sample_question WHERE S_Q_ID=$S_Q_ID" )

				or die("Can not execute query");



			echo "<h2>Record deleted</h2><br>";

			// uncomment the following line for directly skipping to previous page

			// header("Location: read.php");

			echo "<div><a href=sample_question.php><button class='ui right floated orange button'>OK</button></a></div>";

		?>
	</div>
</body>
</html>


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

				$results = mysqli_query( $connect, "SELECT * FROM sample_question where S_Q_ID='$S_Q_ID'" )
                or die("Can not execute query");


				while( $rows = mysqli_fetch_array( $results ) ) {
					extract( $rows );

				echo "<div class='col-lg-4 col-md-12 col-sm-12'>
				    <div class='Author_info' style='padding-top: 30px;'>
				  <h3>Update Author Info</h3>
	  
				  <form class='ui form' method=get action=sample_question_update_handler.php >
				  
				  
	  
					  <p>
	
					   
					  <input type=text  name='S_Q_ID' value='$S_Q_ID' required><br>
	  
					  <P>
	
					  Question Name: <input type='text' name='Question_Name' placeholder='$Question_Name' required> <br>

					  <p>

					  Course_ID: <input type='text' name='Course_ID' placeholder='$Course_ID' required> <br>

					  <p>

					  PDF Link: <input type='text' name='PDF' placeholder='$PDF' required> <br>

					  <p>
	  
					  <input class='ui big right floated orange button' type=submit value='Update'>
				
	  
					</form>
			    </div>
			 </div>";
				}
	  


		?>
	</div>
</body>
</html>


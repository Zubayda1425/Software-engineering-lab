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

			$Book_ID = $_GET["id"];



			require_once('dataBase.php');

			$connect = mysqli_connect( HOST, USER, PASS, DB )

				or die("Can not connect");

				$results = mysqli_query( $connect, "SELECT * FROM books where Book_ID=$Book_ID" )
                or die("Can not execute query");


				while( $rows = mysqli_fetch_array( $results ) ) {
					extract( $rows );

				echo "<div class='col-lg-4 col-md-12 col-sm-12'>
				    <div class='Author_info' style='padding-top: 30px;'>
				  <h3>Update Author Info</h3>
	  
				  <form class='ui form' method=get action=book_update_handler.php >
				  
				  
	  
					  <p>
	
					   
					  <input type=text  name='Book_ID' value='$Book_ID' required><br>
	  
					  <P>
	
					  Book Name: <input type='text' name='Book_Name' placeholder='$Book_Name' required> <br>

					  <p>

					  Department: <input type='text' name='Department' placeholder='$Department' required> <br>

					  <p>

					  Book Price: <input type='text' name='Price' placeholder='$Price' required> <br>

					  <p>

					  Image Link: <input type='text' name='Image' placeholder='$Image' required> <br>

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


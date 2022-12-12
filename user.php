<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Courses - Learn Anything, On Your Schedule</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="css/responsivee.css">
  </head>

  <body>

      <!-- Header Area Start -->
      <header>
        <div class="header_area">
          <div class="container">
            <div class="row">
              <div class="col-lg-2">
                <div class="logo_araa">
                  <a href="index.php"><img  style="height:50px; width:80px;"  src="logo.png" alt="Logo"></a>
                </div>
              </div>
              <div class="col-lg-10">
                <div class="buttons">
                <a href="user.php"  class="cp">Users</a>
                <a href="book.php">Book</a>
                <a href="course.php">Course</a>
                <a href="video.php">Video</a>
                <a href="sample_question.php">sample Question</a>
                <a href="index.php">LogOut</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
    <!-- Header Area End -->


    <!-- Data -->


    <div class="hero_section">
      <div class="container">
        <div class="row">

          <!-- <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="employee_info" style="padding-top: 30px;">
              <h3>New Book Info</h3>
  
              <form class="ui form" method=get action=book_insert_handler.php>
  
                  <p>

                  Book ID: <input type="text" name="Book_ID"> <br>
  
                  <P>

                  Book Title: <input type="text" name="Book_Name"> <br>
  
                  <p>


                  Department: <input type="text" name="Department"> <br>
  
                  <p>

                  Price: <input type="text" name="Price"> <br>
  
                  <p>
  
                  Image Link: <input type="text" name="Image"> <br>
  
                  <p>

                  PDF Link: <input type="text" name="PDF"> <br>
  
                  <p>
  
                  <p>
  
                  <input class="ui big right floated blue button" type=submit value="Insert Entry">
  
                </form>
              </div>
          </div> -->
  
          <div class="col-lg-12 col-md-12 col-sm-12">
           
    <div class="books_info" style=" padding-bottom: 25px;">
    <?php
            require_once('dataBase.php');
            $connect = mysqli_connect( HOST, USER, PASS, DB )
                or die("Can not connect");


            $results = mysqli_query( $connect, "SELECT * FROM user" )
                or die("Can not execute query");
        ?>
        
                
                <h1>Users Information</h1>
        
                <div class="ui text container">

            <?php
                echo "<table class='ui table'> \n";
                echo "<thead><th>Student ID</th> <th>User Name</th> <th>Phone Number</th> <th>Subscription ID</th> <th>Option</th>\n";

                while( $rows = mysqli_fetch_array( $results ) ) {
                    extract( $rows );
                    echo "<tr>";
                    echo "<td> $Student_ID </td>";
                    echo "<td> $User_Name </td>";
                    echo "<td> $Phone_Number </td>";
                    echo "<td> $Subscription_ID </td>";
                    echo "<td> <a style='color: red;' href='user_delete.php?id=$Student_ID'>Kick</a> </td>";
                    echo "</tr> \n";
                }

                echo "</table> \n";
            ?>
        
                </div>
            </div>
          </div>
  

          
        </div>

      </div>

    </div>


    






      <!-- Footer Area Start -->

      <footer class="footer_area" style="border-top: 3px solid black;">
        <div class="container">
            <div class="row">
            <div class="col-md-6">
                <a href="index.html"><img src="logo.png" style="height:50px; width:80px;" alt="UIU edu"></a> 
            </div>
            <div class="col-md-6">
                <p>@ Copyright reserved to <a href="index.html">uiuedu.com</a>  Crafted by <span>Group2</span> </p>
            </div>
            </div>
        </div>
        </footer>


    <!-- Footer Area End -->


        <!-- Scripts -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
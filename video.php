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
                <a href="user.php">Users</a>
                <a href="book.php">Book</a>
                <a href="course.php">Course</a>
                <a href="video.php" class="cp">Video</a>
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

          <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="employee_info" style="padding-top: 30px;">
              <h3>New Lecture Video Info</h3>
  
              <form class="ui form" method=get action=video_insert_handler.php>
  
                  <p>

                  Video ID: <input type="text" name="Video_ID"> <br>
  
                  <P>

                  Video Title: <input type="text" name="Video_Name"> <br>
  
                  <p>


                  Video Link: <input type="text" name="Video_link"> <br>
  
                  <p>

                  Course ID: <input type="text" name="Course_ID"> <br>

                  <p>
  
                  <input class="ui big right floated blue button" type=submit value="Insert Entry">
  
                </form>
              </div>
          </div>
  
          <div class="col-lg-8 col-md-12 col-sm-12">
           
    <div class="books_info" style=" padding-bottom: 25px;">
    <?php
            require_once('dataBase.php');
            $connect = mysqli_connect( HOST, USER, PASS, DB )
                or die("Can not connect");


            $results = mysqli_query( $connect, "SELECT * FROM lecture" )
                or die("Can not execute query");
        ?>
        
                
                <h1>Lecture Video Information</h1>
        
                <div class="ui text container">

            <?php
                echo "<table class='ui table'> \n";
                echo "<thead><th>Video ID</th> <th>Video Title</th> <th>Video Link</th> <th>Course ID</th> <th>Option</th> <th>Update</th> </thead> \n";

                while( $rows = mysqli_fetch_array( $results ) ) {
                    extract( $rows );
                    echo "<tr>";
                    echo "<td> $Video_ID </td>";
                    echo "<td> $Video_Name </td>";
                    echo "<td> $Video_link </td>";
                    echo "<td> $Course_ID </td>";
                    echo "<td> <a style='color: red;' href='video_delete.php?id=$Video_ID'>Delete</a> </td>";
                    echo "<td> <a style='color: blue;' href='video_update.php?id=$Video_ID'>Edit</a> </td>";
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
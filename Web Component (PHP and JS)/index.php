<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">

    <title>BCP Schedule Display</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Bellarmine Daily Schedule</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Current Schedule</a></li>
            <li><a href="schedule_set.php">Set Schedule</a></li>
            <li><a href="api.html">API Docs</a></li>            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <?php

        $file = fopen("schedule_count.txt","r");
        $numAgenda = fgets($file);
        $numAnnouncements = fgets($file);

        $file = fopen("schedule.txt","r");
        $scheduleDate = fgets($file);

        echo sprintf("<h1>Schedule displayed below for %s</h1>", $scheduleDate);

      ?>

      <!--<h1 id="date"></h1>
      <script src="moment.min.js"></script>
      <script>
      document.getElementById("date").innerHTML = "Today is " + moment().format("dddd, MMMM Do, YYYY") + ".";
      </script>-->

      <p class="lead">Use the Set Schedule page in the header to change the current set schedule.</p>

      <h3>Current Agenda</h3>

      <table class="table table-striped">
        <th>Symbol</th>
        <th>Timing</th>
        <th>Type</th>

        <?php

          for ($i = 0; $i < $numAgenda; $i++) {
            $currentSymbol = fgets($file);
            $currentTiming = fgets($file);
            $currentType = fgets($file);
            echo sprintf("<tr> <td>%s</td> <td>%s</td> <td>%s</td>", $currentSymbol, $currentTiming, $currentType);
          }

        ?>

      </table>

      <h3>Current Announcements</h3>

      <table class="table table-striped">
        <th>Text</th>
        <th>Type</th>

        <?php

          for ($i = 0; $i < $numAnnouncements; $i++) {
            $currentText = fgets($file);
            $currentType = fgets($file);
            echo sprintf("<tr> <td>%s</td> <td>%s</td>", $currentText, $currentType);
          }

        ?>

      </table>      


    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
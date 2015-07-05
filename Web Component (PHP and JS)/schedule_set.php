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

    <script src="moment.min.js"></script>
    <script type='text/javascript'>
      function setToCurrentDate(){
        document.getElementsByName('date')[0].value = moment().format("dddd, MMMM Do");
    }

</script>

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
            <li><a href="index.php">Current Schedule</a></li>
            <li class="active"><a href="schedule_set.php">Set Schedule</a></li>
            <li><a href="api.html">API Docs</a></li>            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <?php

        $file = fopen("schedule_count.txt","r");
        $numAgenda = fgets($file);
        $numAnnouncements = fgets($file);

        $file = fopen("schedule.txt","r");
        $scheduleDate = fgets($file);

    ?>

    <div class="container">

      <div class="page-header">
        <h1>Set Schedule <small>Use the form below to set current schedule information.</small></h1>
      </div>

      <h3>Quick Set Form <small>Use the buttons below to set/reset form values to defaults.</small></h3>

      <div class="row">

        <div class="col-md-12 form-group">
          <a href="reset.php" class="btn btn-default" role="button">Reset</a>
          <a href="template.php?day=monday" class="btn btn-primary" role="button">Monday</a>
          <a href="template.php?day=tuesday" class="btn btn-primary" role="button">Tuesday</a>
          <a href="template.php?day=wednesday" class="btn btn-primary" role="button">Wednesday</a>
          <a href="template.php?day=thursday" class="btn btn-primary" role="button">Thursday</a>
          <a href="template.php?day=friday" class="btn btn-primary" role="button">Friday</a>

        </div>

      </div>

      <form action="submit.php" method="post" id="main">

        <div class="form">

        <h3>Date Information <small>The date is based on the currently saved schedule entry.</small></h3>

          <div class="row"> 

            <div class="col-md-4">
              <div class="form-group">
                <label for="date">Date (<a href="#" id="setToToday" onclick="setToCurrentDate(); return false">Set to Today</a>)</label>
                <input type="text" class="form-control" name="date"
                  <?php echo sprintf("value=\"%s\"", $scheduleDate); ?>
                >
              </div>
            </div>

          </div>


          <h3>Agenda Items <small>Enter each part of today's schedule. Leave extras blank. Placeholder text will not be submitted.</small></h3>


            <div class="row"> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda1-symbol">Item 1 Symbol</label>
                  <input type="text" class="form-control" name="agenda1-symbol" placeholder="1"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda1-timing">Item 1 Timing</label>
                  <input type="text" class="form-control" name="agenda1-timing" placeholder="8:15-9:05am"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda1-type">Item 1 Type</label>
                  <select class="form-control" name="agenda1-type">
                    <?php
                      if ($numAgenda > 0) {
                        $tempType = fgets($file); 
                        $numAgenda = $numAgenda - 1;
  
                      } else {
                        $tempType = "";
                      }
                    ?>
                    <option <?php if($tempType === "Regular Class\n") echo "selected"; ?>>Regular Class</option>
                    <option <?php if($tempType === "Break/Lunch\n") echo "selected"; ?>>Break/Lunch</option>
                    <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                    <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="row"> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda1-symbol">Item 2 Symbol</label>
                  <input type="text" class="form-control" name="agenda2-symbol" placeholder="2"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda2-timing">Item 2 Timing</label>
                  <input type="text" class="form-control" name="agenda2-timing" placeholder="8:15-9:05am"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda2-type">Item 2 Type</label>
                  <select class="form-control" name="agenda2-type">
                    <?php
                      if ($numAgenda > 0) {
                        $tempType = fgets($file); 
                        $numAgenda = $numAgenda - 1;
  
                      } else {
                        $tempType = "";
                      }
                    ?>
                    <option <?php if($tempType === "Regular Class\n") echo "selected"; ?>>Regular Class</option>
                    <option <?php if($tempType === "Break/Lunch\n") echo "selected"; ?>>Break/Lunch</option>
                    <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                    <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                  </select>
                </div>
              </div>

            </div>



            <div class="row"> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda3-symbol">Item 3 Symbol</label>
                  <input type="text" class="form-control" name="agenda3-symbol" placeholder="Br"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda3-timing">Item 3 Timing</label>
                  <input type="text" class="form-control" name="agenda3-timing" placeholder="10:05-10:15am"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda3-type">Item 3 Type</label>
                  <select class="form-control" name="agenda3-type">
                    <?php
                      if ($numAgenda > 0) {
                        $tempType = fgets($file); 
                        $numAgenda = $numAgenda - 1;
  
                      } else {
                        $tempType = "";
                      }
                    ?>
                    <option <?php if($tempType === "Regular Class\n") echo "selected"; ?>>Regular Class</option>
                    <option <?php if($tempType === "Break/Lunch\n") echo "selected"; ?>>Break/Lunch</option>
                    <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                    <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                  </select>
                </div>
              </div>

            </div>





            <div class="row"> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda4-symbol">Item 4 Symbol</label>
                  <input type="text" class="form-control" name="agenda4-symbol" placeholder="3"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda4-timing">Item 4 Timing</label>
                  <input type="text" class="form-control" name="agenda4-timing" placeholder="10:05-10:15am"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda4-type">Item 4 Type</label>
                  <select class="form-control" name="agenda4-type">
                    <?php
                      if ($numAgenda > 0) {
                        $tempType = fgets($file); 
                        $numAgenda = $numAgenda - 1;
  
                      } else {
                        $tempType = "";
                      }
                    ?>
                    <option <?php if($tempType === "Regular Class\n") echo "selected"; ?>>Regular Class</option>
                    <option <?php if($tempType === "Break/Lunch\n") echo "selected"; ?>>Break/Lunch</option>
                    <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                    <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                  </select>
                </div>
              </div>

            </div>



            <div class="row"> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda5-symbol">Item 5 Symbol</label>
                  <input type="text" class="form-control" name="agenda5-symbol" placeholder="3"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda5-timing">Item 5 Timing</label>
                  <input type="text" class="form-control" name="agenda5-timing" placeholder="10:05-10:15am"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda5-type">Item 5 Type</label>
                  <select class="form-control" name="agenda5-type">
                    <?php
                      if ($numAgenda > 0) {
                        $tempType = fgets($file); 
                        $numAgenda = $numAgenda - 1;
  
                      } else {
                        $tempType = "";
                      }
                    ?>
                    <option <?php if($tempType === "Regular Class\n") echo "selected"; ?>>Regular Class</option>
                    <option <?php if($tempType === "Break/Lunch\n") echo "selected"; ?>>Break/Lunch</option>
                    <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                    <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                  </select>
                </div>
              </div>

            </div>



            <div class="row"> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda6-symbol">Item 6 Symbol</label>
                  <input type="text" class="form-control" name="agenda6-symbol" placeholder="3"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda6-timing">Item 6 Timing</label>
                  <input type="text" class="form-control" name="agenda6-timing" placeholder="10:05-10:15am"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda6-type">Item 6 Type</label>
                  <select class="form-control" name="agenda6-type">
                    <?php
                      if ($numAgenda > 0) {
                        $tempType = fgets($file); 
                        $numAgenda = $numAgenda - 1;
  
                      } else {
                        $tempType = "";
                      }
                    ?>
                    <option <?php if($tempType === "Regular Class\n") echo "selected"; ?>>Regular Class</option>
                    <option <?php if($tempType === "Break/Lunch\n") echo "selected"; ?>>Break/Lunch</option>
                    <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                    <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                  </select>
                </div>
              </div>

            </div>  






            <div class="row"> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda7-symbol">Item 7 Symbol</label>
                  <input type="text" class="form-control" name="agenda7-symbol" placeholder="3"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda7-timing">Item 7 Timing</label>
                  <input type="text" class="form-control" name="agenda7-timing" placeholder="10:05-10:15am"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda7-type">Item 7 Type</label>
                  <select class="form-control" name="agenda7-type">
                    <?php
                      if ($numAgenda > 0) {
                        $tempType = fgets($file); 
                        $numAgenda = $numAgenda - 1;
  
                      } else {
                        $tempType = "";
                      }
                    ?>
                    <option <?php if($tempType === "Regular Class\n") echo "selected"; ?>>Regular Class</option>
                    <option <?php if($tempType === "Break/Lunch\n") echo "selected"; ?>>Break/Lunch</option>
                    <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                    <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                  </select>
                </div>
              </div>

            </div>



            <div class="row"> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda8-symbol">Item 8 Symbol</label>
                  <input type="text" class="form-control" name="agenda8-symbol" placeholder="3"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda8-timing">Item 8 Timing</label>
                  <input type="text" class="form-control" name="agenda8-timing" placeholder="10:05-10:15am"
                    <?php
                      if ($numAgenda > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                      }
                    ?>
                  >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="agenda8-type">Item 8 Type</label>
                  <select class="form-control" name="agenda8-type">
                    <?php
                      if ($numAgenda > 0) {
                        $tempType = fgets($file); 
                        $numAgenda = $numAgenda - 1;
  
                      } else {
                        $tempType = "";
                      }
                    ?>
                    <option <?php if($tempType === "Regular Class\n") echo "selected"; ?>>Regular Class</option>
                    <option <?php if($tempType === "Break/Lunch\n") echo "selected"; ?>>Break/Lunch</option>
                    <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                    <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                  </select>
                </div>
              </div>

            </div>




        <h3>Announcements <small>Little blurbs of text that go below the day's agenda. Avoid quotation marks. Use type label to customize color.</small></h3>

          <div class="row">
            <div class="form-group col-md-8"> 
              <label for="announcement1-text">Announcement 1 Text</label>
              <input type="text" class="form-control" name="announcement1-text" placeholder="Write announcement or information about any assembly/liturgy/event in agenda here, using the relevant type."
                <?php
                  if ($numAnnouncements > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                  }
                ?>
              >
            </div>
            <div class="form-group col-md-4">
              <label for="announcement1-type">Announcement 1 Type</label>
                <select class="form-control" name="announcement1-type">
                  <?php
                    if ($numAnnouncements > 0) {
                      $tempType = fgets($file); 
                      $numAnnouncements = $numAnnouncements - 1;
                    } else {
                      $tempType = "";
                    }
                  ?>

                  <option <?php if($tempType === "Standard\n") echo "selected"; ?>>Standard</option>
                  <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                  <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                </select>
            </div>
          </div>



          <div class="row">
            <div class="form-group col-md-8"> 
              <label for="announcement2-text">Announcement 2 Text</label>
              <input type="text" class="form-control" name="announcement2-text" placeholder="Write announcement or information about any assembly/liturgy/event in agenda here, using the relevant type."
                <?php
                  if ($numAnnouncements > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                  }
                ?>
              >
            </div>
            <div class="form-group col-md-4">
              <label for="announcement2-type">Announcement 2 Type</label>
                <select class="form-control" name="announcement2-type">
                  <?php
                    if ($numAnnouncements > 0) {
                      $tempType = fgets($file); 
                      $numAnnouncements = $numAnnouncements - 1;
                    } else {
                      $tempType = "";
                    }
                  ?>

                  <option <?php if($tempType === "Standard\n") echo "selected"; ?>>Standard</option>
                  <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                  <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                </select>
            </div>
          </div>

          
          <div class="row">
            <div class="form-group col-md-8"> 
              <label for="announcement3-text">Announcement 3 Text</label>
              <input type="text" class="form-control" name="announcement3-text" placeholder="Write announcement or information about any assembly/liturgy/event in agenda here, using the relevant type."
                <?php
                  if ($numAnnouncements > 0) {
                        echo sprintf("value=\"%s\"", fgets($file));
                  }
                ?>
              >
            </div>
            <div class="form-group col-md-4">
              <label for="announcement3-type">Announcement 3 Type</label>
                <select class="form-control" name="announcement3-type">
                  <?php
                    if ($numAnnouncements > 0) {
                      $tempType = fgets($file); 
                      $numAnnouncements = $numAnnouncements - 1;
                    } else {
                      $tempType = "";
                    }
                  ?>

                  <option <?php if($tempType === "Standard\n") echo "selected"; ?>>Standard</option>
                  <option <?php if($tempType === "Assembly/Liturgy\n") echo "selected"; ?>>Assembly/Liturgy</option>
                  <option <?php if($tempType === "Other\n") echo "selected"; ?>>Other</option>
                </select>
            </div>
          </div>

        </div>

        <input type="submit" class="btn btn-primary" form="main"></input>
<!--         <button type="submit" class="btn btn-primary">Submit</button>
 -->
      </form>

      <br><br><br><br>

      <!--
      <div class="starter-template">
        <h1 id="date"></h1>
        <script src="moment.min.js"></script>
        <script>
        document.getElementById("date").innerHTML = "Today is " + moment().format("dddd, MMMM Do, YYYY") + ".";
        </script>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div> 
      -->


    </div>

    <br><br>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

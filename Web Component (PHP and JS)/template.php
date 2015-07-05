<?php

$path = sprintf("templates/%s.txt", $_GET["day"]);
$contents = file_get_contents($path);
file_put_contents("schedule.txt", $contents);
file_put_contents("schedule_count.txt", "8\n0");

header("Location: schedule_set.php");

?>
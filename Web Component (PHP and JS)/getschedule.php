<?php

$file = "schedule_count.txt";
$contents = file_get_contents($file);
echo $contents;

echo "\n";

$file = "schedule.txt";
$contents = file_get_contents($file);
echo $contents;

?>
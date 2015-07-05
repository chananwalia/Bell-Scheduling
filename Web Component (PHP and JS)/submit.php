<?php

$file = fopen("schedule.txt","w");

$text = sprintf("%s\n", $_POST["date"]);
fwrite($file, $text);

$numAgenda = 0;

for ($i = 1; $i < 9; $i++) {
	$id = sprintf("agenda%d-symbol", $i);
	if (empty($_POST[$id])) {
		break;
	} else {
		$numAgenda = $numAgenda + 1;	

		$text = sprintf("%s\n", $_POST[$id]);
		fwrite($file, $text);

		$id = sprintf("agenda%d-timing", $i);
		$text = sprintf("%s\n", $_POST[$id]);
		fwrite($file, $text);

		$id = sprintf("agenda%d-type", $i);
		$text = sprintf("%s\n", $_POST[$id]);
		fwrite($file, $text);
	}
}

$numAnnouncements = 0;

for ($i = 1; $i < 4; $i++) {
	$id = sprintf("announcement%d-text", $i);

	if (empty($_POST[$id])) {
		break;
	} else {
		$numAnnouncements = $numAnnouncements + 1;
		$text = sprintf("%s\n", $_POST[$id]);
		fwrite($file, $text);

		$id = sprintf("announcement%d-type", $i);
		$text = sprintf("%s\n", $_POST[$id]);
		fwrite($file, $text);
	}
}

fclose($file);

$file = fopen("schedule_count.txt", "w");
$text = sprintf("%d\n%d", $numAgenda, $numAnnouncements);
fwrite($file, $text);
fclose($file);

header("Location: index.php");

?>
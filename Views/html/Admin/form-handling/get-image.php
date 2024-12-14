<?php
$name = $_GET['name'];
$files = glob("../../../bugScreenshots/" . $name . ".*");
header("Location: ../../../bugScreenshots/" . basename($files[0]));
?>

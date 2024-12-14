<?php

require_once __DIR__.'/../Controllers/dbController.php';

class PrioritiesController
{
	public static function getPriorityFromID($id)
	{
		$query = "SELECT * FROM priorities WHERE id = '$id';";
		$result = DbController::query($query);
		$row = $result->fetch_assoc();
		return $row['name'];
	}
}

?>

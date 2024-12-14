<?php

require_once __DIR__.'/../Controllers/dbController.php';

class BugsController
{
	public static function addBug($statusID, $dateCreated, $description, $projectID, $reporterID)
	{
		$query = "INSERT INTO bugs (status_id, date_created, description, project_id, reporter_id) VALUES ($statusID, '$dateCreated', '$description', $projectID, $reporterID);";
		DbController::query($query);
	}

	public static function deleteBug($id)
	{
		$query = "DELETE FROM bugs WHERE id = $id;";
		DbController::query($query);
	}

	public static function getBugsArray(string $orderBy, $assignedStaffID = '', $reporterID = '', $ascending = true)
	{
		$reporter = ($reporterID)? " WHERE reporter_id = $reporterID":"";
		$assignedStaff = ($assignedStaffID)? " WHERE assigned_staff_id = $assignedStaffID":"";
		if($reporter && $assignedStaff)
		{
			$assignedStaff = "";
			$reporter = " WHERE reporter_id = $reporterID AND assigned_staff_id = $assignedStaffID";
		}
		$order = ($ascending)? 'ASC':'DESC';

		$bugs = array();

		$query = 'SELECT * FROM bugs'.$reporter.$assignedStaff.' ORDER BY '.$orderBy.' '.$order.';';
		$result = DbController::query($query);
		while($row = $result->fetch_assoc())
		{
			$bug = new Bug($row);
			array_push($bugs, $bug);
		}

		return $bugs;
	}

	public static function getBug($bugID)
	{
		$query = "SELECT * FROM bugs WHERE id = $bugID;";
		$result = DbController::query($query);
		$bug = new Bug($result->fetch_assoc());

		return $bug;
	}
}

?>

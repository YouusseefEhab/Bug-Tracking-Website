<?php

require_once __DIR__ . '/../Controllers/bugsController.php';
require_once __DIR__ . '/../Controllers/dbController.php';
require_once __DIR__ . '/../Models/user.php';

class Bug
{
	private $id;
	private $priorityID;
	private $statusID;
	private $dateCreated;
	private $description;
	private $projectID;
	private $assignedStaffID;
	private $reporterID;
	private $assignedStaff;
	private $reporter;

	public function __construct($dbRow)
	{
		$this->id = $dbRow['id'];
		$this->priorityID = $dbRow['priority_id'];
		$this->statusID = $dbRow['status_id'];
		$this->dateCreated = $dbRow['date_created'];
		$this->description = $dbRow['description'];
		$this->projectID = $dbRow['project_id'];
		$this->assignedStaffID = $dbRow['assigned_staff_id'];
		$this->reporterID = $dbRow['reporter_id'];

		if($this->isAssigned())
		{
			$query = 'SELECT * FROM users WHERE id = ' . $this->assignedStaffID . ';';
			$result = DbController::query($query);
			$this->assignedStaff = new User($result->fetch_assoc());
		}

		$query = 'SELECT * FROM users WHERE id = ' . $this->reporterID . ';';
		$result = DbController::query($query);
		$this->reporter = new User($result->fetch_assoc());
	}

	public function getID()
	{
		return $this->id;
	}

	public function getPriorityID()
	{
		return $this->priorityID;
	}

	public function getStatusID()
	{
		return $this->statusID;
	}

	public function getDateCreated()
	{
		return $this->dateCreated;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getProjectID()
	{
		return $this->projectID;
	}

	public function getPriorityColor()
	{
		if($this->priorityID == 1)
			return '#ff6361';
		if($this->priorityID == 2)
			return '#494ca2';
		if($this->priorityID == 3)
			return '#6f975c';
		return '#000000';
	}

	public function getPriority()
	{
		$query = 'SELECT * FROM priorities WHERE id = ' . $this->priorityID . ';';
		$result = DbController::query($query);
		return $result->fetch_assoc()['priority'];
	}

	public function getStatus()
	{
		$query = 'SELECT * FROM statuses WHERE id = ' . $this->statusID . ';';
		$result = DbController::query($query);
		return $result->fetch_assoc()['status'];
	}

	public function getAssignedStaff()
	{
		return $this->assignedStaff;
	}

	public function getReporter()
	{
		return $this->reporter;
	}

	public function isAssigned()
	{
		return !is_null($this->assignedStaffID);
	}
}

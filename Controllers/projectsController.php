<?php

require_once __DIR__.'/../Controllers/dbController.php';
require_once __DIR__.'/../Controllers/categoriesController.php';
require_once __DIR__.'/../Models/project.php';

class ProjectsController
{
	public static function getProjectID($projectName)
	{
		$query = "SELECT * FROM projects WHERE name = '$projectName';";
		$result = DbController::query($query);
		$row = $result->fetch_assoc();
		return $row['id'];
	}

	public static function getProjectFromID($id)
	{
		$query = "SELECT * FROM projects WHERE id = '$id';";
		$result = DbController::query($query);
		$row = $result->fetch_assoc();
		return $row['name'];
	}

	public static function getCategory($projectId)
	{
		$query = "SELECT * FROM projects WHERE id = '$projectId';";
		$result = DbController::query($query);
		$row = $result->fetch_assoc();
		return $row['category'];
	}

	public static function isProjectNameTaken($name)
	{
		$query = "SELECT * FROM projects WHERE name = '$name';";
		$result = DbController::query($query);

		if(mysqli_num_rows($result) == 0){ return false; } else { return true; }
	}

	public static function addProject($name, $category)
	{
		$categoryID = CategoriesController::getCategoryID($category);
		$query = "INSERT INTO projects (name, category_id) VALUES ('$name', '$categoryID');";
		DbController::query($query);
	}

	public static function deleteProject($name)
	{
		$query = "DELETE FROM projects WHERE name = '$name';";
		DbController::query($query);
	}

	public static function getProjectsArray()
	{
		$projects = array();

		$query = 'SELECT * FROM projects';
		$result = DbController::query($query);
		while($row = $result->fetch_assoc())
		{
			$project = new Project($row);
			array_push($projects, $project);
		}

		return $projects;
	}
}

?>

<?php

require_once __DIR__ . '/../Controllers/dbController.php';

class CategoriesController
{
	public static function getCategoryID($categoryName)
	{
		$query = "SELECT * FROM categories WHERE name = '$categoryName';";
		$result = DbController::query($query);
		$row = $result->fetch_assoc();
		return $row['id'];
	}

	public static function getCategoryFromID($id)
	{
		$query = "SELECT * FROM categories WHERE id = '$id';";
		$result = DbController::query($query);
		$row = $result->fetch_assoc();
		return $row['name'];
	}
}

<?php
class Project
{
	private $id;
	private $name;
	private $categoryID;

	public function __construct($dbRow)
	{
		$this->id = $dbRow['id'];
		$this->name = $dbRow['name'];
		$this->categoryID = $dbRow['category_id'];
	}

	public function getID()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getCategoryID()
	{
		return $this->categoryID;
	}
}

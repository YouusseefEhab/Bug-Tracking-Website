<?php
class DbController
{
	private static $host = 'localhost';
	private static $user = 'root';
	private static $password = '';
	private static $dbName = 'mydb';

	public static function openConnection()
	{
		return new mysqli(self::$host, self::$user, self::$password, self::$dbName);
	}

	public static function query($query)
	{
		$conn = self::openConnection();
		$result = $conn->query($query);
		$conn->close();

		return $result;
	}
}

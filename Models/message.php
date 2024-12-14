<?php
require_once __DIR__ . '/../Controllers/dbController.php';
require_once __DIR__ . '/../Controllers/messagesController.php';
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/bug.php';

class Message
{
	private $id;
	private $message;
	private $senderID;
	private $receiverID;
	private $bugID;
	private $sender;
	private $receiver;
	private $bug;

	public function __construct($dbRow)
	{
		$this->id = $dbRow['id'];
		$this->message = $dbRow['message'];
		$this->senderID = $dbRow['sender_id'];
		$this->receiverID = $dbRow['receiver_id'];
		$this->bugID = $dbRow['bug_id'];

		$query = 'SELECT * FROM users WHERE id = ' . $this->senderID . ';';
		$result = DbController::query($query);
		$this->sender = new User($result->fetch_assoc());

		$query = 'SELECT * FROM users WHERE id = ' . $this->receiverID . ';';
		$result = DbController::query($query);
		$this->receiver = new User($result->fetch_assoc());

		$query = 'SELECT * FROM bugs WHERE id = ' . $this->bugID . ';';
		$result = DbController::query($query);
		$this->bug = new Bug($result->fetch_assoc());
	}

	public function getID()
	{
		return $this->id;
	}

	public function getMessage()
	{
		return $this->message;
	}

	public function getSender()
	{
		return $this->sender;
	}

	public function getReceiver()
	{
		return $this->receiver;
	}

	public function getBug()
	{
		return $this->bug;
	}
}

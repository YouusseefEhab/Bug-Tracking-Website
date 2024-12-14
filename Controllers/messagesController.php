<?php
require_once __DIR__.'/../Controllers/dbController.php';
require_once __DIR__.'/../Models/message.php';

class MessagesController
{
	public static function addMessage($message, $senderID, $receiverID, $bugID)
	{
		$query = "INSERT INTO messages (message, sender_id, receiver_id, bug_id) VALUES ('$message', '$senderID', '$receiverID', '$bugID');";
		DbController::query($query);
	}

	public static function deleteMessage($id)
	{
		$query = "DELETE FROM messages WHERE id = '$id';";
		DbController::query($query);
	}

	public static function getMessagesArray($receiverID, $bugID = '')
	{
		$messages = array();

		$bug = ($bugID)? " AND bug_id = $bugID":"";

		$query = "SELECT * FROM messages WHERE receiver_id = $receiverID"."$bug;";
		$result = DbController::query($query);
		while($row = $result->fetch_assoc())
		{
			$message = new Message($row);
			array_push($messages, $message);
		}

		return $messages;
	}
}

?>

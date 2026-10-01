<?php namespace App\Controllers\Traits;

use Ratchet\ConnectionInterface;
use \WebSocket\Client;

Trait WSTrait
{
	protected $clients;

	public function __construct() 
	{
		$this->clients = new \SplObjectStorage;
	}

	public function onOpen(ConnectionInterface $conn)
	{
		$this->clients->attach($conn);

		log_message('debug', 'New connection! (' . $conn->resourceId .")\n");
	}

	public function onMessage(ConnectionInterface $from, $msg)
	{
		$numRecv = count($this->clients) - 1;

		log_message('debug', sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's'));

		foreach ($this->clients as $client)
		{
			if ($from !== $client)
			{
				$client->send($msg);
			}
		}
	}

	public function onClose(ConnectionInterface $conn)
	{
		$this->clients->detach($conn);

		log_message('debug', 'Connection ' . $conn->resourceId . " has been disconnected\n");
	}

	public function onError(ConnectionInterface $conn, \Exception $e)
	{
		log_message('debug', 'A connection error has occurred: ' . $e->getMessage() . "\n");

		$conn->close();
	}

	protected function pushMessage($msg)
	{
		try
		{
			$message = is_array($msg) ? json_encode($msg) : $msg;

			$client = new Client(getenv('WEBSOCKET_URL'));
			$client->send($message);
			$client->close();

			log_message('debug', sprintf('Connection has sent a push message "%s" to other connection%s' . "\n", $message));
		}
		catch (\Exception $e)
		{
			log_message('debug', 'A push message error has occurred: ' . $e->getMessage() . "\n");
		}
	}
}
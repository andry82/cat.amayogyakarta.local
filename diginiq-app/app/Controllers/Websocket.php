<?php namespace App\Controllers;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Websocket extends PublicController
{
	public function start()
	{
		$server = IoServer::factory(
			new HttpServer(
				new WsServer(
					new AuthController()
				)
			),
			getenv('WEBSOCKET_PORT')
		);

		$server->run();
	}
}
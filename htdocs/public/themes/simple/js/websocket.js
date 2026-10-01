var conn = startWebsocket(WEBSOCKET_URL);
var msgQue;

function startWebsocket(websocketServerLocation, connectionString = 'Connection') {

    let ws = new WebSocket(websocketServerLocation);
	
	ws.onopen = function (e) {
		console.log(connectionString + " established!");
	};
	
	ws.onmessage = function (e) {
		var msg = e.data;
		/*
		if (typeof msg == 'string') {
			//var message = JSON.parse(msg);
	
			//console.log('message ' + message);
		}
		*/
	}

    ws.onclose = function() {
		setTimeout(function () {
			startWebsocket(websocketServerLocation, 'Reconnecting')
		}, 1000);
	};
	
	return ws;
}

function sendPush(conn, msg) {
	console.log(conn, msg);
	if (conn.readyState == 1)
	{
		if (typeof msg == 'object')
			msg = JSON.stringify(msg);

		conn.send(msg);
	}
	else
	{
		
	}
}

function sendMessage(msg, conn){
	waitForSocketConnection(conn, function () {
		
		if (typeof msg == 'object')
			msg = JSON.stringify(msg);

        conn.send(msg);
    });
}

function waitForSocketConnection(socket, callback){
    setTimeout(
        function () {
            if (socket.readyState === 1) {
                if (callback != null){
                    callback();
                }
            } else {
                waitForSocketConnection(socket, callback);
            }
        }, 5); // wait 5 milisecond for the connection...
}
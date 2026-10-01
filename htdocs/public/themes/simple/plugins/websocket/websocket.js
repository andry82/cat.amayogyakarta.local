var conn = new ReconnectingWebSocket(WEBSOCKET_URL);

//conn.debug = true;

conn.removeEventListener('open', () => {});
conn.removeEventListener('message', () => {});
conn.removeEventListener('error', () => {});
conn.removeEventListener('close', () => {});

conn.addEventListener('open', () => {
	wsConnected = true;
	toggleStatus();
	//console.log('ws-open');
});

conn.addEventListener('message', (e) => {
	var msg = e.data;

	if (typeof msg == 'string') {
		var message = JSON.parse(msg);

		//console.log(message);
	}
});

conn.addEventListener('error', () => {
	$('#socketStatus').removeClass('d-none');
	//console.error('ws-error');
});

conn.addEventListener('close', () => {
	$('#socketStatus').removeClass('d-none');
	//console.error('ws-close');
});

function sendPush(conn, msg) {

	if (conn.readyState !== undefined && conn.readyState == 1)
	{
		if (typeof msg == 'object')
			msg = JSON.stringify(msg);

		conn.send(msg);
	}
}

setInterval(function(){
	wsConnected = !!((conn.readyState !== undefined) && conn.readyState);
	toggleStatus();
}, 2000);
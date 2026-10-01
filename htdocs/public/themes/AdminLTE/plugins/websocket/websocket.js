var conn = new ReconnectingWebSocket(WEBSOCKET_URL);

conn.debug = true;

conn.removeEventListener('open', () => {});
conn.removeEventListener('message', () => {});
conn.removeEventListener('error', () => {});
conn.removeEventListener('close', () => {});

conn.addEventListener('open', () => {
	wsConnected = true;
	toggleStatus();
});

conn.addEventListener('message', (e) => {
	var msg = e.data;

	if (typeof msg == 'string') {
		var message = JSON.parse(msg);

		if (message.type == 'update-praktik') {
			$(`input[name="nilai[${message.keyval}][${message.field}]"]`).val(message.value);

			$('td#' + message.prefix + 'skor_word').html('').html(message.skor_word);
			$('td#' + message.prefix + 'skor_excel').html('').html(message.skor_excel);
			$('td#' + message.prefix + 'skor_ppt').html('').html(message.skor_ppt);
			$('td#' + message.prefix + 'skor_email').html('').html(message.skor_email);
			$('td#' + message.prefix + 'skor_praktik').html('').html(message.skor_praktik);
			$('td#' + message.prefix + 'interview1').html('').html(message.interview1);
			$('td#' + message.prefix + 'interview2').html('').html(message.interview2);
			$('td#' + message.prefix + 'interview3').html('').html(message.interview3);
			$('td#' + message.prefix + 'skor_wawancara').html('').html(message.skor_wawancara);
		}

		console.log(message);
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

console.log(conn);

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
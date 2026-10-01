$.LoadingOverlaySetup({
	/*background: "rgba(255, 140, 0, 0.6)",*/
	text: "",
	textClass: "loading-text",
	progress: true,
	image: plugin_url + "/loading/svg/bars.svg",
	imageClass: "cyan-text",
	imageOrder: 10,
});

function loading() {
	$.LoadingOverlay('show');
}

function loadingInfo(text, progress) {

	if (typeof progress == 'number') {
		$.LoadingOverlay("progress", progress);
	}

	var msg = typeof text == 'string' ? text : 'Processing...';
	$.LoadingOverlay('show', {
		text: msg,
	});
}

function loadingUpdate(text) {
	var msg = typeof text == 'string' ? text : 'Still Processing...';
	$.LoadingOverlay('text', msg);
}

function loadingHide() {
	$.LoadingOverlay('hide', true);
}

$(document).ajaxSend(function(event, jqxhr, settings){
    //loading();
});

$(document).ajaxStop(function(event, jqxhr, settings){
    //loadingHide();
});
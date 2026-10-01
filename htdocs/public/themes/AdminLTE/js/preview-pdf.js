$('.prev-pdf').each(function () {
	var url = site_url + 'viewer/pdf?file=';
	var src = url + $(this).data('src');
	$(this).alertOnClick({
		'iframe': src,
		'size': 'lg',
		fullscreen: true,
	});
});

$('.prev-image').each(function () {
	var src = $(this).data('src');
	$(this).alertOnClick({
		'image': src,
		'imageWidth': '100%',
		'size': 'lg',
		'noPadContent':true
	});
});
$(function () {
	// inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
	responsiveStack();

	$('.table-responsive-stack').each(function () {
		var thCount = $(this)
			.find("th")
			.length;
		var rowGrow = 100 / thCount + '%';

		$(this)
			.find("th, td")
			.css('flex-basis', rowGrow);
	});

	function flexTable() {
		if ($(window).width() < 768) {

			$(".table-responsive-stack")
				.each(function (i) {
					$(this)
						.find(".table-responsive-stack-thead")
						.show();
					$(this)
						.find('thead')
						.hide();
				});

			// window is less than 768px
		} else {

			$(".table-responsive-stack")
				.each(function (i) {
					$(this)
						.find(".table-responsive-stack-thead")
						.hide();
					$(this)
						.find('thead')
						.show();
				});

		}
		// flextable
	}

	flexTable();

	window.onresize = function (event) {
		flexTable();
	};
});

function responsiveStack()
{
	$('.table-responsive-stack').each(function (i) {
		var id = $(this).prop('id');
		var col = 0, step = 0;

		$(this)
			.find("th")
			.each(function (i) {
				var hasColspan = $(this).prop('colSpan');
				if (hasColspan > 1) {
					col = i + step;
					step++;
				}
				else {
					col = i;
				}
				var text = $(this).text();

				if (typeof text == 'string' && text.length) {
					$('#' + id + ' tbody td:nth-child(' + (col + 1) + ')').prepend('<span class="table-responsive-stack-thead">' + text + ' : </span> ');
				}
				//$('.table-responsive-stack-thead').hide();
			});
	});
}
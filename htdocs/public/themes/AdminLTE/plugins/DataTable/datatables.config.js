// uncomment this to extend custom display and custom language

$.extend( true, $.fn.dataTable.defaults, {
    "dom" : "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-2 text-left'i><'col-sm-10 text-right'p>>",
   "language": {
        "url": theme_url + "plugins/DataTable/id-ID.json"
    }
});

$(function () {
	if ($('.datatable-grid').length) {
		$('.datatable-grid').each(function (i, el) {
			var paging = $(this).data('paging') || true;
			var ordering = $(this).data('ordering') || true;
			var searching = $(this).data('searching') || true;
			var info = $(this).data('info') || true;
			var regex = $(this).data('regex') || false;

			var tId = $(this).prop('id');
			var obj = tId.length ? '#' + tId : this;
			var oTable = tId.replace('-', '_');

			$(obj).find('tfoot th').each(function (i) {
				if (! $(this).hasClass('unfilter')) {
					var uid = tId + '_' + i;
					var txt = $(this).data('text');
					$(this).html('<input type="text" id="' + uid + '" class="search-input form-control" placeholder="Cari ' + txt + '" value=""/>');
				}
			});

			window[oTable] = $(obj).DataTable({
				'paging': paging,
				'lengthChange': true,
				'searching': searching,
				'ordering': ordering,
				'info': info,
				'autoWidth': true,
				'stateSave': false,
				'serverSide': false,
				'search': {
					'regex': regex
				  },
				initComplete: function () {
					var table = this.api();

					// Apply the search
					this.api().columns().every( function () {
						var that = this;
		 
						$('input', this.footer()).on('keyup clear click', function () {
							/*
							var uid = tId + '_' + i;
							localStorage.setItem(uid, this.value);
							*/

							if (that.search() !== this.value) {
								table
									.search(this.value)
									.draw();
							}
						});
					});
				}
			});
			/*
			$(".search-input").each(function (i) {
				var uid = tId + '_' + i;
				var lsValue = localStorage.getItem(uid);

				if (lsValue && lsValue.length) {
					$('#' + uid).val(lsValue);
				}
			});
			*/
		});
	}

	if ($('.datatable-ss').length) {
		$('.datatable-ss').each(function (i, obj){
			var ajaxUrl = $(this).data('ajax');
			$('.datatable-ss').DataTable({
				'paging': true,
				'lengthChange': true,
				'searching': true,
				'ordering': true,
				'info': true,
				'autoWidth': true,
				'stateSave': true,
				'processing': true,
				'serverSide': true,
				'sServerMethod': 'POST',
				'ajax': {
					'url': ajaxUrl,
					'type': 'POST'
				}
			});
		});
	}
});
/*
function searchColumn(dataTable)
{
	$('.search-input').each(function () {
        var type = $(this).prop('type');

		var value = '';

		if ($(this).is('input')) {
			if ($.inArray(type, ['text', 'number', 'email', 'password']) >= 0) {
                value = $(this).val();
            } else if ($.inArray(type, ['checkbox', 'radio'])) {
				$.each($(this), function (_, el) {
					value = $(el+':checked').val();
				});
			}
		} else if ($(this).is('select')) {
			value = $(this).val();
		}
		var i = $(this).data('column');
		console.log(i, value);

		dataTable.columns(i).search(value).draw();
    });
}
*/
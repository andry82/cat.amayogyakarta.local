$(document).ready(function () {

	if ($('.mask-bigalphanum').length) {
		$(".mask-bigalphanum").inputmask({
			mask: "-{*} -{*} -{*} -{*} -{*} -{*} -{*} -{*}",
			casing: "upper",
			greedy: false,
			placeholder: "",
			definitions: {
				"-": {
					validator: "[0-9A-Z-.,/]"
				}
			}
		});
	}

	if ($('.mask-bigname').length) {
		$(".mask-bigname").inputmask({
			mask: "a{*} a{*} a{*} a{*} a{*} a{*} a{*} a{*}",
			casing: "upper",
			greedy: false,
			placeholder: "",
			definitions: {
				"a": {
					validator: "[A-Z-]"
				}
			}
		});
	}

	if ($('.mask-bigname-custom').length) {
		$(".mask-bigname-custom").inputmask({
			mask: "a{*} a{*} a{*} a{*} a{*} a{*} a{*} a{*}",
			casing: "upper",
			greedy: false,
			placeholder: "",
			definitions: {
				"a": {
					validator: "[A-Z-.']"
				}
			}
		});
	}

	if ($('.mask-email').length) {
		$(".mask-email").inputmask({
			mask: "*{1,64}[.*{1,64}][.*{1,64}][.*{1,63}]-{1,63}-{1,63}[-{1,63}][-{1,63}]",
			greedy: false,
			casing: "lower",
			placeholder: "",
			onBeforePaste: function (pastedValue, opts) {
				pastedValue = pastedValue.toLowerCase();
				return pastedValue.replace("mailto:", "");
			},
			definitions: {
				"*": {
					validator: "[0-9\uFF11-\uFF19A-Za-z\u0410-\u044F\u0401\u0451\u00C0-\u00FF\u00B5!#$%&'*+/=?^_`{|}~-]"
				},
				"-": {
					validator: "[0-9A-Za-z-@.]"
				}
			},
			onUnMask: function (maskedValue, unmaskedValue, opts) {
				return maskedValue;
			},
			inputmode: "email"
		});
	}

	if ($('.mask-email-valid').length) {
		$(".mask-email-valid").inputmask({
			mask: "*{1,64}[.*{1,64}][.*{1,64}][.*{1,63}]@-{1,63}.-{1,63}[.-{1,63}][.-{1,63}]",
			greedy: false,
			casing: "lower",
			placeholder: "",
			onBeforePaste: function (pastedValue, opts) {
				pastedValue = pastedValue.toLowerCase();
				return pastedValue.replace("mailto:", "");
			},
			definitions: {
				"*": {
					validator: "[0-9\uFF11-\uFF19A-Za-z\u0410-\u044F\u0401\u0451\u00C0-\u00FF\u00B5!#$%&'*+/=?^_`{|}~-]"
				},
				"-": {
					validator: "[0-9A-Za-z-]"
				}
			},
			onUnMask: function (maskedValue, unmaskedValue, opts) {
				return maskedValue;
			},
			inputmode: "email"
		});
	}

	if ($('.mask-num').length) {
		$(".mask-num").inputmask({
			mask: "9{*}",
			placeholder: ""
		});
	}

	if ($('.mask-date-id').length) {
		$(".mask-date-id").inputmask({
			mask: "9{2}-9{2}-9{4}",
			placeholder: ""
		});
	}

	if ($('.mask-num3').length) {
		$(".mask-num3").inputmask({
			mask: "9{3}",
			placeholder: ""
		});
	}

	if ($('.mask-num2').length) {
		$(".mask-num2").inputmask({
			mask: "9{2}",
			placeholder: ""
		});
	}

	if ($('.mask-num4').length) {
		$(".mask-num4").inputmask({
			mask: "9{4}",
			placeholder: ""
		});
	}

	if ($('.mask-num5').length) {
		$(".mask-num5").inputmask({
			mask: "9{5}",
			placeholder: ""
		});
	}

	if ($('.mask-nik').length) {
		$(".mask-nik").inputmask({
			mask: "9{16}",
			placeholder: ""
		});
	}

	if ($('.mask-hp').length) {
		$(".mask-hp").inputmask({
			mask: "9{14}",
			placeholder: ""
		});
	}

	if ($('.mask-uang').length) {
		$('.mask-uang').inputmask("9{1,3},9{1,3},9{3}", {numericInput: true, placeholder: ""});
	}

	if ($('.mask-tahun-akademik').length) {
		$(".mask-tahun-akademik").inputmask({
			mask: "9999/9999",
			placeholder: ""
		});
	}

	if ($('.mask-jam').length) {
		$(".mask-jam").inputmask({
			mask: "99:99",
			placeholder: ""
		});
	}
});

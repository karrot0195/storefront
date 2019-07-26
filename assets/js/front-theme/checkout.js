(function($){
	if ($('#createaccount').length) {
		$('#createaccount').on('change', function () {
			if ($(this).is(':checked')) {
				$('.createaccount-notify').show();
			} else {
				$('.createaccount-notify').hide();
			}
		});
	}

})(jQuery);
(function ($) {
	$(function () {
		$(".table tbody tr").hover(
			function () {
				$(this).addClass("hover");
			}, 
			function () {
				$(this).removeClass("hover");
			}
		);
	});
})(jQuery);



$(document).ready(function() {
	$('#datepickerInRooms')
			.datepicker({
				format: 'yyyy/mm/dd',
				language: 'ru',
				autoclose: 'true'
			});
	$('#datepickerOutRooms')
			.datepicker({
				format: 'yyyy/mm/dd',
				language: 'ru',
				autoclose: 'true'
			});
	$('#datepickerInExcursions')
			.datepicker({
				format: 'yyyy/mm/dd',
				language: 'ru',
				autoclose: 'true'
			});
	$('#datepickerOutExcursions')
			.datepicker({
				format: 'yyyy/mm/dd',
				language: 'ru',
				autoclose: 'true'
			});
	$('#datepickerInCars')
			.datepicker({
				format: 'yyyy/mm/dd',
				language: 'ru',
				autoclose: 'true'
			});
	$('#datepickerOutCars')
			.datepicker({
				format: 'yyyy/mm/dd',
				language: 'ru',
				autoclose: 'true'
			});
});

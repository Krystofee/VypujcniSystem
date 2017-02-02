$(document).on('change', '#item-img', function() {
	$('#item-img-name').html($('#item-img')[0].files[0].name);
});

$(document).on('change', '#item-prew', function() {
	$('#item-prew-name').html($('#item-prew')[0].files[0].name);
});
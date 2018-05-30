// Simple jQuery for updating the text
// when a radio button is clicked
$('#smileys input').on('click', function() {
	$('#result').html($(this).val());
});
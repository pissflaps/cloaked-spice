$(document).ready(function()
{
	$('table#delTable td a.delete').click(function()
	{
		if (confirm("Are you sure you want to delete this row?"))
		{
			var id = $(this).parent().parent().attr('id');
			var data = 'id=' + id ;
			var parent = $(this).parent().parent();

			$.ajax(
			{
				   type: "POST",
				   url: "delete_row.php",
				   data: data,
				   cache: false,

				   success: function()
				   {
					parent.fadeOut('slow', function() {$(this).remove();});
				   }
			 });
		}
	});

	// style the table with alternate colors
	// sets specified color for every odd row
	$('table#delTable tr:odd').css('background',' #FFFFFF');
});
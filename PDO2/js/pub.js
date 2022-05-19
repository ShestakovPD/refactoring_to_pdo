jQuery(document).ready(function($) {
	$(".pub").click(function() {
	var publicTitle = $(this).attr("title");
	var titleID = $(this).attr("id");
	var nameId = $(this);
		$.ajax(
			{ 
				url:'pub.php',
				type:'post',
				data:{"id": publicTitle},  
				success:function (publicObj,test) {
				var result = $.parseJSON(publicObj); 				
				$(nameId).html(result.title).hide().fadeIn(1000); 
				}
				}
			);					
	});	
});
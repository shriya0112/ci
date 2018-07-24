$(document).ready(function(){
	$('#cvalidate').validate({
		debug:true,
		rules:{
			name:{
				required:true
			}
		},
		 highlight: function(element, errorClass, validClass) {
        $('.error1').css({'display':'none'});
        },
		submitHandler:function(form)
		{
			form.submit();
		},
	});
});
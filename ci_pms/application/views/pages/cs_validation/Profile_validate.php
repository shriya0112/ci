<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	// For Validating Select Box
	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg !== value;
	});
// For Validating Number Of Image Files maximum 5
$.validator.addMethod("maxFilesToSelect", function(value, element, params) {
	var fileCount = element.files.length;
	if(fileCount > params ){
		return false;
	}
	else{
		return true;
	}
}, 'Select no more than 5 files');
$('#profile_validate').validate({
	debug :true,
	rules:{
		name:"required",
		email:{
			required:true,
			email:true
		},
		gender:{
			required:true
		},
		dob:"required",
		address:"required",
		mobile_number:"required"
	},
	errorClass: "help-inline",
	highlight:function(element, errorClass, validClass) {
		$(element).parents('.controls').addClass('error');
	},
	unhighlight: function(element, errorClass, validClass) {
		$(element).parents('.controls').removeClass('error');
	},
	submitHandler: function(form) {
		// do other things for a valid form
		form.submit();
		} 
	});
});
</script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$( "#dob" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#dob" ).datepicker("setDate", $.datepicker.parseDate( "dd-mm-yy",$('#dob').val() ));
	});
</script>

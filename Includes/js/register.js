$(document).ready(function(){
	// Functions + Global Var
	var jsonreturn = "false";
	var usname = false;
	var passwd = false;
	var email = false;
	
	// Buntton Enable/Disable
	function buttonEnable(){ $('#form-register').find(":submit").attr("disabled", false); }
	function buttonDisable(){ $('#form-register').find(":submit").attr("disabled", true); }
	
	// Show Error Message
	function errorMsg($msg){
		$('#error-dialog').find('.errormsg').html("<strong>Sorry</strong>, "+$msg+" Please try again.");
		$('#error-dialog').show('slow');
	}
	// Hide Error Message
	function noerrorMsg(){
		$('#error-dialog').hide('slow');
	}
	// Action called when field is correct
	function correct($){
		$.removeClass('error');
		$.addClass('correct');
		noerrorMsg();
		
		if(usname && passwd && email){
			buttonEnable();
		}
	}
	// Action called when field is incorrect
	function incorrect($){
		$.removeClass('correct');
		$.addClass('error');
		buttonDisable();
	}
	// Check if it is a valid email
	// Reference Stack Overflow
	function isValidEmail(emailText) {
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		return pattern.test(emailText);
	};
	
	// Inital
	buttonDisable();
	$('#error-dialog').hide();
	
	// Username Check
	$('#inputRegUsername').on('change keyup paste mouseup', function() {	
		if (jQuery.trim($(this).val()).length > 0) {
			$.post("/Bin/UsernameCheck.php", { inputUsername: $(this).val() }, function(data){ jsonreturn = data.valid; }, "json" );
			
			if(jsonreturn == "true"){
				correct($(this));
				usname = true;
			}else{
				incorrect($(this));
				errorMsg('Your username is either used or invalid.<br />Please note that your username should be in english alphbet and number only. The minium length of your username is 6.');
			}
		}else{
			incorrect($(this));
			errorMsg('You must give a username.');
		}
	});
	
	// Password Check
	$('#inputRegPassword').on('change keyup paste mouseup', function() {
		if(jQuery.trim($(this).val()).length >= 6){
			correct($(this));
		}else{
			incorrect($(this));
			errorMsg('Your password cannot be shorter than 6 words.');
		}
	});
	
	// Confirm Password
	$('#inputRegConPassword').on('change keyup paste mouseup', function() {
		if($('#inputRegPassword').val().length >= 6){
			if($(this).val() == $('#inputRegPassword').val()){
				correct($(this));
				correct($('#inputRegPassword'));
				passwd = true;
			}else{
				incorrect($(this));
				incorrect($('#inputRegPassword'));
				errorMsg('Your password does not match.');
			}
		}
	});
	
	// Email Check
	$('#inputRegEmail').on('change keyup paste mouseup', function() {
		if(isValidEmail($(this).val())){
			correct($(this));
			email = true;
		}else{
			incorrect($(this));
			errorMsg('Your email address is invalid. Please note that your email address will be use for activation. Do not use a email that you can no longer access.');
		}
	});
	
	// Form Check Before Submit
	$('#form-register').on('submit', function(){
		if(usname && passwd && email){
			return true;
		}else{
			return false;
		}
	});
});

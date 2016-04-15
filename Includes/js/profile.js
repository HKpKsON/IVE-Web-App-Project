$(document).ready(function(){
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
	}
	// Action called when field is incorrect
	function incorrect($){
		$.removeClass('correct');
		$.addClass('error');
	}
	// Check if it is a valid email
	// Reference Stack Overflow
	function isValidEmail(emailText) {
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		return pattern.test(emailText);
	};
	
	// Inital
	$('#error-dialog').hide();
	
	// Password Check
	$('#inputPassword').on('change keyup paste mouseup', function() {
		if(jQuery.trim($(this).val()).length >= 6){
			correct($(this));
		}else{
			incorrect($(this));
			errorMsg('Your password cannot be shorter than 6 words.');
		}
	});
	
	// Confirm Password
	$('#inputConPassword').on('change keyup paste mouseup', function() {
		if($('#inputPassword').val().length >= 6){
			if($(this).val() == $('#inputPassword').val()){
				correct($(this));
				correct($('#inputPassword'));
				passwd = true;
			}else{
				incorrect($(this));
				incorrect($('#inputPassword'));
				errorMsg('Your password does not match.');
			}
		}
	});
	
	// Email Check
	$('#inputEmail').on('change keyup paste mouseup', function() {
		if(isValidEmail($(this).val())){
			correct($(this));
			email = true;
		}else{
			incorrect($(this));
			errorMsg('Your email address is invalid. Please note that your email address will be use for activation. Do not use a email that you can no longer access.');
		}
	});
	
	// Form Check Before Submit
	$('#form-profile').on('submit', function(){
		if(jQuery.trim($('#inputLogin').val()).length >= 6){
			correct($('#inputLogin'));
			return true;
		}else{
			incorrect($('#inputLogin'));
			errorMsg('Your have to confirm changes with your current password.');
			return false;
		}
	});
});

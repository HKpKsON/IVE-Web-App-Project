// Reference: http://www.formvalidator.net
$(function() {
	var formRegister = {
		form : '.form-profile',
		validate : {
			'inputEmail' : {
				'validation' : 'email required',
				'error-msg-container' : '#error-dialog',
				'error-msg' : '<div class="alert alert-danger" role="alert"><ul><li>Please check your Email Address.</li></ul></div>'
			},
			'inputPassword' : {
				'validation' : 'alphanubmeric',
			},
			'inputConPassword' : {
				'validation' : 'alphanubmeric confirmation',
				'confirmation' : 'inputPassword',
				'error-msg-container' : '#error-dialog',
				'error-msg' : '<div class="alert alert-danger" role="alert"><ul><li>Your passwords does not match!</li></ul></div>'
			}
		}
	};
		
	$.validate({
		modules : 'jsconf, security',
		onModulesLoaded : function() {
			$.setupValidation( formRegister );
		}
	});
});
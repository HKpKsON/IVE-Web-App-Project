// Reference: http://www.formvalidator.net
$(function() {
	var formRegister = {
		form : '.form-register',
		validate : {
			'inputUsername' : {
				'validation' : 'length alphanubmeric required',
				'length' : '4-32',
				'error-msg-container' : '#error-dialog',
				'error-msg' : '<div class="alert alert-danger" role="alert"><ul><li>Username must be 4 to 32 english characters and numbers.</li></ul></div>'
			},
			'inputEmail' : {
				'validation' : 'email required',
				'error-msg-container' : '#error-dialog',
				'error-msg' : '<div class="alert alert-danger" role="alert"><ul><li>Please check your Email Address.</li></ul></div>'
			},
			'inputPassword' : {
				'validation' : 'length alphanubmeric required',
				'length' : 'min6',
				'error-msg-container' : '#error-dialog',
				'error-msg' : '<div class="alert alert-danger" role="alert"><ul><li>Your password is too weak, please make it longer.</li></ul></div>'
			},
			'inputConPassword' : {
				'validation' : 'length alphanubmeric confirmation required',
				'length' : 'min6',
				'confirmation' : 'inputPassword',
				'error-msg-container' : '#error-dialog',
				'error-msg' : '<div class="alert alert-danger" role="alert"><ul><li>Your passwords does not match!</li></ul></div>'
			},
		}
	};
		
	$.validate({
		modules : 'jsconf, security',
		onModulesLoaded : function() {
			$.setupValidation( formRegister );
		}
	});
});
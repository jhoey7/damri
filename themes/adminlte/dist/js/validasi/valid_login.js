
$(document).ready(function() {
 $('#loginForm')
        .bootstrapValidator({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                identity: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        }
                    }
                },
                password: {
			    validators: {
					notEmpty: {
					message: 'The password is required and cannot be empty'
					},
					different: {
					field: 'identity',
					message: 'The password cannot be the same as username'
						}
					}
				}               

            }
        });
 });
 
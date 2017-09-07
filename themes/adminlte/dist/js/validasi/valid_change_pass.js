

 $(document).ready(function() {
 $('#ChangePasswordForm')
        .bootstrapValidator({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                old: {
                    validators: {
                        notEmpty: {
                            message: 'The old password is required'
                        },
                        remote: {
							message: 'The password not the same with current password ',
							url: 'index.php/account/checkPassword',
							type: 'POST'
						}
                    }
                },
                new: {
			    validators: {
					notEmpty: {
					message: 'The password is required and cannot be empty'
					},
					different: {
					field: 'identity',
					message: 'The password cannot be the same as username'
						},
				    regexp:{
					 regexp: "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]{0,}).{8,}$",
					 message: 'The password should contain Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet and 1 Number:'
						}
				    
					}
				 },
	new_confirm: {
			validators: {
                        notEmpty: {
                        message: 'The confirm password is required and cannot be empty'
                        },
						identical: {
							field: 'new',
							message: 'The password and its confirm are not the same'
						}
					}
				}           

            }
        });
 });
 
 
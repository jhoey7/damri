
$(document).ready(function() {

    $('#contactForm')
        .bootstrapValidator({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    row: '.col-xs-4',
                    validators: {
                        notEmpty: {
                            message: 'The first name is required'
                        }
                    }
                },
                last_name: {
                    row: '.col-xs-4',
                    validators: {
                        notEmpty: {
                            message: 'The last name is required'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'The phone number is required'
                        },
                        regexp: {
                            message: 'The phone number can only contain the digits, spaces, -, (, ), + and .',
                            regexp: /^[0-9\s\-()+\.]+$/
                        }
                    }
                },
                ktp: {
                    validators: {
                        notEmpty: {
                            message: 'The Identity Number is required'
                        },
                        regexp: {
                            message: 'Identity mus contain only numbers',
                            regexp: /^[0-9\s\-()+\.]+$/
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        },
                        remote: {
							message: 'The email is already exist ',
							url: 'index.php/account/checkEmail',
							type: 'POST'
						}
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'The address is required'
                        }
                    }
                },
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
						},
				    regexp:{
					 regexp: "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]{0,}).{8,}$",
					 message: 'The password should contain Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet and 1 Number:'
						}
				    
					}
				 },
		        confirmPassword: {
					validators: {
                        notEmpty: {
                        message: 'The confirm password is required and cannot be empty'
                        },
						identical: {
							field: 'password',
							message: 'The password and its confirm are not the same'
						},
						different: {
							field: 'identity',
							message: 'The password cannot be the same as username'
						}
					}
				}
            }
        })
       
});



 $(document).ready(function() {
 $('#EditForm')
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
                address: {
                    validators: {
                        notEmpty: {
                            message: 'The message is required'
                        }
                    }
                },
                province: {
                    validators: {
                        notEmpty: {
                            message: 'The Province is required'
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: 'The City is required'
                        }
                    }
                },
                identity: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        },
                        remote: {
							message: 'The username is already exist ',
							url: 'index.php/account/checkUsername',
							type: 'POST'
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
				},                 
                bday: {
					validators: {
                        notEmpty: {
                            message: 'Birthday is required and cannto be empty'
                        }
					}
				}             

            }
        });
 });
 

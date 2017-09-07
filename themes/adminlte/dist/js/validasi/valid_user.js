
$(document).ready(function() {

    $('#userForm')
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
               level: {
                    validators: {
                        notEmpty: {
                            message: 'The field is required'
                        }
                    }
                }
            }
        })
       
});



 $(document).ready(function() {
 $('#formAddat3')
        .bootstrapValidator({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },

            fields: {
                bus: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Bus Tidak Boleh Kosong'
                        }
                    }
                }, 
                ops_date: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Tidak Boleh Kosong'
                        }
                    }
                },
                supir: {
                    validators: {
                        notEmpty: {
                            message: 'Pengemudi Tidak Boleh Kosong'
                        }
                    }
                }, 
                mekanik: {
                    validators: {
                        notEmpty: {
                            message: 'Mekanik Tidak Boleh Kosong'
                        }
                    }
                }
            }
        }); 
 });



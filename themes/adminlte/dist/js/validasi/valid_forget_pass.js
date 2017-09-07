
  $(document).ready(function() {
 $('#forgotForm')
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
                            message: 'The email address is required'
                        },
                        remote: {
							message: 'Username Not Found ',
							url: 'index.php/account/FindUsername',
							type: 'POST'
						}
                    }
                }        

            }
        });
 });
 
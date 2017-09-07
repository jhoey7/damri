
 $(document).ready(function() {
 $('#formAddcancel')
        .bootstrapValidator({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                reason: {
                    validators: {
                        notEmpty: {
                            message: 'Cancel reason is required'
                        }
                    }
                }
            }
        });
 });


$(document).ready(function() {
  //  var TIME_PATTERN = "^[0-1][0-9]:[0-5][0-9]$|^[2][0-3]:[0-5][0-9]$|^[2][3]:[0][0]$";
 $('#formAddSupir')
        .bootstrapValidator({
            framework: 'bootstrap',
            //excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nama_terminal: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                }, 
                comp: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                },
                 gm: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                },
                 nik_gm: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                },
                 staf: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                },
                 nik_staf: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                } 
            }
        });
 });
 
 

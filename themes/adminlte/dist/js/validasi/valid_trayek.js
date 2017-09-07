
$(document).ready(function() {
   // var TIME_PATTERN = "^[0-1][0-9]:[0-5][0-9]$|^[2][0-3]:[0-5][0-9]$|^[2][3]:[0][0]$";
 $('#formAddMaster')
        .bootstrapValidator({
            framework: 'bootstrap',
            //excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                tarif: {
                    validators: {
                        notEmpty: {
                            message: 'tarif Tidak Boleh Kosong'
                        }
                    },
                    regexp: {
                            message: 'Harus Angka',
                            regexp: /^[0-9]+$/
                        }
                }, 
                nama_trayek: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                } , 
                pool: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                } , 
                
                group: {
                    validators: {
                        notEmpty: {
                            message: 'Field Tidak Boleh Kosong'
                        }
                    }
                } 
            }
        });
 });
 
 

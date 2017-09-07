$('#birthday').datepicker({format: 'yyyy-mm-dd'}).on('changeDate', function(ev)
{                 
     $('.datepicker').hide();
     $('#contactForm').bootstrapValidator('revalidateField', 'bday');
});
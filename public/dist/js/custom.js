$(document).ready(function() {
    $('input[type=checkbox][name=status]').change(function() {
        id=  $(this).val();
        if ($(this).is(':checked')) {
         
           
            //alert(`${id} is checked`);
         

              $.post( "http://3.134.204.163/api/change/motel/status", { motel_id: id, status: true } )
            
                .done(function(data) {
                  alert( data );
                })
                .fail(function() {
                  alert( "error" );
                })
        }
        else {
            //alert(`${id} is unchecked`);
            $.post( "http://3.134.204.163/api/change/motel/status", { motel_id: id, status: false} )
            
                .done(function(data) {
                  alert( data );
                })
                .fail(function() {
                  alert( "error" );
                })
        }
    });
});



$(document).ready(function() {
    $(".checkout").click(function(){
        if(confirm('Are you sure you want to check out the guest?')){
        var id=$(this).attr('id')
       split= id.split("-")
        
       //alert( split[1] )


        $.ajax('api/check/out/guest', {
            type: 'POST',  // http method
            data: { id: split[1] },  // data to submit
            success: function (data, status, xhr) {
                alert(JSON.parse(data)['data'])
            },
            error: function (jqXhr, textStatus, errorMessage) {
                alert('Error checking out guest')
            }
        }); 

    }
    }); 



   

  /*  setTimeout(function(){
        location.reload();
    }, 3000);  */
    //900000

    $('#printer').click(function() {
        window.print();
    });


    $(".checkin").click(function(){
        if(confirm('Are you sure you want to check in the guest?')){
        var id=$(this).attr('id')
       split= id.split("-")
        
      
       


        $.ajax('api/check/in/guest', {
            type: 'POST',  // http method
            data: { id: split[1] },  // data to submit
            success: function (data, status, xhr) {
                alert(JSON.parse(data)['data'])
                
            },
            error: function (jqXhr, textStatus, errorMessage) {
                alert('Error checking out guest')
            }
        }); 

    }
    }); 

    var Difference_In_Days;
$('#reservationtime').change(function(){
   
  value=$(this).val()
    split= value.split("-")
     //alert(split[0])

    var date1 = new Date(split[0]);
   var date2 = new Date(split[1]);
      
    // To calculate the time difference of two dates
    var Difference_In_Time = date2.getTime() - date1.getTime();
      
    // To calculate the no. of days between two dates
     Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
    diff=Math.round(Difference_In_Days)
    //alert(diff)
})

$('#room').change(function(){
    id=$(this).val()
   price=id.split('-')
  cost_of_rent= price[1]* diff
    //alert(cost_of_rent)

    $('#rent_cost').val(cost_of_rent)
})

      
});
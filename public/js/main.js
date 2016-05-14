// Main javascript

//setup token to authenticate that its this site that sends the request to the server
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $('#userInput').val("").focus();
    $('#underPost').hide();
    // var id = 1;
    //
    // $.ajax({
    //     type: "DELETE",
    //     url: "score/" + id,
    //     success: function(data){
    //         console.log("success: ", data);
    //     }
    // });

    function initiate(){
        $.ajax({
            type: "GET",
            url: "get/",
            dataType: "json"
        });
    }
    initiate();

    $('#post').submit( function(e){
        e.preventDefault();

        //get data
        var dataString = "value=" + $('#userInput').val();

        $.ajax({
            type: "POST",
            url: "post/",
            data: dataString,
            success: function(data){
                console.log(data);
                //if x is returned append empty td after currentscore td else append currentscore td
                if (data.newscore=="x") {
                    $('#currentScore').append('<td colspan="1">'+data.newscore+'</td><td colspan="1"></td>');
                }else {
                    $('#currentScore').append('<td colspan="1">'+data.newscore+'</td>');
                }
                //counts td elements inside currentScore row
                var items = $('#currentScore td').length;
                //if even nbr or 10 elements append totalscore in totalScore row
                if (items % 2==0) {
                    $('#totalScore').append('<td  colspan="2">'+data.totalscore+'</td>');
                }
                if (items==10) {
                    $('#userInput').prop( "disabled", true );
                    $('#userBt').prop( "disabled", true );
                    $('#underPost').html('<h3> Bowling round finished!\n Please reload the page for another round. </h3>').slideDown(1000);
                }
                $('#userInput').val("").focus();
            }
        });
    });//end of submit
});//end of document ready

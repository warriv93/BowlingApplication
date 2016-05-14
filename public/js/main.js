// Main javascript

//first
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $('#userInput').val("").focus();
    // var id = 1;
    //
    // $.ajax({
    //     type: "DELETE",
    //     url: "score/" + id,
    //     success: function(data){
    //         console.log("success: ", data);
    //     }
    // });

    // //ajax get request
    // $.get('get/', function(response){
    //     console.log(response);
    //     $('#underInput').append(response);
    // });
    function getUpdates(){
        $.ajax({
            type: "GET",
            url: "get/",
            dataType: "json",
            success: function(data){
                console.log(data.value);
                $('#underInput').append(data.value);
            }
        });
    }
    getUpdates();

    $('#post').submit( function(e){

        // console.log("submitted");
        e.preventDefault();

        //get data
        var dataString = "value=" + $('#userInput').val();
        // console.log(dataString);

        //ajax post
        // $.post('post/', {value:data}, function(data){
        //     console.log(data);
        //     $('#postReqData').append(data.value);
        // });
        $.ajax({
            type: "POST",
            url: "post/",
            data: dataString,
            success: function(data){
                console.log(data);

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
                $('#userInput').val("").focus();
            }
        });

    });//end of submit
});//end of document ready

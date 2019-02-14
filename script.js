
// jQuery Document

$(document).ready( function(){
    //If user wants to end session
    $("#update").submit(function(e){
        e.preventDefault();
        var id= $("#id").html(); //id of the picture in the db
        var status;
        if( $("#likebutton").val() == "Like"){
            status = 1;
        }
        else{
            status = 0;
        }
                $.ajax({
                    type: "POST",
                    url: "insert.php",
                    data: {id: id, status: status},
                    cache: false,
                    success: function(data) {
                       //$("#likestatus").html("You like this!");
                       $("#likebutton").val("Unlike");
                       if(status == 1){
                            $("#likebutton").val("Unlike");
                        }
                        else{
                            $("#likebutton").val("Like");
                        }
                    }
                });
    });
    

    // //If user submits the form
    // $("#messageForm").submit(function(e){
    //     //e.preventDefault();	
    //     var clientmsg = $("#usermsg").val();
    //     $.post("post.php", {text: clientmsg});
    //     alert("pressed submit: " + $("#usermsg").val());				
    //     $("#usermsg").attr("value", "");
    //     //return false;
    // });

    // function loadLog(){		
    //     $.ajax({
    //     url: "log.html",
    //     cache: false,
    //         success: function(html){		
    //             $("#chatbox").html(html); //Insert chat log into the #chatbox div				
    //         },
    //     });
    // }
});

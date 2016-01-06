$(document).ready(function () {
    var BASE_URL = $("#hdnBaseUrl").val();

    $('body').focus();


    $("#pass_word, #user_name").on("keyup change click",function(){
        $("#errorMessage3").html("");
        $("#errorMessage2").html("");
        $("#errorMessage1").html("");
        $("#errorMessage4").html("");
        $('.errorMessage5').css('display','none');
    });

    $("#adminLoginForm").validate({

//        onkeyup: function(element){this.element(element);},
//        onfocusout: function(element){this.element(element);},

        rules:{

            user_name: {
                required : true
            },
            pass_word: {
                required : true
//                minlength : 8
            }
        },
        messages : {
            user_name: {
                required: "Username is required"
            },
            pass_word: {
                required: "Password is required"
//                minlength : "Minimum of 8 characters."
            }
        }
    });

    var options = {
        beforeSubmit: function()
        {
        },

        success: function(response)
        {
            if(response == "admin")
            {
                window.location.href = BASE_URL + "/admin/users";
            }
            else if(response == "bpo")
            {
                window.location.href = BASE_URL + "/bpo/index";
            }
            else if(response == "acc")
            {
                window.location.href = BASE_URL + "/acc/index";
            }
            else if(response == 1)
            {
                $("#errorMessage1").html("Wrong username and password.").css("margin-left"," 4px");
                $("#errorMessage3").html("");
                $("#errorMessage2").html("");
                $("#errorMessage4").html("");
                $('.errorMessage5').css('display','none');
            }
            else if(response == 2)
            {
                $("#errorMessage2").html("Wrong username and password.");
                $("#errorMessage3").html("");
                $("#errorMessage1").html("");
                $("#errorMessage4").html("");
                $('.errorMessage5').css('display','none');
            }
            else if(response == 4)
            {
                $("#errorMessage3").html("Your account is temporarily locked. Please login again after 1 minute.");
                $("#errorMessage1").html("");
                $("#errorMessage2").html("");
                $("#errorMessage4").html("");
                $('.errorMessage5').css('display','none');
            }
            else if(response == 'User is deactivated.'){
                $("#errorMessage4").html("Your account is disabled please contact your super admin.");
                $("#errorMessage1").html("");
                $("#errorMessage2").html("");
                $("#errorMessage3").html("");
                $('.errorMessage5').css('display','none');
            }
        },
        complete: function()
        {},
        error: function(err)
        {}
    };
    $("#adminLoginForm").ajaxForm(options);

    $('.btn-signin').on('click', function () {
        $('.login-title').focus();
    });

    $('#user_name, #pass_word').on('click change blur focus', function(){
        $('#user_name, #pass_word').attr('style','font-size: 20px !important;border-top-right-radius: 6px;border-bottom-right-radius: 6px;');
        $('.errorMessage5').css('display','none');
    });
    $('.btn-signin').on('click', function(e){
        $('#user_name, #pass_word').attr('style','font-size: 20px !important;border-top-right-radius: 6px;border-bottom-right-radius: 6px;');

        if($('#user_name').val().length < 1 && $('#pass_word').val().length < 1 || $('#user_name').val()=='' && $('#pass_word').val()==''){
            e.preventDefault();

            $('.errorMessage5').css('display','block');
            $('.errorMessage5').html('Username and Password is required.');
            $('#adminLoginForm label').css('display','none')
        } else {
            $('.errorMessage5').css('display','none');
            $('#adminLoginForm label').css('display','block')
        }
    })
});
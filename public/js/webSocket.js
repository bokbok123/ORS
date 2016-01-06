/**
 * Created by christian.labini on 12/9/15.
 */

$(document).ready(function()
{
    var BASE_URL = $("#hdnBaseUrl").val();
    var token = $("input[name='_token']").val();
    var host = window.location.host;
    var fHost = host.length;
    var check = BASE_URL.substr(0, BASE_URL.indexOf('/')+3);
    var fH = BASE_URL.substr(BASE_URL.indexOf('/')+2+fHost);
        if(check == 'https:/'){
            fH = BASE_URL.substr(BASE_URL.indexOf('/')+3);
        }

    var wsUri = "ws://"+host+":9000"+fH+"/Socket?token="+token;

//    var wsUri = "ws://"+host+":9000/ezibills_web_local/server.php";

    try{
    websocket = new WebSocket(wsUri);
    }catch(EX){}

    websocket.onopen = function(ev) { // connection is open
//        $('#message_box').append("<div class=\"system_msg\">Connected!</div>");
    }

    websocket.onclose = function(ev) {
//        $('#message_box').append("<div class=\"system_msg\">Disconnected from the server!</div>");
    }

    //Error
    websocket.onerror = function(ev) {
//        ('#message_box').append("<div class=\"system_msg\">Error "+ev.data+"</div>");
    };

    websocket.onmessage = function(ev) {
        var msg = JSON.parse(ev.data); //PHP sends Json data
        var type = msg.type; //message type
        var umsg = msg.message; //message text
        var info = msg.info;
        var userID = msg.user_id;
        var category = msg.category;
        var countNotifi = msg.countNotif;

        var color = $('#mybilluserEntity').val() == 'Business' ? 'green' : 'blue' ;

        if(type == 'usermsg' && umsg!=null && userID == $('#userC').val())
        {
            if(category == 'Account deactivated'){
                setTimeout(function(){
                    $.ajax({
                        url: BASE_URL + '/checkUserStatus',
                        success: function(){
                            window.location.reload();
                        }
                    });
                }, 4000);
            }
            var href = '';

            switch(category){
                case 'sharebill':
                    href = "/viewNotification";
                    break;
                case 'bpoReceiptAdd':
                    href = "/billsview";
                    break;
                default:
                    href = "/notificationBell";
                    break;
            }

            ohSnap(info+" "+umsg, {color: color,'duration':'8000',href: href});

            var classNotif = 'notification_count-bell';
            var countNotif = parseInt($('.notification_count-bell').html()) + countNotifi;
            if(category == 'sharebill'){
                classNotif ='notification_count-message';
                countNotif = parseInt($('.notification_count-message').html()) + countNotifi;
            }
            countNotif = $.isNumeric(countNotif) ? countNotif : 1;
            $('.'+classNotif).html(
                countNotif
            ).attr('style','display: block;');

            var audioElement = document.createElement('audio');
            audioElement.setAttribute('src', BASE_URL+'/js/notif_sound.mp3');
            audioElement.setAttribute('autoplay', 'autoplay');
            $.get();
            audioElement.addEventListener("load", function() {
                audioElement.play();
            }, true);
            loadtdatatable('liall', "","");

        }

    };

});

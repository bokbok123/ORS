/**
 * Created by jermaine.galman on 9/10/15.
 */

var socket;

$(document).ready(function(){

    try{
        var socketIO = getSocketIO();
       socket = io.connect(socketIO);
   } catch (Exception){}

});

function deactivateUser(id){
    socket.emit('deactivateUser', id);
}

function sendNotif(url){
    $.ajax({
        url: url,
        method: 'post',
        processData: false,
        contentType: false,
        cache: false,
        dataType: 'json',
        success: function (data) {
            $.each(data.Emaildata, function (i, val){
                $.ajax({
                    type: 'post',
                    url: 'sendEmail',
                    data: {
                        emailData: val
                    },
                    success: function (data) {
                        $('.notification_count-bell').css('display','');
                        var currentNotif = $(".notification_count-bell").html();
                        currentNotif ++;
                        $(".notification_count-bell").html(currentNotif);
                    }
                });
            });
        },
        error: function () {
        }
    });
}
/**
 * Created by jermaine.galman on 11/3/15.
 */

function getId(){
    var id=0;
    $.ajax({
        type: 'post',
        url: 'getUserId',
        success: function (data) {
            id = data;
        },
        async: false
    });
    return id;
}
function getSocketIO(){
    var socketIO;
    $.ajax({
        type: 'post',
        url: 'getSocketIo',
        success: function (data) {
            socketIO = data;
        },
        async: false
    });
    return socketIO;
}
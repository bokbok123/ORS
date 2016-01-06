/**
 * Created by jimmy.buyco on 3/17/15.
 */
$(document).ready(function () {
    $(".loginerrorspan").keyup(function () {
        document.getElementById("authendiv").innerHTML = "";
    });
    $("#username").keyup(function (e) {
        if (e.keyCode == 13) {
            $("#btnloginpage").click();
        }
    });
    $("#password").keyup(function (e) {
        if (e.keyCode == 13) {
            $("#btnloginpage").click();
        }
    });
    $("#btnloginpage").on('click', function (e) {
        e.preventDefault();
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        if (username != "" && password != "") {
            if (password.length < 8) {
                document.getElementById("authendiv").innerHTML = "password must be at least 8 characters in length";
                return true;
            }
            document.body.style.cursor = 'wait';
            $('#frmLogin').submit();
            return true;
        }
        else {
            document.getElementById("authendiv").innerHTML = "Username and Password is Required!";
        }
    });
});

function authenmsgfn() {
    document.getElementById('authendiv').innerHTML = "";
}

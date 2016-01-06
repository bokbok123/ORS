/**
 * Returns the name of the currently set context.
 *
 * @author name <arjay.dacanay@estansaas.com>
 * @date 04-Nov-2014
 * @param
 * @return
 * @changes
 * @edited by
 */

/**
 * This method validate and confirm biller category entry.
 *
 * @param.
 *
 * @return void
 */

$(document).ready(function ()
{
    $("#save").on('click', function (e)
    {
        e.preventDefault();
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",
            confirm: function (button)
            {
                /*@category This is for category input value*/
                /*@description This is for category description input value*/
                /*@index This is for a counter*/
                /*@text This is for validation text*/

                var category = $("#category").val();
                var description = $("#description").val();
                var index;
                var text = "";
                if (category != "" && description != "") {
                    $('#form').submit();
                    return true;
                } else {
                    var fields = [category, description];
                    for (index = 0; index < fields.length; index++) {
                        var name;
                        if (index == 0 && fields[index] == "") {
                            name = "BILL IS REQUIRED"
                            text += "</br>" + name + "";

                        } else if (index == 1 && fields[index] == "") {
                            name = "BILL DESCRIPTION IS REQUIRED"
                            text += "</br>" + name + "";
                        }
                    }
                    document.getElementById('errorDiv').innerHTML = "<div class='row alert alert-danger'>" + text + "</div>";
                    return false;
                }
            },
            cancel: function (button)
            {
                return false;
            }
        });
    });
});

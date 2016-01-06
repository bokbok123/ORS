/**
 * Returns the name of the currently set context.
 *
 * @author name <jimmy.buyco@estansaas.com>
 * @date 07-Nov-2014
 * @param
 * @return
 * @changes
 * @edited by arjay.dacanay@estansaas.com
 */

/**
 * This method validate and confirm biller entry.
 *
 * @param.
 *
 * @return void
 */

$(document).ready(function () {
    var BASE_URL = $('#hdnBaseUrl').val();

    $(".btn-save").on('click', function (e) {
        e.preventDefault();
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",
            confirm: function (button) {
                /*@file This is for biller logo input value.*/
                /*@category This is for biller category input value.*/
                /*@billerName This is for biller name input value.*/
                /*@billerAccount This is for biller account number input value.*/
                /*@index This is for a counter */
                /*@text This is for validation text.*/
                var file = $("#biller_logo").val();
                var category = $("#category").val();
                var billerName = $("#billerName").val();
                var billerAccount = $("#billerAccount").val();
                var index;
                var text = "";
                if (file != '' && category != 0 && billerName != "" && billerAccount != "") {
                    $('#BillerEntryForm').submit();
                    return true;
                } else {
                    var fields = [file, category, billerName, billerAccount];
                    for (index = 0; index < fields.length; index++) {
                        var name;
                        if (index == 0 && fields[index] == '') {
                            name = "IMAGE IS REQUIRED";
                            text += "</br>" + name + "";
                        } else if (index == 1 && fields[index] == 0) {
                            name = "CATEGORY IS REQUIRED";
                            text += "</br>" + name + "";
                        } else if (index == 2 && fields[index] == "") {
                            name = "BILLING NAME IS REQUIRED";
                            text += "</br>" + name + "";
                        } else if (index == 3 && fields[index] == "") {
                            name = "BILLING ACCOUNT IS REQUIRED";
                            text += "</br>" + name + "";
                        }
                    }
                    document.getElementById('errorDiv').innerHTML = "<div class='row alert alert-danger'>" + text + "</div>";
                    return false;
                }
                return false;
            },
            cancel: function (button) {
                return false;
            }
        });
    });

    $("#tblbiller").on('click', '.btn-editCategory', function () {
        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/biller/ajax?type=edit-billerCategory&id="+id,
            beforeSend : function (){
            },//
            success: function(msg) {

                document.getElementById("category").value=msg.categoryName;
                document.getElementById("description").value=msg.categoryDesc;
                document.getElementById("category_id").value=msg.categoryId;

                $("#myModalAddBiller").modal("show");

            }

        });
    });



});

/**
 * This method validate biller logo image file entry.
 *
 * @param.
 *
 * @return void
 */
$(document).ready(function ()
{
    $('#biller_logo').change(function ()
    {
        validateUpload(this.files[0]);
    });

    function validateUpload(file)
    {
        /*@uploadFile This is for file parameter.*/
        /*@image This is for new Instantiate of image class.*/
        /*@reader This is for new Instantiate of FileReader class.*/
        /*@uploadFileName This is for image file name.*/
        /*@fileType This is for uploaded image file type*/

        var uploadFile = file;
        var image = new Image();
        var reader = new FileReader();
        var uploadFileName = uploadFile.name;
        var fileType = uploadFileName.split('.')[uploadFileName.split('.').length - 1].toLowerCase();

        if (fileType == 'png' || fileType == 'jpeg' || fileType == 'jpg') {
            reader.readAsDataURL(uploadFile);
            reader.onload = function (_file)
            {
                image.src = _file.target.result;
                image.onload = function ()
                {
                    var w = this.width;
                    var h = this.height;
                    if (w > 240 && h > 70) {
                        var imgContainer = document.getElementById("imgContainer");
                        var img = imgContainer.children[0];
                        imgContainer.removeChild(img);
                        $("#warning").text("File Size must be 240 x 70 pixels");
                        $("#x").text("False");
                    } else {
                        $("#warning").text("");
                        $("#x").text("True");
                    }
                };
            };
        }
        else {
            $("#warning").text("File type not supported.");
            $("#x").text("False");
        }
    }
});

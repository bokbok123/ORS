(function(root) {
    var lib = {};
    var BASE_URL = $('#hdnBaseUrl');

    var updateDataTable = lib.updateDataTable = function(tableID){
        var oTableUpdate = $("#" + tableID).dataTable( { bRetrieve: true } );
        oTableUpdate.fnDraw();
    }

    root['global'] = lib;
}(this));

/* CHOSEN DROPDOWN */
$(document).ready(function(){
//    $("select").chosen({
//        width: "100%",
//        no_results_text: "+ found"
//    });
//    document.getElementById('categoryDrop').value = '<?=$this->type_id?>';
//    $('#select').trigger('chosen:updated');

    $('input').bind('paste',function(e) {
        e.preventDefault();
        return false;
    });

    $('input').bind('copy',function(e) {
        e.preventDefault();
        return false;
    });

    $('#dateexpired').datepicker({
        format: "yyyy-mm-dd",
        startDate: '+0d',
        minDate: 0
    }).on('changeDate', function (ev) {
        $('#dateexpired').valid();
    });
});

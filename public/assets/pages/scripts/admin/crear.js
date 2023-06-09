$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(document).ready(function() {
    SEGSoft.validacionGeneral('form-general');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });
});

$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(document).ready(function () {
    SEGSoft.validacionGeneral("form-general");

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });



    // Manejar cambios en el control "tipo"
    $("#tipo").on("change", function () {
        var selectedTipo = $(this).val();
        console.log(selectedTipo);

        // Reiniciar el control "centro_id"
        $("#centro_id").val(null).trigger("change");

        // Configuraciones y opciones para cada tipo
        if (selectedTipo == 1) {
            // Bloquear el control "centro_id"
            $("#centro_id").prop("disabled", true);
            $("#mesa").prop("disabled",true);
        } else {
            // Desbloquear el control "centro_id"
            $("#centro_id").prop("disabled", false);

            // Configuraciones adicionales según el tipo
            if (selectedTipo === "2") {
                // Permitir seleccionar solo una opción
                $("#centro_id").prop("multiple", false).attr('name', 'centro_id').select2({
                    language: "es",
                    theme: "bootstrap4",
                });
                $("#mesa").prop("disabled",false);
            } else if (selectedTipo === "3") {
                // Permitir seleccionar múltiples opciones
                $("#centro_id").prop("multiple", true).attr('name', 'centro_id').select2({
                    language: "es",
                    theme: "bootstrap4",
                });
                $("#mesa").prop("disabled",true);
            }
        }
        $("#centro_id").attr("name", "centro_id[]");
    });

});



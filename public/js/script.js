$(document).ready(function () {
    $(".taskCheckboxClickable").on("click", function () {
        $tr = $(this).parent().parent();
        $id = $tr.data("itemid");

        $.ajax({
            type: "GET",
            url: "/task/toggleitemstatus/",
            data: {id: $id},
            success: function (data) {
                console.log(data);
                if (data == "1") {
                    window.location.reload();
                }
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR, exception);
                console.log(jqXHR.responseText);
            }
        })
    });
});
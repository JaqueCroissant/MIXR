$(document).ready(function () {
    $('.change_password').click(function () {
        var form = $(this.form);
        $.ajax({
            type: "POST",
            url: "include/ajax/preferences.php",
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    show_success("Your password has been changed.");
                } else {
                    show_error(data.error);
                }
            }
        });
    });
    $('.change_preferences').click(function () {
        var form = $(this.form);
        $.ajax({
            type: "POST",
            url: "include/ajax/preferences.php?do=change_preferences",
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    show_success("Your preferences has been changed.");
                } else {
                    show_error(data.error);
                }
            }
        });
    });
});
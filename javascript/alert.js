function show_error(errorMessage) {
    var alert_container = $('#alert_container');
    var alert_container2 = $('#success_container');
    var alert_message = $('.alert_message');
    alert_message.empty();
    alert_message.append(errorMessage);
    alert_container.removeClass("hidden");
    alert_container2.addClass("hidden");
}

function show_success(errorMessage) {
    var alert_container = $('#success_container');
    var alert_container2 = $('#alert_container');
    var alert_message = $('.alert_message');
    alert_message.empty();
    alert_message.append(errorMessage);
    alert_container.removeClass("hidden");
    alert_container2.addClass("hidden");
}

function show_warning(errorMessage) {
    var alert_container = $('#warning_container');
    var alert_message = $('.warning_message');
    alert_message.empty();
    alert_message.append(errorMessage);
    alert_container.removeClass("hidden");
}

$(function() {
   $(document).on('click', '.alert_close', function() {
       event.preventDefault();
       $('#success_container').addClass("hidden");
       $('#alert_container').addClass("hidden");
   })
});
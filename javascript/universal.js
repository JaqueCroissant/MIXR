function loading_page(isLoading) {
    if(isLoading === true) {
        $('#content_container').addClass("hidden");
        $('#loading_page').removeClass("hidden");
    } else {
        $('#loading_page').addClass("hidden");
        $('#content_container').removeClass("hidden");
    }
}

function change_page(pagename, subpage) {
    $("#content_container").html("");
    var startTime = new Date().getTime();
    loading_page(true);
    if (pagename != null) {
        var url = "include/ajax/pages.php?page=" + pagename;
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    var page = "pages/" + data.pagename + ".php";
                    $("#content_container").load(page, {'url': false, 'step': subpage}, function() {
                        var elapsedTime = (new Date().getTime()) - startTime;
                        if(elapsedTime < 700) {
                            setTimeout(function() { loading_page(false); $('.change_page').find('button').removeAttr("disabled"); }, (700-elapsedTime));
                        } else {
                            loading_page(false);
                            $('.change_page').find('button').removeAttr("disabled");
                        }
                    });
                } else {
                    $("#content_container").load('pages/front.php', {'url': false}, function() {
                        var elapsedTime = (new Date().getTime()) - startTime;
                        if(elapsedTime < 700) {
                            setTimeout(function() { loading_page(false); $('.change_page').find('button').removeAttr("disabled"); }, (700-elapsedTime));
                        } else {
                            loading_page(false);
                            $('.change_page').find('button').removeAttr("disabled");
                        }
                    });
                }
            }
        });
    } else {
        $("#content_container").load('pages/front.php', {'url': false}, function() {
            var elapsedTime = (new Date().getTime()) - startTime;
            if(elapsedTime < 700) {
                setTimeout(function() { loading_page(false) }, (700-elapsedTime));
            } else {
                loading_page(false)
            }
            $('.change_page').find('button').removeAttr("disabled");
        });
    }
}


function set_design_type() {
    $.ajax({
        type: "GET",
        url: "include/ajax/sensor.php",
        dataType: 'json',
        async: true,
        success: function (data) {
            var date = new Date();
            var minutes = 1;
            date.setTime(date.getTime() + (minutes * 60 * 1000));
            if (data.status === true) {
                $.cookie("design_type", data.daytime, { expires: date });
                $.cookie("default_design_type", data.daytime, { expires: 10 });
                if(data.daytime === true) {
                    if($('#cloud_style').attr("href") !== "css/clouds.css") {
                        $('body').fadeOut( function() {
                            $('#cloud_style').attr("href", "css/clouds.css");
                            $('#main_style').attr("href", "css/style.css");
                            $( this ).fadeIn();
                        } );
                    }
                } else {
                    if($('#cloud_style').attr("href") !== "css/clouds_dark.css") {
                        $('body').fadeOut( function() {
                            $('#cloud_style').attr("href", "css/clouds_dark.css");
                            $('#main_style').attr("href", "css/style_dark.css");
                            $( this ).fadeIn();
                        } );
                    }
                }
            }
        }
    });
}
$(function() {
    if($.cookie("design_type") == null) {
        set_design_type();
    }
});

function preload(arrayOfImages) {
    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
    });
}

$(function() {
    preload([
    'images/loading_page.GIF',
    'images/loading_player.GIF'
    ]);
});

$(document).ready(function () {
    $('.change_page').click(function () {
        $('.change_page').attr("disabled", true);
        $('.change_page').find('button').attr("disabled", true);
        event.preventDefault();
        var page = $(this).attr("page");
        var subpage = $(this).attr("subpage");
        change_page(page, subpage);
    });
});
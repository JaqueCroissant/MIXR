function set_playlist(artist_id) {
    $('#playlist_container').empty();
    if(artist_id != null) {
        $("#playlist_container").load('include/ajax/playlists.php', {'artist_id': artist_id});
    } else {
        $("#playlist_container").load('include/ajax/playlists.php');
    }
}
    
$(document).ready(function () {
    function replace(data) {
        var artist_img = data.artist_image;
        if(artist_img === null || artist_img === "") {
            artist_img = "images/no_artist_image.png";
        }
        $('#songname').empty().append(data.songname);
        $('#artist').empty().append(data.artist);
        $('#artist_image').attr("src", artist_img);
        $('#album').empty().append(data.album);
        $('.song_id').attr("value", data.id);
        $('.artist_id').attr("value", data.artist_id);
        
        
        var musicPath = "music/" + data.filepath;
        var audio = $("#audio");
        audio.attr("src", musicPath);
        audio[0].pause();
        audio[0].load();
        audio[0].oncanplaythrough = audio[0].play();
    }
    
    $('.discover').click(function () {
        var form = $(this.form);
        $(this).attr("disabled", true);
        $('#artist_image').attr("src", "images/loading_player.GIF");
        $.ajax({
            type: "POST",
            url: "include/ajax/player.php?do=discover",
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    replace(data);
                } else {
                    show_error(data.error);
                    $('#artist_image').attr("src", "images/no_artist_image.png");
                }
            },
            complete: function() {
                $('.discover').removeAttr("disabled");
            }
        });
    });
    
    $('.get_artist_songs').click(function () {
        var artist_id = $(this).attr("artistid");
        var artist_assigned = (artist_id != null && artist_id > 0);
        if(artist_assigned === true) {
            set_playlist(artist_id);
        } else {
            show_error("An unknown error occoured.");
        }
    });
    
    $('.back_to_user_playlist').click(function() {
        set_playlist();
    });
    
    
    $('.play_by_id').click(function () {
        $(this).attr("disabled", true);
        var form = $(this.form).serializeArray();
        var song_id = $(this).attr("songid");
        var song_assigned = (song_id != null && song_id > 0);
        if(song_assigned === true) {
            form = form.concat([
                {name: "song_id", value: song_id}
            ]);
        }
        $.ajax({
            type: "POST",
            url: "include/ajax/player.php?do=play_by_id",
            data: form,
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    replace(data);
                } else {
                    show_error(data.error);
                }
            },
            complete: function() {
                $('.play_by_id').removeAttr("disabled");
            }
        });
    });
    
    $('.playfromlist').click(function () {
        var form = $(this.form);
        $(this).attr("disabled", true);
        $('#artist_image').attr("src", "images/loading_player.GIF");
        $.ajax({
            type: "POST",
            url: "include/ajax/player.php",
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    replace(data);
                } else {
                    show_error(data.error);
                    $('#artist_image').attr("src", "images/no_artist_image.png");
                }
            },
            complete: function() {
                $('.playfromlist').removeAttr("disabled");
            }
        });
    });
    
    $('.discover_by_artist').click(function () {
        var form = $(this.form);
        $(this).attr("disabled", true);
        $('#artist_image').attr("src", "images/loading_player.GIF");
        $.ajax({
            type: "POST",
            url: "include/ajax/player.php?do=discover_by_artist",
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    replace(data);
                } else {
                    show_error(data.error);
                    $('#artist_image').attr("src", "images/no_artist_image.png");
                }
            },
            complete: function() {
                $('.discover_by_artist').removeAttr("disabled");
            }
        });
    });
    
   
    
    $('.addtolist').click(function () {
        $(this).attr("disabled", true);
        var form = $(this.form).serializeArray();
        var song_id = $(this).attr("songid");
        var song_assigned = (song_id != null && song_id > 0);
        if(song_assigned === true) {
            form = form.concat([
                {name: "song_id", value: song_id}
            ]);
        }
        $.ajax({
            type: "POST",
            url: "include/ajax/player.php?do=add",
            data: form,
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    show_success("The song has been added to your playlist.");
                } else {
                    show_error(data.error);
                }
            },
            complete: function() {
                $('.addtolist').removeAttr("disabled");
            }
        });
    });
    
    $('.removefromlist').click(function () {
        $(this).attr("disabled", true);
        var form = $(this.form).serializeArray();
        var song_id = $(this).attr("songid");
        var song_assigned = (song_id != null && song_id > 0);
        if(song_assigned === true) {
            form = form.concat([
                {name: "song_id", value: song_id}
            ]);
        }
        $.ajax({
            type: "POST",
            url: "include/ajax/player.php?do=remove",
            data: form,
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    if(song_assigned === true) {
                        var tr = "tr[songid="+song_id+"]";
                        $(tr).remove();
                        $('#playlisttable').trigger('update');
                        if($('#playlisttable tr:visible').length < 2) {
                            show_warning("There is no songs in your playlist");
                            $('#playlisttable').hide();
                        }
                    }
                    show_success("The song has been removed from your playlist.");
                } else {
                    show_error(data.error);
                }
            },
            complete: function() {
                $('.removefromlist').removeAttr("disabled");
            }
        });
    });
});
$(function() {

  var $audio = $("#audio"),
      $playpause  = $('#playpause_button'),
      $stop = $('#stop_button'),
	  $timer = $('#player_time'),
	  $mute = $('#volume_button'),
      $volume = $('#volume'),
      $progress = $("#progressbar"),
      AUDIO = $audio[0],
      sliderVolume = 75;
  
  AUDIO.volume = 0.75;
  AUDIO.addEventListener("timeupdate", progress, false);
  
  function getTime(t) {
    var m=~~(t/60), s=~~(t % 60);
    return (m<10?"0"+m:m)+':'+(s<10?"0"+s:s);
  }
  
  function progress() {
    $progress.slider('value', ~~(100/AUDIO.duration*AUDIO.currentTime));
    $timer.text(getTime(AUDIO.currentTime));
	if(AUDIO.duration - AUDIO.currentTime < 0.1) {
            $playpause.removeClass("pause_button");
        }
        if(!AUDIO.paused) {
            $playpause.addClass("pause_button");
        }
  }

  $volume.slider( {
    value : AUDIO.volume*100,
    slide : function(ev, ui) {
      AUDIO.volume = ui.value/100; 
	  sliderVolume = ui.value;
	  if(sliderVolume < 1) {
		  $mute.addClass("mute_button");
	  } else {
		  $mute.removeClass("mute_button");
	  }
    } 
  });
   
  $progress.slider( {
    value : AUDIO.currentTime,
    slide : function(ev, ui) {
      AUDIO.currentTime = AUDIO.duration/100*ui.value;
    }
  });
  
  $playpause.click(function() {
	if(AUDIO.paused) {
		AUDIO.play();
		$playpause.addClass("pause_button");
	} else {
		AUDIO.pause();
		$playpause.removeClass("pause_button");
	}
  });
  
  $stop.click(function() {
    AUDIO.pause();
    AUDIO.currentTime = 0;
	if(AUDIO.paused) {
		$playpause.removeClass("pause_button");
	}
  });
  
  $mute.click(function() {
    if(AUDIO.volume === 0) {
      $volume.slider('value', sliderVolume);
      AUDIO.volume = sliderVolume/100;
	  $mute.removeClass("mute_button");
    } else {
      $volume.slider('value', 0);
      AUDIO.volume = 0;
	  $mute.addClass("mute_button");
    }
  });
  
});
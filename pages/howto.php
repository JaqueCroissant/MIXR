<?php
    if(isset($_POST['url']) && $_POST['url'] == true) {
        require "../include/ajax_includes.php";
        require "../include/ajax/header_includes.php";
    }
 ?>

<div style="width: 750px;margin: 0px auto 0px auto;">
    
    <h3><b>Oh, hi there!</b></h3> 
    If you are here, you are either curious about the content of this page<br />
    or you are uncertain of how <b>MIXR</b> works!<br />
    If the latter is the case, you have come to the right place!<br />
    On this page you will find all the relevant information to get you started with using <b>MIXR</b>!<br />
    To read on, either keep on scrolling or select a topic from the list below!<br /><br />
    

    <a href="#crt&lgn"><b>- Creating a user and logging in</b></a><br />
    <a href="#getpassword"><b>- Forgot your password?</b></a><br />
    <a href="#discover"><b>- Discover new music</b></a><br />
    <a href="#manage"><b>- Manage your favourite music</b></a><br />
    <a href="#prefs"><b>- Edit your preferences</b></a><br />
    <a href="#newpassword"><b>- Change your password</b></a><br />

    <br /><br />

    <div id="crt&lgn">
        <h3><b>Creating a user and logging in</b></h3>
        
        When you first enter this site, you will find these buttons<br />
        in the top right corner of your browser window:<br /><br />
        <img src="images/howto/CreateUserLoginPic.png"><br /><br />
        If you haven't created user-profile yet,
        you will want to press the button marked "<b>Create User</b>".<br />
        This will take you the following formula:<br /><br />
        <img src="images/howto/CreateForm.png"><br /><br />
        To create a user-profile, the first step is to fill out the above formula.<br />
        You are required to provide:<br /><br />
        - A valid email address<br />
        - A suiting username<br />
        - A valid password<br /><br />
        Once these fields have been filled out correctly, you can press<br /> 
        the button marked "<b>Create</b>" and you will be sent on to the next step.<br />
        If, however, you want to clear all you entries, please press "<b>Reset fields</b>."<br /><br />
        
        If all your data has been accepted, you will be presented with the formula below:
        <br /><br />
        <img src="images/howto/CreatePrefs.png"><br /><br />
        Here you will be required to choose an age group and, if you'd like,<br />
        your preferences in regards to music genres.<br />
        Your age group and genre preferences can be changed at your will,<br />
        after you have finished creating your profile.<br /><br />
        
        Once again, if you want to clear all your entries, please press "<b>Reset fields</b>."<br />
        Otherwise, click the button marked "<b>Create</b>" and your profile should now be created.<br /><br />
        
        Once you have gone through these steps, you should automatically be logged in to <b>MIXR</b>.<br /><br />
        If you already have an account, you can log in by pressing the button marked "<b>Login</b>"<br />
        in the upper right corner, next to the "<b>Create user</b>" button.<br />
        You will then be asked to input your email or username, as well as your password.<br /><br />
    </div>
    
    <br /><br />
    <div id="getpassword">
        <h3><b>Forgot your password?</b></h3>
        Sorry, we haven't implemented password retrieval yet!<br />
        Please create a new user instead.<br /><br />
    </div>
    <br /><br />
    <div id="discover">
        <h3><b>Discover new music</b></h3>
        Once you are logged in, you can start listening to all the music <b>MIXR</b> has to offer!<br />
        Press the button marked "<b>Music player</b>" to get started.<br /><br />
        <img src="images/howto/Menu.png"><br /><br />
        You will now be presented with the main features of our service,<br />
        which we will go through now!<br /><br />
        The main content of the player-window is the following display<br />
        where you will be presented with info and images relating to the music<br />
        you are currently listening to.<br />
        On the left side of this window, you are able to add or remove the current song<br />
        from your list of preferred music, using the buttons marked "<b>+</b>" and "<b>-</b>".<br /><br />
        <img src="images/howto/MusicInfo.png"><br /><br />
        On the right side of the player-window you will find two columns<br />
        with various functionality. The top column will let you select<br />
        which genres of music you want to listen to as well as setting your current mood.<br /><br />
        <img src="images/howto/DiscoverPrefs.png"><br /><br />
        In the bottom right corner you will find three buttons,<br />
        representing three modes of listening to music.<br /><br />
        <img src="images/howto/DiscoverModes.png"><br /><br />
        Pressing "<b>Play from playlist</b>" will let you listen to your preferred music only.<br />
        As mentioned earlier, you can add a song to your playlist by pressing<br /> 
        the button marked "<b>+</b>" on the left side of the player window.<br /><br />
        By pressing "<b>Discover song</b>" the application will select a song, that you<br />
        haven't yet heard, based on your mood and genre-preferences.<br /><br />
        Finally, by pressing "<b>Discover from artist</b>" you can discover more music<br />
        by the artist you are currently listening to.<br /><br />
        No matter how you choose to discover music with <b>MIXR</b>, the playback is always<br />
        handled by the player-module, found in the bottom right of your browser.<br /><br />
        <img src="images/howto/Player.png"><br /><br />
        This player has all the basic functionality necessary for easy use:<br />
        You can start, stop and pause the music, you can cue the playhead<br />
        to play from a specific point in a song.<br /> 
        And you can, of course, adjust the volume of the music.<br />
    </div>
    <br /><br />
    <div id="manage">
        <h3><b>Manage your favourite music</b></h3>
        In the former paragraph, we wrote about how you can add music to your playlist<br />
        Here you will be introduced to how you can manage that playlist!<br />
        To get access to your playlist, you must press the button marked "<b>Playlist</b>"<br />
        in the menu tab of the top left of your browser window.<br /><br />
        <img src="images/howto/Menu.png"><br /><br />
        This will lead you to a overview of all the songs you have added to your playlist.<br />
        Below is a sample overview from one of our developers.<br /><br />
        <img src="images/howto/PlaylistOverview.png"><br /><br />
        By default your playlist is sorted alphabetically by song name.<br />
        You can choose what parameter to sort your playlist by,<br />
        by pressing the text "<b>Song</b>", "<b>Artist</b>" and "<b>Album</b>".<br />
        By pressing a parameter multiple times, you can switch between<br />
        ascending and descending alphabetical sorting of that specific paramter,<br />
        as indicated by the small arrows next to each parameter.<br /><br />
        
        On the right side of your playlist overview, you will find<br />
        a set of three buttons for every song in your playlist.<br /><br />
        <img src="images/howto/PlaylistEdit.png"><br /><br />
        These buttons will enable you to play specific songs from your playlist,<br />
        discover more music from a specific artist or simply remove a song from the playlist.<br />
    </div>
    <br /><br />
    <div id="prefs">
        <h3><b>Edit your preferences</b></h3>
        If you would like to edit your age group or your default music preferences,<br />
        you can do so by pressing the "<b>Settings</b>" button in the top right corner<br />
        followed by pressing the tab marked "<b>Preferences</b>", as shown below.<br /><br />
        <img src="images/howto/SettingsPopdown.png"><br /><br />
        You will then be presented with the following form, that will allow you to change<br /> 
        your age group, as well as adding and removing content to your preferred musical genres.<br /><br />
        <img src="images/howto/EditPrefs.png"><br /><br />
        When you are done editing your preferences, simply press the button marked "<b>Change preferences</b>"<br />
        and your new preferences will be saved to your account.
    </div>
    <br /><br />
    <div id="newpassword">
        <h3><b>Change your password</b></h3>
        If you would like to change the password for your account,<br />
        you simply go to the "<b>Settings</b>"-tab in the top right corner<br />
        and press "<b>Change password</b>".<br /><br />
        <img src="images/howto/SettingsPopdown.png"><br /><br />
        This will lead you to the following form, where you must enter<br />
        your old password as well as your choice for a new password.<br /><br />
        <img src="images/howto/ChangePassword.png"><br /><br />
        Once you have entered your details correctly,<br /> 
        press the button marked "<b>Change password</b>" and the form<br /> 
        will tell you that your password has been changed.<br />
        Now you can get back to listening to music!<br />
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br />
    
</div>
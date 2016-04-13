<?php
if(isset($_POST['url']) && $_POST['url'] == true) {
    require "../include/ajax_includes.php";
    require "../include/ajax/header_includes.php";
}
echo "
    <div style='width: 500px;margin:0px auto 0px auto;'>
    <h3>Music is a part of life</h3>
        <h4>Hey you!</h4>
        <p>We'd like to tell you a little about why we've made this site.
            <br>
            We've dedicated this site to music lovers and people who want to widen 
            <br>
            their horizon. Well and who knows, you might even discover a new genre
            <br>
            which falls to your liking and stick to you for the rest of your life!
            <br>
            <br>
            This project started thanks to an exam project we started during our
            <br>
            3rd semester in Computer Science. We, the 4 developers behind the project,
            <br>
            wanted to develop something kind of unique, and still make something
            <br>
            that every age group could be fond of, which resulted in this website.
            <br>
            We've made sure to make it as easy as possible for you to use and we've added
            <br>
            music which was out of the mainstream's eye to make sure that you'd have an
            <br>
            experience out of the ordinary. So what are you waiting for?
            <br>
            Go explore your new additional collection of music!
        </p>
    </div>";

    
?>
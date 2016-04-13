<?php
require "include/includes.php";
unset($_SESSION['current_song']);
?>
<!DOCTYPE html>
<html>
    <?php
    require "templates/header_includes.php";
    ?>
<body>
    <div id="top_bar">
        <div id="clouds">
            <div class="cloud_left_top"></div>
            <div class="cloud_left"></div>
            <div class="cloud_right_top"></div>
            <div class="cloud_right"></div>
        </div>
        <div id="logo"></div>
    </div>
    <div id="middle_bar">
        <?php include "templates/menu.php"; ?>

        <div id="loading_page" class="hidden">
            <img src="images/loading_page.GIF" />
        </div>
        
        <div id="content_container">
        <?php
            if (isset($_GET['page'])) {
                if (in_array($_GET['page'], $pages)) {
                    include('pages/' . $_GET['page'] . '.php');
                } else {
                    include('pages/front.php');
                }
            } else {
                include('pages/front.php');
            }
        ?>
        </div>
    </div>
    <div style="width:100%; height: 200px;"></div>
    <div id="bottom_bar">
        <?php include "templates/footer.php"; ?>
    </div>
</body>
</html>
<?php
require "include/includes.php";
?>
<!DOCTYPE html>
<html>
    <?php
    require "templates/header_includes.php";
    ?>

    <body>
        <div id="main_container">
            <div id="menu_container">
                <?php include "templates/menu.php"; ?>
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
        <div id="footer_container">
            <?php include "templates/footer.php"; ?>
        </div>
    </body>
</html>
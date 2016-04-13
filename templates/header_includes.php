<head>
    <title>MIXR</title>
    <link rel="shortcut icon" href="images/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" charset="UTF-8">
    <meta name="description" content="TBA">
    <meta name="keywords" content="MIXR, musik, humør">
    <?php
    if(isset($_COOKIE['design_type']) && $_COOKIE['design_type'] == "false" || isset($_COOKIE['default_design_type']) && $_COOKIE['default_design_type'] == "false") {
        echo "<link id='main_style' rel='stylesheet' href='css/style_dark.css'>
              <link id='cloud_style' rel='stylesheet' href='css/clouds_dark.css'>";
    } else {
        echo "<link id='main_style' rel='stylesheet' href='css/style.css'>
              <link id='cloud_style' rel='stylesheet' href='css/clouds.css'>";
    }
    ?>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="javascript/jquery.js" type="text/javascript"></script>
    <script src="javascript/jquery-ui.js" type="text/javascript"></script>
    <script src="javascript/jquery.cookie.js" type="text/javascript"></script>
    <script src="javascript/bootstrap.min.js" type="text/javascript"></script>
    <script src="javascript/alert.js" type="text/javascript"></script>
    <script src="javascript/cloud_player.js" type="text/javascript"></script>
    <script src="javascript/player.js" type="text/javascript"></script>
    <script src="javascript/tablesorter.js" type="text/javascript"></script>
    <script src="javascript/universal.js" type="text/javascript"></script>
</head>
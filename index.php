<?php session_start() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Weblab Bundesliga Tippspiel</title>
        <?php include "Scripts/php/header.php" ?>
        <?php require_once "Scripts/php/constant.php" ?>
    </head>
    <body>
    	<?php include "Views/Partial/_navigation.php" ?>
        <div id="page">
            <div id="sidebarLeft">
                <?php include "Views/Partial/_login.php" ?>
            </div>
            <div id="content">
                <a href="<?php echo HOME_HTML.'Views/Page/register.php'?>"><img src="Media/Images/RegistrierenBanner.jpg" /></a>
            </div>
            <div id="sidebarRight">
                
            </div>
        </div>
    <!-- Navigation Active Link Script -->
    <script>
    	var activeLink = "#navHome";
    </script>
    </body>
</html>


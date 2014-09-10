<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>User Verwaltung</title>
        <?php include "../../../Scripts/php/header.php" ?>
        <?php include "../../../Scripts/php/checkAdminLoggedIn.php" ?>
    </head>
    <body>
    	<?php include HOME_PHP."Views/Partial/_navigation.php" ?>
        <div id="page">
            <div id="sidebarLeft">
                <?php include HOME_PHP."Views/Partial/_login.php" ?>
            </div>
            <div id="contentAdmin">
				<?php include HOME_PHP."Views/Partial/Admin/_userAdministration.php" ?>
                
            </div>
        </div>
        <!-- Navigation Active Link Script -->
        <script>
    			var activeLink = "#navUserManagement";
        </script>
    </body>
</html>


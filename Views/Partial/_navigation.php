<div id="navigation">
	<a href="<?php echo HOME_HTML ?>"><img src="<?php echo HOME_HTML."Media/Images/TippspielLogo.png"?>" style="width: 130px; margin: 20px; float:left;"/></a>
        <ul>
            <?php if(isset($_SESSION['user'])){ ?>
            	
            <li id="navStartseite"><a href="<?php echo HOME_HTML."Views/Page/start.php"?>">Startseite</a></li>
            	<?php if($_SESSION['user']['role'] == "Admin"){ ?>
            	<li id="navUserManagement"><a href="<?php echo HOME_HTML."Views/Page/Admin/userManagement.php"?>">Userverwaltung</a></li>
            	<?php } ?>
            <li id="navTipp"><a href="#">Tipps abgeben</a></li>
            <li id="navCommunity"><a href="#">Community</a></li>
            <li id="navStatistik"><a href="#">Statistikcenter</a></li>
            <li id="navAccount"><a href="/BuLiTippspiel/Views/Page/account.php?user=<?php echo $_SESSION['user']['username'] ?>">Mein Account</a></li>
            <?php }else{ ?>
            <li id="navRegistrieren"><a href="<?php echo HOME_HTML."Views/Page/register.php"?>">Registrieren</a></li>
            <?php } ?>
            <li id="navFaq"><a href="<?php echo HOME_HTML."Views/Page/faq.php" ?>">FAQ</a></li>
        </ul>
    <script>
    	$( document ).ready(function() {
    		$(activeLink).addClass("navActiveLink");
    	});
    </script>
</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
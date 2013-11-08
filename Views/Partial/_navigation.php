<div id="navigation">
    <span class="left"><a href="<?php echo HOME_HTML ?>"><img src="<?php echo HOME_HTML."Media/Images/TippspielLogo.png"?>" width="70"/></a></span>
    <span class="left">
        <ul>
            <?php if(isset($_SESSION['user'])){ ?>
            <li><a href="<?php echo HOME_HTML."Views/Page/start.php"?>">Start</a></li>
            <li><a href="#">Tipps abgeben</a></li>
            <li><a href="#">Community</a></li>
            <li><a href="#">Statistikcenter</a></li>
            <li><a href="/BuLiTippspiel/Views/Page/account.php?user=<?php echo $_SESSION['user']['username'] ?>">Mein Account</a></li>
            <?php }else{ ?>
            <li><a href="<?php echo HOME_HTML."Views/Page/register.php"?>">Registrieren</a></li>
            <?php } ?>
            <li><a href="<?php echo HOME_HTML."Views/Page/faq.php" ?>">FAQ</a></li>
        </ul>
    </span>
</div>

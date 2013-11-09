<?php
    $errorLogin = "";
    if(isset($_POST['login'])){
    	require_once $_SERVER['DOCUMENT_ROOT']."/BuLiTippspiel/".'Scripts/php/constant.php';
        require_once HOME_PHP."Controllers/UserController.php";
        $email = htmlspecialchars($_POST['email']);
        $password = crypt($_POST['password'], "wiofnon23ijiosd.!kfjo3!ddsfkj");
        $status = UserController::login($email, $password);
        if($status == 1){
            $errorLogin = "Dein Account wurde noch nicht aktiviert. Bitte setze dich mit dem Administrator unter admin@weblab.eu in Kontakt";
        }else{
            $errorLogin = "Falscher Benutzername oder falsches Passwort";
        }
    }    
?>
<div id="login">
    <?php if(isset($_SESSION['user'])){?>
        <h2>Mein Account</h2>
        <img id="profileImage" src="<?php echo HOME_HTML."Media/Images/profilbild-platzhalter.jpg"?>" height="150" />
        <div id="loginMessage">
            <h3>Hallo, <span class="fec"><?php echo $_SESSION['user']['username'] ?></span>!</h3>
            <ul class="fec">
                <li>><a href="<?php echo HOME_HTML."Views/Page/account.php"?>">Profil anzeigen</a></li>
                <li>><a href="<?php echo HOME_HTML."Scripts/php/logout.php"?>">Logout</a></li>
            </ul>
        </div>
        
    <?php }else{ ?>
        <h2>Einloggen</h2>
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="email" />
                <input type="password" name="password" />
                <div class="buttonRight">
                    <button type="submit" name="login" >login</button>
                </div>
            </form>
        </div><br/>
        
        <a href="<?php echo HOME_HTML.'Views/Page/register.php'?>">Registrieren</a><br/>
        <div class="errorBox"><?php echo $errorLogin ?></div>
    <?php } ?>
</div>

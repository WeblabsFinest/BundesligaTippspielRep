<?php
    $errorLogin = "";
    if(isset($_POST['login'])){
    	require_once $_SERVER['DOCUMENT_ROOT']."/BundesligaTippspiel/".'Scripts/php/constant.php';
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
        <img src="/BundesligaTippspiel/Media/Images/profilbild-platzhalter.jpg" height="150" />
        Hallo, <?php echo $_SESSION['user']['username'] ?>
        <a href="/BundesligaTippspiel/Scripts/php/logout.php">Logout</a>
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
        
        <a href="/BundesligaTippspiel/Views/Page/register.php">>Registrieren</a><br/>
        <div class="errorBox"><?php echo $errorLogin ?></div>
    <?php } ?>
</div>

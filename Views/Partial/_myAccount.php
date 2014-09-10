<?php
    require_once "../../Models/User.php";
    require_once "../../Models/Profile.php";
    require_once "../../Controllers/UserController.php";
    $errorMyAccount = "";
    
    if(isset($_POST['saveEdit'])){
        $profile = UserController::getProfile($_SESSION['user']['username']);
        $profile->home = $_POST['home'];
        $profile->favoriteTeam = $_POST['favoriteTeam'];
        $profile->profileText = $_POST['profileText'];
        if(UserController::editProfile($profile)){
            $errorMyAccount = "Dein Profil konnte leider nicht aktualisiert werden, bitte versuche es erneut";
        }
    }elseif(isset($_POST['changePicture'])){
        
    }elseif(isset($_POST['changePassword'])){
        $old = $_POST['oldPassword'];
        $new = $_POST['newPassword'];
        $confirm = $_POST['confirmNewPassword'];
        if($new == $confirm){
            $status = UserController::changePassword($_SESSION['user']['email'], $old, $new);
            if($status == 2){
                echo  "<script>
                    $(document).ready(function(){
                        $('#successChangePass').modal({
                        overlayClose: true, 
                        escClose: true,
                        close: true,
                        autoPosition: true, 
                        overlayCss: {
                          backgroundColor:'black'
                        }
                    })});
                </script>";
            }elseif($status == 1){
                echo  "<script>
                    $(document).ready(function(){
                        $('#failChangePass').modal({
                        overlayClose: true, 
                        escClose: true,
                        close: true,
                        autoPosition: true, 
                        overlayCss: {
                          backgroundColor:'black'
                        }
                    })});
                </script>";
            }else{
                $message = "Dein eingegebenes Passwort ist falsch!";
                echo  "<script>
                    $(document).ready(function(){
                        $('#changePasswordDiv').modal({
                        overlayClose: true, 
                        escClose: true,
                        close: true,
                        autoPosition: true, 
                        overlayCss: {
                          backgroundColor:'black'
                        }
                    })});
                </script>";
            }
        }else{
            $message = "Deine neuen Passwörter stimmen nicht überein";
            echo  "<script>
                $(document).ready(function(){
                    $('#changePasswordDiv').modal({
                    overlayClose: true, 
                    escClose: true,
                    close: true,
                    autoPosition: true, 
                    overlayCss: {
                      backgroundColor:'black'
                    }
                })});
            </script>";
        }
    }elseif(isset($_POST['deleteAccount'])){
        if(UserController::deleteUser($_SESSION['user']['email'])){
            $host = htmlspecialchars($_SERVER["HTTP_HOST"]);
            $home = "Scripts/php/logout.php";
            header("Location: http://$host/BuLiTippspiel/$home");
        }else{
            $message = "Dein eingegebenes Passwort ist falsch";
               echo  "<script>
                $(document).ready(function(){
                    $('#changePassword').modal({
                    overlayClose: true, 
                    escClose: true,
                    close: true,
                    autoPosition: true, 
                    overlayCss: {
                      backgroundColor:'black'
                    }
                })});
            </script>";
        }
    }
    if(isset($_GET['user'])){
        $profile = UserController::getProfile($_GET['user']);
    }else{
        $profile = UserController::getProfile($_SESSION['user']['username']);
    }
    
?>
<div class="dialog" id="changePasswordDiv">
    <img src="<?php echo HOME_HTML.'Ressource/SimpleModal/x.png'?>" onclick="$.modal.close();" class="modalCloseImg"/>
    <h2>Passwort ändern</h2>
    <div class="errorBox"><?php if(isset($message)){echo $message;} ?></div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="changePassword">
        <ul>
            <li>Bestätige dein altes Passwort:</li>
            <li><input type="password" name="oldPassword" /></li>
            <li>Gib dein neues Passwort ein:</li>
            <li><input type="password" name="newPassword" /></li>
            <li>Bestätige dein neues Passwort:</li>
            <li><input type="password" name="confirmNewPassword" /></li>
            <li><button type="submit" name="changePassword">Passwort ändern</button></li>
        </ul>
    </form>
</div>
<div class="dialog" id="confirmUserDelete">
    <img src="<?php echo HOME_HTML.'Ressource/SimpleModal/x.png'?>" onclick="$.modal.close();" class="modalCloseImg"/>
    <h2>Bist du sicher dass du deinen Account löschen möchtest?</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="deleteUAccount">
        <button type="submit" name="deleteAccount">fortfahren</button>
    </form>
</div>
<div class="dialog" id="successChangePass">
    <img src="<?php echo HOME_HTML.'Ressource/SimpleModal/x.png'?>" onclick="$.modal.close();" class="modalCloseImg"/>
    <h2>Du hast dein Passwort erfolgreich geändert!</h2>
</div>
<div class="dialog" id="failChangePass">
    <img src="<?php echo HOME_HTML.'Ressource/SimpleModal/x.png'?>" onclick="$.modal.close();" class="modalCloseImg"/>
    <h2>Dein Passwort konnte nicht zurückgesetzt werden, bitte kontaktiere unsern Administrator unter admin@theweblab.de</h2>
</div>
<div class="dialog" id="failDeleteAccount">
    <img src="<?php echo HOME_HTML.'Ressource/SimpleModal/x.png'?>" onclick="$.modal.close();" class="modalCloseImg"/>
    <h2>Dein Account konnte leider nicht gelöscht werden, bitte kontaktiere unsern Administrator unter admin@theweblab.de</h2>
</div>
<div id="myAccount">
    <h2>&Uuml;ber <?php echo $profile->username; if($profile->username == $_SESSION['user']['username']){?>
        <button type="button" onclick="edit()" >bearbeiten</button>
        <?php } ?></h2>
    Name: <?php echo $profile->surname." "; echo $profile->name; ?><br/>
    Wohnort: <?php echo $profile->home; ?><br/>
    Lieblingsverein: <?php echo $profile->favoriteTeam; ?><br/><br/>
    <?php echo $profile->profileText;?>
    <div class="errorBox"><?php $errorMyAccount ?></div>
</div>
<div id="myAccountEdit">
    <h2>&Uuml;ber mich</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
        Name: <?php echo $profile->surname." "; echo $profile->name; ?><br/>
        Wohnort: <input type="text" name="home" value="<?php echo $profile->home ?>" /><br/>
        Lieblingsverein: <input type="text" name="favoriteTeam" value="<?php echo $profile->favoriteTeam; ?>" /><br/><br/>
        <textarea name="profileText"><?php echo $profile->profileText;?></textarea>
        <input type="hidden" name="email" value="<?php echo $profile->email ?>" />
        <div class="buttonRight"><button type="submit" name="saveEdit">speichern</button></div>
    </form>
</div>
<?php if($profile->username == $_SESSION['user']['username']){?>
<div id="accountManagement">
    <h2>Konto verwalten</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button type="submit" name="changePicture">Profilbild &auml;ndern</button>
        <button type="button" name="changePassword" onclick="$('#changePasswordDiv').modal({
                                                                                            overlayClose: true, 
                                                                                            escClose: true,
                                                                                            close: true,
                                                                                            autoPosition: true, 
                                                                                            overlayCss: {
                                                                                              backgroundColor:'black'
                                                                                            }
                                                                                            }
        )">Passwort &auml;ndern</button>
        <?php if($_SESSION['user']['role'] != "Admin"){ ?>
        <button type="button" name="deleteAccount" onclick="$('#confirmUserDelete').modal({
                                                                                            overlayClose: true, 
                                                                                            escClose: true,
                                                                                            close: true,
                                                                                            autoPosition: true, 
                                                                                            overlayCss: {
                                                                                              backgroundColor:'black'
                                                                                            }
                                                                                            }
        )">Account l&ouml;schen</button>
        <?php } ?>
    </form>
</div>
<?php } ?>
<script type="text/javascript">
    function edit(){
        document.getElementById("myAccount").style.display = "none";
        document.getElementById("myAccountEdit").style.display = "block";
    }
    
    function feedback(id){
        $('#'+id).modal({
            overlayClose: true, 
            escClose: true,
            close: true,
            autoPosition: true, 
            overlayCss: {
              backgroundColor:'black'
            }
            }
        )
    }
</script>


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
        
    }elseif(isset($_POST['deleteAccount'])){
        UserController::deleteUser($_SESSION['user']['email']);
    }else{
        $profile = UserController::getProfile($_GET['user']);
    }
    
?>
<div id="myAccount">
    <h2>&Uuml;ber mich <?php if($profile->username == $_SESSION['user']['username']){?>
        <button type="button" onclick="edit()" ><img src="/BundesligaTippspiel/Media/Images/Icons/shape_square_edit.png" /> bearbeiten</button>
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
        <button type="submit" name="changePassword">Passwort &auml;ndern</button>
        <button type="submit" name="deleteAccount">Account l&ouml;schen</button>
    </form>
</div>
<?php } ?>
<script type="text/javascript">
    function edit(){
        document.getElementById("myAccount").style.display = "none";
        document.getElementById("myAccountEdit").style.display = "block";
    }
</script>

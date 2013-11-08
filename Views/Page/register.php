<?php
    session_start();
    if(isset($_POST['register'])){
    	require_once '../../Scripts/php/constant.php';
        require_once HOME_PHP.'Models/User.php';
        require_once HOME_PHP.'Models/Profile.php';
        require_once HOME_PHP.'Controllers/UserController.php';
        
        //Daten auslesen und User und Profile erstellen
        $email = htmlspecialchars($_POST['email']);
        $role = "user";
        $password = crypt($_POST['password'], "wiofnon23ijiosd.!kfjo3!ddsfkj");
        $active = 0;
        $lastLogin = null;
        
        $username = htmlspecialchars($_POST['username']);
        $surname = htmlspecialchars($_POST['surname']);
        $name = htmlspecialchars($_POST['name']);
        //TODO
        $profileText = null;
		$home = null;
        $sex = null;
        $favoriteTeam = $_POST['favoriteTeam'];
        //TODO
        $picturePath = null;
        $notification = htmlspecialchars($_POST['notification']);
        //TODO
        $forecastTable = null;
        
        $profile = new Profile($username, $email, $surname, $name, $profileText, $home, $sex, $favoriteTeam, $picturePath, $notification, $forecastTable);
        $user = new User($email, $role, $password, $active, $lastLogin, $profile);
        
        if(UserController::register($user)){
            $errorRegister = "Dein Account wurde erfolgreich angelegt. Du wirst in K&uuml;rze eine Best&auml;tigungsmail erhalten, sobald du f&uuml;r das Tippspiel freigeschaltet wurdest.";
        }else{
            $errorRegister = "Deine Registrierung ist leider fehlgeschlagen, versuche es bitte erneut.";
        }
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Weblab Bundesliga Tippspiel</title>
        <?php include "../../Scripts/php/header.php" ?>
        
        <script type="text/javascript">
            function nextStep(step){
                var current = "register"+step
                var next = "register"+(step+1);
                document.getElementById(next).style.display = "inline";
                document.getElementById("register" + step).style.display = "none";
            }
            
            function previousStep(step){
                var current = "register"+step
                var previous = "register"+(step-1);
                document.getElementById(previous).style.display = "inline";
                document.getElementById("register" + step).style.display = "none";
            }
        </script>
    </head>
    <body>
    	<?php include HOME_PHP."Views/Partial/_navigation.php" ?>
        <div id="page">
            <div id="sidebarLeft">
                <?php include HOME_PHP."Views/Partial/_login.php" ?>
            </div>
            <div id="content">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div id="register">
                    <h2>Registrieren</h2>
                    <div id="register1">
                        <div id="process">
                            <div id="processLabel">Fortschritt:</div>
                            <div id="processActive"></div>
                            <div id="process2"></div>
                            <div id="process3"></div>
                            <div id="process4"></div>
                        </div><br/><br/>
                        <h3><img src="../../Media/Images/SchlossIcon.png" height="25"/>  Stammdaten & Sicherheit</h3>
                        <table>
                            <tr>
                                <td>E-Mail Adresse</td>
                                <td><input type="text" name="email" /></td>
                            </tr>
                            <tr>
                                <td>E-Mail Adresse bestätigen</td>
                                <td><input type="text" name="emailSubmit" /></td>
                            </tr>
                            <tr><td class="whitespaceTableRow"></td></tr>
                            <tr>
                                <td>Vorname</td>
                                <td><input type="text" name="surname" /></td>
                            </tr>
                            <tr>
                                <td>Nachname</td>
                                <td><input type="text" name="name" /></td>
                            </tr>
                            <tr><td class="whitespaceTableRow"></td></tr>
                            <tr>
                                <td>Passwort</td>
                                <td><input type="password" name="password" /></td>
                            </tr>
                            <tr>
                                <td>Passwort bestätigen</td>
                                <td><input type="password" name="passwordSubmit" /></td>
                            </tr>
                        </table>
                        <div class="buttonRight">
                            <button type="button" onclick="nextStep(1)">fortfahren</button>
                        </div>
                    </div>
                    <div id="register2">
                        <div id="process">
                            <div id="processLabel">Fortschritt:</div>
                            <div id="process1"></div>
                            <div id="processActive"></div>
                            <div id="process3"></div>
                            <div id="process4"></div>
                        </div><br/><br/>
                        <h3><img src="../../Media/Images/KopfIcon.png" height="25"/>  Mein Profil</h3>
                        <div id="profileImage">
                            <div class="clear">
                                <div class="left"><img src="../../Media/Images/profilbild-platzhalter.jpg" hspace="10" /></div>
                                <div>
                                    Wähle ein Bild von deiner Festplatte aus und lege es als dein Profilbild fest.
                                </div>
                            </div>
                            <div class="contentWidth"><input type="file" name="profilePicture"/></div>
                        </div><br/>
                        <table>
                            <tr>
                                <td>Benutzername</td>
                                <td><input type="text" name="username" /></td>
                            </tr>
                            <tr>
                                <td>Lieblingsverein auswählen</td>
                                <td><select class="dropdownList" name="favoriteTeam" >
                                     <option value="0"> </option>
                                     <option value="1">1. FC Nürnberg</option>
                                     <option value="2">1. FSV Mainz 05</option>
                                     <option value="3">Bayer 04 Leverkusen</option>
                                     <option value="4">Borussia Dortmund</option>
                                     <option value="5">Borussia Mönchengladbach</option>
                                     <option value="6">Eintracht Braunschweig</option>
                                     <option value="7">Eintracht Frankfurt</option>
                                     <option value="8">FC Augsburg</option>
                                     <option value="9">FC Bayern München</option>
                                     <option value="10">FC Schalke 04</option>
                                     <option value="11">Hamburger SV</option>
                                     <option value="12">Hannover 96</option>
                                     <option value="13">Hertha BSC Berlin</option>
                                     <option value="14">SC Freiburg</option>
                                     <option value="15">TSG 1899 Hoffenheim</option>
                                     <option value="16">VFB Stuttgart</option>
                                     <option value="17">VFL Wolfsburg</option>
                                     <option value="18">Werder Bremen</option>
                                </select></td>
                            </tr>
                        </table>
                        <div class="buttonRight">
                            <button type="button" onclick="previousStep(2)">zur&uuml;ck</button>
                            <button type="button" onclick="nextStep(2)">fortfahren</button>
                        </div>
                    </div>
                    <div id="register3">
                        <div id="process">
                            <div id="processLabel">Fortschritt:</div>
                            <div id="process1"></div>
                            <div id="process2"></div>
                            <div id="processActive"></div>
                            <div id="process4"></div>
                        </div><br/><br/>
                        <h3><img src="../../Media/Images/BriefIcon.png" height="25" />  Benachrichtigungen</h3>
                        <table>
                            <tr>
                                <td>Ich möchte vor jedem Spieltag benachrichtigt werden</td>
                                <td>
                                	<input type="hidden" name="notification" value="0" />
                                	<input type="checkbox" name="notification" value="1" height="40" />
                                </td>
                            </tr>
                        </table>
                        <div class="buttonRight">
                            <button type="button" onclick="previousStep(3)">zur&uuml;ck</button>
                            <button type="submit" name="register">Registrierung abschließen</button>
                        </div>
                    </div>
                    </form>
                    <div id="register4">
                        <div id="process">
                            <div id="processLabel">Fortschritt:</div>
                            <div id="process1"></div>
                            <div id="process2"></div>
                            <div id="process3"></div>
                            <div id="processActive"></div>
                        </div><br/><br/>
                        <h3><img src="../../Media/Images/HakenIcon.png" height="25" />  Registrierung abgeschlossen</h3>
                        <div>
                            <?php echo $errorRegister; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sidebarRight">
                
            </div>
        </div>
        <?php if(isset($_POST['register'])){ ?>
        <script type="text/javascript">
            document.getElementById("register4").style.display = "inline";
            document.getElementById("register1").style.display = "none";
        </script>
        <?php }?>
        <!-- Navigation Active Link Script -->
        <script>
    			var activeLink = "#navRegistrieren";
        </script>
    </body>
</html>


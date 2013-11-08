<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/BuLiTippspiel/Scripts/php/constant.php';
    require_once HOME_PHP."DB/UserDBManager.php";
    require_once HOME_PHP."Models/User.php";
    require_once HOME_PHP."Models/Profile.php";
	
	//AJAX
	if(isset($_POST['searchUsers'])){
	 	$searchString = $_POST['searchUsers'];
		$findUsers = UserController::searchUsers($searchString);
		if(!$findUsers->isEmpty()){
			UserController::generateSearchUsersResult($findUsers);
		}else{
			echo 'No result';
		}
	}
	
	if(isset($_GET['page']) && isset($_GET['rows']) && isset($_GET['sidx']) && isset($_GET['sord'])){
		UserController::getUsersJson();
	}

	
    class UserController{
        /**
         * Loggt einen Benutzer ein
         * 
         * Return: 0 wenn nicht gefunden, also Passwort falsch oder Benutzer nicht vorhanden
         * Return: 1 wenn der Account noch nicht aktiv ist
         * Return: 2 wenn Login Erfolgreich
         * 
         * Verwendet getUser und getProfile vom UserDbManager
         */
        public static function login($email, $password){
            $status = 0;
            $status = UserDBManager::checkPassword($email, $password);
            if($status == 2){
                $user = UserDBManager::getUser($email);
                $profile = UserDBManager::getProfile($email);
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['username'] = $profile->username;
                $_SESSION['user']['role'] = $user->role;
                $_SESSION['user']['favoriteTeam'] = $profile->favoriteTeam;
                
                $host = htmlspecialchars($_SERVER["HTTP_HOST"]);
                $uri  = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
                $home = "Views/Page/start.php";
				$homeAdmin = "Views/Page/Admin/userManagement.php";
				if($user->role != "Admin"){
                header("Location: http://$host/BuLiTippspiel/$home");
				}else{
					header("Location: http://$host/BuLiTippspiel/$homeAdmin");
				}
            }else{
                return $status;
            }
        }
        
        /**
         * verwendete Methoden:
         * insertUser und insertProfile vom UserDBManager
         * liefert true bei erfolgreich, andernfalls false
         */
        public static function register($user){
            if(UserDBManager::insertUser($user)){
                if(UserDBManager::insertProfile($user->profile)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
		
		/**
		 * Liest alle Benutzer des Systems in der Datenbank aus
		 * Return: - eine Liste mit Benutzern inkl. Profil(erfolgreich)
		 * 		   - eine Leere Liste
		 */
		 public static function getAllUsers(){
		 	$users = new SplDoublyLinkedList();	
		 	try{	
		 		$users = UserDBManager::getAllUsers();
				foreach( $users as $user){
					$user->profile = UserDBManager::getProfile($user->email);
				}
			}catch(exception $e){
				echo "UserController::getAllUsers() Fehler beim Benutzer auslesen";
			}
			return $users;
		 }
		 
		 /**
		  * Sperrt einen Benutzer für das System
		  * Return: - true (erfolgreich)
		  * 		- false
		  */
		 public static function lockUser($email){
		 	try{
			 	$user = UserDBManager::getUser($email);
				$user->active = 0;
				UserDBManager::updateUser($user);
			}catch(exception $e){
				return false;
			}
			return true;
		 }
		 
		 /**
		  * Schaltet einen Benutzer im System frei
		  * Return: - true (erfolgreich)
		  * 		- false
		  */
		 public static function activateUser($email){
		 	try{
			 	$user = UserDBManager::getUser($email);
				$user->active = 1;
				UserDBManager::updateUser($user);
			}catch(exception $e){
				return false;
			}
			return true;
		 }
		 
		 public static function resetPassword($email){
		 	  $password = "";
		 	  // $chars - String aller erlaubten Zahlen
			  $chars = "!#abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			  // Funktionsstart
			  srand((double)microtime()*1000000);
			  $i = 0; // Counter auf null
			  while ($i < 6) { // Schleife solange $i kleiner $length
			    // Holen eines zufälligen Zeichens
			    $num = rand() % strlen($chars);
			    // Ausf&uuml;hren von substr zum wählen eines Zeichens
			    $tmp = substr($chars, $num, 1);
			    // Anhängen des Zeichens
			    $password = $password . $tmp;
			    // $i++ um den Counter um eins zu erhöhen
			    $i++;
			  }
			  echo $password;
			  $crypedPassword =  crypt($password, "wiofnon23ijiosd.!kfjo3!ddsfkj");

			  if(UserDBManager::updatePassword($email, $crypedPassword)){
			  	return true;
			  }else{
			  	return false;
			  }
		 }
		 
		  /**
		  * Liefert alle Benutzer des Systems im Json-Format
		  */
		 public static function getUsersJson(){
		 	$users = UserController::getAllUsers();
			$jsonUser = array();
			$controll = "";
			
			foreach ($users as $user) {
				$controll = "";
				$lock = "<form action='".HOME_HTML."Views/Page/Admin/userManagement.php' method='post'>".
							"<input type='hidden' name='email' value='".$user->email."' />".
							'<button type="submit" title="Benutzer Sperren" class="adminIconButton criticalButton" name="lock"><img src="/BundesligaTippspiel/Media/Images/icons/cross.png" alt="Sperren"/></button>'.
						'</form>';
				$activate = "<form action='".HOME_HTML."Views/Page/Admin/userManagement.php' method='post'>".
							"<input type='hidden' name='email' value='".$user->email."' />".
							'<button type="submit" title="Benutzer Freischalten" class="adminIconButton criticalButton" name="activate"><img src="/BundesligaTippspiel/Media/Images/icons/accept.png" alt="Freischalten"/></button>'.
						'</form>';
				$pwdReset = "<form action='".HOME_HTML."Views/Page/Admin/userManagement.php' method='post'>".
							"<input type='hidden' name='email' value='".$user->email."' />".
						'<button type="submit" title="Passwort zurücksetzen" class="adminIconButton criticalButton" name="passwordReset"><img src="/BundesligaTippspiel/Media/Images/icons/key_add.png" alt="Passwort reset"/></button>'.
					'</form>';
				$delete = "<form action='".HOME_HTML."Views/Page/Admin/userManagement.php' method='post'>".
							"<input type='hidden' name='email' value='".$user->email."' />".
						'<button type="submit" title="Benutzer Löschen" class="adminIconButton criticalButton" name="delete"><img src="/BundesligaTippspiel/Media/Images/icons/delete.png" alt="Löschen"/></button>'.
					'</form>';
				if($user->role == "Admin"){
					$controll = "";
				}else if($user->active == 1){
					$controll = $controll.$lock.$delete.$pwdReset ;
				}else if($user->active == 0){
					$controll = $controll.$activate.$delete.$pwdReset ;
				}
				$jsonUser[] = array("email"=>$user->email, "username"=>$user->profile->username, "role"=>$user->role, "active"=>$user->active,
				"controll"=>$controll);
					
			}
		 	echo json_encode($jsonUser);
		 }
		 
		 
		 public static function searchUsers($searchString){
		 	$users = null;
		 	try{
		 		$users = UserDBManager::searchUsers($searchString);
			}catch(exception $e){
				echo "Fehler searchUserDB";
			}
			return $users;
		 }
        
        /**
         * gibt einen User und das zugehörige Profil mit allen Daten aus der Datenbank zurück
         */
        public static function getUser($email){
            $user = UserDBManager::getUser($email);
            $user->profile = UserDBManager::getProfile($email);
            return $user;
        }
        
        /**
         * Sucht eine Email zum gegebenen Benutzernamen und gibt das zugehörige Profil zurück
         */
        public static function getProfile($username){
            $email = UserDBManager::getEmail($username);
            $profile = UserDBManager::getProfile($email);
            return $profile;
        }
        
        public static function editProfile($profile){
            return UserDBManager::updateProfile($profile);
        }
        
        /**
         * löscht einen Benutzer aus der Datenbank und den dazugehörigen Relationen
         */
        public static function deleteUser($email){
            return UserDBManager::deleteUser($email);
        }
    }

<?php
    include HOME_PHP."DB/DBData.php";
    require_once HOME_PHP."Models/User.php";
    require_once HOME_PHP."Models/Profile.php";
    class UserDBManager{
    	
    	public static function getEmail($username){
            $mysqli = connect();
            
            $query = "SELECT email FROM Profile WHERE username = ?";
            $stmt = $mysqli->prepare($query);

            $stmt->bind_param("s", $username);
            if(!$stmt->execute()){
                echo $mysqli->error;
            }
            $stmt->bind_result($email);
            
            $resultEmail = null;
            if($stmt->fetch()){
                $resultEmail = $email;
            }
            
            $mysqli->close();
            
            return $resultEmail;
        }
        /**
         * Überprüft die Login Daten in der Datenbank.
         * Return: 0 wenn nicht gefunden, also Passwort falsch oder Benutzer nicht vorhanden
         * Return: 1 wenn der Account noch nicht aktiv ist
         * Return: 2 wenn Login Erfolgreich
         */
        public static function checkPassword($email, $password){
            $mysqli = connect();
            
            $query = "SELECT active FROM user".
                     " WHERE email=? AND password=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ss", $email, $password);
            if(!$stmt->execute()){
                echo $mysqli->error;
            }
            $stmt->bind_result($active);
            
            
            //TODO Last Login speichern aktuelle Zeit-->$datetime = (date('Y-m-d H:i:s'));
            
            $status = 0;
            if($stmt->fetch()){
                if($active){
                    $status = 2;
                }else{
                    $status = 1;
                }
            }
            
            $mysqli->close();
            return $status;
        }
        
        public static function getUser($email){
            $mysqli = connect();
            
            $query = "SELECT * FROM User WHERE email = ?";
            $stmt = $mysqli->prepare($query);

            $stmt->bind_param("s", $email);
            if(!$stmt->execute()){
                echo $mysqli->error;
            }
            $stmt->bind_result($email, $role, $password, $active, $lastLogin);
            
            $user = null;
            if($stmt->fetch()){
                $user = new user($email, $role, null, $active, $lastLogin);
            }
            $mysqli->close();
            return $user;
        }
        
        public static function insertUser($user){
            $mysqli = connect();
            
            $query = "INSERT INTO User ".
                     " VALUES(?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);

            $stmt->bind_param("sssis", $user->email, $user->role, $user->password, $user->active, $user->lastLogin);
            
            $success = true;
            try{
                $stmt->execute();
            }catch(exception $e){
                echo $mysqli->error;
                $succes = false;
            }
            $mysqli->close();
            return $success;
        }
		
		public static function deleteUser($email){
            $mysqli = connect();
            
            $query = "DELETE FROM User WHERE email = ?";
            $stmt = $mysqli->prepare($query);

            $stmt->bind_param("s", $email);
            $success= true;
            if(!$stmt->execute()){
                echo $mysqli->error;
                $success = false;
            }

            $mysqli->close();
            return $success;
        }
        
        public static function getProfile($email){
            $mysqli = connect();
            
            $query = "SELECT * FROM profile WHERE email = ?";
            $stmt = $mysqli->prepare($query);

            $stmt->bind_param("s", $email);
            if(!$stmt->execute()){
                echo $mysqli->error;
            }
            $stmt->bind_result($username, $email, $surname, $name, $profileText, $home, $sex, $favoriteTeam, $picturePath, $notification, $forecastTable);
            
            $profile = null;
            if($stmt->fetch()){
                $profile = new profile($username, $email, $surname, $name, $profileText, $home, $sex, $favoriteTeam, $picturePath, $notification, $forecastTable);
            }
            
            $mysqli->close();
            
            return $profile;
        }
        
        public static function insertProfile($profile){
            $mysqli = connect();
            
            $query = "INSERT INTO Profile ".
                     " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);

            $stmt->bind_param("ssssssissis", $profile->username, $profile->email, $profile->surname, $profile->name, $profile->profileText, $profile->home, $profile->sex, $profile->favoriteTeam, 
                                       $profile->picturePath, $profile->notification, $profile->forecastTable);
                                       
            $success = true;
            try{
                $stmt->execute();
            }catch(exception $e){
                echo $mysqli->error;
                $succes = false;
            }
            $mysqli->close();
            return $success;
        }
		
		public static function updateProfile($profile){
            $mysqli = connect();
            
            $query = "UPDATE Profile ".
                     " SET username  = ?, surname = ?, name = ?, profileText = ?, home = ?, sex = ?, favoriteTeam = ?, picturePath = ?, notification = ?, forecastTable = ?
                       WHERE email = ?";
            $stmt = $mysqli->prepare($query);

            $stmt->bind_param("sssssississ", $profile->username, $profile->surname, $profile->name, $profile->profileText, $profile->home, $profile->sex, $profile->favoriteTeam, 
                                       $profile->picturePath, $profile->notification, $profile->forecastTable, $profile->email);
                                       
            $success = true;
            try{
                $stmt->execute();
            }catch(exception $e){
                echo $mysqli->error;
                $succes = false;
            }
            $mysqli->close();
            return $success;
        }
		
		public static function getAllUsers(){
			$mysqli = connect();

            $query = "SELECT * FROM USER";
            $stmt = $mysqli->prepare($query);

            if(!$stmt->execute()){
                echo $mysqli->error;
            }
            $stmt->bind_result($email, $role, $password, $active, $lastLogin);
            
            $users = new SplDoublyLinkedList();
            while($stmt->fetch()){
                $user = new user($email, $role, null, $active, $lastLogin);
				$users->push($user);
				
            }
            
            $mysqli->close();
            
            return $users;
		}
		
		/**
		 * Aktiualisiert einen Benutzer (Rolle, Active, LastLogin)
		 * Pre: E-Mail muss im übergebenen User vorhanden sein.
		 * Return - true (erfolgreich)
		 * 		  - false
		 */
		public static function updateUser($user){
			$mysqli = connect();
            
            $query = "UPDATE USER SET role=?, active=?, lastLogin=? WHERE email=?";
            $stmt = $mysqli->prepare($query);
			$stmt->bind_param("siss", $user->role, $user->active, $user->lastLogin, $user->email);
			
            if(!$stmt->execute()){
                echo $mysqli->error;
				return false;
           }
            
            $mysqli->close();
            
            return true;
		}
		
		/**
		 * Ändert das Passwort eines Benutzers
		 * Return: - true (Erfolgreich)
		 * 		   - false
		 */
		public static function updatePassword($email, $password){
			$mysqli = connect();
            
            $query = "UPDATE USER SET password=? WHERE email=?";
            $stmt = $mysqli->prepare($query);
			$stmt->bind_param("ss", $password, $email);
			
            if(!$stmt->execute()){
                echo $mysqli->error;
				return false;
           }
            
            $mysqli->close();
            
            return true;
		}
		
		/**
		 * Sucht nach Benutzer im System anhand eines Such-Strings
		 * 
		 * Der Such-String deckt alle Attribute von User ab bis auf das Passwort
		 * 
		 * Return: - Liste von Usern
		 * 		   - Leere Liste 
		 */
		public static function searchUsers($searchString){
			echo$searchString;
			$searchString = "%" . $searchString . "%";
			$searchInt = 0;
			$mysqli = connect();
            
            $query = "SELECT User.email, User.role, User.active, User.lastLogin, Profile.username FROM User JOIN Profile ON ".
            " User.email = Profile.email WHERE email like ?";
			
            $stmt = $mysqli->prepare($query);
			$stmt->bind_param("s", $searchString);

            if(!$stmt->execute()){
                echo $mysqli->error;
            }
            $stmt->bind_result($email, $role, $password, $active, $lastLogin);
            
            $users = new SplDoublyLinkedList();
            while($stmt->fetch()){
                $user = new user($email, $role, $active, $lastLogin, $username);
				$users->push($user);
            }
            
            $mysqli->close();
            
            return $users;
		}
    }
?>
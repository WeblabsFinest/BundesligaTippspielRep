<?php
    class Profile{
    	public $username;
        public $email;
        public $surname;
        public $name;
		public $profileText;
		public $home;
        public $sex;
        public $favoriteTeam;
        public $picturePath;
        public $notification;
        public $forecastTable;
        
        public function __construct($username, $email, $surname = null, $name = null, $profileText = null, $home = null, $sex = null, $favoriteTeam = null, $picturePath = null, $notification = null, $forecastTable = null){
            $this->username = $username;	
            $this->email = $email;
            $this->surname = $surname;
            $this->name = $name;
			$this->profileText = $profileText;
			$this->home = $home;
            $this->sex = $sex;
            $this->favoriteTeam = $favoriteTeam;
            $this->picturePath = $picturePath;
            $this->notification = $notification;
            $this->forecastTable = $forecastTable;
        }
    }
?>
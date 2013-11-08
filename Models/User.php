<?php
    class User{
        public $email;
        public $role;
        public $password;
        public $active;
        public $lastLogin;
        public $profile;
        
        public function __construct($email, $role, $password, $active = false, $lastLogin = null, $profile = null){
            $this->email = $email;
            $this->role = $role;
            $this->password = $password;
            $this->active = $active;
            $this->lastLogin = $lastLogin;
            $this->profile = $profile;
        }
    }
?>
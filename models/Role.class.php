<?php
    class Role {
        private $_role;
        private $_nameRole;
        
        public function __construct($role, $nameRole) {
            $this->_role = $role;
            $this->_nameRole = $nameRole;
        }
        
        public function getRole() {
            return $this->_role;
        }
        
        public function getNameRole() {
            return $this->_nameRole;
        }
        
        public function setRole($role) {
            $this->_role = $role;
        }
        
        public function setNameRole($nameRole) {
            $this->_nameRole = $nameRole;
        }
    }
?>
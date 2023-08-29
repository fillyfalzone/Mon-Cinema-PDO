<?php
    class Role {
        private $_role;
        private $_roleName;
        
        public function __construct($role, $roleName) {
            $this->_role = $role;
            $this->_roleName = $roleName;
        }
        
        public function getRole() {
            return $this->_role;
        }
        
        public function getRoleName() {
            return $this->_roleName;
        }
        
        public function setRole($role) {
            $this->_role = $role;
        }
        
        public function setRoleName($roleName) {
            $this->_roleName = $roleName;
        }
    }
?>
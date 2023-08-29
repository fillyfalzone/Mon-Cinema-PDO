<?php
    require_once "Role.class.php";
    require_once "app/DAO.php";


    class RolesManager extends DAO {
        private $_roles;
        private $_rolesLoaded = false;

        public function addRole($role){
            if(! in_array($role,$this->_roles)){
                $this->_roles[] = $role;
            }
        }

        public function getRoles() {
            return $this->_roles;
        }

        public function loadRoles() {

            $sql = $this->getBdd()->prepare("SELECT * FROM role;");
            $sql->execute();
            $myRoles = $sql->fetchAll(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            $this->_roles = [];

            foreach ($myRoles as $role){
                $this->_roles[] = new Role($role['id_role'], $role['role_name']);
            }

            $this->_rolesLoaded = true;

        }

        public function getRoleById(int $id) {
            $count = count($this->_roles);
            for ($i = 0; $i < $count; $i++) {
                if ($this->_roles[$i]->getIdRole() === $id) {
                    return $this->_roles[$i];
                }
            }
            throw new Exception("Role not found.");
        }

        
    }

?>
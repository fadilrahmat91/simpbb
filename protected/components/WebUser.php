<?php

class WebUser extends CWebUser {

    private $_model;

    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params = array()) {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $role = $this->getState("roles");
        if ($role == '3') {
            return true; // admin role has access to everything
        }
        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }

    protected function loadUser($id = null) {
        if ($this->_model === null) {
            if ($id !== null)
                $this->_model = User::model()->findByPk($id);
        }
        return $this->_model;
    }

    function getDomain() {
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->iddomain;
    }

    public function afterLogin($fromCookie) {
        $user = User::model()->findByPk($this->id);
        $user->lastlogintime = date('Y-m-d H:i:s');
        $user->saveAttributes(array('lastlogintime'));
        return parent::afterLogin($fromCookie);
    }
    public function beforeLogout(){
        $user = User::model()->findByPk($this->id);
        $user->lastlogintime = date('Y-m-d H:i:s');
        $user->saveAttributes(array('lastlogintime'));
        return parent::beforeLogout();
    }
}

<?php 

class WebUser extends CWebUser 
{
    private $_model = null;
 
    function getRole() 
    {
        if ($account = $this->getModel())
        {
            // в таблице UserStatus есть поле name - имя роли
            return UserStatus::model()->findByPk($account->status_id)->name ;
        }
    }
 
    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null)
        {
            $this->_model = Account::model()->findByPk($this->id, array('select' => 'status_id'));
        }
        return $this->_model;
    }
} 

?>

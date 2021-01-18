<?php
namespace Ced\Emp\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;

/*
Our resource class extends from \Magento\Eav\Model\Entity\AbstractEntity, 
and set $this->_read, $this->_write class properties  in _construct() method 
*/
class Emppost extends AbstractEntity {
    protected function _construct() {
        $this->_read = 'ced_emp_read';
        $this->_write = 'ced_emp_write';
    }

    public function getEntityType() {
        if(empty($this->_type)) {
            $this->setType(\Ced\Emp\Model\Emppost::ENTITY);
        }
        return parent::getEntityType();
    }
}

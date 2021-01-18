<?php
namespace Ced\Emp\Model\ResourceModel\Emppost;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct() {
        /* Full model classname, full resource classname */
        $this->_init(
            'Ced\Emp\Model\Emppost',
            'Ced\Emp\Model\ResourceModel\Emppost');
        
    }
}
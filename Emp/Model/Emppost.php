<?php
namespace Ced\Emp\Model;

use Magento\Framework\Model\AbstractModel;

class Emppost extends AbstractModel {
    const ENTITY = 'emp';

    protected function _construct() {
        /* full resource classname */
        $this->_init('Ced\Emp\Model\ResourceModel\Emppost');
    }
}
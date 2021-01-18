<?php
namespace Ced\Brand\Model;
class Brandpost extends \Magento\Framework\Model\AbstractModel 
{
	/**
     * Define resource model
     */
	protected function _construct()
	{
		$this->_init('Ced\Brand\Model\ResourceModel\Brandpost');
	}

	
}

<?php
namespace Ced\Slider\Model;
class Sliderpost extends \Magento\Framework\Model\AbstractModel 
{
	/**
     * Define resource model
     */
	protected function _construct()
	{
		$this->_init('Ced\Slider\Model\ResourceModel\Sliderpost');
	}

	
}

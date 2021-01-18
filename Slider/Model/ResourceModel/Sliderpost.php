<?php
namespace Ced\Slider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Sliderpost extends AbstractDb
{
	 /**
     * Define main table
     */
	protected function _construct()
	{
		$this->_init('slider_table', 'slider_id');
	}
}

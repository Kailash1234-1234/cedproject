<?php
namespace Ced\Brand\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Brandpost extends AbstractDb
{
	 /**
     * Define main table
     */
	protected function _construct()
	{
		$this->_init('brand_table', 'brand_id');
	}
}

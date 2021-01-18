<?php
namespace Ced\Brand\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Branddeletepost extends AbstractDb
{
	 /**
     * Define main table
     */
	protected function _construct()
	{
		$this->_init('brand_delete_table', 'brand_delete_id');
	}
}

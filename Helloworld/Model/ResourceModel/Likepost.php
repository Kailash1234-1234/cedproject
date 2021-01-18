<?php
namespace Ced\Helloworld\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Likepost extends AbstractDb
{
	 /**
     * Define main table
     */
	protected function _construct()
	{
		$this->_init('like_table', 'like_table_id');
	}
}

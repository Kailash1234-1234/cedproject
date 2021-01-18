<?php

namespace Ced\Brand\Model\ResourceModel\Brandpost;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Ced\Brand\Model\Brandpost', 'Ced\Brand\Model\ResourceModel\Brandpost');
	}

}


?>
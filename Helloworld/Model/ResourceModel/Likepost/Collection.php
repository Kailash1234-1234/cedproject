<?php

namespace Ced\Helloworld\Model\ResourceModel\Likepost;

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
		$this->_init('Ced\Helloworld\Model\Likepost', 'Ced\Helloworld\Model\ResourceModel\Likepost');
	}

}


?>
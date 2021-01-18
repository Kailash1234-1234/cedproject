<?php

namespace Ced\Slider\Model\ResourceModel\Sliderpost;

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
		$this->_init('Ced\Slider\Model\Sliderpost', 'Ced\Slider\Model\ResourceModel\Sliderpost');
	}

}


?>
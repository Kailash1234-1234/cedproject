<?php

namespace Ced\Brand\Controller\Adminhtml\Createmenu\Index;

class Config extends \Magento\Framework\App\Action\Action
{

	protected $helperData;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Ced\Brand\Helper\Data $helperData

	)
	{
		$this->helperData = $helperData;
		return parent::__construct($context);
	}

	public function execute()
	{

		// TODO: Implement execute() method.

		 $this->helperData->getGeneralConfig('enable');
		 $this->helperData->getGeneralConfig('display_text');
		exit();

	}
}
<?php

  
namespace Ced\Helloworld\Controller\Product;
  
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ced\Helloworld\Model\LikepostFactory;
  
class Listlikepost extends Action
{
    /**
     * @var \Emipro\HelloWorld\Model\LikepostFactory
     */
    protected $_modelLikepostFactory;
  
    /**
     * @param Context $context
     * @param LikepostFactory $modelLikepostFactory
     */
    public function __construct(
        Context $context,
        LikepostFactory $modelLikepostFactory
    ) {
        parent::__construct($context);
        $this->_modelLikepostFactory = $modelLikepostFactory;
    }
    public function execute()
    {
        $likepostModel = $this->_modelLikepostFactory->create();
        // Get sample collection
      $likepostCollection = $likepostModel->getCollection();
        // Load all data of collection
       return var_dump($likepostCollection->getData());
    }
}
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\PhtmlForm\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Cache extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_adminSession;

    /**
     * @var \Rh\Blog\Model\BrandpostFactory
     */
    protected $brandpostCollectionFactory;

    /**
     * @param Action\Context                      $context
     * @param \Magento\Backend\Model\Auth\Session $adminSession
     * @param \Rh\Blog\Model\BrandpostFactory          $employeeFactory
     */
    public function __construct(
        Action\Context $context,
        \Ced\Brand\Model\ResourceModel\Brandpost\CollectionFactory $brandpostCollectionFactory,
        \Magento\Framework\App\CacheInterface $cacheType
    ) {
        parent::__construct($context);
        $this->brandpostCollectionFactory=$brandpostCollectionFactory;
        $this->_cacheType = $cacheType;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    { 
            $cacheData = $this->brandpostCollectionFactory->create();
            $cacheData->getData();
            $cacheKey= \Ced\PhtmlForm\Model\Cache\Type::CACHE_KEY;
            $this->_cacheType->save(
            serialize($cacheData),
            $cacheKey,
            [\Ced\PhtmlForm\Model\Cache\Type::CACHE_TAG], 
            6);
            $resultRedirect= $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('phtmlform/index/index');
    }
}
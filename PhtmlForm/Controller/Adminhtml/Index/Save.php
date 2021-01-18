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

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_adminSession;

    /**
     * @var \Rh\Blog\Model\BrandpostFactory
     */
    protected $brandpostFactory;

    /**
     * @param Action\Context                      $context
     * @param \Magento\Backend\Model\Auth\Session $adminSession
     * @param \Rh\Blog\Model\BrandpostFactory          $employeeFactory
     */
    public function __construct(
        Action\Context $context,
        \Ced\Brand\Model\BrandpostFactory $brandpostFactory,
        \Ced\Brand\Model\ResourceModel\Brandpost $brandpostResource
    ) {
        parent::__construct($context);
        $this->brandpostFactory = $brandpostFactory;
        $this->brandpostResource = $brandpostResource;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // die('check');
        $PostValue = $this->getRequest()->getPost();
       // print_r($PostValue);


         $data = $PostValue['brand_name'];
         $country = implode(",",$PostValue['country']);
        // die();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($PostValue) {
            $model = $this->brandpostFactory->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
          
            $model->setData([
                   'brand_name' => $PostValue['brand_name'],
                   'country' => $country
                   ]);
         
            // die(__FILE__);
            try {
                $this->brandpostResource->save($model);
                // $model->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('phtmlform/index/index', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('phtmlform/index/index');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('phtmlform/index/index', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
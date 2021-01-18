<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\BlockForm\Controller\Adminhtml\Grid;

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
        $data = $this->getRequest()->getPostValue();
        $file = $this->getRequest()->getFiles();

        // echo $name, $code, $email, $mobile;
        // die();
        // $date = date("Y-m-d");
        // echo "<pre>";
       
       // print_r($data);
        // die();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->brandpostFactory->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
          
               $model->setData([
                   'brand_name' => $data['brand_name'],
                   'brand_image' => $file['brand_image']['name']
                   ]);
          
            // die(__FILE__);
            try {
                $this->brandpostResource->save($model);
                $this->messageManager->addSuccess(__('The data has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('blockform/grid/new', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('blockform/grid/new');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}